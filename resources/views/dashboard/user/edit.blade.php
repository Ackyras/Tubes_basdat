@extends('master.dashboard')

@section('title-page', 'Edit Akun Admin')

@section('content')
<div class="row justify-content-center">
    <div class="col-6">
        <form method="POST" action="{{ route('user.update', $user->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label class="form-label">Nama</label>
                <input type="text" name="name" value="{{ $user->name }}" class="form-control @error('name') is-invalid @enderror" required autofocus placeholder="Masukkan nama">
                @error('name')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label class="form-label">Username</label>
                <input type="text" name="username" value="{{ $user->username }}" class="form-control @error('username') is-invalid @enderror" required placeholder="Masukkan username">
                @error('username')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" name="email" value="{{ $user->email }}" class="form-control @error('email') is-invalid @enderror" required placeholder="Masukkan email">
                @error('email')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            @if (auth()->user()->role == "superadmin")
            <div class="form-group">
                <label class="form-label">Role</label>
                <select name="role" class="form-control @error('role') is-invalid @enderror" required>
                    <option value="" disabled selected>Pilih Role</option>
                    <option value="superadmin" @if ($user->role == "superadmin") selected @endif>Superadmin</option>
                    <option value="inventaris" @if ($user->role == "inventaris") selected @endif>Inventaris</option>
                    <option value="ruangan" @if ($user->role == "ruangan") selected @endif>Ruangan</option>
                    <option value="rekrut" @if ($user->role == "asprak") selected @endif>Perekrutan Asprak</option>
                    <option value="dosen" @if ($user->role == "dosen") selected @endif>Dosen</option>
                </select>
                @error('role')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            @endif
            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required placeholder="Masukkan password">
                @error('password')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label class="form-label">Password Confirmation</label>
                <input type="password" name="password_confirm" class="form-control @error('password_confirm') is-invalid @enderror" required placeholder="Masukkan password confirmation">
                @error('password_confirm')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary float-right">Submit</button>
        </form>
    </div>
</div>
@endsection