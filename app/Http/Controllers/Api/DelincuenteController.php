<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Delincuente;
use App\Services\DelincuenteServices;
use Illuminate\Http\Request;

class DelincuenteController extends Controller
{
    public function __construct(private readonly DelincuenteServices $delincuenteServices)
    {
        
    }

    public function getDelincuentes() {
        $delincuentes = Delincuente::all();

        return response()->json($delincuentes);
    }
}
