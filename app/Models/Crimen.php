<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Victima;
use App\Models\Delincuente;

class Crimen extends Model
{
    use HasFactory;

    //Relacion de muchos a muchos con el modelo victima

    public function victimas() {
        return $this->belongsToMany(Victima::class);
    }

    // Relacion de muchos a muchos con el modelo delincuente

    public function delincuentes() {
        return $this->belongsToMany(Delincuente::class);
    }
}
