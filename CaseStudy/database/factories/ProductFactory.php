<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'image' => fake()->image(),
            'describe' => fake()->word(),
            'configuration' => fake()->word(),
            'quantity' => mt_rand(100,1000),
            'specifications' => fake()->word(),
            'color' => fake()->word(),
            'price_product' => mt_rand(100,1000),
            'price' => mt_rand(100,1000),
            'category_id' =>mt_rand(1,2),
            'user_id' => mt_rand(1,1),
        ];
    }
}
