<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use illuminate\Support\Str;

class BuscadorController extends Controller
{
    //
    public function search(Request $request){
        // Validar el término de búsqueda
        /* $validator = Validator::make([
            'keyword' => 'required|string|min:3',
        ]); */
        $request->validate([
            'keyword' => 'required|string|min:3',
        ]);

        // Obtener el término de búsqueda
        $query = $request->input('keyword');

        // Realizar la búsqueda con Scout
        //$resultados = actividades::search($query)->get();

        // Buscar en la tabla 'actividades'
        $actividades = \App\Models\Actividad::search($query)->get();
        $documentos = \App\Models\Documentos::search($query)->get();
        $convocatorias = \App\Models\Convocatorias::search($query)->get();

        foreach ($actividades as $actividad) {
            $actividad->descripcion_truncado = $this->truncateHtml($actividad->descripcion, 100);
        }

        foreach ($documentos as $documento) {
            $documento->descripcion_truncado = $this->truncateHtml($documento->descripcion, 100);
        }

        foreach ($convocatorias as $convocatoria) {
            $convocatoria->descripcion_truncado = $this->truncateHtml($convocatoria->descripcion, 100);
        }

        $resultados = [
            'actividades' => $actividades,
            'documentos' => $documentos,
            'convocatorias' => $convocatorias,
        ];

        //$totalResultados = $resultados->count();
        $totalResultados = $actividades->count() + $documentos->count() + $convocatorias->count();

        // return response()->json([
        //     'success' => true,
        //     'data' => $resultados,
        //     'message' => 'Resultados encontrados exitosamente',
        // ], 200);

        // Retornar los resultados a la vista (o como JSON)
        return view('resultadosBusqueda', compact('resultados', 'query', 'totalResultados'));
    }

    function truncateHtml($html, $limit = 100) {
        $text = strip_tags($html); // Quita las etiquetas HTML
        $truncated = Str::limit($text, $limit); // Aplica el límite
        return $truncated;
    }
}
