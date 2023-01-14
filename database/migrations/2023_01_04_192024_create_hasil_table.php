<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHasilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hasil', function (Blueprint $table) {
            $table->bigIncrements('id_hasil');

            $table->bigInteger('id_dokter')->unsigned();
            $table->foreign('id_dokter')->references('id_dokter')->on('dokter')->onDelete('cascade');
            $table->bigInteger('id_pasien')->unsigned();
            $table->foreign('id_pasien')->references('id_pasien')->on('pasien')->onDelete('cascade');

            $table->text('alamat');
            $table->integer('lama_inap');
            $table->enum('keterangan', ['rawat_inap', 'pulang']);
            $table->date('tanggal');
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
        Schema::dropIfExists('hasil');
    }
}
