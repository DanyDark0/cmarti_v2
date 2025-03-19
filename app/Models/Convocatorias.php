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

    public static function boot()
    {
        parent::boot();
    
        static::creating(function ($convocatoria) {
            $convocatoria->slug = self::generateUniqueSlug($convocatoria->titulo);
        });
    
        static::updating(function ($convocatoria) {
            $convocatoria->slug = self::generateUniqueSlug($convocatoria->titulo, $convocatoria->id);
        });
    }
    
    private static function generateUniqueSlug($titulo, $convocatoriaId = null)
    {
        $slug = Str::slug($titulo);
        $query = self::withTrashed()->where('slug', $slug);
    
        if ($convocatoriaId) {
            $query->where('id', '!=', $convocatoriaId);
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
    //
}
