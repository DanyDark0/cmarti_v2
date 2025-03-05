<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Actividad;

class HomeController extends Controller
{
    public function index()
    {
        // Obtener solo las últimas 4 actividades que son noticias
        $noticias = Actividad::where('noticia', true)
            ->select('id', 'titulo', 'descripcion', 'url_img1', 'url_img2', 'archivo1', 'archivo2', 'fecha')
            ->latest()
            ->take(4)
            ->get();

        return view('welcome', compact('noticias'));
    }
}
