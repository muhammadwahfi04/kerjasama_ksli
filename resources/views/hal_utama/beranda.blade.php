@extends('layouts.master')
@section('title', 'Beranda Pangkalan Data KSLI')

<!-- Image and text -->
@section('content')
    
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">@lang('general.jumlah_kerjasama')</h1>
                    </div>

                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                @lang('general.perguruan_tinggi')</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $ks_perguruan }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Annual) Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                @lang('general.instansi_pemerintahan')</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $ks_instansi }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                            <!-- Earnings (Annual) Card Example -->
                            <div class="col-xl-4 col-md-6 mb-4">
                                <div class="card border-left-info shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                    @lang('general.perusahaan_swasta')</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $ks_perusahaan }}</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Area Chart -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">@lang('general.bar_chart_jenis_kerjasama')</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <center>
                                    <div class="chart-area ">
                                        <canvas id="chartbalok"></canvas>
                                    </div>
                                    </center>
                                </div>
                            </div>
                        </div>

                        <!-- Pie Chart -->
                        <div class="col-xl-4 col-lg-5 pb-5">
                            <div class="card shadow">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">@lang('general.donat_chart_instansi_kerjasama')</h6>
                                </div>
                                 <!-- Card Body -->
                                 <div class="card-body pb-5">
                                    <center>
                                    <div class="chart-pie">
                                        <canvas id="myPieChart"></canvas>
                                    </div>
                                    </center>
                                    </div>
                                </div>
                            </div>

                                      <!-- Area Chart -->
                        <div class="col-xl-8 col-lg-9">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">@lang('general.peta')</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <center>
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7962.467613345254!2d102.27260900000002!3d-3.759212!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x204c399f8be76e06!2zM8KwNDUnMzMuMiJTIDEwMsKwMTYnMjEuNCJF!5e0!3m2!1sen!2sus!4v1671078911623!5m2!1sen!2sus" width="800" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                    </center>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-4">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">@lang('general.alamat')</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                               
                                        <p>UPT Kerja Sama dan Layanan Internasional</p>
                                        <p>Rektorat | Universitas Bengkulu</p>
                                        <p>Jalan W.R. Supratman, Kandang Limun, Bengkulu 38371A</p>
                                        <p>Telepon: (0736) 21170, 21884, Ext (190)</p>
                                        <p>Website: http://ksli.unib.ac.id</p>
                                        <p>e-mail: international@unib.ac.id</p>
                                       
                                        
                                      
                                  
                                        
                                        
                            
                                </div>
                            </div>
                        </div>
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

    <script>
        const ctx = document.getElementById('myPieChart');
        
        new Chart(ctx, {
            type: 'doughnut',
            data: {
            labels: ['@lang('general.perguruan_tinggi')', '@lang('general.instansi_pemerintahan')', '@lang('general.perusahaan_swasta')'],
            datasets: [{
                label: '# of Votes',
                data: [{{ $ks_perguruan }}, {{ $ks_instansi }}, {{ $ks_perusahaan }}],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(153, 102, 255, 0.2)'
                    ],
                borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(75, 192, 192)',
                    'rgb(54, 162, 235)',
                    'rgb(153, 102, 255)'
    
                ],
                borderWidth: 1
            }]
            },
            options: {
            scales: {
                y: {
                beginAtZero: true
                }
            }
            }
        });

        const ctxx = document.getElementById('chartbalok');
        
        new Chart(ctxx, {
            type: 'bar',
            data: {
            labels: ['@lang('general.dalam_negeri')', '@lang('general.luar_negeri')', '@lang('general.lokal')'],
            datasets: [{
                label: '@lang('general.jenis_kerjasama')',
                data: [{{ $dalam_negeri }}, {{ $luar_negeri }}, {{ $lokal }}, ],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(153, 102, 255, 0.2)'
                    ],
                borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(75, 192, 192)',
                    'rgb(54, 162, 235)',
                    'rgb(153, 102, 255)'
                    ],

                borderWidth: 1
            }]
            },
            options: {
            scales: {
                y: {
                beginAtZero: true
                }
            }
            }
        });
    </script>
</body>


</html>
@endsection