<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fiesta extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $fillable = ['id_tematica', 'id_musica', 'id_empresa', 'fecha','foto'];

    public function empresa(){
        return $this->hasOne(Empresa::class, 'id', 'id_empresa');
    }
    public function musica(){
        return $this->hasOne(Musica::class, 'id', 'id_musica');
    }
    public function tematica(){
        return $this->hasOne(Tematica::class, 'id', 'id_tematica');
    }
    public function entrada(){
        return $this->hasMany(Entrada::class, 'id_fiesta','id')->where('aforo','>',0);
    }
    public function adentrada(){
        return $this->hasMany(Entrada::class, 'id_fiesta','id');
    }
}
