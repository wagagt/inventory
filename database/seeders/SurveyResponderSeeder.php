<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SurveyResponder;
use Faker\Generator as Faker;

class SurveyResponderSeeder extends Seeder
{
    public function run(Faker $faker)
    {
        $responders=[
            [
                'names'             => $faker->firstNameMale,
                'last_names'        => $faker->lastName,
                'identification'    => $faker->isbn13,
                'email'             => $faker->email,
                'dob'               => $faker->date($format = 'Y-m-d', $max = '2000',$min = '1970'),
                'company'           => $faker->company,
                'position'          => $faker->jobTitle,
            ],
            [
                'names'             => $faker->firstNameMale,
                'last_names'        => $faker->lastName,
                'identification'    => $faker->isbn13,
                'email'             => $faker->email,
                'dob'               => $faker->date($format = 'Y-m-d', $max = '2000', $min = '1970'),
                'company'           => $faker->company,
                'position'          => $faker->jobTitle,
            ],
            [
                'names'             => $faker->firstNameMale,
                'last_names'        => $faker->lastName,
                'identification'    => $faker->isbn13,
                'email'             => $faker->email,
                'dob'               => $faker->date($format = 'Y-m-d', $max = '2000', $min = '1970'),
                'company'           => $faker->company,
                'position'          => $faker->jobTitle,
            ],
            [
                'names'             => $faker->firstNameMale,
                'last_names'        => $faker->lastName,
                'identification'    => $faker->isbn13,
                'email'             => $faker->email,
                'dob'               => $faker->date($format = 'Y-m-d', $max = '2000', $min = '1970'),
                'company'           => $faker->company,
                'position'          => $faker->jobTitle,
            ],
        ];
        SurveyResponder::insert($responders);
    }
}
