@extends('layouts.admin')

@section('content')
    <h1>Event Management</h1>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Event</th>
                    <th>Deskripsi Event</th>
                    <th>Diskon</th>
                    <th>Hari Event</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($events as $event)
                    <tr>
                        <td>{{ $event->id }}</td>
                        <td>{{ $event->nama_event }}</td>
                        <td>{{ $event->deskripsi_event }}</td>
                        <td>{{ $event->diskon }}</td>
                        <td>{{ $event->hari_event }}</td>
                        <td>
                            <a href="{{ route('event.edit', $event->id) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('event.destroy', $event->id) }}" method="POST" style="display: inline-block;">
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

    <a href="{{ route('event.create') }}" class="btn btn-success">Add New Event</a>
@endsection
