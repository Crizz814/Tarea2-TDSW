<?php

namespace App\Repositories;

use App\Models\Perro;
use App\Models\Interaccion;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;

class InteraccionRepository
{
    public function perroCandidato($request)
        {
            try {
                $interesado = Perro::find($request->id); // Perro que está buscando

                // Obtén los IDs de los perros con los que el interesado ya ha tenido interacciones
                $perrosConInteracciones = Interaccion::where('id_perro_interesado', $interesado->id)
                    ->pluck('id_perro_candidato')
                    ->toArray();

                // Si hay perros con los que ha tenido interacciones, exclúyelos de la consulta
                if (!empty($perrosConInteracciones)) {
                    $candidato = Perro::whereNotIn('id', [$interesado->id, ...$perrosConInteracciones])
                        ->inRandomOrder()
                        ->first();
                } else {
                    // Si no ha tenido interacciones, simplemente obtén un perro aleatorio
                    $candidato = Perro::where('id', '!=', $interesado->id)
                        ->inRandomOrder()
                        ->first();
                }
                /*$candidato = Perro::where('id', '!=', $interesado->id)->inRandomOrder()->first(); // Perro que se le va a mostrar
                $interacciones = Interaccion::where('id_perro_interesado', $interesado->id)->get(); // Interacciones del perro que está buscando
                if($interacciones->count() > 0){ // Si el perro que está buscando tiene interacciones
                    foreach($interacciones as $interaccion){ // Por cada interacción
                        if($interaccion->id_perro_candidato === $candidato->id){ // Si el perro que se le va a mostrar ya tuvo una interacción con el perro interesado
                            $candidato = Perro::where('id', '!=', $interesado->id)->inRandomOrder()->first(); // Se busca otro perro
                        }
                    }
                }*/
                return response()->json(["perro" => $candidato], Response::HTTP_OK);
            } catch (Exception $e) {
                Log::info([
                    "error" => $e->getMessage(),
                    "linea" => $e->getLine(),
                    "file" => $e->getFile(),
                    "metodo" => __METHOD__
                ]);
    
                return response()->json([
                    "error" => $e->getMessage(),
                    "linea" => $e->getLine(),
                    "file" => $e->getFile(),
                    "metodo" => __METHOD__
                ], Response::HTTP_BAD_REQUEST);
            }
        }

    public function registrarInteraccion($request)
    {
        try {
            $interaccion = new Interaccion();
            $interaccion->id_perro_interesado = $request->id_perro_interesado;
            $interaccion->id_perro_candidato = $request->id_perro_candidato;
            $interaccion->preferencia = $request->preferencia;
            $interaccion->save();
            $isAMatch = Interaccion::where('id_perro_interesado', $request->id_perro_candidato)->where('id_perro_candidato', $request->id_perro_interesado)->first();
            if($isAMatch && $interaccion->preferencia === "A" && $isAMatch->preferencia === "A") return response()->json(["mensaje" => "It's a Match!", "interaccion" => $interaccion], Response::HTTP_OK);
            else return response()->json(["mensaje" => "ok", "interaccion" => $interaccion], Response::HTTP_OK);
        } catch (Exception $e) {
            Log::info([
                "error" => $e->getMessage(),
                "linea" => $e->getLine(),
                "file" => $e->getFile(),
                "metodo" => __METHOD__
            ]);

            return response()->json([
                "error" => $e->getMessage(),
                "linea" => $e->getLine(),
                "file" => $e->getFile(),
                "metodo" => __METHOD__
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function verAceptados($request)
    {
        try {
            $perro = Perro::find($request->id);
            $perrosAceptados = Interaccion::where('id_perro_interesado', $perro->id)->where('preferencia', 'A')->get();
            $perros = Perro::whereIn('id', $perrosAceptados->pluck('id_perro_candidato'))->orderBy('id')->get();

            return response()->json(["perros" => $perros], Response::HTTP_OK);
        } catch (Exception $e) {
            Log::info([
                "error" => $e->getMessage(),
                "linea" => $e->getLine(),
                "file" => $e->getFile(),
                "metodo" => __METHOD__
            ]);

            return response()->json([
                "error" => $e->getMessage(),
                "linea" => $e->getLine(),
                "file" => $e->getFile(),
                "metodo" => __METHOD__
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function verRechazados($request)
    {
        try {
            $perro = Perro::find($request->id);
            $perrosRechazados = Interaccion::where('id_perro_interesado', $perro->id)->where('preferencia', 'R')->get();
            $perros = Perro::whereIn('id', $perrosRechazados->pluck('id_perro_candidato'))->orderBy('id')->get();
            return response()->json(["perros" => $perros], Response::HTTP_OK);
        } catch (Exception $e) {
            Log::info([
                "error" => $e->getMessage(),
                "linea" => $e->getLine(),
                "file" => $e->getFile(),
                "metodo" => __METHOD__
            ]);

            return response()->json([
                "error" => $e->getMessage(),
                "linea" => $e->getLine(),
                "file" => $e->getFile(),
                "metodo" => __METHOD__
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}

