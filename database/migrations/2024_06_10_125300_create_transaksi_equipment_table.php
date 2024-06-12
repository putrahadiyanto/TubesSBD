<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaksi_equipment', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('booking_id');
            $table->unsignedBigInteger('equipment_id');
            $table->integer('jumlah_equipment');
            $table->decimal('total', 10, 2)->default(0);
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');
            $table->foreign('equipment_id')->references('id')->on('equipments')->onDelete('cascade');
        });

        DB::unprepared('
            CREATE TRIGGER decrement_stok_after_insert AFTER INSERT ON transaksi_equipment
            FOR EACH ROW
            BEGIN
                UPDATE equipments
                SET stok = stok - NEW.jumlah_equipment
                WHERE id = NEW.equipment_id;
            END
        ');

        DB::unprepared('
            CREATE TRIGGER `update_bookings_total` AFTER INSERT ON `transaksi_equipment`
            FOR EACH ROW BEGIN
                DECLARE total_amount DECIMAL(10, 2);
            
                -- Calculate the total amount from transaksi_equipment for the new booking
                SELECT SUM(total) INTO total_amount
                FROM transaksi_equipment
                WHERE booking_id = NEW.booking_id;
            
                -- Update the bookings table with the new total amount
                UPDATE bookings
                SET total = total + total_amount
                WHERE id = NEW.booking_id;
            END
        ');

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS decrement_stok_after_insert');
        DB::unprepared('DROP TRIGGER IF EXISTS update_bookings_total');

        Schema::dropIfExists('transaksi_equipment');
    }
};