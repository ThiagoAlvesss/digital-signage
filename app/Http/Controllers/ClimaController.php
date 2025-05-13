<?php

namespace App\Http\Controllers;

use App\Services\ApiClima;
use Illuminate\Http\Request;

class ClimaController extends Controller
{
    protected $apiClima;

    public function __construct(ApiClima $apiClima)
    {
        $this->apiClima = $apiClima;
    }

    public function mostrar(Request $request)
    {
        try {
            $clima = $this->apiClima->obterClima();

            return view('clima', ['clima' => $clima]);
        } catch (\Exception $e) {
            return view('clima')->withErrors(['error' => 'Não foi possível obter o clima no momento.']);
        }
    }
}

