<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $members = DB::select('SELECT * FROM members');
        return view('admin.member.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.member.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_member' => 'required|string|max:255',
            'no_telepon_member' => 'required|string|max:255',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'hari' => 'required|string|max:255',
        ]);

        DB::insert('INSERT INTO members (nama_member, no_telepon_member, jam_mulai, jam_selesai, hari, created_at, updated_at) VALUES (?, ?, ?, ?, ?, NOW(), NOW())', [
            $request->nama_member,
            $request->no_telepon_member,
            $request->jam_mulai,
            $request->jam_selesai,
            $request->hari,
        ]);

        return redirect()->route('member.index')
            ->with('success', 'Member created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $member = DB::select('SELECT * FROM members WHERE id = ?', [$id]);

        if (empty($member)) {
            return redirect()->route('members.index')->with('error', 'Member not found.');
        }

        return view('members.show', ['member' => $member[0]]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $member = DB::select('SELECT * FROM members WHERE id = ?', [$id]);

        if (empty($member)) {
            return redirect()->route('member.index')->with('error', 'Member not found.');
        }

        return view('admin.member.edit', ['member' => $member[0]]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_member' => 'required|string|max:255',
            'no_telepon_member' => 'required|string|max:255',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'hari' => 'required|string|max:255',
        ]);

        DB::update('UPDATE members SET nama_member = ?, no_telepon_member = ?, jam_mulai = ?, jam_selesai = ?, hari = ?, updated_at = NOW() WHERE id = ?', [
            $request->nama_member,
            $request->no_telepon_member,
            $request->jam_mulai,
            $request->jam_selesai,
            $request->hari,
            $id,
        ]);

        return redirect()->route('member.index')
            ->with('success', 'Member updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::delete('DELETE FROM members WHERE id = ?', [$id]);

        return redirect()->route('member.index')
            ->with('success', 'Member deleted successfully.');
    }
}
