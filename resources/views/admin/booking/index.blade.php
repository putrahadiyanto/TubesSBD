@extends('layouts.admin')

@section('content')
    <h1>Booking Management</h1>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Peminjam</th>
                    <th>No Telepon</th>
                    <th>Tanggal Booking</th>
                    <th>Jam Mulai</th>
                    <th>Jam Selesai</th>
                    <th>Total</th>
                    <th>Event</th>
                    <th>Status Pembayaran</th>
                    <th>Status Booking</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                    <tr>
                        <td>{{ $booking->id }}</td>
                        <td>{{ $booking->nama_peminjam }}</td>
                        <td>{{ $booking->no_telepon }}</td>
                        <td>{{ $booking->tanggal_booking }}</td>
                        <td>{{ $booking->jam_mulai }}</td>
                        <td>{{ $booking->jam_selesai }}</td>
                        <td>{{ $booking->total }}</td>
                        <td>{{ $booking->event_name }}</td>
                        <td>{{ $booking->status_pembayaran }}</td>
                        <td>{{ $booking->status_booking }}</td>
                        <td>
                            <a href="{{ route('booking.edit', $booking->id) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('booking.destroy', $booking->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <a href="{{ route('booking.create') }}" class="btn btn-success">Add New Booking</a>
@endsection
