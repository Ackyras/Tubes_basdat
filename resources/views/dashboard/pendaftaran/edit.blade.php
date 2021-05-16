@extends('master.dashboard')

@section('title-page', 'Buka Pendaftaran')

@section('content')
<form method="POST" action="{{ route('rekrut.update', $daftar->id) }}">
    @csrf
    @method('PUT')
    <div class="mb-1 mx-auto form-admin">
        <label class="form-label">Judul</label>
        <input type="text" name="judul" value="{{ $daftar->judul }}" class="form-control @error('judul') is-invalid @enderror" autofocus required>
        @error('judul')
        <div class="alert alert-danger mt-1">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-1 mx-auto form-admin">
        <label class="form-label">Tanggal Pembukaan</label>
        <input type="date" name="awal_pembukaan" value="{{ $daftar->awal_pembukaan }}" class="form-control @error('awal_pembukaan') is-invalid @enderror" required>
        @error('awal_pembukaan')
        <div class="alert alert-danger mt-1">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-1 mx-auto form-admin">
        <label class="form-label">Tanggal Penutupan</label>
        <input type="date" name="akhir_pembukaan" value="{{ $daftar->akhir_pembukaan }}" class="form-control @error('akhir_pembukaan') is-invalid @enderror" required>
        @error('akhir_pembukaan')
        <div class="alert alert-danger mt-1">{{ $message }}</div>
        @enderror
    </div>
    <div class="my-3 mx-auto form-admin position-relative pb-5">
        <button type="submit" class="btn btn-primary position-absolute top-0 end-0">Submit</button>
    </div>
</form>
@endsection