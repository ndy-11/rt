<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

namespace Database\Factories;

use App\Kelurahan;
use App\Kecamatan;
use Illuminate\Database\Eloquent\Factory;

class KelurahanFactory extends Factory
{
    protected $model = Kelurahan::class;

    public function definition()
    {
        return [
            'nama' => $this->faker->city,  // Generate nama kelurahan menggunakan Faker
            'kecamatan_id' => Kecamatan::factory(),  // Menghubungkan kelurahan dengan kecamatan
        ];
    }
}
