<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
    protected $table = 'kelurahans'; // Pastikan ini sesuai dengan nama tabel di database
    protected $fillable = ['nama', 'kecamatan_id']; // Sesuaikan dengan kolom yang ada di tabel
}

