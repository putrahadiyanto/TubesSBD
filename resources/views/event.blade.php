@extends('layouts.app')

@section('content')
<div class="page-title" data-aos="fade" style="background-image: url(assets/img/fotofor.jpg);">
    <div class="container position-relative">
        <h1>Booking Summary</h1>
        <nav class="breadcrumbs">
            <ol>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li class="current">Booking Summary</li>
            </ol>
        </nav>
    </div>
</div><!-- End Page Title -->
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Booking Summary</div>
                <div class="card-body">
                    <p>Name: {{ $booking->nama_peminjam }}</p>
                    <p>Email: {{ $booking->email_peminjam }}</p>
                    <p>Tanggal Booking: {{ $booking->tanggal_booking }}</p>
                    <p>Jam Mulai: {{ $booking->jam_mulai }}</p>
                    <p>Jam Selesai: {{ $booking->jam_selesai }}</p>
                    @if($booking->diskon)
                        <strong> Diskon {{ $booking->nama_event }}</strong>
                        <p>Diskon: {{ $booking->diskon }}%</p>
                    @endif
                    <p>Total: Rp {{ number_format($booking->total, 2) }}</p>
                    <!-- Include other peminjam details here -->
                    <form method="POST" action="{{ route('cekEmail') }}">
                        @csrf
                        <input type="hidden" name="email" value="{{ $booking->email_peminjam }}">
                        <button type="submit" class="btn btn-primary">List Booking</button>
                    </form>                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
