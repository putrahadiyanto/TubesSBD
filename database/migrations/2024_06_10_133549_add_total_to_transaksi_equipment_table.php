<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('transaksi_equipment', function (Blueprint $table) {
            $table->decimal('total', 10, 2)->after('jumlah_equipment')->default(0);
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('transaksi_equipment', function (Blueprint $table) {
            $table->dropColumn('total');
        });
    }
};
