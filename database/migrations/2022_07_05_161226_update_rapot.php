<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRapot extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rapot', function (Blueprint $table) {
            $table->integer('sakit')->nullable()->after('keterangan');
            $table->integer('izin')->nullable()->after('sakit');
            $table->integer('alpa')->nullable()->after('izin');
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
