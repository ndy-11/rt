<?php

use Illuminate\Database\Seeder;
use App\Models\Kota;

class KotaSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['id' => 1, 'provinsi_id' => 1, 'nama' => 'Kota Tangerang'],
            ['id' => 2, 'provinsi_id' => 1, 'nama' => 'Kota Tangerang Selatan'],
            ['id' => 3, 'provinsi_id' => 1, 'nama' => 'Kabupaten Tangerang'],
        ];

        foreach ($data as $item) {
            Kota::create($item);
        }
    }
}
