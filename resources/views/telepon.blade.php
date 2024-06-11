@extends('layouts.app')

@section('content')
<div class="page-title" data-aos="fade" style="background-image: url({{ asset('assets/img/fotofor.jpg') }});">
    <div class="container position-relative">
        <h1>Enter Phone Number</h1>
        <nav class="breadcrumbs">
            <ol>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li class="current">Enter Phone Number</li>
            </ol>
        </nav>
    </div>
</div><!-- End Page Title -->

<div class="container my-4">
    <div class="card">
        <div class="card-header">Isi data</div>
        <div class="card-body">
            <form method="POST" action="{{ route('telepon') }}" id="phoneForm">
                @csrf

                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="text" name="phone" id="phone" class="form-control" required>
                </div>                

                <div class="form-group">
                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
