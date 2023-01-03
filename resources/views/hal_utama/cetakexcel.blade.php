<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="{{ asset('template/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('template/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template/css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>

<body >
    <br>

    @php
        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=hasil.xls");
    @endphp
    <!-- <center><h3><?php echo $ksInstansi . '-' . $ksJenis . '-' . $ksTglKontrak . '-' . $ksTglKontrak; ?></h3></center> !-->
    <center>
        <h3><?php if (!empty($ksInstansi)) {
            echo '-' . $ksInstansi;
        } else {
            echo 'Semua Instansi';
        }
        if (!empty($ksJenis)) {
            echo '-' . $ksJenis;
        } else {
            echo '-Dalam dan Luar Negeri';
        }
        if (!empty($ksTglKontrak)) {
            echo '-' . $ksTglKontrak;
        } else {
            '';
        }
        ?></h3>
    </center>

    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="border: 1px solid #ccc">
        <thead style="border: 1px solid #ccc">
            <tr style="border: 1px solid #ccc">
                <th>No</th>
                <th>Instansi Kerja sama</th>
                <th>Jenis</th>
                <th>Jenis Instansi</th>
                <th>Kota,Negara</th>
                <th>Nomor kerja sama</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Berakhir </th>
                <th>Jangka Waktu</th>
                <th>Isi Kerja Sama </th>
                <th>Unit Yang Terlibat</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <?php $x =1;
            // dd($dt);
                foreach ($dt as $key) {?>
            <tr>
                <td style="border: 1px solid #ccc">
                    <?php echo $x; ?>
                </td>
                <td style="border: 1px solid #ccc">
                    <?php echo $key->ksNama; ?>
                </td >
                <td style="border: 1px solid #ccc">
                    <?php echo $key->ksJenis; ?>
                </td>
                <td style="border: 1px solid #ccc">
                    <?php echo $key->ksInstansi; ?>
                </td>
                <td style="border: 1px solid #ccc">
                    <?php echo $key->ksKota . ',' . $key->ksNegara; ?>
                </td>
                <td style="border: 1px solid #ccc">
                    <?php echo $key->ksNoKS; ?>
                </td>
                <td style="border: 1px solid #ccc">
                    <?php echo $key->ksTglKontrak; ?>
                </td>
                <td style="border: 1px solid #ccc">
                    <?php echo $key->ksTglAkhir; ?>
                </td>
                <td style="border: 1px solid #ccc"> {{ $key->ksJangka }}</td>
                {{-- <td>
                    <?php $selisih = substr($key->ksTglAkhir, 0, 4) - substr($key->ksTglKontrak, 0, 4);
                    $bulan = substr($key->ksTglAkhir, 5, 2) - substr($key->ksTglKontrak, 5, 2);
                    ?>
                    <?php
                    if ($key->ksTglAkhir == '0000-00-00') {
                        echo $key->ksJangka;
                    } else {
                        echo $selisih . ' Tahun ' . $bulan . ' Bulan';
                    }
                    ?>
                </td> --}}
                <td style="border: 1px solid #ccc">
                    <?php echo $key->ksIsiKS; ?>
                </td>

                <td style="border: 1px solid #ccc">
                    <?php $unitterlibat = databerhubungan($key->ksId); ?>
                    @foreach ($unitterlibat as $index)
                        @php
                            $dataunit = datapihak($index->unitPihakdetail);
                        @endphp
                        @foreach ($dataunit as $index2)
                            <li>{{ $index2->pdNama }}</li>
                        @endforeach
                    @endforeach
                </td>
                <!--
                   <td>
                       <?php if ($key->selisih < 1) {
                           echo 'aktif';
                       } else {
                           echo 'tidak aktif';
                       } ?>
                   </td>
 -->
                <td style="border: 1px solid #ccc">
                    <?php echo $key->ksKet; ?>
                </td>

            </tr>
      
            <?php $x++;
         } ?>
        
        </tbody>


    </table>

</body>

</html>
<script type="text/javascript">

</script>

<!-- Page level plugins -->
<script src="{{ asset('template/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('template/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('template/js/demo/datatables-demo.js') }}"></script>

<!-- Bootstrap core JavaScript-->
<script src="{{asset('template/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    
<!-- Core plugin JavaScript-->
<script src="{{ asset('template/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    
<!-- Custom scripts for all pages-->
<script src="{{ asset('template/js/sb-admin-2.min.js') }}"></script>
