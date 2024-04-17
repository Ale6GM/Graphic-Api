<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Victima;
use App\Services\VictimaServices;
use Illuminate\Http\Request;

class VictimaController extends Controller
{
    public function __construct(private readonly VictimaServices $victimaServices)
    {
        
    }

    public function getVictimas() {
        $victimas = Victima::all(); 

        return response()->json($victimas);
    }
}
