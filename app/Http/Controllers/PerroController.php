<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perro;
use App\Repositories\PerroRepository;
use App\Http\Requests\PerroRequest;
use App\Http\Requests\InteraccionRequest;

class PerroController extends Controller
{
    public function __construct(PerroRepository $perroRepository)
    {
        $this->perroRepository = $perroRepository;
    }

    public function registrarPerro(PerroRequest $request)
    {
        return $this->perroRepository->registrarPerro($request);
    }

    public function listarPerros(Request $request)
    {
        return $this->perroRepository->listarPerros($request);
    }

    public function listarPerro(Request $request)
    {
        return $this->perroRepository->listarPerro($request);
    }

    public function actualizarPerro(PerroRequest $request)
    {
        return $this->perroRepository->actualizarPerro($request);
    }

    public function eliminarPerro(Request $request)
    {
        return $this->perroRepository->eliminarPerro($request);
    }

    public function perroRandom(Request $request)
    {
        return $this->perroRepository->perroRandom($request);
    }

    public function registrarInteraccion(InteraccionRequest $request)
    {
        return $this->perroRepository->registrarInteraccion($request);
    }
}
