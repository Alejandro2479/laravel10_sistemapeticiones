<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Peticion>
 */
class PeticionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'numero_radicado' => fake()->randomNumber(5, true),
            'asunto' => fake()->sentence(),
            'descripcion' => fake()->paragraph(),
            'estatus' => fake()->boolean()
        ];
    }
}
