<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRapot extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rapot', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('nisn');
            $table->uuid('id_kuri');
            $table->uuid('id_kelas');
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
        Schema::table('rapot', function (Blueprint $table) {
            $table->foreign('nisn')->references('nisn')->on('siswa');
            $table->foreign('id_kuri')->references('id_kuri')->on('kurikulum');
            $table->foreign('id_kelas')->references('id_kelas')->on('kelas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rapot');
    }
}
