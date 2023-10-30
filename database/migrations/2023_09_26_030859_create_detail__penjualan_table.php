<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail__penjualan', function (Blueprint $table) {
            $table->unsignedBigInteger('id_transaksi');     
            $table->unsignedBigInteger('id_menu');                 
            $table->integer('jumlah');
            $table->integer('harga_penjualan');             
            $table->timestamps();

            $table->foreign('id_transaksi')->references('id')->on('penjualan');
            $table->foreign('id_menu')->references('id')->on('produks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail__penjualan');
    }
};
