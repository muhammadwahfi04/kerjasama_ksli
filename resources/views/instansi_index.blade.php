@extends('layouts.beranda')
@section('title', 'Admin | Data Kerjasama Instansi Pemerintahan')

<!-- Image and text -->
@section('content')
    
<div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Data Kerjasama dengan Pemerintahan</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Kerjasama dengan Pemerintahan</h6>
            </div>
            <div class="card-body">
                <div class="col-12 text-right">
                    <a href="{{ route ("create_ks_instansi.create") }}" class="btn btn-primary mb-3">Tambah Data Kerjasama Pemerintahan</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Jenis</th>
                                <th>Instansi Kerjasama</th>
                                <th>Nama Instansi Kerjasama</th>
                                <th>Tanggal Mulai</th>
                                <th>Nama Negara</th>
                                <th>Nomor Kerjasama</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($ks_instansis as $ks_instansi)
                            <tr>
                                <td>{{ $loop            ->iteration }}</td>
                                <td>{{ $ks_instansi     ->ksJenis}}</td>
                                <td>{{ $ks_instansi     ->ksInstansi}}</td>
                                <td>{{ $ks_instansi     ->ksNama}}</td>
                                <td>{{ $ks_instansi     ->ksTglKontrak}}</td>
                                <td>{{ $ks_instansi     ->ksNegara}}</td>
                                <td>{{ $ks_instansi     ->ksNoKS}}</td>
                                <td>{{ $ks_instansi     ->ksKet}}</td>
                                <td>
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal-{{ $ks_instansi->ksId }}">Detail</button>                                 
                                </td>
                            </tr>
                            @empty

                            @endforelse
                            {{-- <td colspan="6" class="text-center">No data</td> --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

                <!-- Modal -->
                @foreach ($ks_instansis as $detail_ks_instansi)

                <div class="modal fade" id="exampleModal-{{ $detail_ks_instansi->ksId }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <p>Ayam     : {{ $detail_ks_instansi ->ksNama }}</p>
                            <p>Negara     : {{ $detail_ks_instansi ->ksNegara }}</p>
                            <p>Nomor Kerja Sama     : {{ $detail_ks_instansi ->ksNoKS }}</p>
                            <p>Tanggal Mulai     : {{ $detail_ks_instansi ->ksTglKontrak }}</p>
                            <p>Tanggal Akhir     : {{ $detail_ks_instansi ->ksTglAkhir }}</p>
                            <p>Jangka Waktu     : {{ $detail_ks_instansi ->ksJangka }}</p>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                    </div>
                </div>
                                    
                @endforeach
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
@endsection