<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    protected $table = 'provinsis'; // Pastikan ini sesuai dengan nama tabel di database
    protected $fillable = ['nama']; // Sesuaikan dengan kolom yang ada di tabel

    // Relasi ke model Kota (One-to-Many)
    public function kotas()
    {
        return $this->hasMany(Kota::class, 'provinsi_id'); // Asumsikan 'provinsi_id' adalah kolom yang menghubungkan Provinsi ke Kota
    }
}


