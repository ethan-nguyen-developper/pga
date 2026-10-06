<?php

namespace Database\Factories;

use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Model>
 */
class AnimateurFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "nom" => fake()->name(),
            "prenom" => fake()->firstName(),
            "sexe" => ["M", "F"][rand(0, 1)],
            "age" => rand(10, 25),
            "localisation_id" => rand(1,4)
        ];
    }
}
