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
            Schema::create('bookings', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('id_peminjam')->nullable();
                $table->date('tanggal_booking'); 
                $table->time('jam_mulai');
                $table->time('jam_selesai');
                $table->decimal('total', 10, 2);
                $table->enum('status_pembayaran', ['Belum lunas', 'Lunas']);
                $table->enum('status_booking', ['Proses', 'Selesai']);
                $table->unsignedBigInteger('id_event')->nullable();  

                $table->timestamps();

                // Foreign key constraints
                $table->foreign('id_event')->references('id')->on('events')->onDelete('set null');
                $table->foreign('id_peminjam')->references('id_peminjam')->on('peminjam')->onDelete('set null');
            });

            DB::unprepared('
                CREATE TRIGGER update_booking_event BEFORE INSERT ON bookings
                FOR EACH ROW
                BEGIN
                    DECLARE event_id INT;
                    DECLARE event_discount DECIMAL(5, 2);

                    -- Fetch the event ID and discount based on the booking date
                    SELECT id, diskon INTO event_id, event_discount 
                    FROM events 
                    WHERE hari_event = DAYNAME(NEW.tanggal_booking) LIMIT 1;

                    -- Check if the event is found for the booking date
                    IF event_id IS NOT NULL THEN
                        -- Update the booking ID with the event ID
                        SET NEW.id_event = event_id;

                        -- Apply discount to the booking total
                        SET NEW.total = NEW.total - (NEW.total * event_discount / 100);
                    END IF;
                END
            ');

        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            DB::unprepared('DROP TRIGGER IF EXISTS update_booking_event');
            Schema::dropIfExists('bookings');
        }
    };