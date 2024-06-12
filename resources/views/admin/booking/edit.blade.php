@extends('layouts.admin')

@section('content')
    <h1>Edit Booking</h1>
    <form action="{{ route('booking.update', $booking->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nama_peminjam">Nama Peminjam:</label>
            <input type="text" name="nama_peminjam" class="form-control" value="{{ $booking->nama_peminjam }}" required>
        </div>
        <div class="form-group">
            <label for="no_telepon">No Telepon:</label>
            <input type="text" name="no_telepon" class="form-control" value="{{ $booking->nomor_telepon_peminjam }}" required>
            <input type="hidden" name="id_peminjam" class="form-control" value="{{ $booking->id_peminjam }}" required>
        </div>
        <div class="form-group">
            <label for="tanggal_booking">Tanggal Booking:</label>
            <input type="date" name="tanggal_booking" class="form-control" value="{{ $booking->tanggal_booking }}" required>
        </div>
        <div class="form-group">
            <label for="jam_mulai">Jam Mulai:</label>
            <input type="time" name="jam_mulai" class="form-control" value="{{ $booking->jam_mulai }}" required>
        </div>
        <div class="form-group">
            <label for="jam_selesai">Jam Selesai:</label>
            <input type="time" name="jam_selesai" class="form-control" value="{{ $booking->jam_selesai }}" required>
        </div>
        <div class="form-group">
            <label for="total">Total:</label>
            <input type="text" name="total" class="form-control" value="{{ $booking->total }}" required>
        </div>
        <div class="form-group">
            <label for="status_pembayaran">Status Pembayaran:</label>
            <select name="status_pembayaran" class="form-control" required>
                <option value = "Belum lunas" {{ $booking->status_pembayaran == 'Belum lunas' ? 'selected' : '' }}>Belum lunas</option>
                <option value = "Lunas" {{ $booking->status_pembayaran == 'Lunas' ? 'selected' : '' }}>Lunas</option>
            </select>
        </div>
        <div class="form-group">
            <label for="status_booking">Status Booking:</label>
            <select name="status_booking" class="form-control" required>
                <option value = "Proses" {{ $booking->status_booking == 'Proses' ? 'selected' : '' }}>Proses</option>
                <option value = "Selesai" {{ $booking->status_booking == 'Selesai' ? 'selected' : '' }}>Selesai</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
