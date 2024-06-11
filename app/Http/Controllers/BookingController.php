<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Http\Controllers\EventController;

class BookingController extends Controller
{

    public function enteremail()
    {
        return view('email');
    }

    public function processEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        // Periksa apakah email ada dalam tabel peminjam menggunakan fungsi cekEmailPeminjam
        $email = $request->email;
        $emailExists = DB::selectOne('SELECT cekEmailPeminjam(?) AS emailExists', [$email]);

        if ($emailExists->emailExists == 0) {
            // Jika email ditemukan, simpan email di sesi dan arahkan ke halaman memasukkan nomor telepon
            $request->session()->put('email', $email);
            return redirect()->route('enterPhone');
        } else {
            // Jika email tidak ditemukan, cari id email dan kembalikan dengan pesan kesalahan
            $emailId = DB::selectOne('SELECT id_peminjam FROM peminjam WHERE email_peminjam = ?', [$email]);

            // Check if emailId is not null before accessing its property
            // Pass the email id with the error message
            return redirect()->route('bookingstore', ['id_peminjam' => $emailId->id_peminjam])->with('error', 'Email not found in our records.');
        }
    }
 


    public function enterPhone()
    {
        return view('telepon');
    }

    public function processPhone(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required',
        ]);

        $email = $request->session()->get('email');

        // Execute the SQL INSERT query using Laravel's database facade
        DB::insert("INSERT INTO peminjam (email_peminjam, nama_peminjam, nomor_telepon_peminjam) VALUES (?, ?, ?)", [
            $email,
            $request->name,
            $request->phone,
        ]);

        // Execute a separate SQL query to fetch the last inserted ID
        $result = DB::select("SELECT LAST_INSERT_ID() AS id");
        $peminjamId = $result[0]->id;

        // Redirect to the next page with the success message and the ID of the newly inserted peminjam
        return redirect()->route('bookingstore', ['id_peminjam' => $peminjamId])->with('success', 'Peminjam added successfully.');
    }

    public function index(){
        $bookings = DB::select('
            SELECT bookings.*, events.nama_event AS event_name
            FROM bookings
            LEFT JOIN events ON bookings.id_event = events.id');
    
        return view('admin.booking.index', compact('bookings'));
    }
    

    public function create($id_peminjam)
    {
        return view('booking', compact('id_peminjam'));
    }


   public function book(){
        $bookings = DB::select('SELECT * FROM bookings');
        return view('booking', compact('bookings'));
   }

    public function createEquipment($bookingId){
        $equipments = DB::select('SELECT * FROM equipments');
        return view('equipment', compact('equipments', 'bookingId'));
    }
    
    public function storeEquipment(Request $request)
    {
        $bookingId = $request->booking_id; // Retrieve the booking_id from the request

        if ($request->has('tambahanCheckbox')) {
            $equipmentId = $request->equipment_id;
            $jumlahEquipment = $request->quantity;
            
            // Fetch the equipment details from the database
            $equipment = DB::selectOne("SELECT * FROM equipments WHERE id = ?", [$equipmentId]);
            
            // Calculate the total price based on quantity and equipment price
            $total = $jumlahEquipment * $equipment->harga;
            
            // Insert the data into the equipments table
            DB::insert("INSERT INTO transaksi_equipment (booking_id, equipment_id, jumlah_equipment, total, created_at, updated_at) VALUES (?, ?, ?, ?, NOW(), NOW())
            ", [
                $bookingId,
                $equipmentId,
                $jumlahEquipment,
                $total,
            ]);

            return redirect()->route('event', ['id' => $bookingId])->with('success', 'Equipment added successfully.');
        } else {
            // If no additional equipment is selected, redirect back to the event page
            return redirect()->route('event', ['id' => $bookingId]);
        }
    }

    public function store(Request $request)
    {
        // Extract data from the request
        $id_peminjam = $request->id_peminjam;
        $tanggal_booking = $request->tanggal_booking;
        $jam_mulai = $request->jam_mulai;
        $jam_selesai = $request->jam_selesai;
        $total_price = $request->total_price;
    
        // Perform SQL insertion for bookings table using classic SQL query
        DB::insert("
            INSERT INTO bookings (id_peminjam, tanggal_booking, jam_mulai, jam_selesai, total, created_at, updated_at)
            VALUES (?, ?, ?, ?, ?, NOW(), NOW())
        ", [
            $id_peminjam,
            $tanggal_booking,
            $jam_mulai,
            $jam_selesai,
            $total_price,
        ]);
    
        // Get the ID of the newly created booking
        $result = DB::select("SELECT LAST_INSERT_ID() AS id");
        $bookingId = $result[0]->id;
    
        // Redirect back to the event page with the ID of the newly created booking
        return redirect()->route('createEquipment', ['id' => $bookingId])->with('success', 'Booking created successfully.');
    }
    
   
   
   public function show($id)
   {
       $booking = DB::select('SELECT * FROM bookings WHERE id = ?', [$id]);
   
       if (empty($booking)) {
           // Redirect or handle the case where the booking with the given id does not exist
           return redirect()->route('booking.book')->with('error', 'Booking not found.');
       }
   
       return view('booking.show', ['booking' => $booking[0]]);
   }

   public function edit($id)
    {
        $booking = DB::select('SELECT * FROM bookings WHERE id = ?', [$id]);

        if (empty($booking)) {
            return redirect()->route('booking.index')->with('error', 'Booking not found.');
        }

        return view('admin.booking.edit', ['booking' => $booking[0]]);
    }

    public function update(Request $request, $id)
    {

        DB::update('UPDATE bookings SET 
            nama_peminjam = ?, 
           
            tanggal_booking = ?, 
            jam_mulai = ?, 
            jam_selesai = ?, 
            total = ?, 
            status_pembayaran = ?, 
            status_booking = ?, 
            updated_at = NOW() 
            WHERE id = ?', [
                $request->nama_peminjam,
                $request->tanggal_booking,
                $request->jam_mulai,
                $request->jam_selesai,
                $request->total,
                $request->status_pembayaran, // Ensure this is a string value
                $request->status_booking, // Ensure this is a string value
                $id,
            ]);

        return redirect()->route('booking.index')->with('success', 'Booking updated successfully.');
    }


   public function destroy($id) {

        DB::statement('DELETE FROM bookings WHERE id = ?', [$id]);

        return redirect()->route('booking.index')->with('success', 'Booking deleted successfully');
    }


    public function summary(string $id) {
        $booking = DB::selectOne('
            SELECT bookings.*, events.*
            FROM bookings
            LEFT JOIN events ON bookings.id_event = events.id
            WHERE bookings.id = ? AND bookings.id_event IS NULL
        ', [$id]);

        if (!$booking) {
            $booking = DB::selectOne('
                SELECT bookings.*, events.*
                FROM bookings
                INNER JOIN events ON bookings.id_event = events.id
                WHERE bookings.id = ?
            ', [$id]);
        }
    
        // Pass the $booking data to the view
        return view('event', ['booking' => $booking]);
    }
    

}