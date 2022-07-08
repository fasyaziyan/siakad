<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Kurikulum;
use App\Models\Rapot;
use App\Models\Kelas;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\config\app;
use App\Models\Mapel;
use Dompdf\Dompdf;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\KKM;
// use \PDF;

class RaportController extends Controller
{
    public function index(Request $request)
    {
        $rapot = Rapot::get();
        // $siswa = Siswa::get();
        // $kelas = Kelas::get();
        // $kurikulum = Kurikulum::get();
        return view('raport.index', compact('rapot'));
    }

    public function index2(Request $request)
    {
            $id_sis = Auth::guard('siswa')->user()->nisn;
            $rapot = Rapot::where('nisn', $id_sis)->get();
            $siswa = Siswa::get();
            $kelas = Kelas::get();
            return view('raport.index2', compact('rapot', 'siswa', 'kelas'));
    }

    public function create()
    {
        $siswa = Siswa::where('id_kelas', 'KLS-000001')->orwhere('id_kelas', 'KLS-000002')->orderBy('id_kelas')->get();
        $kurikulum = Kurikulum::get();
        return view('raport.create',compact('siswa', 'kurikulum'));
    }

    public function create2()
    {
        $siswa = Siswa::where('id_kelas', 'KLS-000003')->orwhere('id_kelas', 'KLS-000004')->orderBy('id_kelas')->get();
        $kurikulum = Kurikulum::get();
        return view('raport.create2',compact('siswa', 'kurikulum'));
    }

    public function create3()
    {
        $siswa = Siswa::where('id_kelas', 'KLS-000005')->orwhere('id_kelas', 'KLS-000006')->orderBy('id_kelas')->get();
        $kurikulum = Kurikulum::get();
        return view('raport.create3',compact('siswa', 'kurikulum'));
    }

    public function store(Request $request)
    {
        $id = IdGenerator::generate(['table' => 'rapot', 'field' => 'id_rapot', 'length' => 10, 'prefix' =>'RPT-']);

        $request->validate([

            // 'nama_kelas' => 'required',

        ]);
        $total = $request->n_hadits + $request->n_aqidah + $request->n_fiqih + $request->n_ski 
        + $request->n_pkn + $request->n_bindo + $request->n_barab + $request->n_binggris 
        + $request->n_matematika + $request->n_ipa + $request->n_ips + $request->n_sebud + 
        $request->n_jasmani + $request->n_prakarya + $request->n_bjawa;

        //create fuction average
        $rata_rata = $total / 15;

        $rapot = new Rapot;
        $rapot->id_rapot = $id;
        $rapot->nisn = $request->nisn;
        $rapot->id_kuri = $request->id_kuri;
        $rapot->n_hadits = $request->n_hadits;
        $rapot->n_aqidah = $request->n_aqidah;
        $rapot->n_fiqih = $request->n_fiqih;
        $rapot->n_ski = $request->n_ski;
        $rapot->n_pkn = $request->n_pkn;
        $rapot->n_bindo = $request->n_bindo;
        $rapot->n_barab = $request->n_barab;
        $rapot->n_binggris = $request->n_binggris;
        $rapot->n_matematika = $request->n_matematika;
        $rapot->n_ipa = $request->n_ipa;
        $rapot->n_ips = $request->n_ips;
        $rapot->n_sebud = $request->n_sebud;
        $rapot->n_jasmani = $request->n_jasmani;
        $rapot->n_prakarya = $request->n_prakarya;
        $rapot->n_bjawa = $request->n_bjawa;
        $rapot->jumlah = $total;
        $rapot->n_tik = $request->n_tik;
        $rapot->rata_rata = $rata_rata;
        $rapot->keterangan = $request->keterangan;

        $rapot->save();
        // session()->flash('success','Sukses tambah Kelas!');
        return redirect()->route('raport.index');
    }
    public function edit(Request $request, $id_rapot){
        $siswa = Siswa::get();
        $kurikulum = Kurikulum::get();
        $rapot = Rapot::findorFail($id_rapot);
        return view('raport.edit', compact('rapot', 'siswa', 'kurikulum'));
    }
    public function update(Request $request, $id_rapot){
        $rapot = Rapot::find($id_rapot);

        // $request->validate([
        //     'nip' => 'required'
        // ]);
        $total = $request->n_hadits + $request->n_aqidah + $request->n_fiqih + $request->n_ski 
        + $request->n_pkn + $request->n_bindo + $request->n_barab + $request->n_binggris 
        + $request->n_matematika + $request->n_ipa + $request->n_ips + $request->n_sebud + 
        $request->n_jasmani + $request->n_prakarya + $request->n_bjawa;

        //create fuction average
        $rata_rata = $total / 15;

        $rapot->nisn = $request->nisn;
        $rapot->id_kuri = $request->id_kuri;
        $rapot->n_hadits = $request->n_hadits;
        $rapot->n_aqidah = $request->n_aqidah;
        $rapot->n_fiqih = $request->n_fiqih;
        $rapot->n_ski = $request->n_ski;
        $rapot->n_pkn = $request->n_pkn;
        $rapot->n_bindo = $request->n_bindo;
        $rapot->n_barab = $request->n_barab;
        $rapot->n_binggris = $request->n_binggris;
        $rapot->n_matematika = $request->n_matematika;
        $rapot->n_ipa = $request->n_ipa;
        $rapot->n_ips = $request->n_ips;
        $rapot->n_sebud = $request->n_sebud;
        $rapot->n_jasmani = $request->n_jasmani;
        $rapot->n_prakarya = $request->n_prakarya;
        $rapot->n_bjawa = $request->n_bjawa;
        $rapot->n_tik = $request->n_tik;
        $rapot->jumlah = $total;
        $rapot->rata_rata = $rata_rata;
        $rapot->keterangan = $request->keterangan;

        $rapot -> update();
        return redirect()->route('raport.index');
    }
    public function destroy($id_rapot){
        $rapot = Rapot::find($id_rapot);
        $rapot -> delete();
        return redirect()->back();
    }
    public function cetakpdf(Request $request, $id_rapot){
        $kkm = 75;
        $rapot = Rapot::findorFail($id_rapot);
        $siswa = Siswa::get();
        $kelas = Kelas::get();
        $pdf = PDF::loadview('cetak',compact('rapot', 'siswa', 'kelas', 'kkm'));
        return $pdf->stream($rapot->siswa->nama."-".$rapot->kurikulum->tahun_ajaran.".pdf");

        // return view('cetak',compact('rapot','siswa', 'kelas', 'kkm'));
    }

