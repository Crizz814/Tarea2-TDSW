<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\InteraccionRequest;
use App\Repositories\InteraccionRepository;

class InteraccionController extends Controller
{
    public function __construct(InteraccionRepository $InteraccionRepository)
    {
        $this->InteraccionRepository = $InteraccionRepository;
    }

    public function registrarInteraccion(InteraccionRequest $request)
    {
        return $this->InteraccionRepository->registrarInteraccion($request);
    }

    public function perroCandidato(Request $request)
    {
        return $this->InteraccionRepository->perroCandidato($request);
    }
}
