<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perro extends Model
{
    use HasFactory;

    protected $table = 'perro';

    public function interesados(){
        return $this->belongsToMany(Perro::class, 'interaccion', 'id_perro_candidato', 'id_perro_interesado');
    }

}
