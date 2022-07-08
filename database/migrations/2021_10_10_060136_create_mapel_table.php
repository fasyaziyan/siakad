<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMapelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mapel', function (Blueprint $table) {
            $table->uuid('id_mapel')->primary();
            $table->string('nama_mapel');
            $table->uuid('nip');
            $table->timestamps();
        });
        Schema::table('mapel', function (Blueprint $table) {
            $table->foreign('nip')->references('nip')->on('guru');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mapel');
    }
}
