<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'  => $this->faker->words($nb = 2, $asText = true),
            'description'   => $this->faker->text($maxNbChars = 50),
            'price' => $this->faker->randomNumber(3),
            'code'  => $this->faker->ean8,
            'internal_code' => $this->faker->isbn10,
            'stock' => $this->faker->numberBetween($min = 10, $max = 100),
            'min_stock' => 3,
            'max_stock' => 100,
        ];
    }
}
