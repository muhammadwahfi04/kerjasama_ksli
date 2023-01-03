@extends('layouts.master')
@section('title', 'Kategori Kerjasama')

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
    <div class="card shadow mb-4 col-9">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">@lang('general.kategori_kerjasama')</h6>
        </div>
        <div class="card-body">
            {{-- @forelse ($kerjasama as $ks) --}}

                <!-- Collapsable Card Example -->
                <div class="card mb-1">
                    <!-- Card Header - Accordion -->
                    <a href="#asia" class="d-block card-header py-3" data-toggle="collapse"
                        role="button" aria-expanded="true" aria-controls="collapseCardExample">
                        <h6 class="m-0 font-weight-bold text-dark">Asia</h6>
                    </a>
                    <!-- Card Content - Collapse -->
                    <div class="collapse" id="asia">
                        <div class="card-body">
                            @forelse ($asia as $as)
                            <a href="{{ route('kerjasamaunib.detailKategori', $as->ksNegara) }}">{{ $as->ksNegara }}<br></a>
                            @empty
                            @lang('general.belum_ada_data_kerjasama_benua_asia')
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Collapsable Card Example -->
                <div class="card mb-1">
                    <!-- Card Header - Accordion -->
                    <a href="#afrika" class="d-block card-header py-3" data-toggle="collapse"
                        role="button" aria-expanded="true" aria-controls="collapseCardExample">
                        <h6 class="m-0 font-weight-bold text-dark">Afrika</h6>
                    </a>
                    <!-- Card Content - Collapse -->
                    <div class="collapse" id="afrika">
                        <div class="card-body">
                            @forelse ($afrika as $af)
                            <a href="{{ route('kerjasamaunib.detailKategori', $af->ksNegara) }}">{{ $af->ksNegara }}<br></a>
                            @empty
                            @lang('general.belum_ada_data_kerjasama_benua_afrika')
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Collapsable Card Example -->
                <div class="card mb-1">
                    <!-- Card Header - Accordion -->
                    <a href="#amerika_utara" class="d-block card-header py-3" data-toggle="collapse"
                        role="button" aria-expanded="true" aria-controls="collapseCardExample">
                        <h6 class="m-0 font-weight-bold text-dark">Amerika Utara</h6>
                    </a>
                    <!-- Card Content - Collapse -->
                    <div class="collapse" id="amerika_utara">
                        <div class="card-body">
                                @forelse ($amerika_utara as $amut)
                                    <a href="{{ route('kerjasamaunib.detailKategori', $amut->ksNegara) }}">{{ $amut->ksNegara }}<br></a>
                                @empty
                                @lang('general.belum_ada_data_kerjasama_benua_amerika_utara')
                                @endforelse
                        </div>
                    </div>
                </div>

                <div class="card mb-1">
                    <!-- Card Header - Accordion -->
                    <a href="#amerika_selatan" class="d-block card-header py-3" data-toggle="collapse"
                        role="button" aria-expanded="true" aria-controls="collapseCardExample">
                        <h6 class="m-0 font-weight-bold text-dark">Amerika Selatan</h6>
                    </a>
                    <!-- Card Content - Collapse -->
                    <div class="collapse" id="amerika_selatan">
                        <div class="card-body">
                            @forelse ($amerika_selatan as $asel)
                                <a href="{{ route('kerjasamaunib.detailKategori', $asel->ksNegara) }}">{{ $asel->ksNegara }}<br></a>
                            @empty
                            @lang('general.belum_ada_data_kerjasama_benua_amerika_selatan')
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="card mb-1">
                    <!-- Card Header - Accordion -->
                    <a href="#antartika" class="d-block card-header py-3" data-toggle="collapse"
                        role="button" aria-expanded="true" aria-controls="collapseCardExample">
                        <h6 class="m-0 font-weight-bold text-dark">Antartika</h6>
                    </a>
                    <!-- Card Content - Collapse -->
                    <div class="collapse" id="antartika">
                        <div class="card-body">
                            @forelse ($antartika as $at)
                                <a href="{{ route('kerjasamaunib.detailKategori', $at->ksNegara) }}">{{ $at->ksNegara }}<br></a>
                            @empty
                            @lang('general.belum_ada_data_kerjasama_benua_antartika')
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="card mb-1">
                    <!-- Card Header - Accordion -->
                    <a href="#eropa" class="d-block card-header py-3" data-toggle="collapse"
                        role="button" aria-expanded="true" aria-controls="collapseCardExample">
                        <h6 class="m-0 font-weight-bold text-dark">Eropa</h6>
                    </a>
                    <!-- Card Content - Collapse -->
                    <div class="collapse" id="eropa">
                        <div class="card-body">
                            @forelse ($eropa as $er)
                            <a href="{{ route('kerjasamaunib.detailKategori', $er->ksNegara) }}">{{ $er->ksNegara }}<br></a>
                            @empty
                            @lang('general.belum_ada_data_kerjasama_benua_eropa')
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="card mb-1">
                    <!-- Card Header - Accordion -->
                    <a href="#australia" class="d-block card-header py-3" data-toggle="collapse"
                        role="button" aria-expanded="true" aria-controls="collapseCardExample">
                        <h6 class="m-0 font-weight-bold text-dark">Australia</h6>
                    </a>
                    <!-- Card Content - Collapse -->
                    <div class="collapse" id="australia">
                        <div class="card-body">
                            @forelse ($australia as $aus)
                            <a href="{{ route('kerjasamaunib.detailKategori', $aus->ksNegara) }}">{{ $amut->ksNegara }}<br></a>
                            @empty
                            @lang('general.belum_ada_data_kerjasama_benua_australia')
                            @endforelse
                        </div>
                    </div>
                </div>

            </div>
            {{-- @empty
                
            @endforelse --}}
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