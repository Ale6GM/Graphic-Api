<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Services\SearchServices;

class ClienteController extends Controller
{
    public function __construct(private readonly SearchServices $service)
    {
        
    }
    public function getData() {
        return $this->service->buscar();
    }

    public function getClientes() {
        $clientes = Cliente::all();

        return response()->json($clientes);
    }
}
