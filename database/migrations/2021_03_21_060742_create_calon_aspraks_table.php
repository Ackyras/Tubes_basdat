<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalonAspraksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calon_aspraks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('periode')->references('id')->on('pembukaan_aspraks')->onDelete('cascade');
            $table->string('nama');
            $table->string('nim');
            $table->string('email');
            $table->string('password')->nullable();
            $table->date('tanggal_lahir');
            $table->string('program_studi');
            $table->integer('angkatan');
            $table->string('cv');
            $table->string('khs');
            $table->string('ktm');
            $table->integer('status')->default(0);
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calon_aspraks');
    }
}
