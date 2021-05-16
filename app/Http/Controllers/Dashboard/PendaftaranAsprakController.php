<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\MataKuliah;
use App\Models\PembukaanAsprak;
use Illuminate\Http\Request;

class PendaftaranAsprakController extends Controller
{
    public function index()
    {
        $daftars = PembukaanAsprak::orderBy('created_at', 'desc')->paginate(10);
        return view('dashboard.pendaftaran.index', compact('daftars'));
    }

    public function show($id)
    {
        $pembukaan = PembukaanAsprak::findOrFail($id);
        $daftars = MataKuliah::with('daftarmatakuliah')->where('pembukaan_asprak_id', $id)->paginate(10);
        return view('dashboard.pendaftaran.show', compact('daftars', 'pembukaan'));
        // return response()->json([
        //     'message' => 'success',
        //     'daftars' => $daftars,
        //     'pembukaans' => $pembukaan,
        // ], 200);
    }

    public function create()
    {
        return view('dashboard.pendaftaran.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'             => 'required',
            'awal_pembukaan'    => ['required', 'date'],
            'akhir_pembukaan'   => ['required', 'date', 'after:awal_pembukaan']
        ]);
        PembukaanAsprak::create($request->all());

        return redirect()->route('rekrut.index')->with('status', 'Perekrutan berhasil dibuka');
    }

    public function edit($id)
    {
        $daftar = PembukaanAsprak::findOrFail($id);
        return view('dashboard.pendaftaran.edit', compact('daftar'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul'             => 'required',
            'awal_pembukaan'    => ['required', 'date'],
            'akhir_pembukaan'   => ['required', 'date', 'after:awal_pembukaan']
        ]);
        PembukaanAsprak::where('id', $id)
            ->update($request->only(['judul', 'awal_pembukaan', 'akhir_pembukaan']));

        return redirect()->route('rekrut.index')->with('status', 'Perekrutan berhasil diubah');
    }

    public function destroy($id)
    {
        PembukaanAsprak::where('id', $id)->delete();

        return redirect()->route('rekrut.index')->with('status', 'Perekrutan berhasil dihapus');
    }
}
