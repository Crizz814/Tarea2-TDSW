<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perro;

class PerroController extends Controller
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

    public function listarPerro($request)
    {
        try {
          
            $perros = Perro::all();
            
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
}
