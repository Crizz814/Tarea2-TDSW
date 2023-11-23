<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Perro;
use Illuminate\Support\Str;

class SeederPerro extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 16; $i++) {
            Perro::create([
                'nombre' => Str::random(5),
                'descripcion' => Str::random(20),
            ]);
        }
    }
}
