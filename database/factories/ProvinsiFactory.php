<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

namespace Database\Factories;

use App\Provinsi;
use Illuminate\Database\Eloquent\Factory;

class ProvinsiFactory extends Factory
{
    protected $model = Provinsi::class;

    public function definition()
    {
        return [
            'nama' => $this->faker->state,  // Generate nama provinsi menggunakan Faker
        ];
    }
}



