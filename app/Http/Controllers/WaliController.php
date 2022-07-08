<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\KKM;
use App\Models\Mapel;
use App\Models\Nilai;
use App\Models\Rapot;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Auth;

use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class WaliController extends Controller
{
    public function index_rapot (Request $request){
        $kelas = Kelas::where('nip', Auth::guard('guru')->user()->nip)->get();
        return view('wali.index', compact('kelas'));
    }

    public function index_kelas (Request $request, $id_kelas){
        if ($request->ajax()) {
            $data = Siswa::where('id_kelas', $id_kelas)->orderBy('nama', 'asc')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return;
    }

    public function detail_rapot (Request $request, $nisn){
        $siswa = Siswa::find($nisn);
        $kkm = Kkm::first()->set_kkm;
        $id_kelas = Siswa::where('nisn', $nisn)->value('id_kelas');
        $id_kuri = Kelas::where('id_kelas', $id_kelas)->value('id_kuri');
        $mapel2 = Mapel::where('id_kelas', $id_kelas)->select('id_mapel')->get();
        $mapel3 = [];
        foreach ($mapel2 as $item => $value) {
            $mapel3[] = $value->id_mapel;
        }
        foreach ($mapel3 as $item => $value) {
            Nilai::updateOrCreate(['nisn' => $nisn, 'id_kelas' => $id_kelas, 'id_mapel' => $value, 'id_kuri' => $id_kuri]);
        }
        $nilai = Mapel::leftJoin('detnilai', 'mapel.id_mapel', '=', 'detnilai.id_mapel')->leftjoin('rapot', 'rapot.nisn', '=', 'detnilai.nisn')->where('mapel.id_kelas', $id_kelas)->where('detnilai.nisn', '=', $nisn)->get();
        $jumlah = [];
        foreach ($nilai as $key => $value) {
            $jumlah[$key] = $value->nilai;
        }
        $total = array_sum($jumlah);
        $rata_rata = $total / count($jumlah);
        Rapot::updateOrCreate(['nisn' => $nisn, 'id_kelas' => $id_kelas, 'id_kuri' => $id_kuri]);
        return view('wali.detail_rapot', compact('siswa', 'nilai', 'kkm', 'rata_rata', 'total'));
    }

    public function set_catatan (Request $request)
    {
        Rapot::updateOrCreate(['nisn' => $request->nisn, 'id_kelas' => $request->id_kelas, 'id_kuri' => $request->id_kuri], ['keterangan' => $request->keterangan, 'sakit' => $request->sakit, 'izin' => $request->izin, 'alpa' => $request->alpa]);
        return ;
    }

    public function cetak(Request $request, $nisn){
        $siswa = Siswa::find($nisn);
        $id_kelas = Siswa::where('nisn', $nisn)->value('id_kelas');
        $id_kuri = Kelas::where('id_kelas', $id_kelas)->value('id_kuri');
        $nilai = Mapel::leftJoin('detnilai', 'mapel.id_mapel', '=', 'detnilai.id_mapel')->leftjoin('rapot', 'rapot.nisn', '=', 'detnilai.nisn')->where('mapel.id_kelas', '=', $id_kelas)->where('detnilai.nisn', '=', $nisn)->where('detnilai.id_kuri', '=', $id_kuri)->get();
        $no = 1;
        $jumlah = [];
        foreach ($nilai as $key => $value) {
            $jumlah[$key] = $value->nilai;
        }
        $total = array_sum($jumlah);
        $coba = count($jumlah);
        $rata_rata = $total / count($jumlah);
        $kkm = Kkm::first()->set_kkm;
        $judul = $siswa->kelas->tingkat->nama_tingkat.'-'.$siswa->kelas->nama_kelas.'_'.$siswa->nama.'_'.$siswa->kelas->kurikulum->semester;
        // return view('wali.cetak', compact('nilai', 'no', 'total', 'rata_rata', 'kkm', 'siswa'));
        $pdf = PDF::loadview('wali.cetak',compact('nilai', 'no', 'total', 'rata_rata', 'kkm', 'siswa'));
        return $pdf->stream($judul.".pdf");
    }

    public function profil_siswa (Request $request, $nisn){
        $siswa = Siswa::find($nisn);
        return view('wali.profil_siswa', compact('siswa'));
    }
}
