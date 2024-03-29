<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRawatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rawat', function (Blueprint $table) {
            $table->bigIncrements('id_rawat');

            $table->bigInteger('id_pasien')->unsigned();
            $table->foreign('id_pasien')->references('id_pasien')->on('pasien')->onDelete('cascade');

            $table->bigInteger('id_dokter')->unsigned();
            $table->foreign('id_dokter')->references('id_dokter')->on('dokter')->onDelete('cascade');

            $table->bigInteger('id_kamar')->unsigned();
            $table->foreign('id_kamar')->references('id_kamar')->on('kamar')->onDelete('cascade');

            // $table->bigInteger('id_hasil')->unsigned();
            // $table->foreign('id_hasil')->references('id_hasil')->on('hasil')->onDelete('cascade');

            // $table->integer('lama_inap');
            $table->date('tanggal_inap');
            $table->date('tanggal_inap_selesai');
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
        Schema::dropIfExists('rawat');
    }
}
