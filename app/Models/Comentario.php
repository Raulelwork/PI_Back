<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $fillable = ['id_usuario', 'id_empresa', 'contenido', 'fecha'];

}
