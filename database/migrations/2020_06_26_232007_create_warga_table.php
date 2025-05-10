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
            $table->string('nik')->nullable();
            $table->date('tgl_lahir');
            $table->string('jkel');
            $table->string('status_kawin');
            $table->string('no_kk')->nullable();
            $table->string('no_rt');
            $table->string('no_rw');
            $table->string('kel_ktp')->nullable(); 
            $table->string('kec_ktp')->nullable();
            $table->string('kota_ktp')->nullable();
            $table->string('prov_ktp')->nullable();
            $table->string('agama')->nullable();
            $table->string('pendidikan')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('kewarganegaraan')->nullable();
            $table->string('kedudukan_keluarga')->nullable();
            $table->string('alamat');
            $table->string('alamat_ktp');
            $table->string('status')->nullable();
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