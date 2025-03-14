<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Directorio;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use illuminate\Support\Str;

class directorioController extends Controller
{
    public function admin() {
        $directorio = Directorio::paginate(10);
        return view('directorio.admin', compact('directorio'));
    }
    public function index() {
        $directorio = Directorio::all();
        return view('directorio.index', compact('directorio'));
    }

    public function create() {
        return view('directorio.create');
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'catedra' => ['required', Rule::in(['Coordinador', 'Asistente de coordinación', 'Comité Técnico', 'Comité Honorifico', 'Colaboradores'])],
            'correo' => 'nullable|email|max:255',
            'telefono' => 'nullable|string|max:20',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

            // Verificar si ya existe un "Coordinador"
    if ($request->catedra === 'Coordinador' && Directorio::where('catedra', 'Coordinador')->exists()) {
        return back()->withErrors(['catedra' => 'Ya existe un Coordinador registrado.'])->withInput();
    }

        $directorio = new Directorio();
        $directorio->nombre = $request->nombre;
        $directorio->catedra = $request->catedra;
        $directorio->correo = $request->correo;
        $directorio->telefono = $request->telefono;
        $directorio->save();

        if ($request->hasFile('imagen')) {
            $fileName = $directorio->id . '_' . Str::slug($request->nombre, '_') . '.' . $request->file('imagen')->getClientOriginalExtension();
            $imagenPath = $request->file('imagen')->storeAs('directorio', $fileName, 'public');
            $directorio->imagen = 'storage/directorio/'. $fileName;
        }
         
        $directorio->save();

        return redirect()->route('directorio.admin')->with('success', 'Directorio agregado correctamente');
    }

    public function edit($id)
    {
        $directorio = Directorio::findOrFail($id);
        return view('directorio.edit', compact('directorio'));
    }

    public function update(Request $request, $id) {

        $directorio = Directorio::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'catedra' => ['required', Rule::in(['Coordinador', 'Asistente de coordinación', 'Comité Técnico', 'Comité Honorifico', 'Colaboradores'])],
            'correo' => 'nullable|email|max:255',
            'telefono' => 'nullable|string|max:20',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Verificar si se está intentando asignar "Coordinador" y ya existe otro
        if ($request->catedra === 'Coordinador' && Directorio::where('catedra', 'Coordinador')->where('id', '!=', $id)->exists()) {
            return back()->withErrors(['catedra' => 'Ya existe un Coordinador registrado.'])->withInput();
        }

        $directorio = Directorio::findOrFail($id);
        $directorio->nombre = $request->nombre;
        $directorio->catedra = $request->catedra;
        $directorio->correo = $request->correo;
        $directorio->telefono = $request->telefono;
        $directorio->save();

         // Actualizar imagen
         if ($request->hasFile('imagen')) {
            // Eliminar imagen anterior si existe
            if ($directorio->imagen && Storage::exists('public/'. $directorio->imagen)) {
                Storage::delete('public/' . $directorio->imagen);
            }

            $fileName =  $directorio->id . '_' . Str::slug($request->nombre, '_') . $directorio->id . '.' . $request->file('imagen')->getClientOriginalExtension();

            // Guardar nueva imagen
            $imagenPath = $request->file('imagen')->storeAs('directorio/', $fileName);
            $directorio->imagen = '/storage/directorio/' . $fileName;
        }

        $directorio->save();

        return redirect()->route('directorio.admin')->with('success', 'Directorio actualizado correctamente');
    }

    public function destroy($id)
    {
        $directorio = Directorio::findOrFail($id);
            // Verificar si el directorio tiene archivos asociados 

        // Verificar si hay una imagen y eliminarla
        if ($directorio->imagen) {
            // Extraer la ruta relativa a `storage/app/public`
            $relativePath = str_replace('storage/', '', $directorio->imagen);

        // Verificar si el archivo existe y eliminarlo
        if (Storage::disk('public')->exists($relativePath)) {
            Storage::disk('public')->delete($relativePath);
        }
    }
        $directorio->delete();
        return redirect()->route('directorio.admin')->with('success', 'Se elimino el elemnto correctamente');
    }

    public function eliminarArchivo($id, $campo)
    {
        // Buscar el directorio por ID
        $directorio = Directorio::findOrFail($id);
    
        // Verificar si el campo es válido
        if (!in_array($campo, ['imagen'])) {
            return response()->json(['success' => false, 'message' => 'Campo inválido.']);
        }
    
            // Verificar si el archivo existe
            if ($directorio->$campo) {
                $rutaArchivo = public_path('storage/'.$directorio->$campo);
                
                // Eliminar el archivo del servidor
                if (file_exists($rutaArchivo)) {
                    unlink($rutaArchivo);
                }
    
            // Eliminar referencia en la base de datos
            $directorio->$campo = null;
            $directorio->save();
    
            return response()->json(['success' => true, 'message' => 'Archivo eliminado correctamente.']);
        }
    
        return response()->json(['success' => false, 'message' => 'Archivo no encontrado.']);
    }
}
