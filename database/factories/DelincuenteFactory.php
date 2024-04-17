<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Delincuente>
 */
class DelincuenteFactory extends Factory
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
            'direccion' => $this->faker->streetAddress(),
            'genero' => $this->faker->randomElement(['masculino', 'femenino']),
            'antecedentes' => $this->faker->randomElement(['si', 'no']),
            'relacion_victima' => $this->faker->randomElement(['si', 'no']),
        ];
    }
}
