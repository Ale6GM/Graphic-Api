<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Crimen;

class Victima extends Model
{
    use HasFactory;

    // Relacion inversa de muchos a muchos con el modelo crimen

    public function crimenes() {
        return $this->belongsToMany(Crimen::class);
    }
}
