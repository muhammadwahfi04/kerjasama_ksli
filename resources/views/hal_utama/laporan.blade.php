@extends('layouts.master')
@section('title', 'Cetak Laporan')

<!-- Image and text -->
@section('content')

    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    </head>

    <!-- Basic Card Example -->
    <div class="card shadow mb-4 col-10">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">@lang('general.cetak_laporan')</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('perguruan.cetakpdf') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label for="ksInstansi" class="col-sm-2 col-form-label">@lang('general.instansi_kerjasama')</label>
                    <div class="col-sm-10">
                        <select class="form-control" aria-label="Default select example" id="ksInstansi" name="ksInstansi"
                            value="{{ old('ksInstansi') }}">
                            <option value="" selected>Pilih Instansi Kerja Sama</option>
                            <option value="SEMUA" {{ old('ksInstansi') == 'SEMUA' ? 'selected' : '' }}>SEMUA
                            </option>
                            <option value="INSTANSI PEMERINTAHAN"
                                {{ old('ksInstansi') == 'INSTANSI PEMERINTAHAN' ? 'selected' : '' }}>INSTANSI PEMERINTAHAN
                            </option>
                            <option value="PERGURUAN TINGGI"
                                {{ old('ksInstansi') == 'PERGURUAN TINGGI' ? 'selected' : '' }}>
                                PERGURUAN TINGGI</option>
                            <option value="PERUSAHAAN/SWASTA"
                                {{ old('ksInstansi') == 'PERUSAHAAN/SWASTA' ? 'selected' : '' }}>PERUSAHAAN/SWASTA</option>
                        </select>
                        @error('ksInstansi')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="ksJenis" class="col-sm-2 col-form-label">@lang('general.jenis_kerjasama')</label>
                    <div class="col-sm-10">
                        <select class="form-control" aria-label="Default select example" id="ksJenis" name="ksJenis"
                            value="{{ old('ksJenis') }}">
                            <option value="" selected>Pilih Jenis Kerjasama</option>
                            <option value="SEMUA" {{ old('ksJenis') == 'SEMUA' ? 'selected' : '' }}>SEMUA</option>
                            <option value="DALAM NEGERI" {{ old('ksJenis') == 'DALAM NEGERI' ? 'selected' : '' }}>DALAM
                                NEGERI</option>
                            <option value="LUAR NEGERI" {{ old('ksJenis') == 'LUAR NEGERI' ? 'selected' : '' }}>LUAR NEGERI
                            </option>
                        </select>
                        @error('ksJenis')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="ksTglKontrak" class="col-sm-2 col-form-label">@lang('general.tahun')</label>
                    <div class="col-sm-10">
                        <select class="form-control" aria-label="Default select example" id="ksTglKontrak"
                            name="ksTglKontrak" value="{{ old('ksTglKontrak') }}">
                            <option value="" selected>Pilih Tahun</option>
                            @foreach ($tahunkerjasama as $index)
                                <option value="{{ $index->date }}"
                                    {{ old('ksTglKontrak') == $index->date ? 'selected' : '' }}>
                                    {{ $index->date }}</option>
                            @endforeach
                        </select>
                        @error('ksTglKontrak')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="ksJenis" class="col-sm-2 col-form-label">@lang('general.masa_aktif')</label>
                    <div class="col-sm-10">
                        <select class="form-control" aria-label="Default select example" id="masaAktif" name="masaAktif"
                            value="{{ old('masaAktif') }}">
                            <option value="" selected>Pilih Masa Aktif</option>
                            <option value="AKTIF" {{ old('masaAktif') == 'AKTIF' ? 'selected' : '' }}>AKTIF</option>
                            <option value="TIDAK AKTIF" {{ old('masaAktif') == 'TIDAK AKTIF' ? 'selected' : '' }}>TIDAK AKTIF
                            </option>
                        </select>
                        @error('masaAktif')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="unitPihakdetail" class="col-sm-2 col-form-label">@lang('general.unit_kerjasama')</label>
                    <div class="col-sm-10">
                        <select class="form-control" aria-label="Default select example" id="unitPihakdetail" name="unitPihakdetail"
                            value="{{ old('unitPihakdetail') }}">
                            <option value="" selected>Pilih Unit Kerjasama</option>
                            <option value="p101" {{ old('unitPihakdetail') == 'p201' ? 'selected' : '' }}>UNIB</option>
                            <option value="p201" {{ old('unitPihakdetail') == 'p201' ? 'selected' : '' }}>FKIP</option>
                            <option value="p202" {{ old('unitPihakdetail') == 'p202' ? 'selected' : '' }}>FH</option>
                            <option value="p203" {{ old('unitPihakdetail') == 'p203' ? 'selected' : '' }}>FaPerta</option>
                            <option value="p204" {{ old('unitPihakdetail') == 'p204' ? 'selected' : '' }}>FEB</option>
                            <option value="p205" {{ old('unitPihakdetail') == 'p205' ? 'selected' : '' }}>FISIP</option>
                            <option value="p206" {{ old('unitPihakdetail') == 'p206' ? 'selected' : '' }}>FMIPA</option>
                            <option value="p207" {{ old('unitPihakdetail') == 'p207' ? 'selected' : '' }}>FT</option>
                            <option value="p208" {{ old('unitPihakdetail') == 'p208' ? 'selected' : '' }}>Fked</option>
                            <option value="p301" {{ old('unitPihakdetail') == 'p301' ? 'selected' : '' }}>UPT Perpustakaan</option>
                            <option value="p302" {{ old('unitPihakdetail') == 'p302' ? 'selected' : '' }}>UPT PKM</option>
                            <option value="p303" {{ old('unitPihakdetail') == 'p303' ? 'selected' : '' }}>UPT Kearsipan</option>
                            <option value="p304" {{ old('unitPihakdetail') == 'p304' ? 'selected' : '' }}>UPT KSLI</option>
                            <option value="p305" {{ old('unitPihakdetail') == 'p305' ? 'selected' : '' }}>UPT Bahasa</option>
                            <option value="p401" {{ old('unitPihakdetail') == 'p401' ? 'selected' : '' }}>Biro PPK</option>
                            <option value="p402" {{ old('unitPihakdetail') == 'p402' ? 'selected' : '' }}>Biro USD</option>
                            <option value="p403" {{ old('unitPihakdetail') == 'p403' ? 'selected' : '' }}>LPPM</option>
                            <option value="p404" {{ old('unitPihakdetail') == 'p404' ? 'selected' : '' }}>LPTIK</option>
                            <option value="p405" {{ old('unitPihakdetail') == 'p405' ? 'selected' : '' }}>LPMPP</option>
                            
                        </select>
                        @error('unitPihakdetail')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            
                <div class="form-group row text-right mt-3">
                    <div class="col-12">
                        <button type="submit" name="cetak_excel" value="cetak_excel" class="btn btn-success mr-2">@lang('general.cetak_excel')<i class="fas fa-file-excel ml-2"></i></button>
                        <button type="submit" name="cetak_pdf" value="cetak_pdf" class="btn btn-danger">@lang('general.cetak_pdf')<i class="fas fa-file-pdf ml-2"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    </div>


    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <!--chart-->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    </body>

    </html>

    
@endsection
