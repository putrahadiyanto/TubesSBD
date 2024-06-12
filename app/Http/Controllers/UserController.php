<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function insertEmail(){
        return view('user.insertEmail');
    }

    public function cekEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        // Check if email exists in the peminjam table
        $email = $request->email;
        $emailExists = DB::selectOne('SELECT cekEmailPeminjam(?) AS emailExists', [$email]);

        if ($emailExists->emailExists == 1) {

            // Retrieve booking data
            $bookings = DB::select('SELECT bookings.*, peminjam.*, events.* 
                        FROM bookings 
                        INNER JOIN peminjam ON bookings.id_peminjam = peminjam.id_peminjam
                        LEFT JOIN events ON bookings.id_event = events.id
                        WHERE peminjam.email_peminjam = ?', [$email]);

            // Return the list-booking view with the booking data
            return view('user.list-booking', compact('bookings'));
        } else {
            // If email is not found, redirect back to insertEmail with an error message
            return view('user.insertEmail')->withErrors(['email' => 'Email tidak ditemukan.']);
        }
    }


}
