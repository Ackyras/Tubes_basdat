@extends('master.dashboard')

@section('title-page', 'Tambah Mata Kuliah')

@section('content')
<form method="POST" action="{{ route('daftarmatakuliah.store') }}">
    @csrf
    <div class="mb-1 mx-auto form-admin">
        <label class="form-label">Nama Mata Kuliah</label>
        <input type="text" name="nama" value="{{ old('nama') }}" class="form-control @error('nama') is-invalid @enderror" required>
        @error('nama')
        <div class="alert alert-danger mt-1">{{ $message }}</div>
        @enderror
    </div>
    <div class="my-3 mx-auto form-admin position-relative pb-5">
        <button type="submit" class="btn btn-primary position-absolute top-0 end-0">Submit</button>
    </div>
</form>
@endsection