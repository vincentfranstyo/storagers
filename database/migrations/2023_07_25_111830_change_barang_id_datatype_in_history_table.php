<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeBarangIdDatatypeInHistoryTable extends Migration
{
    public function up()
    {
        Schema::table('history', function (Blueprint $table) {
            $table->string('barang_id')->change();
        });
    }

    public function down()
    {
        Schema::table('history', function (Blueprint $table) {
            $table->bigInteger('barang_id')->unsigned()->change();
        });
    }
}
