<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMataKuliahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mata_kuliahs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mata_kuliah_id')->references('id')->on('daftar_mata_kuliahs')->onDelete('cascade');
            $table->foreignId('pembukaan_asprak_id')->references('id')->on('pembukaan_aspraks')->onDelete('cascade');
            $table->string('dosen');
            $table->date('tanggal_seleksi');
            $table->time('awal_seleksi');
            $table->time('akhir_seleksi');
            $table->string('soal')->nullable();
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
        Schema::dropIfExists('mata_kuliahs');
    }
}
