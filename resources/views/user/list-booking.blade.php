@extends('layouts.app')

@section('content')
<div class="page-title" data-aos="fade" style="background-image: url({{ asset('assets/img/fotofor.jpg') }});">
    <div class="container position-relative">
        <h1>List Booking</h1>
        <nav class="breadcrumbs">
            <ol>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li class="current">List Booking</li>
            </ol>
        </nav>
    </div>
</div><!-- End Page Title -->
<div class="container my-4">
    <h1>Booking List</h1>

    @if(count($bookings) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Peminjam</th>
                    <th>Tanggal Booking</th>
                    <th>Jam Mulai</th>
                    <th>Jam Selesai</th>
                    <th>Total</th>
                    <th>Status Pembayaran</th>
                    <th>Status Booking</th>
                    <th>Event ID</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $index => $booking)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $booking->nama_peminjam }}</td>
                        <td>{{ $booking->tanggal_booking }}</td>
                        <td>{{ $booking->jam_mulai }}</td>
                        <td>{{ $booking->jam_selesai }}</td>
                        <td>{{ number_format($booking->total) }}</td>
                        <td>{{ $booking->status_pembayaran }}</td>
                        <td>{{ $booking->status_booking }}</td>
                        <td>{{ $booking->nama_event }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No bookings found.</p>
    @endif
</div>
@endsection
