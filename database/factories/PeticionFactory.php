<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use Carbon\Carbon;

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
        // Fecha actual
        $now = Carbon::now();
    
        $fechaVencimiento = $now->copy()->addDays(rand(1, 40));

        $dias = $now->diffInDays($fechaVencimiento);
    
        return [
            'numero_radicado' => fake()->randomNumber(5, true),
            'asunto' => fake()->sentence(),
            'descripcion' => fake()->paragraph(),
            'estatus' => fake()->boolean(),
            'fecha_vencimiento' => $fechaVencimiento,
            'dias' => $dias,
            'user_id' => fake()->randomElement([2, 3])
        ];
    }
}
