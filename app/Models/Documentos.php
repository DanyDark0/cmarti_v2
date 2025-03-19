<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Documentos extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Searchable;

    protected $table = 'documentos'; 
    
    protected $fillable = ['titulo', 'descripcion', 'doc1', 'doc2', 'slug'];

    public static function boot()
    {
        parent::boot();
    
        static::creating(function ($documento) {
            $documento->slug = self::generateUniqueSlug($documento->titulo);
        });
    
        static::updating(function ($documento) {
            $documento->slug = self::generateUniqueSlug($documento->titulo, $documento->id);
        });
    }
    
    private static function generateUniqueSlug($titulo, $documentoId = null)
    {
        $slug = Str::slug($titulo);
        $query = self::withTrashed()->where('slug', $slug);
    
        if ($documentoId) {
            $query->where('id', '!=', $documentoId);
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
