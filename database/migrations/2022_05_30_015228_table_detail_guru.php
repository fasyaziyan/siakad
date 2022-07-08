<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TableDetailGuru extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_guru', function (Blueprint $table) {
            $table->uuid('nip');
            $table->uuid('id_mapel');
            $table->foreign('nip')->references('nip')->on('mapel');
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
        //
    }
}
