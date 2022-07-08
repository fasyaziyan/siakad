<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetnilai extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detnilai', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('nisn');
            $table->uuid('id_kelas');
            $table->uuid('id_kuri');
            $table->uuid('id_mapel');
            $table->integer('nilai')->nullable();
            $table->foreign('nisn')->references('nisn')->on('siswa');
            $table->foreign('id_kuri')->references('id_kuri')->on('kurikulum');
            $table->foreign('id_kelas')->references('id_kelas')->on('kelas');
            $table->foreign('id_mapel')->references('id_mapel')->on('mapel');
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
        Schema::dropIfExists('detnilai');
    }
}
