<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Crimen>
 */
class CrimenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tipo_crimen' => $this->faker->randomElement(['Hurto', 'Robo_Fuerza', 'Amenaza', 'Lesiones_graves', 'malversacion', 'cohecho', 'HSGV']),
            'zona' => $this->faker->randomElement(['centro', 'norte', 'sur', 'este']),
            'fecha_ocurrida' => $this->faker->dateTimeThisYear(),
            'modus_operandi' => $this->faker->sentence(),
            'conocimiento_perpetrador' => $this->faker->randomElement(['si', 'no']),
        ];
    }
}
