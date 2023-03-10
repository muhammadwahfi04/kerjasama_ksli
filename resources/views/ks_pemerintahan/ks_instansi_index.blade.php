@extends('layouts.master')

@section('title', 'Data Kerjasama Instansi Pemerintahan')

<!-- Image and text -->
@section('content')

    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">@lang('general.data_kerjasama_dengan_instansi_pemerintahan')</h1>

        <!-- Custom styles for this page -->
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">@lang('general.data_kerjasama_dengan_instansi_pemerintahan')</h6>
            </div>
            <div class="card-body">
                <div>
                    @auth
                        @if (auth()->user()->level == 'unit')
                            <a href="{{ route('pemerintahan.create') }}" class="btn btn-primary mb-3">@lang('general.tambah_data_kerjasama_instansi_pemerintahan')<i class="fa fa-plus ml-2" aria-hidden="true"></i></a>
                        @endif

                        @if (auth()->user()->level == 'admin')
                            <a href="{{ route('pemerintahan.create') }}" class="btn btn-primary mb-3">@lang('general.tambah_data_kerjasama_instansi_pemerintahan')<i class="fa fa-plus ml-2" aria-hidden="true"></i></a>
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
                        @forelse ($ks_instansis as $ks_instansi)
                            @php
                                $instansi = [];

                                foreach ($ks_instansi->tbpihakdetails as $i) {
                                    $instansi[] = $i->pdId;
                                }
                            @endphp
                            
                        @if (auth()->user())
                        {{-- filter pada setiap unit --}}
                            @if (in_array(auth()->user()->pdd_id, $instansi))
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $ks_instansi->ksJenis }}</td>
                                    <td>{{ $ks_instansi->ksInstansi }}</td>
                                    <td>{{ $ks_instansi->ksNama }}</td>
                                    <td>{{ $ks_instansi->ksTglKontrak }}</td>
                                    <td>{{ $ks_instansi->ksTglAkhir }}</td>
                                    <td>{{ $ks_instansi->ksNegara }}</td>
                                    <td>{{ $ks_instansi->ksIsiKS }}</td>
                                    {{-- <td><a href="{{ asset('img/' . $ks_instansi->ksFile) }}">{{ $ks_instansi->ksKet }}</a> --}}
                                        <td><a href="#" data-toggle="modal" data-target="#ModalPDF-{{ $ks_instansi->ksId }}">{{ $ks_instansi->ksKet }}</a>
                                    </td>
                                    {{-- {{ asset('gambar/Logo_Unib.png') }}
                                img/{{ $ks_instansi ->ksFile }} --}}
                                    <td>
                                        @if ($tgl_sekarang >= $ks_instansi->ksTglAkhir)
                                            tidak aktif
                                        @else
                                            aktif
                                        @endif
                                    </td>

                                    <td>
                                        <ul>
                                            @foreach ($ks_instansi->tbpihakdetails as $item)
                                                    <li>{{ $item->pdNama }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        @auth
                                            @if (auth()->user()->level == 'unit')
                                                <button type="button" class="btn btn-info d-inline-block mb-1"
                                                    data-toggle="modal"
                                                    data-target="#exampleModal-{{ $ks_instansi->ksId }}">Detail</button>
                                                <a href="{{ route('pemerintahan.update', $ks_instansi->ksId) }}"
                                                    class="btn btn-primary d-inline-block mb-1" type="button">Edit</a>
                                            @endif
                                            @if (auth()->user()->level == 'admin')
                                                <button type="button" class="btn btn-info d-inline-block mb-1"
                                                    data-toggle="modal"
                                                    data-target="#exampleModal-{{ $ks_instansi->ksId }}">Detail</button>
                                                <a href="{{ route('pemerintahan.update', $ks_instansi->ksId) }}"
                                                    class="btn btn-primary d-inline-block mb-1" type="button">Edit</a>
                                                <a class="btn btn-danger d-inline-block" type="button" data-toggle="modal"
                                                    data-target="#hapusModal">@lang('general.hapus')</a>
                                            @endif
                                        @else
                                            <button type="button" class="btn btn-info d-inline-block mb-1" data-toggle="modal"
                                                data-target="#exampleModal-{{ $ks_instansi->ksId }}">Detail</button>
                                        @endauth
                                    </td>
                                </tr>


                                @elseif (auth()->user()->level == 'admin')
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $ks_instansi->ksJenis }}</td>
                                    <td>{{ $ks_instansi->ksInstansi }}</td>
                                    <td>{{ $ks_instansi->ksNama }}</td>
                                    <td>{{ $ks_instansi->ksTglKontrak }}</td>
                                    <td>{{ $ks_instansi->ksTglAkhir }}</td>
                                    <td>{{ $ks_instansi->ksNegara }}</td>
                                    <td>{{ $ks_instansi->ksIsiKS }}</td>
                                    {{-- <td><a href="{{ asset('img/' . $ks_instansi->ksFile) }}">{{ $ks_instansi->ksKet }}</a> --}}
                                        <td><a href="#" data-toggle="modal" data-target="#ModalPDF-{{ $ks_instansi->ksId }}">{{ $ks_instansi->ksKet }}</a>
                                    </td>
                                    {{-- {{ asset('gambar/Logo_Unib.png') }}
                                img/{{ $ks_instansi ->ksFile }} --}}
                                    <td>
                                        @if ($tgl_sekarang >= $ks_instansi->ksTglAkhir)
                                            tidak aktif
                                        @else
                                            aktif
                                        @endif
                                    </td>

                                    <td>
                                        <ul>
                                            @foreach ($ks_instansi->tbpihakdetails as $item)
                                                    <li>{{ $item->pdNama }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        @auth
                                            @if (auth()->user()->level == 'unit')
                                                <button type="button" class="btn btn-info d-inline-block mb-1"
                                                    data-toggle="modal"
                                                    data-target="#exampleModal-{{ $ks_instansi->ksId }}">Detail</button>
                                                <a href="{{ route('pemerintahan.update', $ks_instansi->ksId) }}"
                                                    class="btn btn-primary d-inline-block mb-1" type="button">Edit</a>
                                            @endif
                                            @if (auth()->user()->level == 'admin')
                                                <button type="button" class="btn btn-info d-inline-block mb-1"
                                                    data-toggle="modal"
                                                    data-target="#exampleModal-{{ $ks_instansi->ksId }}">Detail</button>
                                                <a href="{{ route('pemerintahan.update', $ks_instansi->ksId) }}"
                                                    class="btn btn-primary d-inline-block mb-1" type="button">Edit</a>
                                                <a class="btn btn-danger d-inline-block" type="button" data-toggle="modal"
                                                    data-target="#hapusModal">@lang('general.hapus')</a>
                                            @endif
                                        @else
                                            <button type="button" class="btn btn-info d-inline-block mb-1" data-toggle="modal"
                                                data-target="#exampleModal-{{ $ks_instansi->ksId }}">Detail</button>
                                        @endauth
                                    </td>
                                </tr>
                                @endif
                                {{-- //pengunjungs --}}
                                @else
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $ks_instansi->ksJenis }}</td>
                                    <td>{{ $ks_instansi->ksInstansi }}</td>
                                    <td>{{ $ks_instansi->ksNama }}</td>
                                    <td>{{ $ks_instansi->ksTglKontrak }}</td>
                                    <td>{{ $ks_instansi->ksTglAkhir }}</td>
                                    <td>{{ $ks_instansi->ksNegara }}</td>
                                    <td>{{ $ks_instansi->ksIsiKS }}</td>
                                    {{-- <td><a href="{{ asset('img/' . $ks_instansi->ksFile) }}">{{ $ks_instansi->ksKet }}</a> --}}
                                        <td><a href="#" data-toggle="modal" data-target="#ModalPDF-{{ $ks_instansi->ksId }}">{{ $ks_instansi->ksKet }}</a>
                                    </td>
                                    {{-- {{ asset('gambar/Logo_Unib.png') }}
                                img/{{ $ks_instansi ->ksFile }} --}}
                                    <td>
                                        @if ($tgl_sekarang >= $ks_instansi->ksTglAkhir)
                                            tidak aktif
                                        @else
                                            aktif
                                        @endif
                                    </td>

                                    <td>
                                        <ul>
                                            @foreach ($ks_instansi->tbpihakdetails as $item)
                                                    <li>{{ $item->pdNama }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        @auth
                                            @if (auth()->user()->level == 'unit')
                                                <button type="button" class="btn btn-info d-inline-block mb-1"
                                                    data-toggle="modal"
                                                    data-target="#exampleModal-{{ $ks_instansi->ksId }}">Detail</button>
                                                <a href="{{ route('pemerintahan.update', $ks_instansi->ksId) }}"
                                                    class="btn btn-primary d-inline-block mb-1" type="button">Edit</a>
                                            @endif
                                            @if (auth()->user()->level == 'admin')
                                                <button type="button" class="btn btn-info d-inline-block mb-1"
                                                    data-toggle="modal"
                                                    data-target="#exampleModal-{{ $ks_instansi->ksId }}">Detail</button>
                                                <a href="{{ route('pemerintahan.update', $ks_instansi->ksId) }}"
                                                    class="btn btn-primary d-inline-block mb-1" type="button">Edit</a>
                                                <a class="btn btn-danger d-inline-block" type="button" data-toggle="modal"
                                                    data-target="#hapusModal">@lang('general.hapus')</a>
                                            @endif
                                        @else
                                            <button type="button" class="btn btn-info d-inline-block mb-1" data-toggle="modal"
                                                data-target="#exampleModal-{{ $ks_instansi->ksId }}">Detail</button>
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
        @foreach ($ks_instansis as $detail_ks_instansi)
            <div class="modal fade" id="exampleModal-{{ $detail_ks_instansi->ksId }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">@lang('general.detail_kerjasama')</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>@lang('general.nama_instansi_kerjasama') : {{ $detail_ks_instansi->ksNama }}</p>
                            <p>@lang('general.nama_kota'), @lang('general.nama_negara') : {{ $detail_ks_instansi->ksKota }}, {{ $detail_ks_instansi->ksNegara }}</p>
                            <p>@lang('general.nomor_kerjasama') : {{ $detail_ks_instansi->ksNoKS }}</p>
                            <p>@lang('general.tanggal_mulai') : {{ $detail_ks_instansi->ksTglKontrak }}</p>
                            <p>@lang('general.tanggal_akhir') : {{ $detail_ks_instansi->ksTglAkhir }}</p>
                            <p>@lang('general.jangka_waktu') : {{ $detail_ks_instansi->ksJangka }}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">@lang('general.tutup')</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <!-- /.container-fluid -->

    </div>

    <!-- Hapus Modal-->
    <div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">@lang('general.hapus_kerjasama')</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">??</span>
                    </button>
                </div>
                <div class="modal-body">@lang('general.yakin_hapus_data_kerjasama_ini?')</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">@lang('general.batal')</button>
                    <a class="btn btn-danger"
                        href="{{ route('pemerintahan.hapus', $ks_instansi->ksId) }}">@lang('general.hapus')</a>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Main Content -->

      <!-- Modal -->
        @foreach ($ks_instansis as $ks)
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
                            {{-- <button type="button" class="btn btn-primary" href="{{ asset('img/' . $ks->ksFile) }}">Download</button> --}}
                            @if (file_exists(public_path('img/' . $ks->ksFile))  && !(asset('img/' . $ks->ksFile) == 'http://localhost:8000/img'))
                                <a class="btn btn-primary" href="{{ asset('img/' . $ks->ksFile) }}">Download</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            
        @endforeach
@endsection
