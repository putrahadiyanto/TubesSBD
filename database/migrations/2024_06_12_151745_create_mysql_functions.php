<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Drop the cekEmailPeminjam function if it exists
        DB::unprepared('DROP FUNCTION IF EXISTS `cekEmailPeminjam`');

        // Creating cekEmailPeminjam function
        DB::unprepared('
            CREATE FUNCTION `cekEmailPeminjam`(email VARCHAR(255)) RETURNS int
            DETERMINISTIC
            BEGIN
                DECLARE countEmail INT;
                SELECT COUNT(*) INTO countEmail FROM peminjam WHERE email_peminjam = email COLLATE utf8mb4_unicode_ci;
                IF countEmail > 0 THEN
                    RETURN 1;
                ELSE
                    RETURN 0;
                END IF;
            END
        ');

        // Drop the checkBookingOverlap function if it exists
        DB::unprepared('DROP FUNCTION IF EXISTS `checkBookingOverlap`');

        // Creating checkBookingOverlap function
        DB::unprepared('
            CREATE FUNCTION `checkBookingOverlap`(check_date DATE, start_time TIME, end_time TIME) RETURNS tinyint(1)
            DETERMINISTIC
            BEGIN
                DECLARE overlap_count INT;

                -- Count the number of overlapping bookings
                SELECT COUNT(*) INTO overlap_count
                FROM bookings
                WHERE tanggal_booking = check_date
                    AND (
                        (jam_mulai < end_time AND jam_selesai > start_time)
                        OR (jam_mulai >= start_time AND jam_selesai <= end_time)
                    );

                -- Return true if there are any overlapping bookings, false otherwise
                IF overlap_count > 0 THEN
                    RETURN TRUE;
                ELSE
                    RETURN FALSE;
                END IF;
            END
        ');

        // Drop the checkScheduleConflict function if it exists
        DB::unprepared('DROP FUNCTION IF EXISTS `checkScheduleConflict`');

        // Creating checkScheduleConflict function
        DB::unprepared('
            CREATE FUNCTION `checkScheduleConflict`(
                p_tanggal_booking DATE,
                p_jam_mulai TIME,
                p_jam_selesai TIME
            ) RETURNS int
            DETERMINISTIC
            BEGIN
                DECLARE conflict_count INT;

                -- Count the number of overlapping schedules
                SELECT COUNT(*) INTO conflict_count
                FROM members
                WHERE hari = DAYNAME(p_tanggal_booking)
                AND ((p_jam_mulai BETWEEN jam_mulai AND jam_selesai)
                    OR (p_jam_selesai BETWEEN jam_mulai AND jam_selesai)
                    OR (jam_mulai BETWEEN p_jam_mulai AND p_jam_selesai));

                RETURN conflict_count;
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Dropping the cekEmailPeminjam function
        DB::unprepared('DROP FUNCTION IF EXISTS `cekEmailPeminjam`');

        // Dropping the checkBookingOverlap function
        DB::unprepared('DROP FUNCTION IF EXISTS `checkBookingOverlap`');

        // Dropping the checkScheduleConflict function
        DB::unprepared('DROP FUNCTION IF EXISTS `checkScheduleConflict`');
    }
};
