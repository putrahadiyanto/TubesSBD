@extends('layouts.admin')

@section('content')
    <h1>Member Management</h1>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Member</th>
                    <th>Nomor Telepon Member</th>
                    <th>Jam Mulai</th>
                    <th>Jam Selesai</th>
                    <th>Hari</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($members as $member)
                    <tr>
                        <td>{{ $member->id }}</td>
                        <td>{{ $member->nama_member }}</td>
                        <td>{{ $member->no_telepon_member }}</td>
                        <td>{{ $member->jam_mulai }}</td>
                        <td>{{ $member->jam_selesai }}</td>
                        <td>{{ $member->hari }}</td>
                        <td>
                            <a href="{{ route('member.edit', $member->id) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('member.destroy', $member->id) }}" method="POST" style="display: inline-block;">
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

    <a href="{{ route('member.create') }}" class="btn btn-success">Add New Member</a>
@endsection
