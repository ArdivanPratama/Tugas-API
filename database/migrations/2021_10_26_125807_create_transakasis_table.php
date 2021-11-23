<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransakasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id('id_transaksi');
            $table->string('nama_transaksi');
            $table->integer('id_user');
            $table->string('nama_user');
            $table->string('nama_barang');
            $table->string('jenis_barang');
            $table->integer('ukuran');
            $table->string('no_telpon_user', 15);
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
        Schema::dropIfExists('transaksis');
    }
}
