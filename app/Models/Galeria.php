<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Galeria extends Model
{
    use HasFactory;
    use Searchable;

    protected $table = 'galerias'; 
    protected $fillable = ['titulo', 'descripcion'];

    public function fotos()
    {
        return $this->hasMany(Fotos::class, 'galeria_id');
    }

    public function toSearchableArray()
    {
        return [
            'titulo' => $this->titulo,
            'descripcion' => $this->descripcion,
        ];
    }
}
