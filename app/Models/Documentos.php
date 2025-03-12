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

    public function admin()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        return view('documentos.admin');
    }
    public static function boot()
    {
        parent::boot();

        static::creating(function ($documento) {
            $documento->slug = Str::slug($documento->titulo);
        });

        static::updating(function ($documento) {
            $documento->slug = Str::slug($documento->titulo);
        });
    }

    public function toSearchableArray()
    {
        return [
            'titulo' => $this->titulo,
            'descripcion' => $this->descripcion,
        ];
    }
}
