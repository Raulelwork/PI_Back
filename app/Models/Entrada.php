<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrada extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $fillable = ['id_fiesta', 'precio', 'consumiciones', 'tipo', 'eliminado','aforo','aforoinicial'];
}