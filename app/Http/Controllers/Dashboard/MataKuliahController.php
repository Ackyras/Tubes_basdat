<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\DaftarMataKuliah;
use App\Models\MataKuliah;
use App\Models\PembukaanAsprak;
use App\Rules\AwalSeleksiMataKuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule as ValidationRule;

class MataKuliahController extends Controller
{
    protected $pembukaan_id;

    public function __construct()
    {
        $this->pembukaan_id = PembukaanAsprak::latest()->first();
    }

    public function create()
    {
        $matakuliahs = DaftarMataKuliah::all();
        return view('dashboard.pendaftaran.matakuliah.create', compact('matakuliahs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'matakuliah'        => [
                'required',
                ValidationRule::unique('mata_kuliahs', 'mata_kuliah_id')->where(function ($q) {
                    return $q->where('pembukaan_asprak_id', $this->pembukaan_id->id);
                }),
            ],
            'dosen'             => 'required',
            'tanggal_seleksi'   => ['required', 'after:' . $this->pembukaan_id->akhir_pembukaan],
            'awal_seleksi'      => ['required', 'date_format:H:i', new AwalSeleksiMataKuliah($request->get('awal_seleksi'), $request->get('tanggal_seleksi'), $this->pembukaan_id->id)],
            'akhir_seleksi'     => ['required', 'date_format:H:i', 'after:awal_seleksi'],
            'soal'              => ['mimes:pdf,doc,docx,zip', 'max:2048', 'nullable']
        ]);

        $matkul = DaftarMataKuliah::where('id', $request->input('matakuliah'))->pluck('nama')->first();
        $link = '';
        if ($request->hasFile('soal')) {
            $file = $request->file('soal');
            $path = "public/" . $this->pembukaan_id->judul . "/" . "matakuliah/" . $matkul;
            $store = $file->storeAs($path, $file->getClientOriginalName());
            $link = $request->root() . '/storage/' . $this->pembukaan_id->judul . '/matakuliah' . "/" . $matkul . "/" . $file->getClientOriginalName();
            $file = Storage::url($store);
            $file = $request->root() . $file;
        }

        MataKuliah::create(
            [
                'mata_kuliah_id'        => $request->input('matakuliah'),
                'pembukaan_asprak_id'   => $this->pembukaan_id->id,
                'dosen'                 => $request->input('dosen'),
                'tanggal_seleksi'       => $request->input('tanggal_seleksi'),
                'awal_seleksi'          => $request->input('awal_seleksi'),
                'akhir_seleksi'         => $request->input('akhir_seleksi'),
                'soal'                  => ($link != "") ? $link : null
            ]
        );

        return redirect()->route('rekrut.show', $this->pembukaan_id->id)->with('status', 'Mata Kuliah berhasil ditambah');
    }

    public function edit($id)
    {
        $matakuliahs = DaftarMataKuliah::all();
        $matkul = MataKuliah::findOrFail($id);
        return view('dashboard.pendaftaran.matakuliah.edit', compact('matakuliahs', 'matkul'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'matakuliah'        => [
                'required',
                ValidationRule::unique('mata_kuliahs', 'mata_kuliah_id')->where(function ($q) {
                    return $q->where('pembukaan_asprak_id', $this->pembukaan_id->id);
                })->ignore($id),
            ],
            'dosen'             => 'required',
            'tanggal_seleksi'   => ['required', 'after:' . $this->pembukaan_id->akhir_pembukaan],
            'awal_seleksi'      => [
                'required', 'date_format:H:i',
                ValidationRule::unique('mata_kuliahs', 'awal_seleksi')->where('tanggal_seleksi', $request->get('tanggal_seleksi'))
                    ->where(function ($q) {
                        return $q->where('pembukaan_asprak_id', $this->pembukaan_id->id);
                    })->ignore($id)
            ],
            'akhir_seleksi'     => ['required', 'date_format:H:i', 'after:awal_seleksi'],
            'soal'              => ['mimes:pdf,doc,docx,zip', 'max:2048', 'nullable']
        ]);

        $matkul = DaftarMataKuliah::where('id', $request->input('matakuliah'))->pluck('nama')->first();
        $link = '';
        if ($request->hasFile('soal')) {
            $file = $request->file('soal');
            $path = "public/" . $this->pembukaan_id->judul . "/" . "matakuliah/" . $matkul;
            $store = $file->storeAs($path, $file->getClientOriginalName());
            $link = $request->root() . '/storage/' . $this->pembukaan_id->judul . '/matakuliah' . "/" . $matkul . "/" . $file->getClientOriginalName();
            $file = Storage::url($store);
            $file = $request->root() . $file;
        }

        MataKuliah::where('id', $id)
            ->update(
                [
                    'mata_kuliah_id'        => $request->input('matakuliah'),
                    'pembukaan_asprak_id'   => $this->pembukaan_id->id,
                    'dosen'                 => $request->input('dosen'),
                    'tanggal_seleksi'       => $request->input('tanggal_seleksi'),
                    'awal_seleksi'          => $request->input('awal_seleksi'),
                    'akhir_seleksi'         => $request->input('akhir_seleksi'),
                    'soal'                  => ($link != "") ? $link : $request->input('oldsoal')
                ]
            );

        return redirect()->route('rekrut.show', $this->pembukaan_id->id)->with('status', 'Mata Kuliah berhasil diubah');
    }

    public function destroy($id)
    {
        MataKuliah::where('id', $id)->delete();
        return redirect()->route('rekrut.show', $this->pembukaan_id->id)->with('status', 'Mata Kuliah berhasil dihapus');
    }
}
