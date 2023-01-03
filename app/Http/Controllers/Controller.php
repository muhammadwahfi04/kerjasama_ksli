<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\ActivityLog;
use App\Models\Tbkerjasama;
use Illuminate\Http\Request;
use App\Models\Tbpihakdetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Symfony\Component\Console\Input\Input;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function beranda()
    {
        $ks_instansi = Tbkerjasama::where('ksInstansi', 'INSTANSI PEMERINTAHAN')->count();
        $ks_perguruan = Tbkerjasama::where('ksInstansi', 'PERGURUAN TINGGI')->count();
        $ks_perusahaan = Tbkerjasama::where('ksInstansi', 'PERUSAHAAN/SWASTA')->count();
        $dalam_negeri = Tbkerjasama::where('ksJenis', 'DALAM NEGERI')->count();
        $luar_negeri = Tbkerjasama::where('ksJenis', 'LUAR NEGERI')->count();
        $lokal = Tbkerjasama::where('ksJenis', 'LOKAL')->count();

        return view('hal_utama.beranda', compact('ks_instansi', 'ks_perguruan', 'ks_perusahaan', 'dalam_negeri', 'luar_negeri', 'lokal'));
    }

    public function notifikasi()
    {
        // $hapus_otomatis = ActivityLog::where('created_at', '<', Carbon::now()->subMinute())->get();

        // foreach ($hapus_otomatis as $ho) {
        //     $ho->delete();
        // }
        $activity_log = ActivityLog::with('user')->orderBy('id', 'DESC')->get();
        return view('hal_utama.notifikasi', compact('activity_log'));
    }

    // public function hapus($id)
    // {
    //     $menghapus = ActivityLog::findorfail($id);

    //     $menghapus->delete();

    //     return redirect()->route('notifikasi.unib')->with('berhasil_hapus', 'Activity Log berhasil dihapus'); 
    // }

    public function laporan()
    {
        // $ayam =Tbkerjasama::all()->first();
        // $ayam2 = Tbkerjasama::find(request('ksJenis'));

        $data = [
            'tahunkerjasama' => Tbkerjasama::select(DB::raw("DATE_FORMAT(ksTglKontrak, '%Y') as date"))->groupBy(DB::raw("DATE_FORMAT(ksTglKontrak, '%Y')"))->get(),
        ];
        // dd($data['tahunkerjasama']);
        return view('hal_utama.laporan', $data);
    }

    public function kategori()
    {
        $kerjasama = Tbkerjasama::all();
        //asia afrika amerika utara amerika selatan antartika eropa australia
        $asia = Tbkerjasama::where('ksBenua', 'Asia')->distinct()->get(['ksNegara']);
        $amerika_utara = Tbkerjasama::where('ksBenua', 'Amerika Utara')->distinct()->get(['ksNegara']);
        $afrika = Tbkerjasama::where('ksBenua', 'Afrika')->distinct()->get(['ksNegara']);
        $amerika_selatan = Tbkerjasama::where('ksBenua', 'Amerika Selatan')->distinct()->get(['ksNegara']);
        $antartika = Tbkerjasama::where('ksBenua', 'Antartika')->distinct()->get(['ksNegara']);
        $eropa = Tbkerjasama::where('ksBenua', 'Eropa')->distinct()->get(['ksNegara']);
        $australia = Tbkerjasama::where('ksBenua', 'Australia')->distinct()->get(['ksNegara']);

        return view('hal_utama.kategori',  compact('asia', 'amerika_utara', 'afrika', 'amerika_selatan', 'antartika', 'eropa', 'australia', 'kerjasama'));
    }

    public function detailKategori($ksNegara)
    {
        $tgl_sekarang=date("Y-m-d");
        $kerjasama = Tbkerjasama::where('ksNegara', $ksNegara)->get();
        $judulKs = Tbkerjasama::where('ksNegara', $ksNegara)->first();
        return view('hal_utama.detail_kategori', compact('kerjasama', 'judulKs', 'tgl_sekarang'));
        dd($kerjasama);
    }

    public function lang($locale)
    {
        App::setLocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    }

    public function cetakpdf(Request $request)
    {
        $messages = [
            'required' => 'Kolom ini wajib diiisi',
            'mimes' => 'File harus bertipe file PDF',
        ];

        $this->validate($request, [
            'ksJenis'           =>  'required',
            'ksInstansi'        =>  'required',
            'ksTglKontrak'      =>  'required',
            'masaAktif'         =>  'required',
            'unitPihakdetail'   =>  'required',
        ], $messages);
        // dd($request);
        if (isset($_POST['cetak_pdf'])) {

            $tgl_sekarang = date("Y-m-d");

            $ksJenis = Tbkerjasama::get();
            if (($request->ksJenis == "SEMUA") && ($request->ksInstansi == "SEMUA")) {
                if ($request->masaAktif == "AKTIF") {
                    $dt =  Tbkerjasama::join('tbunits', 'tbkerjasamas.ksId', '=', 'tbunits.unitIsiKS')->where([
                        ['tbkerjasamas.ksTglAkhir', '>=', now()],
                        ['tbunits.unitPihakdetail', $request->unitPihakdetail],
                    ])->whereYear('ksTglKontrak', $request->ksTglKontrak)->get();
                } else {
                    $dt =  Tbkerjasama::join('tbunits', 'tbkerjasamas.ksId', '=', 'tbunits.unitIsiKS')->where([
                        ['tbkerjasamas.ksTglAkhir', '<=', now()],
                        ['tbunits.unitPihakdetail', $request->unitPihakdetail],
                    ])->whereYear('ksTglKontrak', $request->ksTglKontrak)->get();
                }
                // $dt =  Tbkerjasama::whereYear('ksTglKontrak', $request->ksTglKontrak)->get();
            } else if (($request->ksJenis == "SEMUA") && ($request->ksInstansi != "SEMUA")) {
                // $dt = Tbkerjasama::where([
                //     ['ksInstansi', $request->ksInstansi]
                // ])->whereYear('ksTglKontrak', $request->ksTglKontrak)->get();

                if ($request->masaAktif == "AKTIF") {
                    $dt =  Tbkerjasama::join('tbunits', 'tbkerjasamas.ksId', '=', 'tbunits.unitIsiKS')->where([
                        ['tbkerjasamas.ksInstansi', $request->ksInstansi],
                        ['tbkerjasamas.ksTglAkhir', '>=', now()],
                        ['tbunits.unitPihakdetail', $request->unitPihakdetail],
                    ])->whereYear('ksTglKontrak', $request->ksTglKontrak)->get();
                } else {
                    $dt =  Tbkerjasama::join('tbunits', 'tbkerjasamas.ksId', '=', 'tbunits.unitIsiKS')->where([
                        ['tbkerjasamas.ksInstansi', $request->ksInstansi],
                        ['tbkerjasamas.ksTglAkhir', '<=', now()],
                        ['tbunits.unitPihakdetail', $request->unitPihakdetail],
                    ])->whereYear('ksTglKontrak', $request->ksTglKontrak)->get();
                }
            } else if (($request->ksJenis != "SEMUA") && ($request->ksInstansi == "SEMUA")) {
                // $dt = Tbkerjasama::where([
                //     ['ksJenis', $request->ksJenis],
                // ])->whereYear('ksTglKontrak', $request->ksTglKontrak)->get();

                if ($request->masaAktif == "AKTIF") {
                    $dt =  Tbkerjasama::join('tbunits', 'tbkerjasamas.ksId', '=', 'tbunits.unitIsiKS')->where([
                        ['tbkerjasamas.ksJenis', $request->ksJenis],
                        ['tbkerjasamas.ksTglAkhir', '>=', now()],
                        ['tbunits.unitPihakdetail', $request->unitPihakdetail],
                    ])->whereYear('ksTglKontrak', $request->ksTglKontrak)->get();
                } else {
                    $dt =  Tbkerjasama::join('tbunits', 'tbkerjasamas.ksId', '=', 'tbunits.unitIsiKS')->where([
                        ['tbkerjasamas.ksJenis', $request->ksJenis],
                        ['tbkerjasamas.ksTglAkhir', '<=', now()],
                        ['tbunits.unitPihakdetail', $request->unitPihakdetail],
                    ])->whereYear('ksTglKontrak', $request->ksTglKontrak)->get();
                }

            }
            //  else if (($request->ksJenis == "SEMUA") && ($request->unitPihakdetail->pdNama == "SEMUA")) {   //diubah //ksintansi
            //     if ($request->masaAktif == "AKTIF") {
            //         $dt =  Tbkerjasama::join('tbunits', 'tbkerjasamas.ksId', '=', 'tbunits.unitIsiKS')->where([
            //             ['tbkerjasamas.ksTglAkhir', '>=', now()],
            //             ['tbkerjasamas.ksInstansi', $request->ksInstansi],
            //         ])->whereYear('ksTglKontrak', $request->ksTglKontrak)->get();
            //     } else {
            //         $dt =  Tbkerjasama::join('tbunits', 'tbkerjasamas.ksId', '=', 'tbunits.unitIsiKS')->where([
            //             ['tbkerjasamas.ksTglAkhir', '<=', now()],
            //             ['tbkerjasamas.ksInstansi', $request->ksInstansi],
            //         ])->whereYear('ksTglKontrak', $request->ksTglKontrak)->get();
            //     }
            // }
            
            
            else {
                // $dt = Tbkerjasama::where([
                //     ['ksInstansi', $request->ksInstansi],
                //     ['ksJenis', $request->ksJenis],

                // ])->whereYear('ksTglKontrak', $request->ksTglKontrak)->get();
                if ($request->masaAktif == "AKTIF") {
                    $dt =  Tbkerjasama::join('tbunits', 'tbkerjasamas.ksId', '=', 'tbunits.unitIsiKS')->where([
                        ['tbkerjasamas.ksInstansi', $request->ksInstansi],
                        ['tbkerjasamas.ksJenis', $request->ksJenis],
                        ['tbkerjasamas.ksTglAkhir', '>=', now()],
                        ['tbunits.unitPihakdetail', $request->unitPihakdetail],
                    ])->whereYear('ksTglKontrak', $request->ksTglKontrak)->get();
                } else {
                    $dt =  Tbkerjasama::join('tbunits', 'tbkerjasamas.ksId', '=', 'tbunits.unitIsiKS')->where([
                        ['tbkerjasamas.ksInstansi', $request->ksInstansi],
                        ['tbkerjasamas.ksJenis', $request->ksJenis],
                        ['tbkerjasamas.ksTglAkhir', '<=', now()],
                        ['tbunits.unitPihakdetail', $request->unitPihakdetail],
                    ])->whereYear('ksTglKontrak', $request->ksTglKontrak)->get();
                }
            }
            $pihakdetail = Tbpihakdetail::where('pdId', $request->unitPihakdetail)->first();
            $data = [
                'ksInstansi' => $request->ksInstansi,
                'ksJenis' => $request->ksJenis,
                'ksTglKontrak' => $request->ksTglKontrak,
                'masaAktif' => $request->masaAktif,
                'unitPihakdetail' => $pihakdetail->pdNama,
                'dt' => $dt,
            ];
            return view('hal_utama.cetak', $data, compact('tgl_sekarang'));


        } else if (isset($_POST['cetak_excel'])) {

            
            $tgl_sekarang = date("Y-m-d");

            $ksJenis = Tbkerjasama::get();
            if (($request->ksJenis == "SEMUA") && ($request->ksInstansi == "SEMUA")) {
                if ($request->masaAktif == "AKTIF") {
                    $dt =  Tbkerjasama::join('tbunits', 'tbkerjasamas.ksId', '=', 'tbunits.unitIsiKS')->where([
                        ['tbkerjasamas.ksTglAkhir', '>=', now()],
                        ['tbunits.unitPihakdetail', $request->unitPihakdetail],
                    ])->whereYear('ksTglKontrak', $request->ksTglKontrak)->get();
                } else {
                    $dt =  Tbkerjasama::join('tbunits', 'tbkerjasamas.ksId', '=', 'tbunits.unitIsiKS')->where([
                        ['tbkerjasamas.ksTglAkhir', '<=', now()],
                        ['tbunits.unitPihakdetail', $request->unitPihakdetail],
                    ])->whereYear('ksTglKontrak', $request->ksTglKontrak)->get();
                }
                // $dt =  Tbkerjasama::whereYear('ksTglKontrak', $request->ksTglKontrak)->get();
            } else if (($request->ksJenis == "SEMUA") && ($request->ksInstansi != "SEMUA")) {
                // $dt = Tbkerjasama::where([
                //     ['ksInstansi', $request->ksInstansi]
                // ])->whereYear('ksTglKontrak', $request->ksTglKontrak)->get();

                if ($request->masaAktif == "AKTIF") {
                    $dt =  Tbkerjasama::join('tbunits', 'tbkerjasamas.ksId', '=', 'tbunits.unitIsiKS')->where([
                        ['tbkerjasamas.ksInstansi', $request->ksInstansi],
                        ['tbkerjasamas.ksTglAkhir', '>=', now()],
                        ['tbunits.unitPihakdetail', $request->unitPihakdetail],
                    ])->whereYear('ksTglKontrak', $request->ksTglKontrak)->get();
                } else {
                    $dt =  Tbkerjasama::join('tbunits', 'tbkerjasamas.ksId', '=', 'tbunits.unitIsiKS')->where([
                        ['tbkerjasamas.ksInstansi', $request->ksInstansi],
                        ['tbkerjasamas.ksTglAkhir', '<=', now()],
                        ['tbunits.unitPihakdetail', $request->unitPihakdetail],
                    ])->whereYear('ksTglKontrak', $request->ksTglKontrak)->get();
                }
            } else if (($request->ksJenis != "SEMUA") && ($request->ksInstansi == "SEMUA")) {
                // $dt = Tbkerjasama::where([
                //     ['ksJenis', $request->ksJenis],
                // ])->whereYear('ksTglKontrak', $request->ksTglKontrak)->get();

                if ($request->masaAktif == "AKTIF") {
                    $dt =  Tbkerjasama::join('tbunits', 'tbkerjasamas.ksId', '=', 'tbunits.unitIsiKS')->where([
                        ['tbkerjasamas.ksJenis', $request->ksJenis],
                        ['tbkerjasamas.ksTglAkhir', '>=', now()],
                        ['tbunits.unitPihakdetail', $request->unitPihakdetail],
                    ])->whereYear('ksTglKontrak', $request->ksTglKontrak)->get();
                } else {
                    $dt =  Tbkerjasama::join('tbunits', 'tbkerjasamas.ksId', '=', 'tbunits.unitIsiKS')->where([
                        ['tbkerjasamas.ksJenis', $request->ksJenis],
                        ['tbkerjasamas.ksTglAkhir', '<=', now()],
                        ['tbunits.unitPihakdetail', $request->unitPihakdetail],
                    ])->whereYear('ksTglKontrak', $request->ksTglKontrak)->get();
                }
            } else {
                // $dt = Tbkerjasama::where([
                //     ['ksInstansi', $request->ksInstansi],
                //     ['ksJenis', $request->ksJenis],

                // ])->whereYear('ksTglKontrak', $request->ksTglKontrak)->get();
                if ($request->masaAktif == "AKTIF") {
                    $dt =  Tbkerjasama::join('tbunits', 'tbkerjasamas.ksId', '=', 'tbunits.unitIsiKS')->where([
                        ['tbkerjasamas.ksInstansi', $request->ksInstansi],
                        ['tbkerjasamas.ksJenis', $request->ksJenis],
                        ['tbkerjasamas.ksTglAkhir', '>=', now()],
                        ['tbunits.unitPihakdetail', $request->unitPihakdetail],
                    ])->whereYear('ksTglKontrak', $request->ksTglKontrak)->get();
                } else {
                    $dt =  Tbkerjasama::join('tbunits', 'tbkerjasamas.ksId', '=', 'tbunits.unitIsiKS')->where([
                        ['tbkerjasamas.ksInstansi', $request->ksInstansi],
                        ['tbkerjasamas.ksJenis', $request->ksJenis],
                        ['tbkerjasamas.ksTglAkhir', '<=', now()],
                        ['tbunits.unitPihakdetail', $request->unitPihakdetail],
                    ])->whereYear('ksTglKontrak', $request->ksTglKontrak)->get();
                }
            }
            $pihakdetail = Tbpihakdetail::where('pdId', $request->unitPihakdetail)->first();
            $data = [
                'ksInstansi' => $request->ksInstansi,
                'ksJenis' => $request->ksJenis,
                'ksTglKontrak' => $request->ksTglKontrak,
                'masaAktif' => $request->masaAktif,
                'unitPihakdetail' => $pihakdetail->pdNama,
                'dt' => $dt,
            ];
            // $ksJenis = Tbkerjasama::get();
            // if (($request->ksJenis == "SEMUA") && ($request->ksInstansi == "SEMUA")) {
            //     $dt =  Tbkerjasama::whereYear('ksTglKontrak', $request->ksTglKontrak)->get();
            // } else if (($request->ksJenis == "SEMUA") && ($request->ksInstansi != "SEMUA")) {
            //     $dt = Tbkerjasama::where([
            //         ['ksInstansi', $request->ksInstansi]
            //     ])->whereYear('ksTglKontrak', $request->ksTglKontrak)->get();
            // } else if (($request->ksJenis != "SEMUA") && ($request->ksInstansi == "SEMUA")) {
            //     $dt = Tbkerjasama::where([
            //         ['ksJenis', $request->ksJenis],
            //     ])->whereYear('ksTglKontrak', $request->ksTglKontrak)->get();
            // } else {
            //     $dt = Tbkerjasama::where([
            //         ['ksInstansi', $request->ksInstansi],
            //         ['ksJenis', $request->ksJenis],
            //     ])->whereYear('ksTglKontrak', $request->ksTglKontrak)->get();
            // }
            // $data = [
            //     'ksInstansi' => $request->ksInstansi,
            //     'ksJenis' => $request->ksJenis,
            //     'ksTglKontrak' => $request->ksTglKontrak,

            //     'dt' => $dt,
            // ];

            return view('hal_utama.cetakexcel', $data, compact('tgl_sekarang'));
        }
    }
}
