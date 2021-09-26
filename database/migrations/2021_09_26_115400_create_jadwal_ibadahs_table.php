<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalIbadahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal_ibadah', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('key');
            $table->foreignId('jadwal_id');
            $table->foreignId('leader_id');
            $table->foreignId('pembaca_kitab_id');
            $table->foreignId('pembaca_doa_id');
            $table->timestamps();
            $table->foreign('jadwal_id')->references('id')->on('jadwal')->onDelete('cascade');
            $table->foreign('leader_id')->references('id')->on('petugas')->onDelete('cascade');
            $table->foreign('pembaca_kitab_id')->references('id')->on('petugas')->onDelete('cascade');
            $table->foreign('pembaca_doa_id')->references('id')->on('petugas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jadwal_ibadah');
    }
}
