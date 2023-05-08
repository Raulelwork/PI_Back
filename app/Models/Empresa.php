<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class Empresa extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $fillable = ['id_usuario', 'nombre', 'cif', 'ubicacion','lugar', 'foto'];

    public function scopeListar($query){
        return $query->where('id_usuario', Auth::id());
    }
    public function fiestas(){
        return $this->hasMany(Fiesta::class, 'id_empresa','id');
    }
}
