@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Booking</div>
                <div class="card-body">
                    <form method="POST" action="">
                        @csrf
                        
                        <div class="form-group">
                            <label for="total">Total</label>
                            <input type="number" name="total" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="status_pembayaran">Status Pembayaran</label>
                            <select name="status_pembayaran" class="form-control" required>
                                <option value="Belum lunas">Belum lunas</option>
                                <option value="Lunas">Lunas</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="status_booking">Status Booking</label>
                            <select name="status_booking" class="form-control" required>
                                <option value="Proses">Proses</option>
                                <option value="Selesai">Selesai</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="id_event">Event</label>
                            <select name="id_event" class="form-control">
                                <!-- Populate this select with events from your database -->
                            </select>
                        </div>

                        <form id="emailForm" method="POST" action="{{ route('cekEmail') }}">
                            @csrf
                            <input type="hidden" name="email" value="{{ $Email }}">
                            <button type="submit" class="btn btn-primary mt-3">Submit</button>
                        </form>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
