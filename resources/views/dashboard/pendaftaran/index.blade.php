@extends('master.dashboard')

@section('css')
<link rel="stylesheet" href="{{asset('/pedaftaran/css/style.css')}}">
@endsection

@section('title-page', 'Perekrutan Asprak')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">List Perekrutan Asprak</h6>
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
                        <th>Judul</th>
                        <th>Awal Pembukaan</th>
                        <th>Akhir Pembukaan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($daftars as $daftar)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $daftar->judul }}</td>
                        <td>{{ Carbon\Carbon::createFromFormat('Y-m-d', $daftar->awal_pembukaan)->format('d-m-Y') }}</td>
                        <td>{{ Carbon\Carbon::createFromFormat('Y-m-d',  $daftar->akhir_pembukaan)->format('d-m-Y') }}</td>
                        <td>
                            <a href="{{ route('rekrut.show', $daftar->id) }}" class="btn btn-info">Detail</a>
                            <a href="{{ route('rekrut.edit', $daftar->id) }}" class="btn btn-primary">Ubah</a>
                            <form class="d-inline" action="{{ route('rekrut.destroy', $daftar->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Yakin ingin menghapus?')" class="btn btn-danger" style="display:inline-block;">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">Tidak ada pembukaan</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            {{$daftars->links()}}
            <a href="{{ route('rekrut.create') }}" class="btn btn-primary">Buka Pendaftaran</a>
        </div>
    </div>
</div>
@endsection