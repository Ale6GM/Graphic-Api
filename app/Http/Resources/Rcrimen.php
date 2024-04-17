<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Rcrimen extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // en esta funcion convertimos los datos en objetos, para que puedan ser usados como JSON
        return [
            'id' => $this->id,
            'tipo_crimen' => $this->tipo_crimen,
            'zona' => $this->zona,
            'fecha_ocurrida' => $this->fecha_ocurrida,
            'modus_operandi' => $this->modus_operandi,
            'conocimiento_perpetrador' => $this->conocimiento_perpetrador,

        ];
    }
}
