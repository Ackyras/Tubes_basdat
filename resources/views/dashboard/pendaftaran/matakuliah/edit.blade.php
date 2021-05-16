@extends('master.dashboard')

@section('title-page', 'Tambah Mata Kuliah')

@section('content')
<form method="POST" action="{{ route('matakuliah.update', $matkul->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-1 mx-auto form-admin">
        <label class="form-label">Mata Kuliah</label>
        <select name="matakuliah" class="form-select @error('matakuliah') is-invalid @enderror" required>
            <option disabled value="">Pilih Mata Kuliah</option>
            @foreach ($matakuliahs as $matakuliah)
            <option value="{{$matakuliah->id}}" {{ $matakuliah->id == $matkul->mata_kuliah_id ? 'selected' : '' }}>{{$matakuliah->nama}}</option>
            @endforeach
        </select>
        @error('matakuliah')
        <div class="alert alert-danger mt-1">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-1 mx-auto form-admin">
        <label class="form-label">Dosen</label>
        <input type="text" name="dosen" value="{{ $matkul->dosen }}" class="form-control @error('dosen') is-invalid @enderror" required>
        @error('dosen')
        <div class="alert alert-danger mt-1">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-1 mx-auto form-admin">
        <label class="form-label">Tanggal Seleksi</label>
        <input type="date" name="tanggal_seleksi" value="{{ $matkul->tanggal_seleksi }}" class="form-control @error('tanggal_seleksi') is-invalid @enderror" required>
        @error('tanggal_seleksi')
        <div class="alert alert-danger mt-1">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-1 mx-auto form-admin">
        <label class="form-label">Jam Mulai Seleksi</label>
        <input type="time" name="awal_seleksi" value="{{ Carbon\Carbon::createFromFormat('H:i:s', $matkul->awal_seleksi)->format('H:i') }}" class="form-control @error('awal_seleksi') is-invalid @enderror" required>
        @error('awal_seleksi')
        <div class="alert alert-danger mt-1">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-1 mx-auto form-admin">
        <label class="form-label">Jam Akhir Seleksi</label>
        <input type="time" name="akhir_seleksi" value="{{ Carbon\Carbon::createFromFormat('H:i:s', $matkul->akhir_seleksi)->format('H:i') }}" class="form-control @error('akhir_seleksi') is-invalid @enderror" required>
        @error('akhir_seleksi')
        <div class="alert alert-danger mt-1">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group mb-1 mx-auto form-admin">
        <label>Soal</label>
        <input type="file" name="soal" class="form-control @error('soal') is-invalid @enderror">
        @error('soal')
        <div class="alert alert-danger mt-1">{{ $message }}</div>
        @enderror
    </div>
    <input type="hidden" value="{{ $matkul->soal }}" name="oldsoal">
    <div class="my-3 mx-auto form-admin position-relative pb-5">
        <button type="submit" class="btn btn-primary position-absolute top-0 end-0">Submit</button>
    </div>
</form>
@endsection