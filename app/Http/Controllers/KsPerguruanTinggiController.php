<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tbkerjasama;
use App\Models\Tbpihak;
use App\Models\Tbpihakdetail;
use Illuminate\Support\Facades\DB;

class KsPerguruanTinggiController extends Controller
{
    public function index(Request $request)
    {
        $ks_perguruans = Tbkerjasama::where('ksInstansi', 'PERGURUAN TINGGI')->get();
        $tgl_sekarang = date("Y-m-d");

        return view('ks_perguruan_tinggi.ks_perguruan_index', [
            'ks_perguruans' => $ks_perguruans, 'request' => $request,
            'tgl_sekarang' => $tgl_sekarang
        ]);
    }
    
    public function create()
    {
        $ks_perguruan = Tbkerjasama::all();

        return view('ks_perguruan_tinggi.ks_perguruan_create', compact('ks_perguruan'));
    }

    public function store(Request $request)
    {
        $messages = [
            'required' => 'Kolom ini wajib diiisi',
            'mimes' => 'File harus bertipe file PDF',
        ];

        $this->validate($request, [
            'ksJenis'           =>  'required',
            'ksInstansi'        =>  'required',
            'ksNama'            =>  'required|max:100',
            'ksKota'            =>  'required',
            'ksNegara'          =>  'required',
            'ksBenua'           =>  'required',
            'ksNoKS'            =>  'required',
            'ksTglKontrak'      =>  'required',
            'ksTglAkhir'        =>  'required',
            'ksJangka'          =>  'required',
            'ksIsiKS'           =>  'required',
            'ksKet'             =>  'required',
            'ksFile'            =>  'required|mimes:doc,pdf',
            'unitPihakdetail'   =>  'required',

        ], $messages);

        $nm = $request->ksFile;
        $namaFile = time().".".$nm->getClientOriginalName();

        $tampungan_data = new Tbkerjasama;
        $tampungan_data->ksJenis = $request->ksJenis;
        $tampungan_data->ksInstansi = $request->ksInstansi;
        $tampungan_data->ksNama = $request->ksNama;
        $tampungan_data->ksKota = $request->ksKota;
        $tampungan_data->ksNegara = $request->ksNegara;
        $tampungan_data->ksBenua = $request->ksBenua;
        $tampungan_data->ksNoKS = $request->ksNoKS;
        $tampungan_data->ksTglKontrak = $request->ksTglKontrak;
        $tampungan_data->ksTglAkhir = $request->ksTglAkhir;
        $tampungan_data->ksJangka = $request->ksJangka;
        $tampungan_data->ksIsiKS = $request->ksIsiKS;
        $tampungan_data->ksKet = $request->ksKet;
        $tampungan_data->ksFile = $namaFile;

        $nm->move(public_path() . '/img', $namaFile);

        if ($tampungan_data->save()) {
            $tampungan_data->tbpihakdetails()->attach($request->unitPihakdetail);
        }

        activity()->log('Menambah Data Kerjasama Perguruan Tinggi');
        return redirect()->route('perguruan.index')->with('berhasil_tambah', 'Data kerjasama berhasil ditambahkan');
    }

    public function hapus($ksId)
    {
        $menghapus = Tbkerjasama::findorfail($ksId);

        $file = public_path('/img/') . $menghapus->ksFile;

        //mengecek file 
        if (file_exists($file)) {
            //maka hapus file fi folder public/img
            @unlink($file);
        }

        $menghapus->delete();
        activity()->log('Menghapus Data Kerjasama Perguruan Tinggi');
        return redirect()->route('perguruan.index')->with('berhasil_hapus', 'Data kerjasama berhasil dihapus');
    }

    public function update($ksId)
    {

        $kerjasama = Tbkerjasama::with('tbunits')->where('ksId', $ksId)->first()->findorfail($ksId);
        $pihakdetail = Tbpihakdetail::all();
        return view('ks_perguruan_tinggi.ks_perguruan_update', ['kerjasama' => $kerjasama, 'pihakdetail' => $pihakdetail]);
    }

    public function update_proses(Request $request, $ksId)
    {
        $messages = [
            'required' => 'Kolom ini wajib diiisi',
            'mimes' => 'File harus bertipe file PDF',
        ];

        $this->validate($request, [
            'ksJenis'           =>  'required',
            'ksInstansi'        =>  'required',
            'ksNama'            =>  'required|max:100',
            'ksKota'            =>  'required',
            'ksNegara'          =>  'required',
            'ksBenua'           =>  'required',
            'ksNoKS'            =>  'required',
            'ksTglKontrak'      =>  'required',
            'ksTglAkhir'        =>  'required',
            'ksJangka'          =>  'required',
            'ksIsiKS'           =>  'required',
            'ksKet'             =>  'required',
            'ksFile'            =>  'mimes:pdf',
            'unitPihakdetail'   =>  'required',

        ], $messages);

        $perubahan = Tbkerjasama::findorfail($ksId);
        if($request->file('ksFile') == "") {

            $kerjasama = [
                'ksJenis' => $request['ksJenis'],
                'ksNama' => $request['ksNama'],
                'ksJenis' => $request['ksJenis'],
                'ksKota' => $request['ksKota'],
                'ksNegara' => $request['ksNegara'],
                'ksBenua' => $request['ksBenua'],
                'ksNoKS' => $request['ksNoKS'],
                'ksTglKontrak' => $request['ksTglKontrak'],
                'ksTglAkhir' => $request['ksTglAkhir'],
                'ksJangka' => $request['ksJangka'],
                'ksIsiKS' => $request['ksIsiKS'],
                'ksKet' => $request['ksKet'],
            ];

        } else {

    $file = public_path('/img/').$perubahan->ksFile;

    //mengecek file 
    if (file_exists($file)){
        //maka hapus file fi folder public/img
        @unlink($file);
    }
        $awal = $request->ksFile;

        $namaFile = time().".".$awal->getClientOriginalName();
        $awal->move(public_path() . '/img', $namaFile);

        $kerjasama = [
            'ksJenis' => $request['ksJenis'],
            'ksNama' => $request['ksNama'],
            'ksJenis' => $request['ksJenis'],
            'ksKota' => $request['ksKota'],
            'ksNegara' => $request['ksNegara'],
            'ksBenua' => $request['ksBenua'],
            'ksNoKS' => $request['ksNoKS'],
            'ksTglKontrak' => $request['ksTglKontrak'],
            'ksTglAkhir' => $request['ksTglAkhir'],
            'ksJangka' => $request['ksJangka'],
            'ksIsiKS' => $request['ksIsiKS'],
            'ksKet' => $request['ksKet'],
            'ksFile' => $namaFile,
        ];
    }

        // $nm->move(public_path().'/img', $namaFile);

        if ($perubahan->update($kerjasama)) {
            $perubahan->tbpihakdetails()->sync($request->unitPihakdetail);
        }

        activity()->log('Memperbarui Data Kerjasama Perguruan Tinggi');
        return redirect()->route('perguruan.index')->with('berhasil_perbarui', 'Data kerjasama berhasil diperbarui');
    }
}
