<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
        $product_name = $this->faker->unique()->words($nb = 4, $asText = true);
        $slug = Str::slug($product_name);
        return [
            'name' => $product_name,
            'slug' => $slug,
            'short_description' => $this->faker->text(200),
            'description' => $this->faker->text(500),
            'regular_price' => $this->faker->numberBetween(100000, 5000000),
            'stock_status' => 'instock',
            'views' => $this->faker->numberBetween(1, 100),
            'quantity' => $this->faker->numberBetween(100, 200),
            'image' => 'digital_' . $this->faker->unique()->numberBetween(1, 22) . '.jpg',
            'category_id' => $this->faker->numberBetween(4, 11),
        ];
    }
}
