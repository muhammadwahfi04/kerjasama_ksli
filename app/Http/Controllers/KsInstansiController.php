<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ks_instansi;

class KsInstansiController extends Controller
{
    public function index() //tampil
    {
        // $data = DB::table('ks_instansis')->where([
        //     ['ksJenis', '=', 'DALAM NEGERI'],
        // ])->get();

        // $data=Ks_instansi::where('kerjasama','pemerintah)->get();
        $ks_instansis = Ks_instansi::where('ksInstansi', 'PERGURUAN TINGGI')->get();
        return view('instansi_index', ['ks_instansis' => $ks_instansis]);
    }


    public function create()
    {
        return view('create_ks_instansi');
    }

    // public function detail($ks_instansi){
    //     $id_detail = Ks_instansi::find($ks_instansi) ;
    //     return view('instansi_index.detail', ['ks_instansi' => $id_detail]);
    // }

    public function store(Request $request)
    {
        $validateData = $request -> validate([
            'ksJenis'           =>  'required',
            'ksInstansi'        =>  'required',
            'ksNama'            =>  'required|max:100',
            'ksKota'            =>  'required',
            'ksNegara'          =>  'required',
            'ksNoKS'            =>  'required',
            'ksTglKontrak'      =>  'required',
            'ksTglAkhir'        =>  'required',
            'ksJangka'          =>  'required',
            'ksIsiKS'           =>  'required',
            'ksKet'             =>  'required',
            'ksFile'            =>  'required',
        ]);
        
        //Input data
        //Cara manual 
        // $ks_instansi    = new Ks_instansi(); //pembuatan objek ks_instansi dari class Ks_instansi(dari model)
        // $ks_instansi    ->ksjenis   = $validateData['ksJenis'];
        // $ks_instansi    ->ksInstansi   = $validateData['ksInstansi'];
        // $ks_instansi    ->ksNama   = $validateData['ksNama'];
        // $ks_instansi    ->ksKota   = $validateData['ksKota'];
        // $ks_instansi    ->ksnegara   = $validateData['ksNegara'];
        // $ks_instansi    ->ksNoKS   = $validateData['ksNoKS'];
        // $ks_instansi    ->ksTglKontrak   = $validateData['ksTglKontrak'];
        // $ks_instansi    ->ksTglAkhir   = $validateData['ksTglAkhir'];
        // $ks_instansi    ->ksJangka   = $validateData['ksJangka'];
        // $ks_instansi    ->kslsiKS   = $validateData['kslsiKS'];
        // $ks_instansi    ->ksKet   = $validateData['ksKet'];
        // $ks_instansi    ->ksFile   = $validateData['ksFile'];


        //Input Data menggunakan mass Assignment
        
        Ks_instansi::create($validateData);
        return "Data berhasil diinput ke dalam database";
    }
}
