<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

namespace Database\Factories;

use App\Kota;
use App\Provinsi;
use Illuminate\Database\Eloquent\Factory;

class KotaFactory extends Factory
{
    protected $model = Kota::class;

    public function definition()
    {
        return [
            'nama' => $this->faker->city,  // Generate nama kota menggunakan Faker
            'provinsi_id' => Provinsi::factory(),  // Menghubungkan kota dengan provinsi
        ];
    }
}

