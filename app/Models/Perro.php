<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Perro extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'perro';

    protected $fillable =[
        'nombre',
        'url_imagen',
        'descripcion'
    ];

    protected $dates = ['deleted_at'];

    public function interesados(){
        return $this->belongsToMany(Perro::class, 'interaccion', 'id_perro_candidato', 'id_perro_interesado');
    }

}
