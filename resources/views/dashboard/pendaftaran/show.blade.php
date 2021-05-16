@extends('master.dashboard')

@section('css')
<link rel="stylesheet" href="{{asset('/pedaftaran/css/style.css')}}">
@endsection

@section('title-page', 'Mata Kuliah')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">List Mata Kuliah {{ $pembukaan->judul }} </h6>
    </div>
    <div class="card-body">
        @if (session('status'))
        <div class="alert alert-success mt-3">
            {{ session('status') }}
        </div>
        @endif
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Mata Kuliah</th>
                        <th>Dosen</th>
                        <th>Tanggal Seleksi</th>
                        <th>Awal Seleksi</th>
                        <th>Akhir Seleksi</th>
                        <th>Soal</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($daftars as $daftar)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $daftar->daftarmatakuliah->nama }}</td>
                        <td>{{ $daftar->dosen }}</td>
                        <td>{{ Carbon\Carbon::createFromFormat('Y-m-d', $daftar->tanggal_seleksi)->format('d-m-Y') }}</td>
                        <td>{{ $daftar->awal_seleksi }}</td>
                        <td>{{ $daftar->akhir_seleksi }}</td>
                        <td>@if($daftar->soal == null) Belum ada soal @else <a href="{{ $daftar->soal }}" class="btn btn-sm btn-info ">Soal</a>@endif</td>
                        <td>
                            <a href="{{ route('matakuliah.edit', $daftar->id) }}" class="btn btn-sm btn-primary">Ubah</a>
                            <form class="d-inline" action="{{ route('matakuliah.destroy', $daftar->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Yakin ingin menghapus?')" class="btn btn-sm btn-danger" style="display:inline-block;">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7">Tidak ada pembukaan</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            {{$daftars->links()}}
            <a href="{{ route('matakuliah.create') }}" class="btn btn-primary">Tambah Mata Kuliah</a>
        </div>
    </div>
</div>
@endsection