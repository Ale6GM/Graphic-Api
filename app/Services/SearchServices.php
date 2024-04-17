<?php

namespace App\Services;

use App\Http\Resources\Ventas;
use Illuminate\Http\Request;
use App\Models\Cliente;

class SearchServices {
    public function buscar() {
        $ventas = Cliente::query()->get();

        return Ventas::collection($ventas);
    }
}