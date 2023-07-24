<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('history', function (Blueprint $table) {
            $table->id('history_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('barang_id');
            $table->integer('jumlah');
            $table->decimal('total_harga', 8, 2);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            // Add any other foreign key constraints if needed
        });
    }

    public function down()
    {
        Schema::dropIfExists('history');
    }
};
