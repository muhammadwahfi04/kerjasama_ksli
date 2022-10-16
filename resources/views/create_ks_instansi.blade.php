@extends('layouts.beranda')
@section('title', 'Admin Beranda')

<!-- Image and text -->
@section('content')
    

    {{-- <nav class="navbar navbar-light bg-primary">
        <a class="navbar-brand" href="#">
        <img src="/docs/4.0/assets/brand/bootstrap-solid.svg" width="30" height="30" class="d-inline-block align-top" alt="">
        Bootstrap
        </a>
    </nav> --}}


    {{-- 'PERGURUAN TINGGI','INSTANSI PEMERINTAHAN','PERUSAHAAN/SWASTA' --}}
    <div class="container-fluid mt-4">
        <h1 class="h3 text-gray-800 mb-4">Form Tambah Data Instansi Pemerintahan</h1>
        <form action=" {{ route('ks_instansi.store') }}" method="POST">
            @csrf
            <div class="form-group row">
            <label for="ksInstansi" class="col-sm-2 col-form-label">Instansi Kerjasama</label>
            <div class="col-sm-10">
                <select class="form-select form-select-lg mb-3" aria-label="Default select example" id="ksInstansi" name="ksInstansi" value="{{ old('ksInstansi') }}">
        
                    <option value="INSTANSI PEMERINTAHAN" {{ old('ksInstansi')=='INSTANSI PEMERINTAHAN' ? 'selected': '' }}>INSTANSI PEMERINTAHAN</option>
                    <option value="PERGURUAN TINGGI" {{ old('ksInstansi')=='PERGURUAN TINGGI' ? 'selected': '' }}>PERGURUAN TINGGI</option>
                    <option value="PERUSAHAAN/SWASTA" {{ old('ksInstansi')=='PERUSAHAAN/SWASTA' ? 'selected': '' }}>PERUSAHAAN/SWASTA</option>
                </select>
            @error('ksInstansi')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            </div>
            </div>

            <div class="form-group row">
                <label for="ksJenis" class="col-sm-2 col-form-label">Jenis Kerjasama</label>
                <div class="col-sm-10">
            <select class="form-select form-select-lg mb-3" aria-label="Default select example" id="ksJenis" name="ksJenis" value="{{ old('ksJenis') }}">
        
                <option value="LOKAL" {{ old('ksJenis')=='LOKAL' ? 'selected': '' }}>LOKAL</option>
                <option value="DALAM" {{ old('ksJenis')=='DALAM' ? 'selected': '' }}>DALAM NEGERI</option>
                <option value="LUAR" {{ old('ksJenis')=='LUAR' ? 'selected': '' }}>LUAR NEGERI</option>
            </select>
            @error('ksJenis')
            <div class="text-danger">{{ $message }}</div>
            @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="ksNama" class="col-sm-2 col-form-label">Nama Instansi Kerjasama</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="ksNama" name="ksNama" placeholder="Tuliskan Nama Instansi Kerjasama" value="{{ old('ksNama') }}">
                    @error('ksNama')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="ksKota" class="col-sm-2 col-form-label">Nama Kota</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="ksKota" name="ksKota" placeholder="Tuliskan Nama Kota" value="{{ old('ksKota') }}">
                    @error('ksKota')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="ksNegara" class="col-sm-2 col-form-label">Nama Negara</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="ksNegara" placeholder="Nama Negara" name="ksNegara" value="{{ old('ksNegara') }}">
                    @error('ksNegara')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="ksNoKS" class="col-sm-2 col-form-label">Nomor Kerjasama</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="ksNoKS" name="ksNoKS" placeholder="Tuliskan Nomor Kerja Sama" value="{{ old('ksNoKS') }}">
                    @error('ksNoKS')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="ksTglKontrak" class="col-sm-2 col-form-label">Tanggal Mulai</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control col-sm-3" id="ksTglKontrak" name="ksTglKontrak" value="{{ old('ksTglKontrak') }}" >
                    @error('ksTglKontrak')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="ksTglAkhir" class="col-sm-2 col-form-label">Tanggal Berakhir</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control col-sm-3" id="ksTglAkhir" name="ksTglAkhir" value="{{ old('ksTglAkhir') }}">
                    @error('ksTglAkhir')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="ksJangka" class="col-sm-2 col-form-label">Jangka Waktu</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="ksJangka" name="ksJangka" placeholder="Tuliskan Jangka Waktu" value="{{ old('ksJangka') }}">
                    @error('ksJangka')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                </div>

                
            <div class="form-group row">
                <label for="ksIsiKS" class="col-sm-2 col-form-label">Isi Kerja Sama</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="ksIsiKS" name="ksIsiKS" value="{{ old('ksIsiKS') }}">
                    @error('ksIsiKS')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="ksKet" class="col-sm-2 col-form-label">Keterangan</label>
                <div class="col-sm-10">
            <select class="form-select form-select-lg mb-3" aria-label="Default select example" id="ksKet" name="ksKet" value="{{ old('ksKet') }}">
                <option selected>Tidak Ada</option>
                <option value="MoU" {{ old('ksKet')=='MoU' ? 'selected': '' }}>MoU</option>
                <option value="PKS" {{ old('ksKet')=='PKS' ? 'selected': '' }}>PKS</option>
                <option value="Lol" {{ old('ksKet')=='Lol' ? 'selected': '' }}>Lol</option>
                <option value="CoC" {{ old('ksKet')=='CoC' ? 'selected': '' }}>CoC</option>
                <option value="IA" {{ old('ksKet')=='IA' ? 'selected': '' }}>IA</option>
                @error('ksKet')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="ksFile" class="col-sm-2 col-form-label">Kerja sama File</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="ksFile" name="ksFile" value="{{ old('ksFile') }}">
                    @error('ksFile')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            
            <div class="form-group row text-right mt-3">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Tambah Data</button>
                </div>
                </div>
        </form>
            </div>

</body>

</div>

<script type="text/javascript">
        $(function(){
        $(".datepicker").datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true,
        });
        });
    </script>
@endsection