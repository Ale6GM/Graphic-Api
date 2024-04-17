<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Delincuente;
use App\Http\Resources\Rdelincuente;

class DelincuenteServices {
    public function getDelincuente() {
        $delincuentes = Delincuente::query()->get();

        return Rdelincuente::collection($delincuentes);
    }
}