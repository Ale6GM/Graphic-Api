<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Rvictima extends JsonResource
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
            'genero' => $this->genero,
            'relacion_delincuente' => $this->relacion_delincuente,
            'lesiones_danos' => $this->lesiones_danos,
            'estado' => $this->estado,
             

        ];
    }
}
