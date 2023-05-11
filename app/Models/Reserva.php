<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $fillable = ['id_entrada','id_usuario','fecha_reserva'];
}
