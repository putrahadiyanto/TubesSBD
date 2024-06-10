<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use carbon\carbon;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = DB::select('SELECT * FROM events');
        return view('admin.event.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Fetch events data using classic SQL query
        $events = DB::select('SELECT * FROM events');

        // Pass events data to the view
        return view('booking', compact('events'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_event' => 'required|string|max:255',
            'deskripsi_event' => 'required|string',
            'diskon' => 'required|numeric|min:0|max:100',
            'hari_event' => 'required|string|max:255',
        ]);

        DB::insert('INSERT INTO events (nama_event, deskripsi_event, diskon, hari_event, created_at, updated_at) VALUES (?, ?, ?, ?, NOW(), NOW())', [
            $request->nama_event,
            $request->deskripsi_event,
            $request->diskon,
            $request->hari_event,
        ]);

        return redirect()->route('event.index')
            ->with('success', 'Event created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $event = DB::select('SELECT * FROM events WHERE id = ?', [$id]);

        if (empty($event)) {
            return redirect()->route('event.index')->with('error', 'Event not found.');
        }

        return view('admin.event.show', ['event' => $event[0]]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $event = DB::select('SELECT * FROM events WHERE id = ?', [$id]);

        if (empty($event)) {
            return redirect()->route('event.index')->with('error', 'Event not found.');
        }

        return view('admin.event.edit', ['event' => $event[0]]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_event' => 'required|string|max:255',
            'deskripsi_event' => 'required|string',
            'diskon' => 'required|numeric|min:0|max:100',
            'hari_event' => 'required|string|max:255',
        ]);

        DB::update('UPDATE events SET nama_event = ?, deskripsi_event = ?, diskon = ?, hari_event = ?, updated_at = NOW() WHERE id = ?', [
            $request->nama_event,
            $request->deskripsi_event,
            $request->diskon,
            $request->hari_event,
            $id,
        ]);

        return redirect()->route('event.index')
            ->with('success', 'Event updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::delete('DELETE FROM events WHERE id = ?', [$id]);

        return redirect()->route('event.index')
            ->with('success', 'Event deleted successfully.');
    }

    public function summary($id)
    {
        $booking = DB::table('bookings')->find($id);
    
        if (!$booking) {
            return redirect()->route('booking.book')->with('error', 'Booking not found.');
        }
    
        // Lakukan pengolahan untuk mendapatkan informasi event, diskon, dan total harga setelah diskon
        // Anda bisa mendapatkan informasi event berdasarkan tanggal booking atau event tertentu yang terkait dengan booking
    
        // Misalnya:
        $event = DB::table('events')->where('hari_event', Carbon::parse($booking->tanggal_booking)->format('l'))->first();
    
        if (!$event) {
            return redirect()->route('booking')->with('error', 'Event not found.');
        }
    
        // Hitung total harga setelah diskon
        $discountedTotal = $booking->total - ($booking->total * $event->diskon / 100);

        $booking->total = $discountedTotal;
    
        return view('event', [
            'booking' => $booking,
            'event' => $event,
            'discounted_total' => $discountedTotal,
        ]);
    }
    
    

}
