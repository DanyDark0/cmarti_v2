<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Actividad extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Searchable;
    
    protected $dates = ['deleted_at'];
    protected $table = 'actividades'; 

    protected $fillable = [
        'titulo',
        'descripcion',
        'url_img1',
        'url_img2',
        'archivo1',
        'archivo2',
        'fecha',
        'noticia',
    ];

    public function toSearchableArray()
    {
        return [
            'titulo' => $this->titulo,
            'descripcion' => $this->descripcion,
        ];
    }

}
