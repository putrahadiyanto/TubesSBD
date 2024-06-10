<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Http\Controllers\EventController;

class BookingController extends Controller
{

    public function create()
    {
        
        $events = DB::select('SELECT * FROM events');
        
        return view('booking', compact('events'));
    }

   public function book(){
        $bookings = DB::select('SELECT * FROM bookings');
        return view('booking', compact('bookings'));
   }


   public function store(Request $request)
{
    // Extract form data
    $nama_peminjam = $request->nama_peminjam;
    $no_telepon = $request->no_telepon;
    $tanggal_booking = $request->tanggal_booking;
    $jam_mulai = $request->jam_mulai;
    $jam_selesai = $request->jam_selesai;
    $total = $request->total_price;

    // Get the day of the week for the booking date
    $dayOfWeek = Carbon::parse($tanggal_booking)->format('l');

    // Check for conflicts with members' reserved times
    $conflict = DB::table('members')
        ->where('hari', $dayOfWeek)
        ->where(function($query) use ($jam_mulai, $jam_selesai) {
            $query->where(function($query) use ($jam_mulai, $jam_selesai) {
                $query->where('jam_mulai', '<=', $jam_mulai)
                      ->where('jam_selesai', '>', $jam_mulai);
            })->orWhere(function($query) use ($jam_mulai, $jam_selesai) {
                $query->where('jam_mulai', '<', $jam_selesai)
                      ->where('jam_selesai', '>=', $jam_selesai);
            })->orWhere(function($query) use ($jam_mulai, $jam_selesai) {
                $query->where('jam_mulai', '>=', $jam_mulai)
                      ->where('jam_selesai', '<=', $jam_selesai);
            });
        })
        ->exists();

    if ($conflict) {
        return back()->withErrors(['error' => 'The selected time slot is already reserved by a member.']);
    }

    // Perform SQL insertion
    $bookingId = DB::table('bookings')->insertGetId([
        'nama_peminjam' => $nama_peminjam,
        'no_telepon' => $no_telepon,
        'tanggal_booking' => $tanggal_booking,
        'jam_mulai' => $jam_mulai,
        'jam_selesai' => $jam_selesai,
        'total' => $total,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    // Redirect back with success message
    return redirect()->route('event', ['id' => $bookingId])->with('success', 'Booking has been created successfully!');
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

   public function summary(string $id){
    $booking = DB::selectOne('
        SELECT bookings.*, events.*
        FROM bookings
        INNER JOIN events ON bookings.id_event = events.id
        WHERE bookings.id = ?', [$id]);

    // Pass the $booking data to the view
    return view('event', ['booking' => $booking]);
    }

}