<?php

namespace Database\Factories;

use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;

class StoreFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Store::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'  => $this->faker->word,
            'address'   => $this->faker->address ,
            'zone'  => $this->faker-> numberBetween($min = 1, $max = 21),
            'city'  => $this->faker->city ,
            'department'    => $this->faker->state,
        ];
    }
}
