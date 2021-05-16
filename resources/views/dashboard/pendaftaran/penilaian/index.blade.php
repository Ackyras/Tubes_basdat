@extends('master.dashboard')

@section('css')
@endsection

@section('title-page', 'Verifikasi Kelulusan Calon Asprak')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">List Penilaian Calon Asprak</h6>
    </div>
    <div class="card-body">
        @if (session('status'))
        <div class="alert alert-success mt-3">
            {{ session('status') }}
        </div>
        @endif
        <form action="{{ route('asprak.nilai.index.matkul') }}" method="GET">
            <input class="my-2 form-control w-25 float-right mr-2" name="matkul" type="text" id="myInput" onkeyup="searchData()" placeholder="Cari mata kuliah">
        </form>
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Mata Kuliah</th>
                        <th>Jawaban</th>
                        <th>Nilai</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($penilaians as $penilaian)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $penilaian->calonasprak->nama }}</td>
                        <td>
                            @foreach ($daftar_matkuls as $daftar_matkul)
                            @if($penilaian->matakuliah->mata_kuliah_id == $daftar_matkul->id)
                            {{ $daftar_matkul->nama }}
                            @endif
                            @endforeach
                        </td>
                        <td><a href="{{ $penilaian->jawaban }}">Jawaban</a></td>
                        <td>{{$penilaian->nilai}}</td>
                        <td>
                            <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#data{{$penilaian->id}}">Detail</button>
                        </td>
                        <div class="modal fade" id="data{{$penilaian->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                            <dd>{{ $penilaian->calonasprak->nama }}</dd>
                                            <dt><small><b>Nim</b></small></dt>
                                            <dd>{{ $penilaian->calonasprak->nim }}</dd>
                                            <dt><small><b>Program Studi</b></small></dt>
                                            <dd>{{ $penilaian->calonasprak->program_studi }}</dd>
                                            <dt><small><b>Angkatan</b></small></dt>
                                            <dd>{{$penilaian->calonasprak->angkatan}} </dd>
                                            <dt><small><b>E-mail</b></small></dt>
                                            <dd>{{ $penilaian->calonasprak->email }}</b></small></dt>
                                            <dt><small><b>Tanggal lahir</dt>
                                            <dd>{{ $penilaian->calonasprak->tanggal_lahir }}</b></small></dt>
                                        </dl>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-info" data-toggle="modal" data-target="#data{{$penilaian->id . $penilaian->id}}">Nilai</button>
                                        <form action="{{ route('asprak.verifikasi.lulus') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $penilaian->id }}">
                                            @if($penilaian->nilai != null)
                                            <button type="submit" name="action" value="2" onclick="return confirm('Tolak calon asprak {{ $penilaian->calonasprak->nama }}?')" class="btn btn-warning">Tolak</button>
                                            <button type="submit" name="action" value="1" onclick="return confirm('Verifikasi kelulusan calon asprak {{ $penilaian->calonasprak->nama }}?')" class="btn btn-success">Lulus</button>
                                            @endif
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="data{{$penilaian->id . $penilaian->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Beri penilaian</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('asprak.verifikasi.nilai') }}" method="POST">
                                            @csrf
                                            <div class="form-group col-5">
                                                <label for="nilai">Nilai</label>
                                                <input type="hidden" name="penilaian_id" value="{{ $penilaian->id }}">
                                                <input class="form-control" type="number" min="0" max="100" value="{{ $penilaian->nilai }}" name="nilai" id="nilai" required>
                                            </div>
                                            <button type="submit" class="btn btn-success ml-3">Submit</button>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
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
            {{ $penilaians->links() }}
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
            tdLokasi = tr[i].getElementsByTagName("td")[2];
            if (td || tdLokasi) {
                txtValue = td.textContent || td.innerText;
                txtValueLokasi = tdLokasi.textContent || tdLokasi.innerText;
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