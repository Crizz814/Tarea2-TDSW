<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Perro;
use Illuminate\Support\Str;
use Illuminate\Http\Response;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $urlBase = "https://dog.ceo/api/breeds/image/random";
    for ($i = 1; $i < 16; $i++) {
        $response = json_decode(file_get_contents($urlBase));
        $url = $response->message;
        Perro::create([
            'nombre' => Str::random(5),
            'url_imagen' => $url,
            'descripcion' => Str::random(20),
        ]);
    }
    }
}
