@extends('master.dashboard')

@section('content')
<div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Barang Dipinjam (Hari Ini)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$barangdipinjam}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-toolbox fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Form Masuk Peminjaman (Barang)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$banyakformbarang}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fab fa-wpforms fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Barang Telat Dikembalikan</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$barangbelumkembali}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-exclamation fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Form Masuk Peminjaman (Ruangan)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$banyakformruangan}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fab fa-wpforms fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Peminjaman Barang Hari Ini</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" style="font-size: 13px">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Status</th>
                                <th scope="col">Waktu Isi</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($formbarangs as $formbarang)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{$formbarang->nama_peminjam}}</td>
                                <td>{{ ($formbarang->validasi == '1') ? "Belum Meminjam" : "Sedang Meminjam" }}</td>
                                <td>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $formbarang->created_at)->format('d-m-Y H:i:s') }}</td>
                                <td><button class="btn btn-info btn-sm" data-toggle="modal" data-target="#data{{$formbarang->id}}">Detail</button></td>
                            </tr>
                            <div class="modal fade" id="data{{$formbarang->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Data Peminjam</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h5 class="my-2 ml-3">Status : {{ ($formbarang->validasi == '1') ? "Belum Meminjam" : "Sedang Meminjam" }}</h5>
                                            <dl class="ml-3">
                                                <dt><small><b>Nama</b></small></dt>
                                                <dd>{{$formbarang->nama_peminjam}}</dd>
                                                <dt><small><b>NIM / NIP</b></small></dt>
                                                <dd>{{$formbarang->nim}}</dd>
                                                <dt><small><b>Email</b></small></dt>
                                                <dd>{{$formbarang->email}}</dd>
                                                <dt><small><b>No HP</b></small></dt>
                                                <dd>{{$formbarang->no_hp}}</dd>
                                                <dt><small><b>Afiliasi</b></small></dt>
                                                <dd>{{$formbarang->afiliasi}}</dd>
                                                <dt><small><b>Tanggal Peminjaman</b></small></dt>
                                                <dd>{{ Carbon\Carbon::createFromFormat('Y-m-d', $formbarang->tanggal_peminjaman)->format('d-m-Y') }}</dd>
                                                <dt><small><b>Tanggal Pengembalian</b></small></dt>
                                                <dd>{{ Carbon\Carbon::createFromFormat('Y-m-d', $formbarang->tanggal_pengembalian)->format('d-m-Y') }}</b></dt>
                                            </dl>
                                            <b class="ml-3">Barang Pinjaman</b>
                                            <ul>
                                                @foreach ($barangs as $barang)
                                                @if ($barang->form_barang_id == $formbarang->id)
                                                <li>{{ $barang->inventaris->nama_barang }} <small>({{$barang->jumlah}} unit)</small></li>
                                                @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                        @can('inventaris')
                                        <div class="modal-footer">
                                            <form action="{{ route('peminjaman.barang.update') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="form_barang_id" value="{{ $formbarang->id }}" />
                                                @if ($formbarang->validasi == 1)
                                                <button type="submit" name="action" value="3" onclick="return confirm('Yakin ingin menghapus data?')" class="btn btn-danger">Hapus Data</button>
                                                <button type="submit" name="action" value="2" class="btn btn-warning">Sedang meminjam</button>
                                                @endif
                                                @if ($formbarang->validasi == 2)
                                                <button type="submit" name="action" value="0" class="btn btn-success">Selesai meminjam</button>
                                                @endif
                                            </form>
                                        </div>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                            @empty
                            <tr>
                                <th scope="row" colspan="5">Tidak ada form peminjaman barang</th>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @can('inventaris')
                <a href="{{ route('peminjaman.barang') }}" class="btn btn-primary btn-icon-split float-right w-100">
                    <span class="text" style="color:white;">Lihat Selengkapnya</span>
                </a>
                @endcan
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Peminjaman Ruangan</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" style="font-size: 13px">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Ruangan</th>
                                <th scope="col">Waktu Isi</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($formruangans as $formruangan)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td> {{$formruangan->nama_peminjam}} </td>
                                <td> {{$formruangan->ruanglab->ruang}} </td>
                                <td> {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $formruangan->created_at)->format('d-m-Y H:i:s') }} </td>
                                <td>
                                    <button class="btn btn-info" data-toggle="modal" data-target="#ruang{{$formruangan->id}}">Detail</button>
                                </td>
                            </tr>
                            <div class="modal fade" id="ruang{{$formruangan->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Data Peminjam</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h5 class="my-2 ml-3">{{ $formruangan->ruanglab->lokasi . ' : ' .$formruangan->ruanglab->ruang }}</h5>
                                            <dl class="ml-3">
                                                <dt><small><b>Nama</b></small></dt>
                                                <dd>{{$formruangan->nama_peminjam}}</dd>
                                                <dt><small><b>NIM / NIP</b></small></dt>
                                                <dd>{{$formruangan->nim}}</dd>
                                                <dt><small><b>Email</b></small></dt>
                                                <dd>{{$formruangan->email}}</dd>
                                                <dt><small><b>No HP</b></small></dt>
                                                <dd>{{$formruangan->no_hp}}</dd>
                                                <dt><small><b>Afiliasi</b></small></dt>
                                                <dd>{{$formruangan->afiliasi}}</dd>
                                                <dt><small><b>Ruang Lab</b></small></dt>
                                                <dd>{{$formruangan->ruanglab->lokasi . ' : ' .$formruangan->ruanglab->ruang}}</dd>
                                                <dt><small><b>Dosen</b></small></dt>
                                                <dd>{{$formruangan->dosen}}</dd>
                                                <dt><small><b>Kode Mata Kuliah</b></small></dt>
                                                <dd>{{$formruangan->kode_matkul}}</dd>
                                                <dt><small><b>Mata Kuliah</b></small></dt>
                                                <dd>{{$formruangan->mata_kuliah}}</dd>
                                                <dt><small><b>Hari</b></small></dt>
                                                <dd>{{$formruangan->hari}}</dd>
                                                <dt><small><b>Waktu</b></small></dt>
                                                <dd>{{$formruangan->waktu}}</dd>
                                            </dl>
                                            <b class="ml-3">Minggu Ke</b>
                                            <ul>
                                                @foreach ($ruangans as $ruangan)
                                                @if ($ruangan->form_ruangan_id == $formruangan->id)
                                                <li>{{ $ruangan->minggu }}</small></li>
                                                @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                        @can('ruangan')
                                        <div class="modal-footer">
                                            <form method="POST" action="{{ route('peminjaman.ruangan.update') }}">
                                                @csrf
                                                <input type="hidden" name="form_ruangan_id" value="{{ $formruangan->id }}" />
                                                <button type="submit" onclick="return confirm('Yakin ingin menghapus data?')" class="btn btn-danger" name="action" value="0">Hapus</button>
                                            </form>
                                            <button type="submit" class="btn btn-success" data-toggle="modal" data-target="#verif{{$formruangan->id}}">Verifikasi</button>
                                        </div>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="verif{{$formruangan->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Verifikasi Peminjaman Ruangan</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('peminjaman.ruangan.update') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="form_ruangan_id" value="{{ $formruangan->id }}" />
                                                <div class="form-group">
                                                    <label for="nilai">Pesan</label>
                                                    <textarea name="pesan" id="nilai" class="form-control" cols="10" rows="5" placeholder="Masukkan pesan"></textarea>
                                                </div>
                                                <button type="submit" class="btn btn-warning ml-1" name="action" value="1">Tolak</button>
                                                <button type="submit" class="btn btn-success ml-3" name="action" value="2">Terima</button>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <tr>
                                <th scope="row" colspan="5">Tidak ada form peminjaman ruangan</th>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @can('ruangan')
                <a href="{{ route('peminjaman.ruangan') }}" class="btn btn-primary btn-icon-split float-right w-100">
                    <span class="text" style="color:white;">Lihat Selengkapnya</span>
                </a>
                @endcan
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Barang dipinjam</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" style="font-size: 13px">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Peminjam</th>
                                    <th scope="col">Barang</th>
                                    <th scope="col">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($barangpinjamans as $barangpinjaman)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td> {{$barangpinjaman->formbarang->nama_peminjam}} </td>
                                    <td> {{$barangpinjaman->inventaris->nama_barang}} </td>
                                    <td> {{$barangpinjaman->jumlah}} </td>
                                </tr>
                                @empty
                                <tr>
                                    <th scope="row" colspan="4">Tidak ada barang yang dipinjam</th>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{$barangpinjamans->links()}}
                    </div>
                    @can('inventaris')
                    <a href="{{ route('peminjaman.barang') }}" class="btn btn-primary btn-icon-split float-right w-100">
                        <span class="text" style="color:white;">Lihat Selengkapnya</span>
                    </a>
                    @endcan
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Peminjaman Barang Telat</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" style="font-size: 13px">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Tanggal Pengembalian</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($peminjamtelats as $peminjamtelat)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{$peminjamtelat->nama_peminjam}}</td>
                                    <td>{{ Carbon\Carbon::createFromFormat('Y-m-d', $peminjamtelat->tanggal_pengembalian)->format('d-m-Y') }}</td>
                                    <td><button class="btn btn-info btn-sm" data-toggle="modal" data-target="#telat{{$peminjamtelat->id}}">Detail</button></td>
                                </tr>
                                <div class="modal fade" id="telat{{$peminjamtelat->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Data Peminjam</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <h5 class="my-2 ml-3">Status : {{ ($peminjamtelat->validasi == '1') ? "Belum Meminjam" : "Sedang Meminjam" }}</h5>
                                                <dl class="ml-3">
                                                    <dt><small><b>Nama</b></small></dt>
                                                    <dd>{{$peminjamtelat->nama_peminjam}}</dd>
                                                    <dt><small><b>NIM / NIP</b></small></dt>
                                                    <dd>{{$peminjamtelat->nim}}</dd>
                                                    <dt><small><b>Email</b></small></dt>
                                                    <dd>{{$peminjamtelat->email}}</dd>
                                                    <dt><small><b>No HP</b></small></dt>
                                                    <dd>{{$peminjamtelat->no_hp}}</dd>
                                                    <dt><small><b>Afiliasi</b></small></dt>
                                                    <dd>{{$peminjamtelat->afiliasi}}</dd>
                                                    <dt><small><b>Tanggal Peminjaman</b></small></dt>
                                                    <dd>{{ Carbon\Carbon::createFromFormat('Y-m-d', $peminjamtelat->tanggal_peminjaman)->format('d-m-Y') }}</dd>
                                                    <dt><small><b>Tanggal Pengembalian</b></small></dt>
                                                    <dd>{{ Carbon\Carbon::createFromFormat('Y-m-d', $peminjamtelat->tanggal_pengembalian)->format('d-m-Y') }}</b></dt>
                                                </dl>
                                                <b class="ml-3">Barang Pinjaman</b>
                                                <ul>
                                                    @foreach ($barangs as $barang)
                                                    @if ($barang->form_barang_id == $peminjamtelat->id)
                                                    <li>{{ $barang->inventaris->nama_barang }} <small>({{$barang->jumlah}} unit)</small></li>
                                                    @endif
                                                    @endforeach
                                                </ul>
                                            </div>
                                            @can('inventaris')
                                            <div class="modal-footer">
                                                <form action="{{ route('peminjaman.barang.update') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="form_barang_id" value="{{ $peminjamtelat->id }}" />
                                                    <button type="submit" name="action" value="0" class="btn btn-success">Selesai meminjam</button>
                                                    <button type="submit" name="action" value="1" class="btn btn-warning" onclick="return confirm('Kirim notifikasi?')">Kirim Notifikasi</button>
                                                </form>
                                            </div>
                                            @endcan
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <tr>
                                    <th scope="row" colspan="5">Tidak ada telat peminjaman barang</th>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{$peminjamtelats->links()}}
                    </div>
                    @can('inventaris')
                    <a href="{{ route('peminjaman.barang.telat') }}" class="btn btn-primary btn-icon-split float-right w-100">
                        <span class="text" style="color:white;">Lihat Selengkapnya</span>
                    </a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
    @endsection