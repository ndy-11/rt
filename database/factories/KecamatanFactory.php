<?php

/** @var \Illuminate\Database\Eloquent\Factories\Factory $factory */

namespace Database\Factories;

use App\Kecamatan;
use App\Kota;
use Illuminate\Database\Eloquent\Factory;

class KecamatanFactory extends Factory
{
    protected $model = Kecamatan::class;

    public function definition()
    {
        return [
            'nama' => $this->faker->city,  // Generate nama kecamatan menggunakan Faker
            'kota_id' => Kota::factory(),  // Menghubungkan kecamatan dengan kota
        ];
    }
}
