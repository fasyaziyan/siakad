<?php

namespace App\Http\Controllers;
use App\Models\Nilai;
use App\Models\Mapel;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Rapot;
use App\Models\KKM;
use Yajra\DataTables\DataTables;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    public function store(Request $request){
        $reqnilai = $request->nilai;
        $reqnisn = $request->nisn;
        $reqmapel = $request->id_mapel;
        $reqkelas = $request->id_kelas;
        $data = $request->all();

        // for ($i = 0; $i < count($reqnilai); $i++){
        //     $save =[
        //         $detnilai = new Nilai,
        //         $detnilai->nisn = $reqnisn,
        //         $detnilai->id_kelas = $reqmapel,
        //         $detnilai->id_mapel = $reqkelas,
        //         $detnilai->nilai = $reqnilai,
        //     ];
        //     $detnilai->save($save);
        // }
        // if (count($request-> nilai) > 0){
        //     foreach($request-> nilai as $item => $value) {
        //         $data2 = array(
        //             // $detnilai = Nilai::where(['nisn' => $data['nisn'], 'id_kelas' => $data['id_kelas'], 'id_mapel' => $data['id_mapel'] ]),
        //             $detnilai = new Nilai,
        //             $detnilai->nisn = $data['nisn'][$item],
        //             $detnilai->id_kelas = $data ['id_kelas'][$item],
        //             $detnilai->id_mapel = $data['id_mapel'][$item],
        //             $detnilai->nilai = $data['nilai'][$item],
        //         );
        //         if (Nilai::where(['nisn' => $data['nisn'][$item], 'id_kelas' => $data['id_kelas'][$item], 'id_mapel' => $data['id_mapel'][$item]])->exists()){
        //             $detnilai->nilai = $data['nilai'][$item];
        //             $detnilai->update($data2);
        //         } else {
        //             $detnilai->save($data2);
        //         }
        //     }
        // }
        foreach ($request-> nilai as $item => $value) {
            Nilai::updateOrCreate(['nisn' => $data['nisn'][$item], 'id_kelas' => $data['id_kelas'][$item], 'id_mapel' => $data['id_mapel'][$item], 'id_kuri' => $data['id_kuri'][$item]], ['nilai' => $data['nilai'][$item]]);
        }        
        return redirect()->route('raport.mapel')->with('success', 'Data Nilai Berhasil Ditambahkan');
    }
    
    public function shownilai (Request $request, $id_mapel){
        $mapel = Mapel::find($id_mapel);
        $siswa2 = Siswa::where('id_kelas', $mapel->id_kelas)->select('nisn')->get();
        $id_kuri = Kelas::where('id_kelas', $mapel->id_kelas)->select('id_kuri')->first();
        foreach ($siswa2 as $item => $value) {
            Nilai::updateOrCreate(['nisn' => $value->nisn, 'id_kelas' => $mapel->id_kelas, 'id_mapel' => $mapel->id_mapel, 'id_kuri' => $id_kuri->id_kuri]);
        }
        $siswa = Siswa::where('id_kelas', $mapel->id_kelas)->get();
        $jml = $siswa->count();
        // $detnilai = Nilai::rightJoin('siswa', 'siswa.nisn', '=', 'detnilai.nisn')->where('siswa.id_kelas' , $mapel->id_kelas)->get();
        $detnilai = Siswa::leftJoin('detnilai', 'detnilai.nisn', '=', 'siswa.nisn')->leftjoin('mapel', 'detnilai.id_mapel', '=', 'mapel.id_mapel')->where('siswa.id_kelas' , $mapel->id_kelas)->where('detnilai.id_mapel', $mapel->id_mapel)->orderBy('siswa.nama', 'asc')->get();
        // dd($detnilai);
        return view('guru_new.nilai', compact('mapel', 'siswa', 'jml', 'detnilai'));
    }

    public function show (Request $request){
        if ($request->ajax()) {
            $data = Siswa::with('kelas.tingkat')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->rawColumns(['action'])
                    ->make(true);
        }
        $kkm = Kkm::first()->set_kkm;
        return view('admin_new.raport', compact('kkm'));
    }

    public function shownilaiadmin (Request $request, $nisn){
        $siswa = Siswa::find($nisn);
        $kkm = Kkm::first()->set_kkm;
        // $siswa = Siswa::where('id_kelas', $mapel->id_kelas)->get();
        // $jml = $siswa->count();
        // $detnilai = Nilai::rightJoin('siswa', 'siswa.nisn', '=', 'detnilai.nisn')->where('siswa.id_kelas' , $mapel->id_kelas)->get();
        // $detnilai = Siswa::leftJoin('detnilai', 'detnilai.nisn', '=', 'siswa.nisn')->leftjoin('mapel', 'detnilai.id_mapel', '=', 'mapel.id_mapel')->where('siswa.id_kelas' , $mapel->id_kelas)->where('detnilai.id_mapel', $mapel->id_mapel)->get();
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
        // dd($nilai);
        $jumlah = [];
        foreach ($nilai as $key => $value) {
            $jumlah[$key] = $value->nilai;
        }
        $total = array_sum($jumlah);
        $rata_rata = $total / count($jumlah);
        Rapot::updateOrCreate(['nisn' => $nisn, 'id_kelas' => $id_kelas, 'id_kuri' => $id_kuri]);
        return view('admin_new.detail_raport', compact('siswa', 'nilai', 'kkm', 'rata_rata', 'total'));
    }

    public function nilaimapel (){
        $kelas = Kelas::get();
        return view('admin_new.nilai_mapel', compact('kelas'));
    }

    public function showmapel (Request $request, $id_kelas){
        if ($request->ajax()) {
            $data = Mapel::where('id_kelas', $id_kelas)->with('guru')->get();
            $kkm = Kkm::first()->set_kkm;
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return ;
    }

    public function showmapel_detail ($id_mapel){
        $mapel = Mapel::find($id_mapel);
        $id_kelas = Mapel::where('id_mapel', $id_mapel)->value('id_kelas');
        $id_kuri = Kelas::where('id_kelas', $id_kelas)->value('id_kuri');
        $siswa = Siswa::where('id_kelas', $id_kelas)->get();
        $siswa2 = [];
        foreach ($siswa as $item => $value) {
            $siswa2[] = $value->nisn;
        }
        foreach ($siswa2 as $item => $value) {
            Nilai::updateOrCreate(['nisn' => $value, 'id_kelas' => $id_kelas, 'id_mapel' => $id_mapel, 'id_kuri' => $id_kuri]);
        }
        $nilai = Siswa::leftJoin('detnilai', 'detnilai.nisn', '=', 'siswa.nisn')->leftjoin('mapel', 'detnilai.id_mapel', '=', 'mapel.id_mapel')->where('siswa.id_kelas' , $id_kelas)->where('detnilai.id_mapel', $id_mapel)->orderBy('siswa.nama', 'asc')->get();
        // dd($nilai);
        return view('admin_new.nilai_mapel_detail', compact('nilai', 'mapel', 'siswa'));
    }

    public function setkkm (Request $request)
    {
        $kkm = Kkm::find(1);
        $kkm->set_kkm = $request->set_kkm;
        $kkm->update();
        return redirect()->back();
    }
}