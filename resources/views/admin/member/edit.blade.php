<!-- resources/views/admin/member/edit.blade.php -->
@extends('layouts.admin')

@section('content')
    <h1>Edit Member</h1>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('member.update', $member->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nama_member">Nama Member</label>
            <input type="text" name="nama_member" id="nama_member" class="form-control" value="{{ old('nama_member', $member->nama_member) }}" required>
        </div>

        <div class="form-group">
            <label for="no_telepon_member">No Telepon Member</label>
            <input type="text" name="no_telepon_member" id="no_telepon_member" class="form-control" value="{{ old('no_telepon_member', $member->no_telepon_member) }}" required>
        </div>

        <div class="form-group">
            <label for="jam_mulai">Jam Mulai</label>
            <select name="jam_mulai" id="jam_mulai" class="form-control" required>
                @for ($i = 7; $i <= 23; $i++)
                    @for ($j = 0; $j < 60; $j += 60)
                        @php
                            $time = sprintf('%02d', $i) . ':' . sprintf('%02d', $j);
                        @endphp
                        <option value="{{ $time }}" {{ old('jam_mulai', $member->jam_mulai) == $time ? 'selected' : '' }}>{{ $time }}</option>
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
                        <option value="{{ $time }}" {{ old('jam_selesai', $member->jam_selesai) == $time ? 'selected' : '' }}>{{ $time }}</option>
                    @endfor
                @endfor
            </select>
        </div>

        <div class="form-group">
            <label for="hari">Hari</label>
            <select name="hari" id="hari" class="form-control" required>
                <option value="">Select a day</option>
                <option value="Monday" {{ old('hari', $member->hari) == 'Monday' ? 'selected' : '' }}>Monday</option>
                <option value="Tuesday" {{ old('hari', $member->hari) == 'Tuesday' ? 'selected' : '' }}>Tuesday</option>
                <option value="Wednesday" {{ old('hari', $member->hari) == 'Wednesday' ? 'selected' : '' }}>Wednesday</option>
                <option value="Thursday" {{ old('hari', $member->hari) == 'Thursday' ? 'selected' : '' }}>Thursday</option>
                <option value="Friday" {{ old('hari', $member->hari) == 'Friday' ? 'selected' : '' }}>Friday</option>
                <option value="Saturday" {{ old('hari', $member->hari) == 'Saturday' ? 'selected' : '' }}>Saturday</option>
                <option value="Sunday" {{ old('hari', $member->hari) == 'Sunday' ? 'selected' : '' }}>Sunday</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Member</button>
    </form>
@endsection
