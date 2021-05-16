@extends('master.dashboard')

@section('css')
@endsection

@section('title-page', 'Verifikasi Berkas Calon Asprak')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">List Calon Asprak</h6>
    </div>
    <div class="card-body">
        @if (session('status'))
        <div class="alert alert-success mt-3">
            {{ session('status') }}
        </div>
        @endif
        <form action="{{ route('asprak.index.matkul') }}" method="GET">
            <input class="my-2 form-control w-25 float-right mr-2" name="nama" type="text" id="myInput" autocomplete="off" onkeyup="searchData()" placeholder="Cari nama atau program studi">
        </form>
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Prodi</th>
                        <th>Angkatan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($aspraks as $asprak)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $asprak->nama }}</td>
                        <td>{{ $asprak->program_studi }}</td>
                        <td>{{ $asprak->angkatan }}</td>
                        <td>
                            <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#data{{$asprak->id}}">Detail</button>
                        </td>
                        <div class="modal fade" id="data{{$asprak->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Data Calon Asprak</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <dl class="ml-3">
                                            <dt><small><b>Nama</b></small></dt>
                                            <dd>{{ $asprak->nama }}</dd>
                                            <dt><small><b>Nim</b></small></dt>
                                            <dd>{{ $asprak->nim }}</dd>
                                            <dt><small><b>Program Studi</b></small></dt>
                                            <dd>{{ $asprak->program_studi }}</dd>
                                            <dt><small><b>Angkatan</b></small></dt>
                                            <dd>{{$asprak->angkatan}} </dd>
                                            <dt><small><b>E-mail</b></small></dt>
                                            <dd>{{ $asprak->email }}</b></small></dt>
                                            <dt><small><b>Tanggal lahir</dt>
                                            <dd>{{ $asprak->tanggal_lahir }}</b></small></dt>
                                        </dl>
                                        <div class="d-flex justify-content-evenly">
                                            <a href="{{ $asprak->cv }}" class="btn btn-sm btn-info">Lihat CV</a>
                                            <a href="{{ $asprak->khs }}" class="btn btn-sm btn-info">Lihat KHS</a>
                                            <a href="{{ $asprak->ktm }}" class="btn btn-sm btn-info">Lihat KTM</a>
                                        </div>
                                        <b class="ml-3 d-block mt-2">Pilihan mata kuliah</b>
                                        <ul>
                                            @foreach ($pilihans as $pilihan)
                                            @foreach ($daftar_matkuls as $daftar_matkul)
                                            @if($pilihan->matakuliah->mata_kuliah_id == $daftar_matkul->id and $pilihan->calon_asprak_id == $asprak->id)
                                            <li>{{ $daftar_matkul->nama }}</li>
                                            @endif
                                            @endforeach
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('asprak.verifikasi') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $asprak->id }}">
                                            <button type="submit" name="action" value="0" onclick="return confirm('Yakin ingin menghapus data calon asprak {{ $asprak->nama }}?')" class="btn btn-danger">Hapus</button>
                                            <button type="submit" name="action" value="1" onclick="return confirm('Tolak verifikasi calon asprak {{ $asprak->nama }}?')" class="btn btn-warning">Tolak</button>
                                            <button type="submit" name="action" value="2" onclick="return confirm('Verifikasi calon asprak {{ $asprak->nama }}?')" class="btn btn-success">Verifikasi</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">Tidak ada pendaftar calon asprak</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $aspraks->links() }}
        </div>
    </div>
</div>
<script>
    function searchData() {
        // Declare variables
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("dataTable");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1];
            tdProdi = tr[i].getElementsByTagName("td")[2];
            if (td || tdProdi) {
                txtValue = td.textContent || td.innerText;
                txtValueLokasi = tdProdi.textContent || tdProdi.innerText;
                if ((txtValue.toUpperCase().indexOf(filter) > -1) || (txtValueLokasi.toUpperCase().indexOf(filter) > -1)) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>
@endsection