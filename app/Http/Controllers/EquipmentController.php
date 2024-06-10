<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EquipmentController extends Controller
{
    public function index()
    {
        $equipments = DB::select('SELECT * FROM equipments');
        return view('admin.equipment.index', compact('equipments'));
    }

    public function create()
    {
        return view('admin.equipment.create');
    }

    public function store(Request $request)
    {

        DB::insert('INSERT INTO equipments (nama_equipment, stok, harga, created_at, updated_at) VALUES (?, ?, ?, NOW(), NOW())', [
            $request->nama_equipment,
            $request->stok,
            $request->harga,
        ]);

        return redirect()->route('equipment.index')
            ->with('success', 'Equipment created successfully.');
    }

    public function show($id)
    {
        $equipment = DB::select('SELECT * FROM equipments WHERE id = ?', [$id]);

        if (empty($equipment)) {
            return redirect()->route('equipments.index')->with('error', 'Equipment not found.');
        }

        return view('equipments.show', ['equipment' => $equipment[0]]);
    }

    public function edit($id)
    {
        $equipment = DB::select('SELECT * FROM equipments WHERE id = ?', [$id]);

        if (empty($equipment)) {
            return redirect()->route('equipment.index')->with('error', 'Equipment not found.');
        }

        return view('admin.equipment.edit', ['equipment' => $equipment[0]]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_equipment' => 'required|string|max:255',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
        ]);

        DB::update('UPDATE equipments SET nama_equipment = ?, stok = ?, harga = ?, updated_at = NOW() WHERE id = ?', [
            $request->nama_equipment,
            $request->stok,
            $request->harga,
            $id,
        ]);

        return redirect()->route('equipment.index')
            ->with('success', 'Equipment updated successfully.');
    }

    public function destroy($id)
    {
        DB::delete('DELETE FROM equipments WHERE id = ?', [$id]);

        return redirect()->route('equipment.index')
            ->with('success', 'Equipment deleted successfully.');
    }
}
