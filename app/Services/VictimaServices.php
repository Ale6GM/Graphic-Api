<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Victima;
use App\Http\Resources\Rvictima;

class VictimaServices {
    public function getVictima() {
        $victimas = Victima::query()->get();

        return Rvictima::collection($victimas);
    }
}