<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Racer>
 */
class RacerFactory extends Factory
{
    /**
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->name();

        return [
            'name' => $name,
            'country' => fake()->country(),
            'price' => fake()->randomFloat(2, 100, 10000),
            'user_id' => null,
            'on_market' => true,
            'avatar' => 'storage/avatars/' . str_replace(' ', '_', strtolower($name)) . '.jpg',
        ];
    }
}
