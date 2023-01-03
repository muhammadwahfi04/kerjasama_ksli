@extends('layouts.master')
@section('title', 'Aktivitas Log')

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
            <h6 class="m-0 font-weight-bold text-primary">Aktivitas Log</h6>
        </div>
        <div class="card-body ">

            <div class="table-responsive">
                <table class="table table-borderless table-striped font-size-sm">
                    <tbody>
                    @forelse ($activity_log as $item)
                        <tr>
                            <td class="font-w600 text-center" style="width: 100px">
                                <span class="badge badge-success">{{ $item->user->name }}</span>
                            </td>
                            <td>
                                <span class="">{{ $item->description }}</span>
                            </td>
                            <td>
                                <span class="">{{ $item->created_at }}</span>
                            </td>
                            <td>
                                <span class="badge badge-primary">{{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</span>
                            </td> 
                            {{-- <td>
                                <a class="btn btn-danger d-inline-block" type="button" data-toggle="modal" data-target="#hapusModal">@lang('general.hapus')</a>  
                            </td> --}}

                        </tr>   
                    @empty
                    <td>
                        <span class="">Tidak Ada Aktivitas Log</span>
                    </td>
                    @endforelse
                </tbody>
        </table>
        </div>
    </div>
    

            {{-- <!-- Hapus Modal-->
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
                        <a class="btn btn-danger" href="{{ route("activity_log.hapus", $item->id) }}">@lang('general.hapus')</a>
                    </div>
                </div>
            </div>
        </div> --}}
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