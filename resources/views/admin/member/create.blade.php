<!-- resources/views/admin/member/create.blade.php -->
@extends('layouts.admin')

@section('content')
    <h1>Create New Member</h1>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('member.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="nama_member">Nama Member</label>
            <input type="text" name="nama_member" id="nama_member" class="form-control" value="{{ old('nama_member') }}" required>
        </div>

        <div class="form-group">
            <label for="no_telepon_member">No Telepon Member</label>
            <input type="text" name="no_telepon_member" id="no_telepon_member" class="form-control" value="{{ old('no_telepon_member') }}" required>
        </div>

        <div class="form-group">
            <label for="jam_mulai">Jam Mulai</label>
            <select name="jam_mulai" id="jam_mulai" class="form-control" required>
                @for ($i = 7; $i <= 23; $i++)
                    @for ($j = 0; $j < 60; $j += 60)
                        @php
                            $time = sprintf('%02d', $i) . ':' . sprintf('%02d', $j);
                        @endphp
                        <option value="{{ $time }}" {{ old('jam_mulai') == $time ? 'selected' : '' }}>{{ $time }}</option>
                    @endfor
                @endfor
            </select>
        </div>

        <div class="form-group">
            <label for="jam_selesai">Jam Selesai</label>
            <select name="jam_selesai" id="jam_selesai" class="form-control" required>
                @for ($i = 7; $i <= 23; $i++)
                    @for ($j = 0; $j < 60; $j += 60)
                        @php
                            $time = sprintf('%02d', $i) . ':' . sprintf('%02d', $j);
                        @endphp
                        <option value="{{ $time }}" {{ old('jam_selesai') == $time ? 'selected' : '' }}>{{ $time }}</option>
                    @endfor
                @endfor
            </select>
        </div>

        <div class="form-group">
            <label for="hari">Hari</label>
            <input type="text" name="hari" id="hari" class="form-control" value="{{ old('hari') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Create Member</button>
    </form>
@endsection
