<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TambahKolomNikDanBarangKeAngsurans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('angsurans', function (Blueprint $table) {
            $table->string('nik');
            $table->string('barang');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('angsurans', function (Blueprint $table) {
            $table->dropColumn('nik')->after('nama');
            $table->dropColumn('barang')->after('nik');
        });
    }
}
