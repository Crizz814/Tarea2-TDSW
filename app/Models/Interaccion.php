<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interaccion extends Model
{
    use HasFactory;

    protected $table = 'interaccion';

    public function perroInteresado(){
        return $this->belongsTo(Perro::class, 'id_perro_interesado');
    }

    public function perroCandidato(){
        return $this->belongsTo(Perro::class, 'id_perro_candidato');
    }
}
