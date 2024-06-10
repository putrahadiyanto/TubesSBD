@extends('layouts.admin')

@section('content')
    <h1>Add New Event</h1>
    <form action="{{ route('event.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nama_event">Nama Event:</label>
            <input type="text" name="nama_event" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="deskripsi_event">Deskripsi Event:</label>
            <textarea name="deskripsi_event" class="form-control" rows="3" required></textarea>
        </div>
        <div class="form-group">
            <label for="diskon">Diskon:</label>
            <input type="number" name="diskon" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="hari_event">Hari Event:</label>
            <select name="hari_event" class="form-control" required>
                <option value="" hidden selected>Select a day</option>
                <option value="Monday">Monday</option>
                <option value="Tuesday">Tuesday</option>
                <option value="Wednesday">Wednesday</option>
                <option value="Thursday">Thursday</option>
                <option value="Friday">Friday</option>
                <option value="Saturday">Saturday</option>
                <option value="Sunday">Sunday</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
