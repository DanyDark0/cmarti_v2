<?php

namespace App\Http\Controllers;

use illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Documentos;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class DocumentosController extends Controller
{
    function truncateHtml($html, $limit = 100)
    {
        $text = strip_tags($html); // Quita las etiquetas HTML
        $truncated = Str::limit($text, $limit); // Aplica el límite
        return $truncated;
    }
    public function search_documento(Request $request) {

        $query = $request->input('keyword');
        $documentos = Documentos::search($query)->paginate(24);
        foreach ($documentos as $documento) {
            $documento->descripcion = $request->descripcion;
        }
        return view ("documentos.search" , compact('documentos', 'query'));
    }   

    public function BuscadorAdminDocumentos(Request $request){
        $mensajes = [
            'keyword.required' => 'Se requiere agregar un texto.',
            'keyword.string' => 'El dato a buscar debe ser un texto.',
            'keyword.min' => 'Su busqueda debe contener minimo 3 caracteres.',
        ];

        $validator = Validator::make($request->all(), [
            'keyword' => 'required|string|min:3',
        ],$mensajes);

        if ($validator->fails()) {
            return redirect()->route('documentos.admin') // Cambia por la ruta de tu formulario
                ->withErrors($validator) // Enviar errores a la vista
                ->withInput();
        }

            // Obtener el término de búsqueda
            $query = $request->input('keyword');
        // Realizar la búsqueda con Scout
        $documentos = Documentos::search($query)->paginate(6);

        $totalResultados = $documentos->total();

            // Devolver los resultados a la vista, junto con el término de búsqueda
    return view('documentos.resultados_admin', [
        'documentos' => $documentos,
        'query' => $query, // Pasar el término de búsqueda para mostrarlo en el input
        'totalResultados' => $totalResultados
    ]);
    }

    public function index() {
        $documentos = Documentos::paginate(8);
        return view('documentos.index', compact('documentos'));
    }

    public function admin() {
        
        $documentos = Documentos::paginate(10);
        return view('documentos.admin', compact('documentos'));
    }

    public function create() {
        return view('documentos.create');
    }

    public function store(Request $request) {

        $documento = new Documentos();

        $validator = Validator::make($request->all(), [
            'titulo' => ['required', 'string', 'max:255', Rule::unique('documentos')->ignore($documento->id)->whereNull('deleted_at'),],
            'descripcion' => 'required|string',
            'doc1' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx',
            'doc2' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx',
        ], [
            'titulo.required' => 'El título es obligatorio.',
            'titulo.unique' => 'El título ya está en uso. Prueba con otro.',
            'descripcion.required' => 'Agregue una descripción.',
            'doc1.required' => 'Agrega minimo un documento',
            'doc1.mimes' => 'El documento 1 debe ser de extension pdf,doc,docx,xls,xlsx,ppt,pptx',
            'doc2.mimes' => 'El documento 1 debe ser de extension pdf,doc,docx,xls,xlsx,ppt,pptx',

        ]);

                
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $documento->titulo = $request->titulo;
        $documento->descripcion = $request->descripcion;
        $documento->slug = Str::slug($request->titulo, '-');
        $documento->save();

        // Lógica para asegurarse que si doc2 es enviado, se toma como doc1
        if ($request->hasFile('doc2')) {
            $request->merge(['doc1' => $request->file('doc2')]);
        }

            // Guardar archivos con nombre original
            if ($request->hasFile('doc1')) {
                $file = $request->file('doc1');
                $fileName = $documento->id . '_' . $file->getClientOriginalName();
                $file->storeAs('documentos', $fileName, 'public');
                $documento->doc1 = "storage/documentos/$fileName";
            }
    
            if ($request->hasFile('doc2')) {
                $file = $request->file('doc2');
                $fileName = $documento->id . '_' . $file->getClientOriginalName();
                $file->storeAs('documentos', $fileName, 'public');
                $documento->doc2 = "storage/documentos/$fileName";
            }   
            $documento->save();

            return redirect()->route('documentos.admin')->with('success', 'Documentos guardados correctamente');
            }
    public function show($slug)
    {
    // Buscar la documento por el Slug
    $documento = Documentos::where('slug', $slug)->firstOrFail();
    // Retornar la vista con la documento encontrada
    // Obtener los documentos adjuntos relacionados
    // $documentos_actividad = Documentos::where('id', $documento->id)->get();
        return view('documentos.show', compact('documento'));
    }

    public function edit($slug)
    {
        // Buscar la documento por el Slug
        $documento = Documentos::where('slug', $slug)->firstOrFail();
        // Retornar la vista con la documento encontrada
        return view('documentos.edit', compact('documento'));
    }

    public function update(Request $request, $slug) {

        $documento = Documentos::where('slug', $slug)->firstOrFail();

        $validator = Validator::make($request->all(), [
        'titulo' => [
            'required',
            'string',
            'max:255',
            Rule::unique('documentos')->ignore($documento->id)->whereNull('deleted_at'),
        ],
            'descripcion' => 'nullable|string',
            'doc1' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx',
            'doc2' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx',
        ], [
            'titulo.required' => 'El título es obligatorio.',
            'titulo.unique' => 'El título ya está en uso. Prueba con otro.',
            'descripcion.required' => 'Agregue una descripción.',
            'doc1.mimes' => 'El documento 1 debe ser de extension pdf,doc,docx,xls,xlsx,ppt,pptx',
            'doc2.mimes' => 'El documento 1 debe ser de extension pdf,doc,docx,xls,xlsx,ppt,pptx',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $documento->titulo = $request->titulo;
        $documento->descripcion = $request->descripcion;
        $documento->save();

                // Actualizar archivos
                if ($request->hasFile('doc1')) {
                    if ($documento->doc1 && file_exists(storage_path('app/public/' . str_replace('storage/', '', $documento->doc1)))) {
                        unlink(storage_path('app/public/' . str_replace('storage/', '', $documento->doc1)));
                    }

                    $file = $request->file('doc1');
                    $fileName = $documento->id . '_' . $file->getClientOriginalName();
                    $file->storeAs('documentos', $fileName, 'public');
                    $documento->doc1 = "storage/documentos/$fileName";
                }
        
                if ($request->hasFile('doc2')) {
                    if ($documento->doc2 && file_exists(storage_path('app/public/' . str_replace('storage/', '', $documento->doc2)))) {
                        unlink(storage_path('app/public/' . str_replace('storage/', '', $documento->doc2)));
                    }
                    
                    $file = $request->file('doc2');
                    $fileName = $documento->id . '_' . $file->getClientOriginalName();
                    $file->storeAs('documentos', $fileName, 'public');
                    $documento->doc2 = "storage/documentos/$fileName";
                }

                $documento->save();

                return redirect()->route('documentos.admin')->with('success', 'Documentos actualizados correctamente');
    }

    public function destroy($id) {
        $documento = Documentos::findOrFail($id);

    // Verificar si el documento tiene archivos asociados (doc1 y doc2)
    if ($documento->doc1) {
        // Obtener la ruta del archivo doc1
        $filePathDoc1 = public_path($documento->doc1);

        // Verificar si el archivo doc1 existe y eliminarlo
        if (file_exists($filePathDoc1)) {
            unlink($filePathDoc1);
        }
    }

    if ($documento->doc2) {
        // Obtener la ruta del archivo doc2
        $filePathDoc2 = public_path($documento->doc2);

        // Verificar si el archivo doc2 existe y eliminarlo
        if (file_exists($filePathDoc2)) {
            unlink($filePathDoc2);
        }
    }
        $documento->delete();
        return redirect()->route('documentos.admin')->with('success', 'Documentos eliminados correctamente');
    }
 }

