<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailKelas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_kelas', function (Blueprint $table) {
            $table->uuid('nisn');
            $table->uuid('id_kelas');
            $table->foreign('nisn')->references('nisn')->on('siswa');
            $table->foreign('id_kelas')->references('id_kelas')->on('kelas');
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
        Schema::dropIfExists('detail_kelas');
    }
}
