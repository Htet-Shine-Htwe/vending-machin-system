<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str ;
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
    public function definition(): array
    {
        $product_name = $this->faker->words(3, true);
        return [
            'name' => $product_name,
            'slug' => Str::slug($product_name),
            'price' => $this->faker->randomFloat(2, 1, 1000),
            'quantity_available' => $this->faker->randomNumber(2),
            'image' => $this->faker->imageUrl(),
        ];
    }
}
