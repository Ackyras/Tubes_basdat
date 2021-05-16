<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Mail\VerifikasiBerkasMail;
use App\Mail\VerifikasiKelulusanAsprakMail;
use App\Models\CalonAsprak;
use App\Models\DaftarMataKuliah;
use App\Models\MataKuliah;
use App\Models\PembukaanAsprak;
use App\Models\PenilaianAsprak;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class VerifikasiController extends Controller
{
    protected $pembukaan_id;

    public function __construct()
    {
        $this->pembukaan_id = PembukaanAsprak::latest()->first();
    }

    public function index()
    {
        $aspraks = CalonAsprak::where('periode', $this->pembukaan_id->id)
            ->where('status', 0)
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        $id = $aspraks->pluck('id')->toArray();
        $pilihans = PenilaianAsprak::with('matakuliah')->whereIn('calon_asprak_id', $id)->get();
        $daftar_matkuls = DaftarMataKuliah::has('matakuliahs')->get();
        return view('dashboard.pendaftaran.verifikasi.index', compact('aspraks', 'pilihans', 'daftar_matkuls'));
    }

    public function berkasmatkul(Request $request)
    {
        $search = $request->input('nama');
        $aspraks = CalonAsprak::where('periode', $this->pembukaan_id->id)
            ->where('nama', 'like', '%' . $search . '%')
            ->orWhere('program_studi', 'like', '%' . $search . '%')
            ->where('status', 0)
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        $id = $aspraks->pluck('id')->toArray();
        $pilihans = PenilaianAsprak::with('matakuliah')->whereIn('calon_asprak_id', $id)->get();
        $daftar_matkuls = DaftarMataKuliah::has('matakuliahs')->get();
        return view('dashboard.pendaftaran.verifikasi.index', compact('aspraks', 'pilihans', 'daftar_matkuls'));
    }

    public function verifikasiberkas(Request $request)
    {
        $calon = CalonAsprak::where('id', $request->input('id'))->first();
        switch ($request->input('action')) {
            case '0':
                CalonAsprak::where('id', $calon->id)->delete();
                break;
            case '1':
                CalonAsprak::where('id', $calon->id)
                    ->update(
                        [
                            'status'    => 2
                        ]
                    );
                $calon = CalonAsprak::where('id', $calon->id)->first();
                $content = [
                    'nama'          => $calon->nama,
                    'nim'           => $calon->nim,
                    'username'      => '',
                    'password'      => '',
                    'status'        => $calon->status
                ];

                //KIRIM NOTIFIKASI TIDAK LULUS BERKAS
                Mail::to($calon->email)->send(new VerifikasiBerkasMail($content));
                break;
            case '2':
                $password = uniqid();
                DB::transaction(
                    function () use ($password, $calon) {
                        CalonAsprak::where('id', $calon->id)
                            ->update(
                                [
                                    'password'  => bcrypt($password),
                                    'status'    => 1
                                ]
                            );
                        $akun = User::create(
                            [
                                'name'      => $calon->nama,
                                'username'  => preg_replace("/\s+/", "", strtolower($calon->nama . '.' . $calon->nim)),
                                'role'      => 'calonasprak',
                                'email'     => $calon->email,
                                'password'  => bcrypt($password)
                            ]
                        );
                        $calon = CalonAsprak::where('id', $calon->id)->first();
                        $content = [
                            'nama'          => $calon->nama,
                            'nim'           => $calon->nim,
                            'username'      => $akun->username,
                            'password'      => $password,
                            'status'        => $calon->status
                        ];
                        Mail::to($calon->email)->send(new VerifikasiBerkasMail($content));
                    }
                );
                break;
        }
        return redirect()->route('asprak.index')->with('status', 'Berhasil memvalidasi berkas calon asisten praktikum');
    }

    public function indexnilai()
    {
        $aspraks = CalonAsprak::where('periode', $this->pembukaan_id->id)
            ->where('status', 1)
            ->get()
            ->pluck('id')
            ->toArray();
        $penilaians = PenilaianAsprak::with('matakuliah', 'calonasprak')
            ->whereIn('calon_asprak_id', $aspraks)
            ->whereNull('lulus')
            ->paginate(20);
        $daftar_matkuls = DaftarMataKuliah::has('matakuliahs')->get();
        return view('dashboard.pendaftaran.penilaian.index', compact('penilaians', 'daftar_matkuls'));
    }

    public function penilaianmatkul(Request $request)
    {
        $search = '%' . $request->input('matkul') . '%';
        $daftar = DaftarMataKuliah::where('nama', 'like', $search)
            ->get()
            ->pluck('id')
            ->toArray();
        $matkul = MataKuliah::whereIn('mata_kuliah_id', $daftar)
            ->get()
            ->pluck('id')
            ->toArray();

        $aspraks = CalonAsprak::where('periode', $this->pembukaan_id->id)
            ->where('status', 1)
            ->get()
            ->pluck('id')
            ->toArray();
        $penilaians = PenilaianAsprak::with('matakuliah', 'calonasprak')
            ->whereIn('calon_asprak_id', $aspraks)
            ->whereIn('mata_kuliah_id', $matkul)
            ->whereNull('lulus')
            ->paginate(20);
        $daftar_matkuls = DaftarMataKuliah::has('matakuliahs')
            ->get();
        return view('dashboard.pendaftaran.penilaian.index', compact('penilaians', 'daftar_matkuls'));
    }

    public function penilaian(Request $request)
    {
        $request->validate(
            [
                'nilai' => ['numeric', 'min:0', 'max:100']
            ]
        );

        PenilaianAsprak::where('id', $request->input('penilaian_id'))
            ->update(
                [
                    'nilai' => $request->input('nilai')
                ]
            );
        return redirect()->route('asprak.nilai.index')->with('status', 'Berhasil mengubah nilai calon asisten praktikum');
    }

    public function verifikasilulus(Request $request)
    {
        $penilaian_id = PenilaianAsprak::where('id', $request->input('id'))->first();
        switch ($request->input('action')) {
            case '1':
                DB::transaction(
                    function () use ($penilaian_id) {
                        PenilaianAsprak::where('id', $penilaian_id->id)
                            ->update(['lulus' => 'Lulus']);
                        $lulus =  PenilaianAsprak::where('id', $penilaian_id->id)
                            ->first();
                        $mata_kuliah = MataKuliah::where('id', $lulus->mata_kuliah_id)->first();
                        $mata_kuliah = DaftarMataKuliah::where('id', $mata_kuliah->mata_kuliah_id)
                            ->first();
                        $calon = CalonAsprak::where('id', $penilaian_id->calon_asprak_id)->first();
                        // KIRIM NOTIFIKASI LULUS ASPRAK
                        $content = [
                            'nama'          => $calon->nama,
                            'nim'           => $calon->nim,
                            'matakuliah'    => $mata_kuliah->nama,
                            'nilai'         => $lulus->nilai,
                            'status'        => $lulus->lulus
                        ];
                        Mail::to($calon->email)->send(new VerifikasiKelulusanAsprakMail($content));
                    }
                );
                break;
            case '2':
                DB::transaction(
                    function () use ($penilaian_id) {
                        PenilaianAsprak::where('id', $penilaian_id->id)
                            ->update(['lulus' => 'Tidak Lulus']);
                        $lulus =  PenilaianAsprak::where('id', $penilaian_id->id)
                            ->first();
                        $mata_kuliah = MataKuliah::where('id', $lulus->mata_kuliah_id)->first();
                        $mata_kuliah = DaftarMataKuliah::where('id', $mata_kuliah->mata_kuliah_id)
                            ->first();
                        $calon = CalonAsprak::where('id', $penilaian_id->calon_asprak_id)->first();
                        // KIRIM NOTIFIKASI Tidak LULUS ASPRAK
                        $content = [
                            'nama'          => $calon->nama,
                            'nim'           => $calon->nim,
                            'matakuliah'    => $mata_kuliah->nama,
                            'nilai'         => $lulus->nilai,
                            'status'        => $lulus->lulus
                        ];
                        Mail::to($calon->email)->send(new VerifikasiKelulusanAsprakMail($content));
                    }
                );
                break;
        }
        return redirect()->route('asprak.nilai.index')->with('status', 'Berhasil memvalidasi kelulusan calon asisten praktikum');
    }
}
