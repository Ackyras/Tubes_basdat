@extends('master.master')

@section('css')
<link rel="stylesheet" href="{{ asset('css/asprak/jadwal.css') }}">
@endsection

@section('logout')
@if(auth()->user() and auth()->user()->role == 'calonasprak')
<form action="{{ route('calonasprak.logout') }}" method="POST">
    @csrf
    <button type="submit" class="btn btn-primary-outline float-right">Logout</button>
</form>
@else
<a href="{{ route('calonasprak.login') }}" class="btn btn-primary-outline float-right">Login</a>
@endif
@endsection

@section('content')
<div class="row">
    <h4 class="p-2 title-header">Jadwal Seleksi</h4>
    <div class="line"></div>
</div>
<div class="row row-2">
    <div class="card mx-auto">
        <div class="card-body align-items-center d-flex">
            <div class="table-responsive w-100">
                <table class="table table-bordered table-hover">
                    <thead class="thead">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Mata Kuliah</th>
                            <th scope="col">Tanggal Seleksi</th>
                            <th scope="col">Dosen</th>
                            <th scope="col">Mulai Seleksi</th>
                            <th scope="col">Akhir Seleksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($matkuls as $matkul)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $matkul->daftarmatakuliah->nama }}</td>
                            <td>{{ Carbon\Carbon::createFromFormat('Y-m-d', $matkul->tanggal_seleksi)->format('d-m-Y') }}</td>
                            <td>{{ $matkul->dosen }}</td>
                            <td>{{ Carbon\Carbon::createFromFormat('H:i:s', $matkul->awal_seleksi)->format('H:i') }}</td>
                            <td>{{ Carbon\Carbon::createFromFormat('H:i:s', $matkul->akhir_seleksi)->format('H:i') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <th colspan=" 6">Belum ada jadwal seleksi</th>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection