<?php

use App\Models\Bagian;
use Illuminate\Database\Seeder;

class BagianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bagian = [
            [
                "nama_bagian" => "RW 001",
                "tipe_bagian" => "RW"
            ],
            [
                "nama_bagian" => "RW 002",
                "tipe_bagian" => "RW"
            ],
            [
                "nama_bagian" => "RW 003",
                "tipe_bagian" => "RW"
            ],
            [
                "nama_bagian" => "RW 004",
                "tipe_bagian" => "RW"
            ],
            [
                "nama_bagian" => "RW 005",
                "tipe_bagian" => "RW"
            ],           [
                "nama_bagian" => "RW 006",
                "tipe_bagian" => "RW"
            ],
            [
                "nama_bagian" => "RW 007",
                "tipe_bagian" => "RW"
            ],
            [
                "nama_bagian" => "RW 008",
                "tipe_bagian" => "RW"
            ],
            [
                "nama_bagian" => "RW 009",
                "tipe_bagian" => "RW"
            ],
            [
                "nama_bagian" => "RW 010",
                "tipe_bagian" => "RW"
            ],
            [
                "nama_bagian" => "RT 001",
                "tipe_bagian" => "RT"
            ],
            [
                "nama_bagian" => "RT 002",
                "tipe_bagian" => "RT"
            ],
            [
                "nama_bagian" => "RT 003",
                "tipe_bagian" => "RT"
            ],
            [
                "nama_bagian" => "RT 004",
                "tipe_bagian" => "RT"
            ],
            [
                "nama_bagian" => "RT 005",
                "tipe_bagian" => "RT"
            ],
            [
                "nama_bagian" => "RT 006",
                "tipe_bagian" => "RT"
            ],
            [
                "nama_bagian" => "RT 007",
                "tipe_bagian" => "RT"
            ],
            [
                "nama_bagian" => "RT 008",
                "tipe_bagian" => "RT"
            ],
            [
                "nama_bagian" => "RT 009",
                "tipe_bagian" => "RT"
            ],
            [
                "nama_bagian" => "RT 010",
                "tipe_bagian" => "RT"
            ]        
        ];

        

        foreach ($bagian as $value) {
            Bagian::create($value);
        }
    }
}
