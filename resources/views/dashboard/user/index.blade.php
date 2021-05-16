@extends('master.dashboard')

@section('title-page', 'List Akun Admin')

@section('content')
<div class="row">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List Akun Admin</h6>
        </div>
        <div class="card-body">
            @if (session('status'))
            <div class="alert alert-success mt-3">
                {{ session('status') }}
            </div>
            @endif
            <form action="{{ route('user.resetasprak') }}" method="POST">
                @csrf
                <button type="submit" onclick="return confirm('Aksi ini akan mereset seluruh akun asprak, pastikan uji seleksi telah selesai dilaksanakan')" class="btn btn-danger">Reset Asprak</button>
                <a href="{{route('user.create')}}" class="btn btn-primary float-right mb-2">Tambah User</a>
            </form>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Role</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ ucfirst($user->role) }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm btn-primary">Ubah</a>
                                <form class="d-inline" action="{{ route('user.destroy', $user->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Yakin ingin menghapus akun {{$user->name}}?')" class="btn btn-sm btn-danger d-inline-block"">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$users->links()}}
            </div>
        </div>
    </div>
</div>
@endsection