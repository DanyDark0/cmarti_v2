<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Actividad;
use App\Models\Convocatorias;
use Illuminate\Pagination\LengthAwarePaginator;

class HomeController extends Controller
{
    public function welcome()
    {
            // Obtener años únicos de ambas tablas
    $years = Actividad::selectRaw('YEAR(fecha) as year')
    ->whereNotNull('fecha')
    ->groupBy('year')
    ->pluck('year')
    ->toArray();

$yearsConvocatorias = Convocatorias::selectRaw('YEAR(fecha) as year')
    ->whereNotNull('fecha')
    ->groupBy('year')
    ->pluck('year')
    ->toArray();

// Fusionar y ordenar los años
$years = array_unique(array_merge($years, $yearsConvocatorias));
rsort($years); // Ordena los años de mayor a menor
        // Obtener solo las últimas 4 actividades que son noticias
        $noticias = Actividad::where('noticia', true)
            ->select('id', 'titulo', 'descripcion', 'url_img1', 'url_img2', 'archivo1', 'archivo2', 'fecha', 'slug')
            ->latest()
            ->take(4)
            ->get();

        return view('welcome', compact('noticias', 'years'));
    }

    public function getYears()
    {
        $years = Actividad::selectRaw('YEAR(fecha) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year')
            ->merge(
                Convocatorias::selectRaw('YEAR(fecha) as year')
                    ->distinct()
                    ->orderBy('year', 'desc')
                    ->pluck('year')
            )
            ->unique()
            ->sortDesc();

        return view('home', compact('years'));
    }
    public function filtrarFecha(Request $request)
{
    $year = $request->year;

    if (!$year) {
        return redirect()->route('welcome')->with('error', 'Debe seleccionar un año válido.');
    }

    $actividades = Actividad::whereYear('fecha', $year)->get();
    $convocatorias = Convocatorias::whereYear('fecha', $year)->get();

    $resultados = $actividades->merge($convocatorias)->sortByDesc('fecha');

    $perPage = 8;
    $currentPage = request()->input('page', 1);
    $currentItems = $resultados->slice(($currentPage - 1) * $perPage, $perPage)->all();
    $resultadosPaginados = new LengthAwarePaginator($currentItems, $resultados->count(), $perPage, $currentPage, [
        'path' =>request()->url(),
        'query' => request()->query(),
    ]);

    return view('resultadosFechas', compact('year', 'resultadosPaginados'));
}
}
