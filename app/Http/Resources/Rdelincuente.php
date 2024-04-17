<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Rdelincuente extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'edad' => $this->edad,
            'direccion' => $this->direccion,
            'genero' => $this->genero,
            'antecedentes' => $this->antecedentes,
            'relacion_victima' => $this->relacion_victima,

        ];
    }
}
