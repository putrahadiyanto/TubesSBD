@extends('layouts.admin')

@section('content')
    <h1>Edit Equipment</h1>
    <form action="{{ route('equipment.update', $equipment->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nama_equipment">Nama Equipment:</label>
            <input type="text" name="nama_equipment" class="form-control" value="{{ $equipment->nama_equipment }}" required>
        </div>
        <div class="form-group">
            <label for="stok">Stok:</label>
            <input type="number" name="stok" class="form-control" value="{{ $equipment->stok }}" required>
        </div>
        <div class="form-group">
            <label for="harga">Harga:</label>
            <input type="text" name="harga" class="form-control" value="{{ $equipment->harga }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
