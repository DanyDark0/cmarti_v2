<?php

namespace App\Models;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Fotos extends Model
{
    protected $fillable = ['galeria_id', 'url_imagen'];

    public function galeria()
    {
        return $this->belongsTo(Galeria::class);
    }
}
