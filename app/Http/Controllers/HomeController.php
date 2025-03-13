<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Actividad;
use App\Models\Convocatorias;

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

        return view('welcome', compact('years'));
    }
    public function filtrarFecha(Request $request)
{
    $year = $request->year;

    $actividades = Actividad::whereYear('fecha', $year)->get();
    $convocatorias = Convocatorias::whereYear('fecha', $year)->get();

    return view('resultados_fechas', compact('year', 'actividades', 'convocatorias'));
}
}
