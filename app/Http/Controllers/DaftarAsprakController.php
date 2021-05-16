<?php

namespace App\Http\Controllers;

use App\Http\Requests\DaftarAsprakRequest;
use App\Models\CalonAsprak;
use App\Models\MataKuliah;
use App\Models\PembukaanAsprak;
use App\Models\PenilaianAsprak;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DaftarAsprakController extends Controller
{
    protected $pembukaan_id;

    public function __construct()
    {
        $this->pembukaan_id = PembukaanAsprak::latest()->first();
    }

    public function index()
    {
        $master = "asprak";
        $login = false;
        $pembukaan = $this->pembukaan_id;
        if (!$pembukaan)
            return redirect()->route('calonasprak.none');
        $matkul = MataKuliah::where('pembukaan_asprak_id', $this->pembukaan_id->id)
            ->orderBy('tanggal_seleksi', 'desc')
            ->first();
        if ($this->pembukaan_id->akhir_pembukaan <= Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d') and $matkul->tanggal_seleksi >= Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d')) {
            $login = true;
        }
        if (($this->pembukaan_id->awal_pembukaan <= Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d') and $this->pembukaan_id->akhir_pembukaan >= Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d')) or ($this->pembukaan_id->akhir_pembukaan <= Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d') and $matkul->tanggal_seleksi >= Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d'))) {
            return view('asprak.index', compact('master', 'pembukaan', 'login'));
        }
        return redirect()->route('calonasprak.none');
    }

    public function login()
    {
        $master = "asprak";
        if (!$this->pembukaan_id)
            return redirect()->route('calonasprak.none');
        $matkul = MataKuliah::where('pembukaan_asprak_id', $this->pembukaan_id->id)
            ->orderBy('tanggal_seleksi', 'desc')
            ->first();
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role == 'calonasprak')
                return redirect()->route('calonasprak.seleksi');
            return redirect()->route('calonasprak.index');
        }
        if ($this->pembukaan_id->akhir_pembukaan <= Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d') and $matkul->tanggal_seleksi >= Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d')) {
            return view('asprak.login', compact('master'));
        }
        return redirect()->route('calonasprak.none');
    }

    public function loginpost(Request $request)
    {
        $request->validate(
            [
                'username'  => 'required',
                'password'  => 'required'
            ],
            [
                'username.required' => 'Masukkan username',
                'password.required' => 'Masukkan password'
            ]
        );
        if (Auth::attempt($request->only('username', 'password'))) {
            $auth = Auth::user();
            if ($auth->role == "calonasprak") {
                return redirect()->route('calonasprak.seleksi');
            } else {
                Auth::logout();
                return redirect()->back()->withErrors('Login gagal, pastikan anda lolos verifikasi berkas');
            }
        } else {
            return redirect()->back()->withErrors('Login gagal, pastikan anda lolos verifikasi berkas');
        }
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        Auth::logout();
        return redirect()->route('calonasprak.index');
    }

    public function form()
    {
        $master = "asprak";
        if (!$this->pembukaan_id)
            return redirect()->route('calonasprak.none');
        if ($this->pembukaan_id->awal_pembukaan <= Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d') and $this->pembukaan_id->akhir_pembukaan >= Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d')) {
            $matakuliahs = MataKuliah::with('daftarmatakuliah')
                ->where('pembukaan_asprak_id', $this->pembukaan_id->id)
                ->get();
            if (!auth()->user())
                return view('asprak.form', compact('matakuliahs', 'master'));
        }
        $matkul = MataKuliah::where('pembukaan_asprak_id', $this->pembukaan_id->id)
            ->orderBy('tanggal_seleksi', 'desc')
            ->first();
        if ($this->pembukaan_id->akhir_pembukaan <= Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d') and $matkul->tanggal_seleksi >= Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d')) {
            return redirect()->route('calonasprak.index');
        }
        return redirect()->route('calonasprak.none');
    }

    public function store(DaftarAsprakRequest $request)
    {
        if ($request->hasFile('cv') and $request->hasFile('khs') and $request->hasFile('ktm')) {
            $cv = $request->file('cv');
            $khs = $request->file('khs');
            $ktm = $request->file('ktm');
            $path = 'public/calon/' . $request->input('nim');

            $storecv = $cv->storeAs($path, $cv->getClientOriginalName());
            $storekhs = $khs->storeAs($path, $khs->getClientOriginalName());
            $storektm = $ktm->storeAs($path, $ktm->getClientOriginalName());

            $link_cv = $request->root() . '/storage/calon/' . $request->input('nim') . '/' . $cv->getClientOriginalName();
            $link_khs = $request->root() . '/storage/calon/' . $request->input('nim') . '/' . $khs->getClientOriginalName();
            $link_ktm = $request->root() . '/storage/calon/' . $request->input('nim') . '/' . $ktm->getClientOriginalName();

            $cv = Storage::url($storecv);
            $khs = Storage::url($storekhs);
            $ktm = Storage::url($storektm);
        }
        DB::transaction(function () use ($request, $link_cv, $link_khs, $link_ktm) {
            $id = CalonAsprak::create(
                [
                    'periode'           => $this->pembukaan_id->id,
                    'nama'              => $request->input('nama'),
                    'nim'               => $request->input('nim'),
                    'email'             => $request->input('email'),
                    'tanggal_lahir'     => $request->input('tanggal_lahir'),
                    'program_studi'     => $request->input('prodi'),
                    'angkatan'          => $request->input('angkatan'),
                    'cv'                => $link_cv,
                    'khs'               => $link_khs,
                    'ktm'               => $link_ktm
                ]
            );
            $pilihan = array_unique($request->input('pilihan'));
            foreach ($pilihan as $key => $value) {
                if ($value != null) {
                    PenilaianAsprak::create(
                        [
                            'calon_asprak_id'   => $id->id,
                            'mata_kuliah_id'    => $value
                        ]
                    );
                }
            }
        });

        return redirect()->route('calonasprak.index')->with('status', 'Berhasil mendaftar, silahkan tunggu konfirmasi seleksi berkas');
    }

    public function seleksi()
    {
        $master = "asprak";
        $matkul = MataKuliah::where('pembukaan_asprak_id', $this->pembukaan_id->id)
            ->orderBy('tanggal_seleksi', 'desc')
            ->first();
        if ($this->pembukaan_id->akhir_pembukaan <= Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d') and $matkul->tanggal_seleksi >= Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d')) {
            if (!Auth::user())
                return redirect()->route('calonasprak.login');
            if (auth()->user()->role == "calonasprak") {
                $calon = CalonAsprak::where('periode', $this->pembukaan_id->id)->where('email', auth()->user()->email)->first();
                $pilihan = PenilaianAsprak::where('calon_asprak_id', $calon->id)
                    ->whereNull('jawaban')
                    ->get()
                    ->pluck('mata_kuliah_id')
                    ->toArray();
                $matkuls = MataKuliah::with('daftarmatakuliah')
                    ->whereIn('id', $pilihan)
                    ->get();
                return view('asprak.seleksi', compact('master', 'matkuls'));
            }

            return redirect()->route('calonasprak.index');
        }
        return redirect()->route('calonasprak.none');
    }

    public function seleksishow($id)
    {
        $master = "asprak";
        if (!Auth::user())
            return redirect()->route('calonasprak.login');

        $pilihan = PenilaianAsprak::where('mata_kuliah_id', $id)->first();
        if (!$pilihan)
            return redirect()->route('calonasprak.index')->with('status', 'Kamu tidak memiliki akses');

        $matkul = MataKuliah::with('daftarmatakuliah')->where('pembukaan_asprak_id', $this->pembukaan_id->id)
            ->where('id', $id)
            ->where('tanggal_seleksi', Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d'))
            ->where('awal_seleksi', '<=', Carbon::now()->setTimezone('Asia/Jakarta')->format('H:i:s'))
            ->where('akhir_seleksi', '>', Carbon::now()->setTimezone('Asia/Jakarta')->format('H:i:s'))
            ->first();

        $waktu = $matkul->akhir_seleksi;
        return view('asprak.show', compact('master', 'matkul', 'waktu'));
    }

    public function seleksiupload(Request $request, $id)
    {
        $request->validate(
            [
                'file'  => ['required', 'mimes:pdf,doc,docx,zip,rar', 'max:5000']
            ],
            [
                'file.required' => 'Masukkan file sebelum upload jawaban',
                'file.mimes'    => 'File jawaban yang diterima hanya format pdf, zip, rar, doc, docx',
                'file.max'      => 'Maksimum file diupload 5MB'
            ]
        );
        $calon = CalonAsprak::where('periode', $this->pembukaan_id->id)->where('email', auth()->user()->email)->first();
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = 'public/calon/jawaban/' . $calon->nim;
            $store = $file->storeAs($path, $file->getClientOriginalName());
            $link = $request->root() . '/storage/calon/jawaban/' . $calon->nim . '/' . $file->getClientOriginalName();
            $file = Storage::url($store);
        }
        PenilaianAsprak::where('mata_kuliah_id', $id)
            ->where('calon_asprak_id', $calon->id)
            ->update(
                [
                    'jawaban'   => $link
                ]
            );
        return redirect()->route('calonasprak.index')->with('status', 'Berhasil mengupload jawaban, silahkan tunggu pengumuman kelulusan di email anda');
    }

    public function jadwal()
    {
        $master = "asprak";
        if (!$this->pembukaan_id)
            return redirect()->route('calonasprak.none');
        $matkul = MataKuliah::where('pembukaan_asprak_id', $this->pembukaan_id->id)
            ->orderBy('tanggal_seleksi', 'desc')
            ->first();
        if (($this->pembukaan_id->awal_pembukaan <= Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d') and $this->pembukaan_id->akhir_pembukaan >= Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d')) or ($this->pembukaan_id->akhir_pembukaan <= Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d') and $matkul->tanggal_seleksi >= Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d'))) {
            $matkuls = MataKuliah::with('daftarmatakuliah')->where('pembukaan_asprak_id', $this->pembukaan_id->id)
                ->get();
            return view('asprak.jadwal', compact('master', 'matkuls'));
        }
        return redirect()->route('calonasprak.none');
    }

    public function none()
    {
        $master = "asprak";
        if (!$this->pembukaan_id)
            return view('asprak.none', compact('master'));

        $matkul = MataKuliah::where('pembukaan_asprak_id', $this->pembukaan_id->id)
            ->orderBy('tanggal_seleksi', 'desc')
            ->first();

        if (($this->pembukaan_id->awal_pembukaan <= Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d') and $this->pembukaan_id->akhir_pembukaan >= Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d')) or ($this->pembukaan_id->akhir_pembukaan <= Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d') and $matkul->tanggal_seleksi >= Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d')))
            return redirect()->route('calonasprak.index');

        return view('asprak.none', compact('master'));
    }
}
