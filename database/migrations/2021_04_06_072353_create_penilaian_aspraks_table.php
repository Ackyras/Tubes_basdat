<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenilaianAspraksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penilaian_aspraks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('calon_asprak_id')->references('id')->on('calon_aspraks')->onDelete('cascade');
            $table->foreignId('mata_kuliah_id')->references('id')->on('mata_kuliahs')->onDelete('cascade');
            $table->string('jawaban')->nullable();
            $table->integer('nilai')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penilaian_aspraks');
    }
}
