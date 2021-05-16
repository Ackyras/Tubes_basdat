<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\DaftarMataKuliah;
use Illuminate\Http\Request;

class DaftarMataKuliahController extends Controller
{
    public function create()
    {
        return view('dashboard.pendaftaran.daftarmatakuliah.create');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'nama'  => 'required'
            ]
        );

        DaftarMataKuliah::create($request->all());
        return redirect()->route('rekrut.index');
    }
}
