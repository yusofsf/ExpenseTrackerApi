<?php

namespace Database\Factories;

use App\Models\IncomeDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<IncomeDetail>
 */
class IncomeDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'amount' => strval(fake()->numberBetween(100, 1000)),
            'date' => fake()->dateTimeBetween('-1 years'),
            'note' => fake()->text(10)
        ];
    }
}
