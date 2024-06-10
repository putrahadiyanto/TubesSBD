@extends('layouts.admin')

@section('content')
    <h1>Add New Equipment</h1>
    <form action="{{ route('equipment.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nama_equipment">Nama Equipment:</label>
            <input type="text" name="nama_equipment" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="stok">Stok:</label>
            <input type="number" name="stok" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="harga">Harga:</label>
            <input type="text" name="harga" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
