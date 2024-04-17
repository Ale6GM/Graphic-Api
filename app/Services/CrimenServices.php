<?php

namespace App\Services;

use App\Http\Resources\CrimenResource;
use Illuminate\Http\Request;
use App\Models\Crimen;

class CrimenServices {

    // Funcion para obtener los Crimenes , se los pasa a la clase resource Rcrimen para convertirlos en una coleccion y lo parsea a JSON
    public function getCrimenes() {
        $crimenes = Crimen::query()->get();

        return CrimenResource::collection($crimenes);
    }
}