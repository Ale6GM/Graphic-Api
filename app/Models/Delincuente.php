<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Crimen;

class Delincuente extends Model
{
    use HasFactory;

    // relacion de muchos a muchos inversa con el modelo crimen

    public function crimenes() {
        return $this->belongsToMany(Crimen::class);
    }
}
