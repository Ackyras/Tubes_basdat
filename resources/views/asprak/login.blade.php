@extends('master.master')

@section('css')
<link rel="stylesheet" href="{{ asset('css/asprak/login.css') }}">
@endsection

@section('content')
<div class="row">
    <h4 class="p-2 title-header">Login</h4>
    <div class="line"></div>
</div>
<div class="row mt-3">
    <div class="card mx-auto">
        <div class="card-body align-items-center d-flex">
            <form class="mx-auto pb-3" method="POST" action="{{ route('calonasprak.login.post') }}">
                @csrf
                @if ($errors->any())
                @foreach ($errors->all() as $error)
                @if ($error[0] != "M")
                <div class="alert alert-danger" style="font-size: 14px;">
                    {{ $error }}
                </div>
                @endif
                @endforeach
                @endif
                <i class="fas fa-sign-in-alt ml-4"> Calon Asprak</i>
                <div class="form-group mt-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" id="username" name="username" class="form-control @error('username') is-invalid @enderror" required placeholder="Masukkan username" autofocus autocomplete="off">
                    @error('username')
                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mt-2">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" required placeholder="Masukkan password" autocomplete="off">
                    @error('password')
                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <button class="btn btn-login my-3 float-right" type="submit">Login</button>
            </form>
        </div>
    </div>
</div>
@endsection