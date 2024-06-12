@extends('layouts.app')

@section('content')
<div class="page-title" data-aos="fade" style="background-image: url({{ asset('assets/img/fotofor.jpg') }});">
    <div class="container position-relative">
        <h1>Enter Email</h1>
        <nav class="breadcrumbs">
            <ol>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li class="current">Enter Email</li>
            </ol>
        </nav>
    </div>
</div><!-- End Page Title -->

<div class="container my-4">
    <div class="card">
        <div class="card-header">Enter Email</div>
        <div class="card-body">
            <form method="POST" action="{{ route('cekEmail') }}" id="emailForm">
                @csrf

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" required>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
