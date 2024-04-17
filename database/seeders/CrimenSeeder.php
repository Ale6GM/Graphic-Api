<?php

namespace Database\Seeders;

use App\Models\Crimen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CrimenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $crimenes = Crimen::factory(50)->create();

        foreach($crimenes as $crimen) {
            $crimen->victimas()->attach([
                rand(1,25),
                rand(26, 50)
            ]);

            $crimen->delincuentes()->attach([
                rand(1,25),
                rand(26,50)

            ]);
        }
    }
}
