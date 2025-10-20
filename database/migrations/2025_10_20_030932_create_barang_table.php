<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->id('id_barang');
            $table->string('kode_barang', 20)->unique();
            $table->string('nama_barang', 200);
            $table->text('deskripsi')->nullable();
            $table->unsignedBigInteger('id_bagian');
            $table->unsignedBigInteger('id_jenis');
            $table->unsignedBigInteger('id_tipe');
            $table->unsignedBigInteger('id_status');
            $table->date('tanggal_masuk');
            $table->bigInteger('harga')->nullable();
            $table->string('lokasi', 100)->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
            
            $table->foreign('id_bagian')->references('id_bagian')->on('bagian')->onDelete('cascade');
            $table->foreign('id_jenis')->references('id_jenis')->on('jenis_barang')->onDelete('cascade');
            $table->foreign('id_tipe')->references('id_tipe')->on('tipe_barang')->onDelete('cascade');
            $table->foreign('id_status')->references('id_status')->on('status_barang')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barang');
    }
}
