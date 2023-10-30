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
        Schema::create('penjualan', function (Blueprint $table) {
            $table->id();  
            $table->unsignedBigInteger('id_pelanggan');
            $table->unsignedBigInteger('id_kasirs'); 
            $table->enum('status_transaksi', ['0', '1', '-1']);    
            $table->string('bukti_tf')->nullable();
            $table->timestamps();

            $table->foreign('id_pelanggan')->references('id')->on('users');
            $table->foreign('id_kasirs')->references('id')->on('kasirs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penjualan');
    }
};