    public function nilai_kurang(Request $request){
        $judul = '';
        if ($tampung = $request->mapel == 'n_hadits'){
            $judul = 'AlQuran Hadits';
        } elseif ($tampung = $request->mapel == 'n_aqidah'){
            $judul = 'Aqidah Akhlaq';
        } elseif ($tampung = $request->mapel == 'n_fiqih'){
            $judul = 'Fiqih';
        } elseif ($tampung = $request->mapel == 'n_ski'){
            $judul = 'SKI';
        } elseif ($tampung = $request->mapel == 'n_pkn'){
            $judul = 'PKN';
        } elseif ($tampung = $request->mapel == 'n_bindo'){
            $judul = 'Bahasa Indonesia';
        } elseif ($tampung = $request->mapel == 'n_barab'){
            $judul = 'Bahasa Arab';
        } elseif ($tampung = $request->mapel == 'n_binggris'){
            $judul = 'Bahasa Inggris';
        } elseif ($tampung = $request->mapel == 'n_matematika'){
            $judul = 'Matematika';
        } elseif ($tampung = $request->mapel == 'n_ipa'){
            $judul = 'IPA';
        } elseif ($tampung = $request->mapel == 'n_ips'){
            $judul = 'IPS';
        } elseif ($tampung = $request->mapel == 'n_sebud'){
            $judul = 'Seni Budaya';
        } elseif ($tampung = $request->mapel == 'n_jasmani'){
            $judul = 'Jasmani';
        } elseif ($tampung = $request->mapel == 'n_prakarya'){
            $judul = 'Prakarya';
        } elseif ($tampung = $request->mapel == 'n_bjawa'){
            $judul = 'Bahasa Jawa';
        } elseif ($tampung = $request->mapel == 'n_tik'){
            $judul = 'Informatika';
        }
        $kkm = 75;
        $tampung = $request->mapel;
        $rapot = Rapot::where($tampung, '<', $kkm)
        ->get();
        //db query from request

        $siswa = Siswa::get();
        $kelas = Kelas::get();
        $pdf = PDF::loadview('nilaikurang',compact('rapot', 'siswa', 'kelas', 'kkm', 'tampung'));
        return $pdf->stream($judul." Rapot Kurang KKM.pdf");

        // return view('n ilaikurang',compact('rapot','siswa', 'kelas', 'kkm', 'tampung'));
        // dd($rapot);
    }

    public function coba(){
        $data_siswa = Siswa::where('id_kelas', 'KLS-000002')->orderBy('nama', 'asc')->select('nisn')->get();
        $data2 = [];
        foreach ($data_siswa as $item => $value) {
            $data2[] = $value->nisn;
        }
        //Data Araay Namma
        $data_siswa_nama = Siswa::where('id_kelas', 'KLS-000002')->orderBy('nama', 'asc')->select('nama')->get();
        $data3 = [];
        foreach ($data_siswa_nama as $item => $value) {
            $data3[] = $value->nama;
        }
        ////

        foreach ($data2 as $item => $value) {
            $siswa_kelas[] = Siswa::leftJoin('detnilai', 'siswa.nisn', '=', 'detnilai.nisn')->where('siswa.nisn', '=', $value)->leftJoin('mapel', 'mapel.id_mapel', '=', 'detnilai.id_mapel')->where('mapel.id_kelas', '=', 'KLS-000002')->where('detnilai.id_kuri', '=', 'KRK-000001')->get();
        }
        $nilai = [];
        foreach ($siswa_kelas as $key => $value) {
            $nilai[] = $value->sum('nilai');
        }
        $data = [];
        foreach ($data3 as $item => $value) {
            $data[] = $value;
        }
        $array_gabung = array_combine($data, $nilai);
        arsort($array_gabung);
        dd($array_gabung);
        return view('coba');
    }
}