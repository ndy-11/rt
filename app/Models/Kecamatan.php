<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    protected $table = 'kecamatans'; // Pastikan ini sesuai dengan nama tabel di database
    protected $fillable = ['nama', 'kota_id']; // Sesuaikan dengan kolom yang ada di tabel

    // Relasi ke model Kelurahan (One-to-Many)
    public function kelurahans()
    {
        return $this->hasMany(Kelurahan::class, 'kecamatan_id');
    }
}