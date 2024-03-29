<?php

namespace App\Http\Controllers;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Guru;
use App\Models\Mapel;
use App\Models\Tingkat;
use App\Models\Jadwal;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request){
        $siswa = Siswa::count();
        $kelas = Kelas::count();
        $guru = Guru::count();
        $mapel = Mapel::count();

        $list_kelas = Kelas::leftJoin('tingkat', 'tingkat.id_tingkat', '=', 'kelas.id_tingkat')->select('kelas.id_kelas', 'kelas.nama_kelas', 'tingkat.nama_tingkat')->get();

        $id_kelas = Kelas::orderBy('id_kelas', 'asc')->get()->pluck('id_kelas')->toArray();
        foreach ($id_kelas as $id_kelas) {
            $siswa_kelas_count[] = Siswa::where('id_kelas', $id_kelas)->count();
        }
        $siswa_kelas_count = json_encode($siswa_kelas_count);
        
        $data_kelas = Kelas::get();

        $date = Carbon::now('Asia/Jakarta');
        $date = $date->format('d-M-Y');

        $jadwal = Jadwal::where('status', 'Active')->get();
        return view('dashboard', compact('siswa', 'kelas', 'guru', 'mapel', 'list_kelas', 'siswa_kelas_count', 'data_kelas', 'date', 'jadwal'));
    }

    public function peringkat (Request $request){
        $id_kuri = Kelas::find($request->id_kelas)->id_kuri;
        $data_siswa = Siswa::where('id_kelas', $request->id_kelas)->orderBy('nama', 'asc')->select('nisn')->get();
        $data2 = [];
        foreach ($data_siswa as $item => $value) {
            $data2[] = $value->nisn;
        }
        //Data Araay Namma
        $data_siswa_nama = Siswa::where('id_kelas', $request->id_kelas)->orderBy('nama', 'asc')->select('nama')->get();
        $data3 = [];
        foreach ($data_siswa_nama as $item => $value) {
            $data3[] = $value->nama;
        }

        foreach ($data2 as $item => $value) {
            $siswa_kelas[] = Siswa::leftJoin('detnilai', 'siswa.nisn', '=', 'detnilai.nisn')->where('siswa.nisn', '=', $value)->leftJoin('mapel', 'mapel.id_mapel', '=', 'detnilai.id_mapel')->where('mapel.id_kelas', '=', $request->id_kelas)->where('detnilai.id_kuri', '=', $id_kuri)->get();
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
        return $array_gabung;
    }

    public function index1()
    {
        return view('layout.login');
    }

    public function index_siswa(){
        $date = Carbon::now('Asia/Jakarta');
        $date = $date->format('d-M-Y');

        //List Nama Mapel
        $id_kelas = Auth::guard('siswa')->user()->id_kelas;
        $list_mapel = Mapel::where('id_kelas', $id_kelas)->get();
        $mapel = [];
        foreach ($list_mapel as $item => $value) {
            $mapel[] = $value->nama_mapel;
        }
        $mapel = json_encode($mapel);

        $id_kuri = Kelas::where('id_kelas', $id_kelas)->value('id_kuri');
        $id_mapel = [];
        foreach ($list_mapel as $item => $value) {
            $id_mapel[] = $value->id_mapel;
        }
        foreach ($id_mapel as $item => $value) {
            $nilai[] = Mapel::leftJoin('detnilai', 'mapel.id_mapel', '=', 'detnilai.id_mapel')->where('detnilai.id_mapel', '=', $value)->where('detnilai.id_kuri', '=', $id_kuri)->where('detnilai.id_kelas', '=', $id_kelas)->get();
        }
        $nilai_mapel = [];
        foreach ($nilai as $item => $value) {
            $nilai_mapel[] = $value->sum('nilai');
        }
        $jumlah_siswa = Siswa::where('id_kelas', $id_kelas)->count();
        foreach ($nilai_mapel as $item => $value) {
            $nilai_rata[] = $value / $jumlah_siswa;
        }
        $nilai_rata = json_encode($nilai_rata);
        return view('dashboard2', compact('date', 'mapel', 'nilai_rata'));
    }
}
