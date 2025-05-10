<?php

use Illuminate\Database\Seeder;
use App\Models\Kelurahan;

class KelurahanSeeder extends Seeder
{
    public function run()
    {
        // Data Kelurahan untuk Kecamatan di Kota Tangerang
        $data = [
            // Kecamatan Neglasari
            ['id' => 1, 'kecamatan_id' => 1, 'nama' => 'Kelurahan Neglasari'],
            ['id' => 2, 'kecamatan_id' => 1, 'nama' => 'Kelurahan Cibodas Baru'],
            ['id' => 3, 'kecamatan_id' => 1, 'nama' => 'Kelurahan Karang Satria'],
            // Kecamatan Batu Ceper
            ['id' => 4, 'kecamatan_id' => 2, 'nama' => 'Kelurahan Batu Ceper'],
            ['id' => 5, 'kecamatan_id' => 2, 'nama' => 'Kelurahan Tanah Tinggi'],
            // Kecamatan Cibodas
            ['id' => 6, 'kecamatan_id' => 3, 'nama' => 'Kelurahan Cibodas'],
            ['id' => 7, 'kecamatan_id' => 3, 'nama' => 'Kelurahan Cibodas Indah'],
            // Kecamatan Karawaci
            ['id' => 8, 'kecamatan_id' => 4, 'nama' => 'Kelurahan Karawaci'],
            ['id' => 9, 'kecamatan_id' => 4, 'nama' => 'Kelurahan Karawaci Baru'],
            // Kecamatan Periuk
            ['id' => 10, 'kecamatan_id' => 5, 'nama' => 'Kelurahan Periuk'],
            ['id' => 11, 'kecamatan_id' => 5, 'nama' => 'Kelurahan Periuk Jaya'],
            // Kecamatan Tangerang
            ['id' => 12, 'kecamatan_id' => 6, 'nama' => 'Kelurahan Tangerang'],
            ['id' => 13, 'kecamatan_id' => 6, 'nama' => 'Kelurahan Babakan'],
            // Kecamatan Ciledug
            ['id' => 14, 'kecamatan_id' => 7, 'nama' => 'Kelurahan Ciledug'],
            ['id' => 15, 'kecamatan_id' => 7, 'nama' => 'Kelurahan Ciledug Barat'],
            // Kecamatan Pinang
            ['id' => 16, 'kecamatan_id' => 8, 'nama' => 'Kelurahan Pinang'],
            ['id' => 17, 'kecamatan_id' => 8, 'nama' => 'Kelurahan Kunciran'],
            // Kecamatan Benda
            ['id' => 18, 'kecamatan_id' => 9, 'nama' => 'Kelurahan Benda'],
            ['id' => 19, 'kecamatan_id' => 9, 'nama' => 'Kelurahan Benda Barat'],

            // Kecamatan Serpong
            ['id' => 20, 'kecamatan_id' => 11, 'nama' => 'Kelurahan Serpong'],
            ['id' => 21, 'kecamatan_id' => 11, 'nama' => 'Kelurahan Serpong Utara'],
            // Kecamatan Pondok Aren
            ['id' => 22, 'kecamatan_id' => 12, 'nama' => 'Kelurahan Pondok Aren'],
            ['id' => 23, 'kecamatan_id' => 12, 'nama' => 'Kelurahan Pondok Pucung'],
            // Kecamatan Ciputat
            ['id' => 24, 'kecamatan_id' => 13, 'nama' => 'Kelurahan Ciputat'],
            ['id' => 25, 'kecamatan_id' => 13, 'nama' => 'Kelurahan Ciputat Timur'],
            // Kecamatan Ciputat Timur
            ['id' => 26, 'kecamatan_id' => 14, 'nama' => 'Kelurahan Ciputat Timur'],
            ['id' => 27, 'kecamatan_id' => 14, 'nama' => 'Kelurahan Kedaung'],
            // Kecamatan Setu
            ['id' => 28, 'kecamatan_id' => 15, 'nama' => 'Kelurahan Setu'],
            ['id' => 29, 'kecamatan_id' => 15, 'nama' => 'Kelurahan Cilenggang'],

            // Kecamatan Tigaraksa
            ['id' => 30, 'kecamatan_id' => 16, 'nama' => 'Kelurahan Tigaraksa'],
            ['id' => 31, 'kecamatan_id' => 16, 'nama' => 'Kelurahan Waluya'],
            // Kecamatan Cikupa
            ['id' => 32, 'kecamatan_id' => 17, 'nama' => 'Kelurahan Cikupa'],
            ['id' => 33, 'kecamatan_id' => 17, 'nama' => 'Kelurahan Suka Asih'],
            // Kecamatan Curug
            ['id' => 34, 'kecamatan_id' => 18, 'nama' => 'Kelurahan Curug'],
            ['id' => 35, 'kecamatan_id' => 18, 'nama' => 'Kelurahan Curug Timur'],
            // Kecamatan Panongan
            ['id' => 36, 'kecamatan_id' => 19, 'nama' => 'Kelurahan Panongan'],
            ['id' => 37, 'kecamatan_id' => 19, 'nama' => 'Kelurahan Ciseeng'],
            // Kecamatan Legok
            ['id' => 38, 'kecamatan_id' => 20, 'nama' => 'Kelurahan Legok'],
            ['id' => 39, 'kecamatan_id' => 20, 'nama' => 'Kelurahan Cileles'],
            // Kecamatan Balaraja
            ['id' => 40, 'kecamatan_id' => 21, 'nama' => 'Kelurahan Balaraja'],
            ['id' => 41, 'kecamatan_id' => 21, 'nama' => 'Kelurahan Sukamanah'],
            // Kecamatan Kemiri
            ['id' => 42, 'kecamatan_id' => 22, 'nama' => 'Kelurahan Kemiri'],
            ['id' => 43, 'kecamatan_id' => 22, 'nama' => 'Kelurahan Rancabungur'],
            // Kecamatan Mauk
            ['id' => 44, 'kecamatan_id' => 23, 'nama' => 'Kelurahan Mauk'],
            ['id' => 45, 'kecamatan_id' => 23, 'nama' => 'Kelurahan Mauk Timur'],
            // Kecamatan Kosambi
            ['id' => 46, 'kecamatan_id' => 24, 'nama' => 'Kelurahan Kosambi'],
            ['id' => 47, 'kecamatan_id' => 24, 'nama' => 'Kelurahan Kosambi Barat'],
            // Kecamatan Rajeg
            ['id' => 48, 'kecamatan_id' => 25, 'nama' => 'Kelurahan Rajeg'],
            ['id' => 49, 'kecamatan_id' => 25, 'nama' => 'Kelurahan Rajeg Barat']
        ];

        foreach ($data as $item) {
            Kelurahan::create($item);
        }
    }
}
