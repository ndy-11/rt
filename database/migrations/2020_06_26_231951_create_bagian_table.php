<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBagianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bagian', function (Blueprint $table) {
            $table->id();
            $table->string('nama_bagian');
            $table->char('tipe_bagian');
            $table->unsignedBigInteger('induk_id')->nullable(); // Parent ID for hierarchy
            $table->foreign('induk_id')->references('id')->on('bagian')->cascadeOnDelete();
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
        Schema::dropIfExists('bagian');
    }
}
