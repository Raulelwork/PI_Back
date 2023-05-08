<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fiesta extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $fillable = ['id_tematica', 'id_musica', 'id_empresa', 'fecha','foto'];

}
