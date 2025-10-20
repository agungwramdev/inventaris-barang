<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipeBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipe_barang', function (Blueprint $table) {
            $table->id('id_tipe');
            $table->string('nama_tipe', 100);
            $table->unsignedBigInteger('id_jenis');
            $table->timestamps();
            
            $table->foreign('id_jenis')->references('id_jenis')->on('jenis_barang')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipe_barang');
    }
}
