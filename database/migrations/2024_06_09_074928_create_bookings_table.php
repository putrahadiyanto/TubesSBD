    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

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
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('bookings');
        }
    };