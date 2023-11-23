<?php

namespace App\Repositories;

use App\Models\Perro;
use App\Models\Interaccion;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;

class PerroRepository
{
    public function registrarPerro($request)
    {
        try {
            $perro = new Perro();
            $perro->nombre = $request->nombre;
            $perro->url_imagen = $request->url_imagen;
            $perro->descripcion = $request->descripcion;
            $perro->save();
            return response()->json(["perro" => $perro], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                "error" => $e->getMessage(),
                "linea" => $e->getLine(),
                "file" => $e->getFile(),
                "metodo" => __METHOD__
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function listarPerros($request)
    {
        try {
            $perros = Perro::withTrashed()->get();
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

    public function listarPerro($request)
    {
        try {
            $perro = Perro::find($request->id);
            return response()->json(["perro" => $perro], Response::HTTP_OK);
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

    public function actualizarPerro($request)
    {
        try {
            $perro = Perro::find($request->id);
            $perro->nombre = $request->nombre;
            $perro->url_imagen = $request->url_imagen;
            $perro->descripcion = $request->descripcion;
            $perro->save();
            return response()->json(["perro" => $perro], Response::HTTP_OK);
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

    public function eliminarPerro($request)
    {
        try {
            $perro = Perro::find($request->id);
            $perro->delete();
            return response()->json(["perro" => $perro], Response::HTTP_OK);
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

    public function perroRandom($request)
    {
        try {
            $perro = Perro::select('id', 'nombre')->inRandomOrder()->first();
            return response()->json(["perro" => $perro], Response::HTTP_OK);
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
