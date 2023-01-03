<?php

namespace App\Http\Controllers;

use App\Console\Kernel;
use Illuminate\Http\Request;
use App\Models\Tbkerjasama;
use App\Models\Tbpihak;
use App\Models\Tbpihakdetail;
use App\Models\Tbunit;
use App\Models\Tbuser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class KsInstansiController extends Controller
{
    public function index(Request $request) 
    {
        // $ks_instansis = Tbkerjasama::find(1);
        $ks_instansis = Tbkerjasama::where('ksInstansi', 'INSTANSI PEMERINTAHAN')->with('tbpihakdetails')->get();
        // dd($ks_instansis->toArray());
        // $ks_instansis = Tbkerjasama::where('ksInstansi', 'INSTANSI PEMERINTAHAN')->get();

        $tgl_sekarang=date("Y-m-d");

        return view('ks_pemerintahan.ks_instansi_index', ['ks_instansis' => $ks_instansis, 'request' => $request, 
        'tgl_sekarang' => $tgl_sekarang]);
    }


    public function create()
    {
        $ks_instansi = Tbkerjasama::all();

        return view('ks_pemerintahan.ks_instansi_create', compact('ks_instansi'));
    }

    // public function detail($ks_instansi){
    //     $id_detail = Ks_instansi::find($ks_instansi) ;
    //     return view('instansi_index.detail', ['ks_instansi' => $id_detail]);
    // }

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
            'ksFile'            =>  'required|mimes:pdf',
            'unitPihakdetail'   =>  'required',

        ], $messages);

        $nm = $request->ksFile;
        // $nm = optional($request->file('ksFile'));
        $namaFile = time().".".$nm->getClientOriginalName();

        $tampungan_data = new Tbkerjasama;
        $tampungan_data->ksJenis = $request->ksJenis;
        $tampungan_data->ksInstansi = $request ->ksInstansi;
        $tampungan_data->ksNama = $request ->ksNama;
        $tampungan_data->ksKota = $request ->ksKota;
        $tampungan_data->ksNegara = $request ->ksNegara;
        $tampungan_data->ksBenua = $request ->ksBenua;
        $tampungan_data->ksNoKS = $request ->ksNoKS;
        $tampungan_data->ksTglKontrak = $request ->ksTglKontrak;
        $tampungan_data->ksTglAkhir = $request ->ksTglAkhir;
        $tampungan_data->ksJangka = $request ->ksJangka;
        $tampungan_data->ksIsiKS = $request ->ksIsiKS;
        $tampungan_data->ksKet = $request ->ksKet;
        $tampungan_data->ksFile = $namaFile;

        $nm->move(public_path().'/img', $namaFile);

        if ($tampungan_data->save()) {
            $tampungan_data->tbpihakdetails()->attach($request->unitPihakdetail);
        }

        activity()->log('Menambah Data Kerjasama Instansi Pemerintahan');
        return redirect()->route('pemerintahan.index')->with('berhasil_tambah', 'Data kerjasama berhasil ditambahkan'); 
    }

    public function hapus($ksId){
        $menghapus = Tbkerjasama::findorfail($ksId);

        $file = public_path('/img/').$menghapus->ksFile;

        //mengecek file 
        if (file_exists($file)){
            //maka hapus file fi folder public/img
            @unlink($file);
        }

        $menghapus->delete();

        activity()->log('Menghapus Data Kerjasama Instansi Pemerintahan');
        return redirect()->route('pemerintahan.index')->with('berhasil_hapus', 'Data kerjasama berhasil dihapus'); 
    }

    public function update($ksId){

        // $ins = Ks_instansi::with('tbunits')->where('ksId', $ksId)->first();
        
        $kerjasama = Tbkerjasama::with('tbunits')->where('ksId', $ksId)->first()->findorfail($ksId);

        $pihakdetail = Tbpihakdetail::all();
        //UNIB
        $tbcabangunib = Tbpihakdetail::where('pdKode', 'p1')->get();

        //fakultas
        $tbfakultas = Tbpihak::where('pihakNama', 'Fakultas')->get();
        $tbcabangfakultas = Tbpihakdetail::where('pdKode', 'p2')->get();

        //UPT
        $tbupt = Tbpihak::where('pihakNama', 'UPT')->get();
        $tbcabangupt = Tbpihakdetail::where('pdKode', 'p3')->get();

        //Lembaga
        $tblembaga = Tbpihak::where('pihakNama', 'Lembaga')->get();
        $tbcabanglembaga = Tbpihakdetail::where('pdKode', 'p4')->get();

        return view('ks_pemerintahan.ks_instansi_update', ['pihakdetail' => $pihakdetail, 'kerjasama' => $kerjasama, 'tbcabangunib' =>$tbcabangunib, 'tbfakultas' => $tbfakultas, 'tbcabangfakultas' => $tbcabangfakultas, 'tbupt' => $tbupt, 'tbcabangupt' => $tbcabangupt, 'tblembaga' => $tblembaga, 'tbcabanglembaga' => $tbcabanglembaga]);
    }

    public function update_proses(Request $request, $ksId){
        
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
        $awal->move(public_path().'/img', $namaFile);

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

        if ($perubahan->update($kerjasama)) {
            $perubahan->tbpihakdetails()->sync($request->unitPihakdetail);
        }

        activity()->log('Memperbarui Data Kerjasama Instansi Pemerintahan');
        return redirect()->route('pemerintahan.index')->with('berhasil_perbarui', 'Data kerjasama berhasil diperbarui'); 

    }

    public function login(){

        return view('hal_utama.login');
    }

    public function postLogin(Request $request){
        if (Auth::attempt($request->only('name', 'password'))){
            return redirect()->route('kerjasamaunib.beranda'); 
        }
        return redirect()->route('login')->with('gagal_login', 'Maaf Username/Password salah'); 
    }

    public function logout(Request $request){
        Auth::logout();
        return redirect()->route('login'); 
    }

}
