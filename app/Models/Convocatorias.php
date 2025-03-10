<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use Illuminate\Support\Str;

class  Convocatorias extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Searchable;

    protected $dates = ['deleted_at'];
    protected $table = 'convocatorias'; 
    
    protected $fillable = [
        'titulo',
        'descripcion',
        'slug',
        'url_img1',
        'url_img2',
        'archivo1',
        'archivo2',
        'fecha',
    ];

    public static function boot(){
        parent::boot();

        static::creating(function ($convocatoria) {
            $convocatoria->slug = Str::slug($convocatoria->titulo);
        });
    }

    public function toSearchableArray()
    {
        return [
            'titulo' => $this->titulo,
            'descripcion' => $this->descripcion,
        ];
    }
    //
}
