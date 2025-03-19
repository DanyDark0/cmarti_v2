<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use Illuminate\Support\Str;

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
    public static function boot()
    {
        parent::boot();
    
        static::creating(function ($actividad) {
            $actividad->slug = self::generateUniqueSlug($actividad->titulo);
        });
    
        static::updating(function ($actividad) {
            $actividad->slug = self::generateUniqueSlug($actividad->titulo, $actividad->id);
        });
    }
    
    private static function generateUniqueSlug($titulo, $actividadId = null)
    {
        $slug = Str::slug($titulo);
        $query = self::withTrashed()->where('slug', $slug);
    
        if ($actividadId) {
            $query->where('id', '!=', $actividadId);
        }
    
        $count = $query->count();
    
        return $count > 0 ? "{$slug}-" . ($count + 1) : $slug;
    }

    public function toSearchableArray()
    {
        return [
            'titulo' => $this->titulo,
            'descripcion' => $this->descripcion,
        ];
    }

}
