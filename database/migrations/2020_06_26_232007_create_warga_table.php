<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWargaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warga', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_bagian')->unsigned();
            $table->foreign('id_bagian')->references('id')->on('bagian')->cascadeOnDelete();
            $table->string('nama');
            $table->string('nik');
            $table->date('tgl_lahir');
            $table->string('jkel');
            $table->string('status_kawin');
            $table->string('no_kk');
            $table->string('no_rt');
            $table->string('no_rw');
            $table->string('kel_ktp')->nullable(); 
            $table->string('kec_ktp')->nullable();
            $table->string('kota_ktp')->nullable();
            $table->string('prov_ktp')->nullable();
            $table->string('agama');
            $table->string('pendidikan');
            $table->string('pekerjaan');
            $table->string('kewarganegaraan');
            $table->string('kedudukan_keluarga');
            $table->string('alamat');
            $table->string('alamat_ktp');
            $table->string('prov_tinggal')->nullable();
            $table->string('kota_tinggal')->nullable();
            $table->string('kec_tinggal')->nullable();
            $table->string('kel_tinggal')->nullable();
            $table->string('alamat_tinggal')->nullable();
            $table->string('status');
            $table->longText('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('warga');
    }
}