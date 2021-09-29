<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToJadwalIbadahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jadwal_ibadah', function (Blueprint $table) {
            $table->time('waktu_ibadah')->after('key')->nullable();
            $table->string('lagu')->after('waktu_ibadah')->nullable();
            $table->foreignId('tempat_ibadah_id')->nullable();
            $table->foreign('tempat_ibadah_id')->references('id')->on('tempat_ibadah')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jadwal_ibadah', function (Blueprint $table) {
            $table->dropColumn('tempat_ibadah_id');
            $table->dropColumn('lagu');
            $table->dropColumn('waktu_ibadah');
        });
    }
}
