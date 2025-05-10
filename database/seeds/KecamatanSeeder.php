<?php

use Illuminate\Database\Seeder;
use App\Models\Kecamatan;

class KecamatanSeeder extends Seeder
{
    public function run()
    {
        // Data Kecamatan untuk Kota Tangerang
        $data = [
            // Kota Tangerang
            ['id' => 1, 'kota_id' => 1, 'nama' => 'Neglasari'],
            ['id' => 2, 'kota_id' => 1, 'nama' => 'Batu Ceper'],
            ['id' => 3, 'kota_id' => 1, 'nama' => 'Cibodas'],
            ['id' => 4, 'kota_id' => 1, 'nama' => 'Karawaci'],
            ['id' => 5, 'kota_id' => 1, 'nama' => 'Periuk'],
            ['id' => 6, 'kota_id' => 1, 'nama' => 'Tangerang'],
            ['id' => 7, 'kota_id' => 1, 'nama' => 'Ciledug'],
            ['id' => 8, 'kota_id' => 1, 'nama' => 'Pinang'],
            ['id' => 9, 'kota_id' => 1, 'nama' => 'Benda'],
            ['id' => 10, 'kota_id' => 1, 'nama' => 'Jatiuwung'],

            // Kota Tangerang Selatan
            ['id' => 11, 'kota_id' => 2, 'nama' => 'Serpong'],
            ['id' => 12, 'kota_id' => 2, 'nama' => 'Pondok Aren'],
            ['id' => 13, 'kota_id' => 2, 'nama' => 'Ciputat'],
            ['id' => 14, 'kota_id' => 2, 'nama' => 'Ciputat Timur'],
            ['id' => 15, 'kota_id' => 2, 'nama' => 'Setu'],

            // Kabupaten Tangerang
            ['id' => 16, 'kota_id' => 3, 'nama' => 'Tigaraksa'],
            ['id' => 17, 'kota_id' => 3, 'nama' => 'Cikupa'],
            ['id' => 18, 'kota_id' => 3, 'nama' => 'Curug'],
            ['id' => 19, 'kota_id' => 3, 'nama' => 'Panongan'],
            ['id' => 20, 'kota_id' => 3, 'nama' => 'Legok'],
            ['id' => 21, 'kota_id' => 3, 'nama' => 'Balaraja'],
            ['id' => 22, 'kota_id' => 3, 'nama' => 'Kemiri'],
            ['id' => 23, 'kota_id' => 3, 'nama' => 'Mauk'],
            ['id' => 24, 'kota_id' => 3, 'nama' => 'Kosambi'],
            ['id' => 25, 'kota_id' => 3, 'nama' => 'Rajeg']
        ];

        foreach ($data as $item) {
            Kecamatan::create($item);
        }
    }
}
