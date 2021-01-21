<?php

namespace Database\Factories;

use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Item::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
        'serial_number' => $this->faker->ean8,
        'price' => $this->faker->numberBetween($min = 500, $max = 6000),
        'transaction_detail' => 1,
        'product_id' => 1 ,
        'store_id'=> 1
        ];
    }
}
