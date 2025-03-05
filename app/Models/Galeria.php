<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galeria extends Model
{
    protected $fillable = ['titulo'];

    public function fotos()
    {
        return $this->hasMany(Fotos::class, 'galeria_id');
    }
}
