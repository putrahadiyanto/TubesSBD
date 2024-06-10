@extends('layouts.admin')

@section('content')
    <h1>Edit Event</h1>
    <form action="{{ route('event.update', $event->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nama_event">Nama Event:</label>
            <input type="text" name="nama_event" class="form-control" value="{{ $event->nama_event }}" required>
        </div>
        <div class="form-group">
            <label for="deskripsi_event">Deskripsi Event:</label>
            <textarea name="deskripsi_event" class="form-control" rows="3" required>{{ $event->deskripsi_event }}</textarea>
        </div>
        <div class="form-group">
            <label for="diskon">Diskon:</label>
            <input type="number" name="diskon" class="form-control" value="{{ $event->diskon }}" required>
        </div>
        <div class="form-group">
            <label for="hari_event">Hari Event:</label>
            <select name="hari_event" class="form-control" required>
                <option value="" hidden>Select a day</option>
                <option value="Monday" {{ $event->hari_event == 'Monday' ? 'selected' : '' }}>Monday</option>
                <option value="Tuesday" {{ $event->hari_event == 'Tuesday' ? 'selected' : '' }}>Tuesday</option>
                <option value="Wednesday" {{ $event->hari_event == 'Wednesday' ? 'selected' : '' }}>Wednesday</option>
                <option value="Thursday" {{ $event->hari_event == 'Thursday' ? 'selected' : '' }}>Thursday</option>
                <option value="Friday" {{ $event->hari_event == 'Friday' ? 'selected' : '' }}>Friday</option>
                <option value="Saturday" {{ $event->hari_event == 'Saturday' ? 'selected' : '' }}>Saturday</option>
                <option value="Sunday" {{ $event->hari_event == 'Sunday' ? 'selected' : '' }}>Sunday</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
