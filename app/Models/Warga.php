<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{
    BelongsTo,
    HasOne,
    HasMany
};

class Warga extends Model
{
    protected $table = 'warga';

    protected $fillable = [
        'id_bagian',
        'nama',
        'nik',
        'tgl_lahir',
        'jkel',
        'status_kawin',
        'no_kk',
        'no_rt',
        'no_rw',
        'agama',
        'pendidikan',
        'pekerjaan',
        'kewarganegaraan',
        'kedudukan_keluarga',
        'alamat',
        'alamat_ktp',
        'keterangan'
    ];

    /**
     * Relasi ke bagian (RT/RW).
     */
    public function bagian()
    {
        return $this->belongsTo(Bagian::class, 'no_rt'); 
        return $this->belongsTo(Bagian::class, 'no_rw'); // atau 'id_bagian' sesuai struktur
    }

    /**
     * Mendapatkan nama RT yang terkait dengan warga berdasarkan bagian.
     */
    public function rt()
    {
        return $this->hasOne(Bagian::class, 'id', 'no_rt')->where('tipe_bagian', 'RT');
    }

    /**
     * Mendapatkan nama RW yang terkait dengan warga berdasarkan bagian.
     */
    public function rw()
    {
        return $this->hasOne(Bagian::class, 'id', 'no_rw')->where('tipe_bagian', 'RW');
    }

    public function pemimpinRapat(): HasOne
    {
        return $this->hasOne(Rapat::class, 'id_pemimpin');
    }

    public function presensiRapat(): HasMany
    {
        return $this->hasMany(PresensiRapat::class, 'id_warga');
    }

    public function pengusulPemilu(): HasMany
    {
        return $this->hasMany(Pengusul::class, 'id_warga');
    }

    public function calonPemilu(): HasMany
    {
        return $this->hasMany(CalonPemilu::class, 'id_warga');
    }

    public function aspirasi(): HasMany
    {
        return $this->hasMany(AspirasiWarga::class, 'id_warga');
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id_warga');
    }

    public function mutasi()
    {
        return $this->hasMany(MutasiWarga::class, 'id_warga');
    }

    public function pendudukSementara(): HasOne
    {
        return $this->hasOne(PendudukSementara::class, 'id_warga');
    }

    public function pemilikRumah(): HasMany
    {
        return $this->hasMany(PendudukSementara::class, 'id_pemilik_rumah');
    }

    public function requestSurat(): HasMany
    {
        return $this->hasMany(RequestSuratKependudukan::class, 'id_bagian', 'id_bagian');
    }
}
