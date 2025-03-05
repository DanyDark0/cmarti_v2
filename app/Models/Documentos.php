<?php

namespace App\Models;
use Laravel\Scout\Searchable;

use Illuminate\Database\Eloquent\Model;

class Documentos extends Model
{
    use Searchable;
    
    protected $fillable = ['titulo', 'cuerpo', 'doc1', 'doc2'];
}
