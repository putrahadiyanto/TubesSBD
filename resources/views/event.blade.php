@extends('layouts.app')

@section('content')
<div class="page-title" data-aos="fade" style="background-image: url(assets/img/fotofor.jpg);">
    <div class="container position-relative">
        <h1>Event Summary</h1>
        <nav class="breadcrumbs">
            <ol>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li class="current">Event Summary</li>
            </ol>
        </nav>
    </div>
</div><!-- End Page Title -->
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Event Summary</div>
                <div class="card-body">
                    <h3>{{ $booking->nama_event }}</h3>
                    <p>{{ $booking->deskripsi_event }}</p>
                    <p>Diskon: {{ $booking->diskon }}%</p>
                    <p>Total Harga: Rp {{ number_format($booking->total, 2) }}</p>
                    <a href="{{ route('home') }}" class="btn btn-primary">Bayar</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
