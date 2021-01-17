<?php
namespace Database\Factories;

use App\Models\CrmCustomer;
use Illuminate\Database\Eloquent\Factories\Factory;

class CrmCustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CrmCustomer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
        'first_name'        =>  $this->faker->firstName,
        'last_name'     =>  $this->faker->lastName,
        'email'     =>  $this->faker->email,
        'phone'     =>  $this->faker->phoneNumber,
        'address'       =>  $this->faker->address,
        'skype'     =>  $this->faker->userName,
        'website'       =>  $this->faker->url,
        'description'       =>  $this->faker->sentence($nbWords = 6, $variableNbWords = true),
        ];
    }
}
