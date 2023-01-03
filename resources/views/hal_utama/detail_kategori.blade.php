@extends('layouts.master')
@section('title', 'Data Kategori')

<!-- Image and text -->
@section('content')
    
<div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">@lang('general.data_kerjasama_dengan') {{ $judulKs->ksNegara }}</h1>


        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">@lang('general.data_kerjasama_dengan') {{ $judulKs->ksNegara }}</h6>
            </div>
            <div class="card-body">
                
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>@lang('general.jenis_kerjasama') </th>
                                <th>@lang('general.instansi_kerjasama') </th>
                                <th>@lang('general.nama_instansi_kerjasama') </th>
                                <th>@lang('general.tanggal_mulai') </th>
                                <th>@lang('general.nama_negara') </th>
                                <th>@lang('general.nomor_kerjasama') </th>
                                <th>@lang('general.keterangan') </th>
                                <th>@lang('general.status') </th>
                                <th>@lang('general.unit_yang_terlibat') </th>
                                <th>@lang('general.aksi') </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($kerjasama as $ks)
                            <tr>
                                <td>{{ $loop ->index + 1 }}</td>
                                <td>{{ $ks     ->ksJenis}}</td>
                                <td>{{ $ks     ->ksInstansi}}</td>
                                <td>{{ $ks     ->ksNama}}</td>
                                <td>{{ $ks     ->ksTglKontrak}}</td>
                                <td>{{ $ks     ->ksNegara}}</td>
                                <td>{{ $ks     ->ksNoKS}}</td>
                                <td><a href="{{ asset('img/'. $ks ->ksFile) }}">{{  $ks     ->ksKet}}</a></td>
                                {{-- {{ asset('gambar/Logo_Unib.png') }}
                                img/{{ $ks ->ksFile }} --}}
                                <td>
                                @if ($tgl_sekarang >= $ks->ksTglAkhir) 
                                    tidak aktif
                                @else
                                    aktif
                                @endif
                                    
                                </td>  
                                
                                <td>
                                    <ul>
                                        @foreach ($ks->tbpihakdetails as $item)
                                            <li>{{ $item->pdNama }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>
                                    {{-- <button type="button" class="btn btn-info d-inline-block mb-1" data-toggle="modal" data-target="#exampleModal-{{ $ks->ksId }}">Detail</button>  
                                    <a href="{{ route ("perguruan.update", $ks->ksId) }}" class="btn btn-primary d-inline-block mb-1" type="button">Edit</a>
                                    @if (auth()->user()->level=="admin")
                                        <a class="btn btn-danger d-inline-block" type="button"  data-toggle="modal" data-target="#hapusModal">Hapus</a>
                                    @endif --}}
                                    @auth
                                    @if (auth()->user()->level == 'unit')
                                        <button type="button" class="btn btn-info d-inline-block mb-1"
                                            data-toggle="modal"
                                            data-target="#exampleModal-{{ $ks->ksId }}">Detail</button>
                                        {{-- <a href="{{ route('pemerintahan.update', $ks->ksId) }}"
                                            class="btn btn-primary d-inline-block mb-1" type="button">Edit</a> --}}
                                    @endif
                                    @if (auth()->user()->level == 'admin')
                                        <button type="button" class="btn btn-info d-inline-block mb-1"
                                            data-toggle="modal"
                                            data-target="#exampleModal-{{ $ks->ksId }}">Detail</button>
                                        {{-- <a href="{{ route('pemerintahan.update', $ks->ksId) }}"
                                            class="btn btn-primary d-inline-block mb-1" type="button">Edit</a>
                                        <a class="btn btn-danger d-inline-block" type="button" data-toggle="modal"
                                            data-target="#hapusModal">@lang('general.hapus')</a> --}}
                                    @endif
                                @else
                                    <button type="button" class="btn btn-info d-inline-block mb-1" data-toggle="modal"
                                        data-target="#exampleModal-{{ $ks->ksId }}">Detail</button>
                                @endauth
                                

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
                @foreach ($kerjasama as $detail_ks)

                <div class="modal fade" id="exampleModal-{{ $detail_ks->ksId }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Kerjasama</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <p>@lang('general.nama_instansi_kerjasama')     : {{ $detail_ks ->ksNama }}</p>
                            <p>@lang('general.nama_kota'), @lang('general.nama_negara') : {{ $detail_ks ->ksKota }}, {{ $detail_ks ->ksNegara }}</p>
                            <p>@lang('general.nomor_kerjasama')      : {{ $detail_ks ->ksNoKS }}</p>
                            <p>@lang('general.tanggal_mulai')      : {{ $detail_ks ->ksTglKontrak }}</p>
                            <p>@lang('general.tanggal_akhir')      : {{ $detail_ks ->ksTglAkhir }}</p>
                            <p>@lang('general.jangka_waktu')      : {{ $detail_ks ->ksJangka }}</p>
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
            <!-- Hapus Modal-->
            <div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Hapus kerjasama</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Yakin hapus data kerjasama ini ?</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                        <a class="btn btn-danger" href="{{ route("perguruan.hapus", $ks->ksId) }}">Hapus</a>
                    </div>
                </div>
            </div>
        </div>
</div>
<!-- End of Main Content -->



@endsection