<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalIbadahTamborinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal_ibadah_tamborin', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jadwal_ibadah_id');
            $table->foreignId('petugas_id');
            $table->timestamps();
            $table->foreign('jadwal_ibadah_id')->references('id')->on('jadwal_ibadah')->onDelete('cascade');
            $table->foreign('petugas_id')->references('id')->on('petugas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jadwal_ibadah_tamborin');
    }
}
