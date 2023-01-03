@extends('layouts.master')
@section('title', 'Admin | Edit Data Instansi Pemerintahan')

@section('content')

    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">@lang('general.edit_data_kerjasama_perguruan_tinggi')</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">@lang('general.edit_data_kerjasama_perguruan_tinggi')</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('perguruan.update_proses', $kerjasama->ksId) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="ksInstansi" class="col-sm-2 col-form-label">@lang('general.instansi_kerjasama')</label>
                        <div class="col-sm-10">
                            <select class="form-control" aria-label="Default select example" id="ksInstansi"
                                name="ksInstansi" value="{{ old('ksInstansi') ?? $kerjasama->ksInstansi }}">
                                {{-- <option value="INSTANSI PEMERINTAHAN"
                                    {{ (old('ksInstansi') ?? $kerjasama->ksInstansi) == 'INSTANSI PEMERINTAHAN' ? 'selected' : '' }}>
                                    INSTANSI PEMERINTAHAN</option> --}}
                                <option value="PERGURUAN TINGGI"
                                    {{ (old('ksInstansi') ?? $kerjasama->ksInstansi) == 'PERGURUAN TINGGI' ? 'selected' : '' }}>
                                    PERGURUAN TINGGI</option>
                                {{-- <option value="PERUSAHAAN/SWASTA"
                                    {{ (old('ksInstansi') ?? $kerjasama->ksInstansi) == 'PERUSAHAAN/SWASTA' ? 'selected' : '' }}>
                                    PERUSAHAAN/SWASTA</option> --}}
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
                                value="{{ old('ksJenis') ?? $kerjasama->ksJenis }}">
                                <option value="LOKAL"
                                    {{ (old('ksJenis') ?? $kerjasama->ksJenis) == 'LOKAL' ? 'selected' : '' }}>LOKAL
                                </option>
                                <option value="DALAM NEGERI"
                                    {{ (old('ksJenis') ?? $kerjasama->ksJenis) == 'DALAM NEGERI' ? 'selected' : '' }}>DALAM NEGERI
                                </option>
                                <option value="LUAR NEGERI"
                                    {{ (old('ksJenis') ?? $kerjasama->ksJenis) == 'LUAR NEGERI' ? 'selected' : '' }}>
                                    LUAR NEGERI</option>
                            </select>
                            @error('ksJenis')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="ksNama" class="col-sm-2 col-form-label">@lang('general.nama_instansi_kerjasama')</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="ksNama" name="ksNama"
                                placeholder="Tuliskan Nama Instansi Kerjasama"
                                value="{{ old('ksNama') ?? $kerjasama->ksNama }}">
                            @error('ksNama')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="ksKota" class="col-sm-2 col-form-label">@lang('general.nama_kota')</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="ksKota" name="ksKota"
                                placeholder="Tuliskan Nama Kota" value="{{ old('ksKota') ?? $kerjasama->ksKota }}">
                            @error('ksKota')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="ksNegara" class="col-sm-2 col-form-label">@lang('general.nama_negara')</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="ksNegara" placeholder="Nama Negara"
                                name="ksNegara" value="{{ old('ksNegara') ?? $kerjasama->ksNegara }}">
                            @error('ksNegara')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="ksJenis" class="col-sm-2 col-form-label">@lang('general.nama_benua')</label>
                        <div class="col-sm-10">
                            <select class="form-control" aria-label="Default select example" id="ksBenua" name="ksBenua"
                                value="{{ old('ksBenua') ?? $kerjasama->ksBenua }}">

                                <option value="Asia"
                                    {{ (old('ksBenua') ?? $kerjasama->ksBenua) == 'Asia' ? 'selected' : '' }}>
                                    Asia</option>
                                <option value="Afrika"
                                    {{ (old('ksBenua') ?? $kerjasama->ksBenua) == 'Afrika' ? 'selected' : '' }}>Afrika
                                </option>
                                <option value="Amerika Utara"
                                    {{ (old('ksBenua') ?? $kerjasama->ksBenua) == 'Amerika Utara' ? 'selected' : '' }}>
                                    Amerika
                                    utara</option>
                                <option value="Amerika Selatan"
                                    {{ (old('ksBenua') ?? $kerjasama->ksBenua) == 'Amerika Selatan' ? 'selected' : '' }}>
                                    Amerika
                                    Selatan</option>
                                <option value="Antartika"
                                    {{ (old('ksBenua') ?? $kerjasama->ksBenua) == 'Antartika' ? 'selected' : '' }}>
                                    Antartika
                                </option>
                                <option value="Eropa"
                                    {{ (old('ksBenua') ?? $kerjasama->ksBenua) == 'Eropa' ? 'selected' : '' }}>Eropa
                                </option>
                                <option value="Australia"
                                    {{ (old('ksBenua') ?? $kerjasama->ksBenua) == 'Australia' ? 'selected' : '' }}>
                                    Australia
                                </option>
                            </select>
                            @error('ksBenua')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="ksNoKS" class="col-sm-2 col-form-label">@lang('general.nomor_kerjasama')</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="ksNoKS" name="ksNoKS"
                                placeholder="Tuliskan Nomor Kerja Sama" value="{{ old('ksNoKS') ?? $kerjasama->ksNoKS }}">
                            @error('ksNoKS')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="ksTglKontrak" class="col-sm-2 col-form-label">@lang('general.tanggal_mulai')</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control col-sm-3" id="ksTglKontrak" name="ksTglKontrak"
                                value="{{ old('ksTglKontrak') ?? $kerjasama->ksTglKontrak }}">
                            @error('ksTglKontrak')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="ksTglAkhir" class="col-sm-2 col-form-label">@lang('general.tanggal_akhir')</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control col-sm-3" id="ksTglAkhir" name="ksTglAkhir"
                                value="{{ old('ksTglAkhir') ?? $kerjasama->ksTglAkhir }}">
                            @error('ksTglAkhir')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="ksJangka" class="col-sm-2 col-form-label">@lang('general.jangka_waktu')</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="ksJangka" name="ksJangka"
                                placeholder="Tuliskan Jangka Waktu"
                                value="{{ old('ksJangka') ?? $kerjasama->ksJangka }}">
                            @error('ksJangka')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="ksIsiKS" class="col-sm-2 col-form-label">@lang('general.isi_kerjasama')</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="ksIsiKS" name="ksIsiKS" rows="5" >{{ old('ksIsiKS') ?? $kerjasama->ksIsiKS }}</textarea>
                            @error('ksIsiKS')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="ksKet" class="col-sm-2 col-form-label">@lang('general.keterangan')</label>
                        <div class="col-sm-10">
                            <select class="form-control" aria-label="Default select example" id="ksKet"
                                name="ksKet" value="{{ old('ksKet', $kerjasama->ksKet) }}">
                                <option selected>Tidak Ada</option>
                                <option value="MoU"
                                    {{ (old('ksKet') ?? $kerjasama->ksKet) == 'MoU' ? 'selected' : '' }}>
                                    MoU
                                </option>
                                <option value="PKS"
                                    {{ (old('ksKet') ?? $kerjasama->ksKet) == 'PKS' ? 'selected' : '' }}>
                                    PKS
                                </option>
                                <option value="Lol"
                                    {{ (old('ksKet') ?? $kerjasama->ksKet) == 'Lol' ? 'selected' : '' }}>
                                    Lol
                                </option>
                                <option value="CoC"
                                    {{ (old('ksKet') ?? $kerjasama->ksKet) == 'CoC' ? 'selected' : '' }}>
                                    CoC
                                </option>
                                <option value="IA"
                                    {{ (old('ksKet') ?? $kerjasama->ksKet) == 'IA' ? 'selected' : '' }}>IA
                                </option>
                                @error('ksKet')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="ksFile" class="col-sm-2 col-form-label">@lang('general.kerjasama_file')</label>
                        <div class="col-sm-5 custom-file">
                            <input type="file" class="form-input" id="ksFile" name="ksFile"
                                value="{{ old('ksFile') ?? $kerjasama->ksFile }}">
                            {{ $kerjasama->ksFile }}
                            @error('ksFile')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="unitPihakdetail" class="col-sm-2 col-form-label">@lang('general.unit_yang_terlibat')</label>
                        <div class="col-sm-2">
                            {{-- update --}}
                            @php
                            $ambil = [];
                            $cek = [];
                            @endphp

                            @foreach ($kerjasama->tbUnits as $item)
                                @php
                                    if (!(is_null($item->unitPihakdetail))) {
                                        $ambil[] = $pihakdetail->where('pdId', $item->unitPihakdetail)->first();
                                    }   
                                @endphp
                            @endforeach
                            @if (!(is_null($ambil)))
                            @foreach ($ambil as $index)
                                @php
                                    $cek[] = $index->pdId;
                                @endphp
                            @endforeach
                            @php
                                $cek = implode(',', $cek);
                                
                                $cek = explode(',', $cek);
                                // dd($cek);
                            @endphp
                            @endif
                            <select id='unitPihakdetail' name="unitPihakdetail[]" multiple='multiple'>


                                <option value="p101" <?php in_array('p101', $cek) ? print 'selected' : ''; ?>
                                    {{ collect(old('unitPihakdetail', $cek))->contains('p101') ? 'selected' : '' }}>
                                    UNIB</option>

                                <optgroup label='Fakultas'>
                                    <option value="p201" <?php in_array('p201', $cek) ? print 'selected' : ''; ?>
                                        {{ collect(old('unitPihakdetail', $cek))->contains('p201') ? 'selected' : '' }}>
                                        FKIP</option>
                                    <option value="p202" <?php in_array('p202', $cek) ? print 'selected' : ''; ?>
                                        {{ collect(old('unitPihakdetail', $cek))->contains('p202') ? 'selected' : '' }}>
                                        FH</option>
                                    <option value="p203" <?php in_array('p203', $cek) ? print 'selected' : ''; ?>
                                        {{ collect(old('unitPihakdetail', $cek))->contains('p203') ? 'selected' : '' }}>
                                        FaPerta</option>
                                    <option value="p204" <?php in_array('p204', $cek) ? print 'selected' : ''; ?>
                                        {{ collect(old('unitPihakdetail', $cek))->contains('p204') ? 'selected' : '' }}>
                                        FEB</option>
                                    <option value="p205" <?php in_array('p205', $cek) ? print 'selected' : ''; ?>
                                        {{ collect(old('unitPihakdetail', $cek))->contains('p205') ? 'selected' : '' }}>
                                        FISIP</option>
                                    <option value="p206" <?php in_array('p206', $cek) ? print 'selected' : ''; ?>
                                        {{ collect(old('unitPihakdetail', $cek))->contains('p206') ? 'selected' : '' }}>
                                        FMIPA</option>
                                    <option value="p207" <?php in_array('p207', $cek) ? print 'selected' : ''; ?>
                                        {{ collect(old('unitPihakdetail', $cek))->contains('p207') ? 'selected' : '' }}>
                                        FT</option>
                                    <option value="p208" <?php in_array('p208', $cek) ? print 'selected' : ''; ?>
                                        {{ collect(old('unitPihakdetail', $cek))->contains('p208') ? 'selected' : '' }}>
                                        FKed</option>
                                </optgroup>

                                <optgroup label='UPT'>

                                    <option value="p301" <?php in_array('p301', $cek) ? print 'selected' : ''; ?>
                                        {{ collect(old('unitPihakdetail', $cek))->contains('p301') ? 'selected' : '' }}>
                                        UPT Perpustakaan</option>
                                    <option value="p302" <?php in_array('p302', $cek) ? print 'selected' : ''; ?>
                                        {{ collect(old('unitPihakdetail', $cek))->contains('p302') ? 'selected' : '' }}>
                                        UPT PKM</option>
                                    <option value="p303" <?php in_array('p303', $cek) ? print 'selected' : ''; ?>
                                        {{ collect(old('unitPihakdetail', $cek))->contains('p303') ? 'selected' : '' }}>
                                        UPT Kearsipan</option>
                                    <option value="p304" <?php in_array('p304', $cek) ? print 'selected' : ''; ?>
                                        {{ collect(old('unitPihakdetail', $cek))->contains('p304') ? 'selected' : '' }}>
                                        UPT KSLI</option>
                                    <option value="p305" <?php in_array('p305', $cek) ? print 'selected' : ''; ?>
                                        {{ collect(old('unitPihakdetail', $cek))->contains('p305') ? 'selected' : '' }}>
                                        UPT Bahasa</option>
                                </optgroup>

                                <optgroup label='Lembaga'>
                                    <option value="p401" <?php in_array('p401', $cek) ? print 'selected' : ''; ?>
                                        {{ collect(old('unitPihakdetail', $cek))->contains('p401') ? 'selected' : '' }}>
                                        Biro PPK</option>
                                    <option value="p402" <?php in_array('p402', $cek) ? print 'selected' : ''; ?>
                                        {{ collect(old('unitPihakdetail', $cek))->contains('p402') ? 'selected' : '' }}>
                                        Biro USD</option>
                                    <option value="p403" <?php in_array('p403', $cek) ? print 'selected' : ''; ?>
                                        {{ collect(old('unitPihakdetail', $cek))->contains('p403') ? 'selected' : '' }}>
                                        LPPM</option>
                                    <option value="p404" <?php in_array('p404', $cek) ? print 'selected' : ''; ?>
                                        {{ collect(old('unitPihakdetail', $cek))->contains('p404') ? 'selected' : '' }}>
                                        LPTIK</option>
                                    <option value="p405" <?php in_array('p405', $cek) ? print 'selected' : ''; ?>
                                        {{ collect(old('unitPihakdetail', $cek))->contains('p405') ? 'selected' : '' }}>
                                        LPMPP</option>
                                </optgroup>

                            </select>
                            @error('ksUnit')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
                                crossorigin="anonymous"></script>
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/multi-select/0.9.12/js/jquery.multi-select.min.js"
                                type="text/javascript"></script>
                        </div>
                    </div>
                    <div class="form-group row text-right mt-3">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Edit Data</button>
                        </div>
                    </div>
                </form>

                @foreach ($kerjasama->tbUnits as $item)
                @endforeach

            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(function() {
            $(".datepicker").datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true,
            });
        });
        $('#unitPihakdetail').multiSelect({
            selectableOptgroup: true
        });
    </script>

@endsection
