<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    private $image = 1;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => \fake()->words(asText: true),
            'price' => \fake()->numberBetween(100, 1000),
            'description' => \fake()->paragraph(),
            'status' => 2
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Product $product) {
            $product->thumbnail()->create(['url' => 'images/products/' . $this->image++ . '.jpg']);
            $product->images()->createManyQuietly([
                ['url' => 'images/products/' . \rand(1, 15) . '.jpg'],
                ['url' => 'images/products/' . \rand(1, 15) . '.jpg'],
            ]);
        });
    }
}
