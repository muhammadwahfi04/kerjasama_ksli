@extends('layouts.master')
@section('title', 'Admin | Tambah Data Instansi Pemerintahan')

<!-- Image and text -->
@section('content')
    
    <div class="container-fluid mt-4">
        <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">@lang('general.form_tambah_data_instansi_pemerintahan')</h6>
                </div>
            <div class="card-body">
        <form action=" {{ route('pemerintahan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
            <label for="ksInstansi" class="col-sm-2 col-form-label">@lang('general.instansi_kerjasama')</label>
            <div class="col-sm-10">
                <select class="form-control" aria-label="Default select example" id="ksInstansi" name="ksInstansi" value="{{ old('ksInstansi') }}" >
                    <option value="INSTANSI PEMERINTAHAN" {{ old('ksInstansi')=='INSTANSI PEMERINTAHAN' ? 'selected': '' }}>INSTANSI PEMERINTAHAN</option>
                    {{-- <option value="PERGURUAN TINGGI" {{ old('ksInstansi')=='PERGURUAN TINGGI' ? 'selected': '' }}>PERGURUAN TINGGI</option>
                    <option value="PERUSAHAAN/SWASTA" {{ old('ksInstansi')=='PERUSAHAAN/SWASTA' ? 'selected': '' }}>PERUSAHAAN/SWASTA</option> --}}
                </select>
            @error('ksInstansi')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            </div>
            </div>

            <div class="form-group row">
                <label for="ksJenis" class="col-sm-2 col-form-label">@lang('general.jenis_kerjasama')</label>
                <div class="col-sm-10">
            <select class="form-control" aria-label="Default select example" id="ksJenis" name="ksJenis" value="{{ old('ksJenis') }}">
        
                <option value="LOKAL" {{ old('ksJenis')=='LOKAL' ? 'selected': '' }}>LOKAL</option>
                <option value="DALAM NEGERI" {{ old('ksJenis')=='DALAM NEGERI' ? 'selected': '' }}>DALAM NEGERI</option>
                <option value="LUAR NEGERI" {{ old('ksJenis')=='LUAR NEGERI' ? 'selected': '' }}>LUAR NEGERI</option>
            </select>
            @error('ksJenis')
            <div class="text-danger">{{ $message }}</div>
            @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="ksNama" class="col-sm-2 col-form-label">@lang('general.nama_instansi_kerjasama')</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="ksNama" name="ksNama" placeholder="Tuliskan Nama Instansi Kerjasama" value="{{ old('ksNama') }}">
                    @error('ksNama')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="ksKota" class="col-sm-2 col-form-label">@lang('general.nama_kota')</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="ksKota" name="ksKota" placeholder="Tuliskan Nama Kota" value="{{ old('ksKota') }}">
                    @error('ksKota')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="ksNegara" class="col-sm-2 col-form-label">@lang('general.nama_negara')</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="ksNegara" placeholder="Nama Negara" name="ksNegara" value="{{ old('ksNegara') }}">
                    @error('ksNegara')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="form-group row">
                <label for="ksJenis" class="col-sm-2 col-form-label">@lang('general.nama_benua')</label>
                <div class="col-sm-10">
            <select class="form-control" aria-label="Default select example" id="ksBenua" name="ksBenua" value="{{ old('ksBenua') }}">
        
                <option value="Asia" {{ old('ksBenua')=='Asia' ? 'selected': '' }}>Asia</option>
                <option value="Afrika" {{ old('ksBenua')=='Afrika' ? 'selected': '' }}>Afrika</option>
                <option value="Amerika Utara" {{ old('ksBenua')=='Amerika Utara' ? 'selected': '' }}>Amerika utara</option>
                <option value="Amerika Selatan" {{ old('ksBenua')=='Amerika Selatan' ? 'selected': '' }}>Amerika Selatan</option>
                <option value="Antartika" {{ old('ksBenua')=='Antartika' ? 'selected': '' }}>Antartika</option>
                <option value="Eropa" {{ old('ksBenua')=='Eropa' ? 'selected': '' }}>Eropa</option>
                <option value="Australia" {{ old('ksBenua')=='Australia' ? 'selected': '' }}>Australia</option>
            </select>
            @error('ksBenua')
            <div class="text-danger">{{ $message }}</div>
            @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="ksNoKS" class="col-sm-2 col-form-label">@lang('general.nomor_kerjasama')</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="ksNoKS" name="ksNoKS" placeholder="Tuliskan Nomor Kerja Sama" value="{{ old('ksNoKS') }}">
                    @error('ksNoKS')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="ksTglKontrak" class="col-sm-2 col-form-label">@lang('general.tanggal_mulai')</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control col-sm-3" id="ksTglKontrak" name="ksTglKontrak" value="{{ old('ksTglKontrak') }}" >
                    @error('ksTglKontrak')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="ksTglAkhir" class="col-sm-2 col-form-label">@lang('general.tanggal_akhir')</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control col-sm-3" id="ksTglAkhir" name="ksTglAkhir" value="{{ old('ksTglAkhir') }}">
                    @error('ksTglAkhir')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="ksJangka" class="col-sm-2 col-form-label">@lang('general.jangka_waktu')</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="ksJangka" name="ksJangka" placeholder="Tuliskan Jangka Waktu" value="{{ old('ksJangka') }}">
                    @error('ksJangka')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                </div>

                
            <div class="form-group row">
                <label for="ksIsiKS" class="col-sm-2 col-form-label">@lang('general.isi_kerjasama')</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="ksIsiKS" placeholder="Tuliskan Isi Kerjasama" rows="5" name="ksIsiKS" value="{{ old('ksIsiKS') }}"></textarea>
                    @error('ksIsiKS')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="ksKet" class="col-sm-2 col-form-label">@lang('general.keterangan')</label>
                <div class="col-sm-10">
            <select class="form-control" aria-label="Default select example" id="ksKet" name="ksKet" value="{{ old('ksKet') }}">
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
                <label for="ksFile" class="col-sm-2 col-form-label">@lang('general.kerjasama_file')</label>
                <div class="col-sm-5 custom-file">
                    <input type="file" class="form-input" id="ksFile" name="ksFile" value="{{ old('ksFile') }}"> 
                    @error('ksFile')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="unitPihakdetail" class="col-sm-2 col-form-label">@lang('general.unit_yang_terlibat')</label>
                <div class="col-sm-2">
                    <select id='unitPihakdetail' name="unitPihakdetail[]" multiple='multiple'>
                        
                        <option value="p101" {{ (collect(old('unitPihakdetail'))->contains('p101')) ? 'selected':'' }}>UNIB</option>

                    <optgroup label='Fakultas'>
                        <option value="p201" {{ (collect(old('unitPihakdetail'))->contains('p201')) ? 'selected':'' }}>FKIP</option>
                        <option value="p202" {{ (collect(old('unitPihakdetail'))->contains('p202')) ? 'selected':'' }}>FH</option>
                        <option value="p203" {{ (collect(old('unitPihakdetail'))->contains('p203')) ? 'selected':'' }}>FaPerta</option>
                        <option value="p204" {{ (collect(old('unitPihakdetail'))->contains('p204')) ? 'selected':'' }}>FEB</option>
                        <option value="p205" {{ (collect(old('unitPihakdetail'))->contains('p205')) ? 'selected':'' }}>FISIP</option>
                        <option value="p206" {{ (collect(old('unitPihakdetail'))->contains('p206')) ? 'selected':'' }}>FMIPA</option>
                        <option value="p207" {{ (collect(old('unitPihakdetail'))->contains('p207')) ? 'selected':'' }}>FT</option>
                        <option value="p208" {{ (collect(old('unitPihakdetail'))->contains('p208')) ? 'selected':'' }}>FKed</option>
                    </optgroup>

                    <optgroup label='UPT'>
                        <option value="p301" {{ (collect(old('unitPihakdetail'))->contains('p301')) ? 'selected':'' }}>UPT Perpustakaan</option>
                        <option value="p302" {{ (collect(old('unitPihakdetail'))->contains('p302')) ? 'selected':'' }}>UPT PKM</option>
                        <option value="p303" {{ (collect(old('unitPihakdetail'))->contains('p303')) ? 'selected':'' }}>UPT Kearsipan</option>
                        <option value="p304" {{ (collect(old('unitPihakdetail'))->contains('p304')) ? 'selected':'' }}>UPT KSLI</option>
                        <option value="p305" {{ (collect(old('unitPihakdetail'))->contains('p305')) ? 'selected':'' }}>UPT Bahasa</option>
                    </optgroup>
                    
                    <optgroup label='Lembaga'>
                        <option value="p401" {{ (collect(old('unitPihakdetail'))->contains('p401')) ? 'selected':'' }}>Biro PPK</option>
                        <option value="p402" {{ (collect(old('unitPihakdetail'))->contains('p402')) ? 'selected':'' }}>Biro USD</option>
                        <option value="p403" {{ (collect(old('unitPihakdetail'))->contains('p403')) ? 'selected':'' }}>LPPM</option>
                        <option value="p404" {{ (collect(old('unitPihakdetail'))->contains('p404')) ? 'selected':'' }}>LPTIK</option>
                        <option value="p405" {{ (collect(old('unitPihakdetail'))->contains('p405')) ? 'selected':'' }}>LPMPP</option>
                    </optgroup>
                    </select>
                    @error('unitPihakdetail')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/multi-select/0.9.12/js/jquery.multi-select.min.js" type="text/javascript"></script>
                </div>
            </div>
            <div class="form-group row text-right mt-3">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">@lang('general.tambah_data')</button>
                </div>
                </div>
        </form>
            </div>
            </body>
        </div>
    </div>
</div>

<script type="text/javascript">
        $(function(){
        $(".datepicker").datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true,
        });
});
        $('#unitPihakdetail').multiSelect({ selectableOptgroup: true });  
        
    </script>

@endsection
