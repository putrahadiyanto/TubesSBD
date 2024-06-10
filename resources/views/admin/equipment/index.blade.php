@extends('layouts.admin')

@section('content')
    <h1>Equipment Management</h1>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Equipment</th>
                    <th>Stok</th>
                    <th>Harga</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($equipments as $equipment)
                    <tr>
                        <td>{{ $equipment->id }}</td>
                        <td>{{ $equipment->nama_equipment }}</td>
                        <td>{{ $equipment->stok }}</td>
                        <td>{{ $equipment->harga }}</td>
                        <td>
                            <a href="{{ route('equipment.edit', $equipment->id) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('equipment.destroy', $equipment->id) }}" method="POST" style="display: inline-block;">
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

    <a href="{{ route('equipment.create') }}" class="btn btn-success">Add New Equipment</a>
@endsection
