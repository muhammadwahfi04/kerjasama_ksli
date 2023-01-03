@extends('layouts.master')
@section('title', 'Data Kerjasama Perusahaan Swasta')

<!-- Image and text -->
@section('content')
    
<div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">@lang('general.data_kerjasama_dengan_perusahaan_swasta')</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">@lang('general.data_kerjasama_dengan_perusahaan_swasta')</h6>
            </div>
            <div class="card-body">
                <div>
                    @auth
                    @if(auth()->user()->level=="unit")
                    <a href="{{ route ("perusahaan.create") }}" class="btn btn-primary mb-3">@lang('general.tambah_data_kerjasama_perusahaan_swasta')<i class="fa fa-plus ml-2" aria-hidden="true"></i></a>
                    @endif

                    @if(auth()->user()->level=="admin")
                    <a href="{{ route ("perusahaan.create") }}" class="btn btn-primary mb-3">@lang('general.tambah_data_kerjasama_perusahaan_swasta')<i class="fa fa-plus ml-2" aria-hidden="true"></i></a>
                    @endif
                    @endauth
                </div>

                @if ($message = Session::get('berhasil_tambah'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if ($message = Session::get('berhasil_perbarui'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if ($message = Session::get('berhasil_hapus'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>@lang('general.jenis_kerjasama')</th>
                                <th>@lang('general.instansi_kerjasama')</th>
                                <th>@lang('general.nama_instansi_kerjasama')</th>
                                <th>@lang('general.tanggal_mulai')</th>
                                <th>@lang('general.tanggal_akhir')</th>
                                <th>@lang('general.nama_negara')</th>
                                <th>@lang('general.isi_kerjasama')</th>
                                <th>@lang('general.keterangan')</th>
                                <th>@lang('general.status')</th>
                                <th>@lang('general.unit_yang_terlibat')</th>
                                <th>@lang('general.aksi')</th>
                            </tr>
                        </thead>
                        <tbody>

                        {{-- //filter unit pada setiap hak akses --}}
                        @forelse ($ks_perusahaans as $ks_perusahaan)
                            @php
                                $perusahaan = [];
   
                                foreach ($ks_perusahaan->tbpihakdetails as $i) {
                                    $perusahaan[] = $i->pdId;
                                }
                            @endphp

                        @if (auth()->user())
                            @if (in_array(auth()->user()->pdd_id, $perusahaan))
                            <tr>
                                <td>{{ $loop ->index + 1 }}</td>
                                <td>{{ $ks_perusahaan     ->ksJenis}}</td>
                                <td>{{ $ks_perusahaan     ->ksInstansi}}</td>
                                <td>{{ $ks_perusahaan     ->ksNama}}</td>
                                <td>{{ $ks_perusahaan     ->ksTglKontrak}}</td>
                                <td>{{ $ks_perusahaan     ->ksTglAkhir}}</td>
                                <td>{{ $ks_perusahaan     ->ksNegara}}</td>
                                <td>{{ $ks_perusahaan     ->ksIsiKS}}</td>
                                <td><a href="#" data-toggle="modal" data-target="#ModalPDF-{{ $ks_perusahaan->ksId }}">{{  $ks_perusahaan     ->ksKet}}</a></td>
                                {{-- {{ asset('gambar/Logo_Unib.png') }}
                                img/{{ $ks_perusahaan ->ksFile }} --}}
                                <td>
                                @if ($tgl_sekarang >= $ks_perusahaan->ksTglAkhir) 
                                    Tidak aktif
                                @else
                                    Aktif
                                @endif
                                    
                                </td>  
                                
                                <td>
                                    <ul>
                                        @foreach ($ks_perusahaan->tbpihakdetails as $item)
                                            <li>{{ $item->pdNama }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>
                                    @auth
                                    @if(auth()->user()->level=="unit")
                                        <button type="button" class="btn btn-info d-inline-block mb-1" data-toggle="modal" data-target="#exampleModal-{{ $ks_perusahaan->ksId }}">Detail</button>  
                                        <a href="{{ route ("perusahaan.update", $ks_perusahaan->ksId) }}" class="btn btn-primary d-inline-block mb-1" type="button">Edit</a>
                                    @endif

                                    @if(auth()->user()->level=="admin")
                                        <button type="button" class="btn btn-info d-inline-block mb-1" data-toggle="modal" data-target="#exampleModal-{{ $ks_perusahaan->ksId }}">Detail</button>  
                                        <a href="{{ route ("perusahaan.update", $ks_perusahaan->ksId) }}" class="btn btn-primary d-inline-block mb-1" type="button">Edit</a>
                                        <a class="btn btn-danger d-inline-block" type="button" data-toggle="modal" data-target="#hapusModal">@lang('general.hapus')</a>  
                                    @endif
                                    
                                    @else
                                        <button type="button" class="btn btn-info d-inline-block mb-1" data-toggle="modal" data-target="#exampleModal-{{ $ks_perusahaan->ksId }}">Detail</button>                               
                                    @endauth
                                    

                                </td>
                            </tr>

                            @elseif (auth()->user()->level=="admin")
                            <tr>
                                <td>{{ $loop ->index + 1 }}</td>
                                <td>{{ $ks_perusahaan     ->ksJenis}}</td>
                                <td>{{ $ks_perusahaan     ->ksInstansi}}</td>
                                <td>{{ $ks_perusahaan     ->ksNama}}</td>
                                <td>{{ $ks_perusahaan     ->ksTglKontrak}}</td>
                                <td>{{ $ks_perusahaan     ->ksTglAkhir}}</td>
                                <td>{{ $ks_perusahaan     ->ksNegara}}</td>
                                <td>{{ $ks_perusahaan     ->ksIsiKS}}</td>
                                <td><a href="#" data-toggle="modal" data-target="#ModalPDF-{{ $ks_perusahaan->ksId }}">{{  $ks_perusahaan     ->ksKet}}</a></td>
                                {{-- {{ asset('gambar/Logo_Unib.png') }}
                                img/{{ $ks_perusahaan ->ksFile }} --}}
                                <td>
                                @if ($tgl_sekarang >= $ks_perusahaan->ksTglAkhir) 
                                    Tidak aktif
                                @else
                                    Aktif
                                @endif
                                    
                                </td>  
                                
                                <td>
                                    <ul>
                                        @foreach ($ks_perusahaan->tbpihakdetails as $item)
                                            <li>{{ $item->pdNama }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>
                                    @auth
                                    @if(auth()->user()->level=="unit")
                                        <button type="button" class="btn btn-info d-inline-block mb-1" data-toggle="modal" data-target="#exampleModal-{{ $ks_perusahaan->ksId }}">Detail</button>  
                                        <a href="{{ route ("perusahaan.update", $ks_perusahaan->ksId) }}" class="btn btn-primary d-inline-block mb-1" type="button">Edit</a>
                                    @endif

                                    @if(auth()->user()->level=="admin")
                                        <button type="button" class="btn btn-info d-inline-block mb-1" data-toggle="modal" data-target="#exampleModal-{{ $ks_perusahaan->ksId }}">Detail</button>  
                                        <a href="{{ route ("perusahaan.update", $ks_perusahaan->ksId) }}" class="btn btn-primary d-inline-block mb-1" type="button">Edit</a>
                                        <a class="btn btn-danger d-inline-block" type="button" data-toggle="modal" data-target="#hapusModal">@lang('general.hapus')</a>  
                                    @endif
                                    
                                    @else
                                        <button type="button" class="btn btn-info d-inline-block mb-1" data-toggle="modal" data-target="#exampleModal-{{ $ks_perusahaan->ksId }}">Detail</button>                               
                                    @endauth
                                    

                                </td>
                            </tr>
                            @endif

                            @else
                            <tr>
                                <td>{{ $loop ->index + 1 }}</td>
                                <td>{{ $ks_perusahaan     ->ksJenis}}</td>
                                <td>{{ $ks_perusahaan     ->ksInstansi}}</td>
                                <td>{{ $ks_perusahaan     ->ksNama}}</td>
                                <td>{{ $ks_perusahaan     ->ksTglKontrak}}</td>
                                <td>{{ $ks_perusahaan     ->ksTglAkhir}}</td>
                                <td>{{ $ks_perusahaan     ->ksNegara}}</td>
                                <td>{{ $ks_perusahaan     ->ksIsiKS}}</td>
                                <td><a href="#" data-toggle="modal" data-target="#ModalPDF-{{ $ks_perusahaan->ksId }}">{{  $ks_perusahaan     ->ksKet}}</a></td>
                                {{-- {{ asset('gambar/Logo_Unib.png') }}
                                img/{{ $ks_perusahaan ->ksFile }} --}}
                                <td>
                                @if ($tgl_sekarang >= $ks_perusahaan->ksTglAkhir) 
                                    Tidak aktif
                                @else
                                    Aktif
                                @endif
                                    
                                </td>  
                                
                                <td>
                                    <ul>
                                        @foreach ($ks_perusahaan->tbpihakdetails as $item)
                                            <li>{{ $item->pdNama }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>
                                    @auth
                                    @if(auth()->user()->level=="unit")
                                        <button type="button" class="btn btn-info d-inline-block mb-1" data-toggle="modal" data-target="#exampleModal-{{ $ks_perusahaan->ksId }}">Detail</button>  
                                        <a href="{{ route ("perusahaan.update", $ks_perusahaan->ksId) }}" class="btn btn-primary d-inline-block mb-1" type="button">Edit</a>
                                    @endif

                                    @if(auth()->user()->level=="admin")
                                        <button type="button" class="btn btn-info d-inline-block mb-1" data-toggle="modal" data-target="#exampleModal-{{ $ks_perusahaan->ksId }}">Detail</button>  
                                        <a href="{{ route ("perusahaan.update", $ks_perusahaan->ksId) }}" class="btn btn-primary d-inline-block mb-1" type="button">Edit</a>
                                        <a class="btn btn-danger d-inline-block" type="button" data-toggle="modal" data-target="#hapusModal">@lang('general.hapus')</a>  
                                    @endif
                                    
                                    @else
                                        <button type="button" class="btn btn-info d-inline-block mb-1" data-toggle="modal" data-target="#exampleModal-{{ $ks_perusahaan->ksId }}">Detail</button>                               
                                    @endauth
                                    

                                </td>
                            </tr>

                            @endif
                        @empty
                    @endforelse

                    
                            {{-- <td colspan="6" class="text-center">No data</td> --}}
                        </tbody>
                    </table>
                </div>
            </div>   
        </div>

                <!-- Modal -->
                @foreach ($ks_perusahaans as $detail_ks_perusahaan)

                <div class="modal fade" id="exampleModal-{{ $detail_ks_perusahaan->ksId }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">@lang('general.detail_kerjasama')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <p>@lang('general.nama_instansi_kerjasama')     : {{ $detail_ks_perusahaan ->ksNama }}</p>
                            <p>@lang('general.nama_kota'), @lang('general.nama_negara')     : {{ $detail_ks_perusahaan ->ksKota }}, {{ $detail_ks_perusahaan ->ksNegara }}</p>
                            <p>@lang('general.nomor_kerjasama')     : {{ $detail_ks_perusahaan ->ksNoKS }}</p>
                            <p>@lang('general.tanggal_mulai')     : {{ $detail_ks_perusahaan ->ksTglKontrak }}</p>
                            <p>@lang('general.tanggal_akhir')     : {{ $detail_ks_perusahaan ->ksTglAkhir }}</p>
                            <p>@lang('general.jangka_waktu')     : {{ $detail_ks_perusahaan ->ksJangka }}</p>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('general.tutup')</button>

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
                    <h5 class="modal-title" id="exampleModalLabel">@lang('general.hapus_kerjasama')</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">@lang('general.yakin_hapus_data_kerjasama_ini?')</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">@lang('general.batal')</button>
                    <a class="btn btn-danger" href="{{ route("perusahaan.hapus", $ks_perusahaan->ksId) }}">@lang('general.hapus')</a>
                </div>
            </div>
        </div>
    </div>
</div>


    <!-- Modal -->
        @foreach ($ks_perusahaans as $ks)
        <div class="modal fade bd-example-modal-lg" id="ModalPDF-{{ $ks->ksId }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{-- <embed type="application/pdf" src="{{ asset('img/' . $ks->ksFile) }}" width="600" height="400"></embed> --}}
                        <div id="pdf">
                            <object width="100%" height="700" type="application/pdf" data="{{ asset('img/' . $ks->ksFile) }}#zoom=85&scrollbar=0&toolbar=0&navpanes=0" id="pdf_content" style="pointer-events: none;">
                                <p>Pdf tidak bisa tampil dikarenakan file sudah tidak ada</p>
                            </object>
                        </div>
                    </div>
                    <div class="modal-footer">
                        @if (file_exists(public_path('img/' . $ks->ksFile))  && !(asset('img/' . $ks->ksFile) == 'http://localhost:8000/img'))
                            <a class="btn btn-primary" href="{{ asset('img/' . $ks->ksFile) }}">Download</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach
<!-- End of Main Content -->
@endsection