<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kota extends Model
{
    protected $table = 'kotas'; // Pastikan ini sesuai dengan nama tabel di database
    protected $fillable = ['nama', 'provinsi_id']; // Sesuaikan dengan kolom yang ada di tabel

    // Relasi ke model Kecamatan (One-to-Many)
    public function kecamatans()
    {
        return $this->hasMany(Kecamatan::class, 'kota_id');
    }
}