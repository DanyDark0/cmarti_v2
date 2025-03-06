<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Actividad;
use illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
class actividadesController extends Controller
{

    public function search_actividad(Request $request) {

        $query = $request->input('keyword');

        $actividades = Actividad::search($query)->paginate(24);
        foreach ($actividades as $actividad) {
            $actividad->descripcion_truncado = $this->truncateHtml($actividad->descripcion, 100);
        }

        return view ("actividades" , compact('actividades', 'query'));
    }

    function truncateHtml($html, $limit = 100)
    {
        $text = strip_tags($html); // Quita las etiquetas HTML
        $truncated = Str::limit($text, $limit); // Aplica el límite
        return $truncated;
    }

    public function admin()
    {
        $actividades = Actividad::paginate(10);
        foreach ($actividades as $actividad) {
            $actividad->descripcion_truncado = $this->truncateHtml($actividad->descripcion, 100);
        }
        return view('actividades.admin', compact('actividades'));
    }
    public function index()
    {
        $actividades = Actividad::paginate(6);
        //return response()->json($actividades);
        foreach ($actividades as $actividad) {
            $actividad->descripcion_truncado = $this->truncateHtml($actividad->descripcion, 100);
        }
        return view('actividades.index', compact('actividades'));
    }

    public function create()
    {
        return view('actividades.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'url_img1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'url_img2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'archivo1' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:5120',
            'archivo2' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:5120',
            'fecha' => 'nullable|date',
            'noticia' => 'nullable|boolean',
        ]);

        $actividad = new Actividad();
        $actividad->titulo = $request->titulo;
        $actividad->descripcion = $request->descripcion;
        $actividad->fecha = $request->fecha;
        $actividad->noticia = $request->has('noticia');

        if ($request->hasFile('url_img1')) {
            $fileName = Str::slug($request->titulo) . '-' . 'imagen1' . '-' . now()->timestamp . '.' . $request->file('url_img1')->getClientOriginalExtension();
            $request->file('url_img1')->storeAs('image', $fileName); // Guardar en storage/app/image
            $actividad->url_img1 = "image/$fileName";
        }

        if ($request->hasFile('url_img2')) {
            $fileName = Str::slug($request->titulo) . '-' . 'imagen2' . '-' . now()->timestamp . '.' . $request->file('url_img2')->getClientOriginalExtension();
            $request->file('url_img2')->storeAs('image', $fileName);
            $actividad->url_img2 = "image/$fileName";
        }

        if ($request->hasFile('archivo1')) {
            $fileName = Str::slug($request->titulo) . '-' . 'archivo1' . '-' . now()->timestamp . '.' . $request->file('archivo1')->getClientOriginalExtension();
            $request->file('archivo1')->storeAs('files', $fileName); // Guardar en storage/app/files
            $actividad->archivo1 = "files/$fileName";
        }

        if ($request->hasFile('archivo2')) {
            $fileName = Str::slug($request->titulo) . '-' . 'archivo1' . '-' . now()->timestamp . '.' . $request->file('archivo2')->getClientOriginalExtension();
            $request->file('archivo2')->storeAs('files', $fileName);
            $actividad->archivo2 = "files/$fileName";
        }

        //dd($request->all());
        $actividad->save();
        //return response()->json(['message' => 'Actividad creada correctamente', 'actividad' => $actividad], 201);
        return redirect()->route('actividades.admin')->with('success', 'Actividad creada correctamente');
    }

    public function edit($id)
    {
        $actividad = Actividad::findOrFail($id);
        return view('actividades.edit', compact('actividad'));
    }
    public function show($id)
    {
        // Buscar la actividad por ID
        $actividad = Actividad::findOrFail($id);

        // Retornar la vista con la actividad encontrada
        return view('actividades.show', compact('actividad'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'url_img1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'url_img2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'archivo1' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:5120',
            'archivo2' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:5120',
            'fecha' => 'nullable|date',
            'noticia' => 'nullable|boolean',
        ]);

        $actividad = Actividad::findOrFail($id);
        $actividad->titulo = $request->titulo;
        $actividad->descripcion = $request->descripcion;
        $actividad->fecha = $request->fecha;
        $actividad->noticia = $request->has('noticia'); // Guarda como true o false


        // Actualizar imágenes
        $actividad->url_img1 = $this->actualizarArchivo($request->file('url_img1'), $request->titulo, 'image', 'url_img1', $actividad, identificador: 'imagen1');
        $actividad->url_img2 = $this->actualizarArchivo($request->file('url_img2'), $request->titulo, 'image', 'url_img2', $actividad, identificador: 'imagen2');

        // Actualizar archivos
        $actividad->archivo1 = $this->actualizarArchivo($request->file('archivo1'), $request->titulo, 'files', 'archivo1', $actividad, identificador: 'archivo1');
        $actividad->archivo2 = $this->actualizarArchivo($request->file('archivo2'), $request->titulo, 'files', 'archivo2', $actividad, identificador: 'archivo2');

        $actividad->save();

        return redirect()->route('actividades.admin')->with('success', 'Actividad actualizada correctamente');
    }
   function actualizarArchivo($file, $titulo, $carpeta, $campo, $modelo, $identificador)
    {
        if ($file) {
            if ($modelo->$campo) {
                Storage::delete('storage/' . $modelo->$campo);
            }
            $fileName = Str::slug($titulo) . '-' . $identificador . '-' . now()->timestamp . '.' . $file->getClientOriginalExtension();
            $file->storeAs($carpeta, $fileName);
            return "$carpeta/$fileName";
        }
        return $modelo->$campo;
    }
    public function destroy($id)
    {
        $actividad = Actividad::findOrFail($id);
        $actividad->delete();
        return redirect()->route('actividades.admin')->with('success', 'Actividad eliminada correctamente');
    }
}
