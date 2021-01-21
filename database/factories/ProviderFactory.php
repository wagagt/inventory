<?php

namespace Database\Factories;

use App\Models\Provider;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProviderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Provider::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'  => $this->faker->words($nb = 2, $asText = true),
            'address'   => $this->faker->address,
            'zone'  => $this->faker->numberBetween($min = 1, $max = 21),
            'city'  => $this->faker->city,
            'department'    => $this->faker->state,
            'contact_name'  => $this->faker->name,
            'contact_email' => $this->faker->email,
            'contact_phone' => $this->faker->phoneNumber,
        ];
    }
}
