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
                $perroInteresado = Perro::find($request->id);
                $perroCandidato = Perro::where('id', '!=', $perroInteresado)->select('id','nombre','url_imagen')->inRandomOrder()->first();
                return response()->json(["perro" => $perroCandidato], Response::HTTP_OK);
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
            
            if($interaccion->preferencia === "A") return "It's a Match!";
            else return "ok";
            //return response()->json(["interaccion" => $interaccion], Response::HTTP_OK);
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