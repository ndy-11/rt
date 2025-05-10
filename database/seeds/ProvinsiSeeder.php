<?php

use Illuminate\Database\Seeder;
use App\Models\Provinsi;

class ProvinsiSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['id' => 1, 'nama' => 'Aceh'],
            ['id' => 2, 'nama' => 'Banten']
        ];

        foreach ($data as $item) {
            Provinsi::create($item); // Make sure the Provinsi model is set up correctly in your namespace
        }
    }
}
