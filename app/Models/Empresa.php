<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $fillable = ['id_usuario', 'nombre', 'cif', 'foto'];
    public static function crear_empresa($datos){
        return self::create($datos);
    }
}
