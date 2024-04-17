<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Victima>
 */
class VictimaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'edad' => $this->faker->randomElement([18,80,19, 25, 35, 40, 50, 60,75]),
            'genero' => $this->faker->randomElement(['masculino', 'femenino']),
            'relacion_delincuente' => $this->faker->randomElement(['si', 'no']),
            'lesiones_danos' => $this->faker->randomElement(['leves', 'graves']),
            'estado' => $this->faker->randomElement(['bien', 'mal']),
        ];
    }
}
