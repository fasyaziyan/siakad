<?php

namespace App\Http\Controllers;
use App\Models\Kelas;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\Tingkat;
use App\Models\Kurikulum;
use App\Rules\TingkatValidate;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade as PDF;
use Yajra\DataTables\DataTables;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class KelasController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Kelas::with('kurikulum', 'guru', 'tingkat')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->rawColumns(['action'])
                    ->make(true);
            dd($data);
        }
        return view('kelas.index');
    }

    public function create()
    {
        $kelas = Kelas::get();
        $guru = Guru::get();
        $tingkat = Tingkat::get();
        $kurikulum = Kurikulum::get();
        return view('kelas.create',compact('kelas', 'guru', 'tingkat', 'kurikulum'));
    }

    public function store(Request $request)
    {
        $id = IdGenerator::generate(['table' => 'kelas', 'field' => 'id_kelas', 'length' => 10, 'prefix' =>'KLS-']);

        $request->validate([
            'nama_kelas' => 'required',
            'id_tingkat' => ['required', new TingkatValidate],
            'nip' => 'required',
        ],
        [
            'nama_kelas.required' => 'Nama Kelas harus diisi!',
            'nip.required' => 'NIP harus diisi!',
        ]);

        $kelas = new Kelas;
        $kelas->id_kelas = $id;
        $kelas->nip = $request->nip;
        $kelas->id_tingkat = $request->id_tingkat;
        $kelas->nama_kelas = $request->nama_kelas;
        $kelas->id_kuri = $request->id_kuri;
        $kelas->save();

        return redirect()->route('kelas.index')->with('simpan', 'Data Berhasil Ditambah');
    }

    public function edit(Request $request, $id_kelas){
        $kelas = Kelas::findorFail($id_kelas);
        $guru = Guru::get();
        $tingkat = Tingkat::get();
        $kurikulum = Kurikulum::get();
        return view('kelas.edit', compact('kelas', 'guru', 'tingkat', 'kurikulum'));
    }

    public function update(Request $request, $id_kelas){
        $kelas = Kelas::find($id_kelas);

        $request->validate([
            'nama_kelas' => 'required',
            'nip' => 'required',
        ],
        [
            'nama_kelas.required' => 'Nama Kelas harus diisi!',
            'tahun.required' => 'Tahun harus diisi!',
            'nip.required' => 'NIP harus diisi!',
        ]);

        $kelas -> id_kelas = $request->id_kelas;
        $kelas -> nip = $request->nip;
        $kelas -> id_tingkat = $request->id_tingkat;
        $kelas -> nama_kelas = $request->nama_kelas;
        $kelas->id_kuri = $request->id_kuri;

        $kelas -> update();
        return redirect()->route('kelas.index')->with('edit', 'Data Berhasil Diubah');
    }

    public function destroy($id_kelas){
        $kelas = Kelas::find($id_kelas);
        $kelas -> delete();
        return redirect()->back();
    }

    public function detail_kelas($id_kelas){
        $kelas = Kelas::find($id_kelas);
        $siswa = Siswa::where('id_kelas', $id_kelas)->orderBy('nama', 'asc')->get();
        return view('admin_new.detail_kelas', compact('siswa', 'kelas'));
    }

    public function absen($kelas_id){
        $kelas = Kelas::find($kelas_id);
        $bulan = Carbon::now('Asia/Jakarta')->format('F');
        $siswa = Siswa::where('id_kelas', $kelas_id)->orderBy('nama', 'asc')->get();
        $pdf = PDF::loadView('admin_new.absen', compact('siswa', 'kelas', 'bulan'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream("Absensi ".$kelas->tingkat->nama_tingkat."-".$kelas->nama_kelas." ".$bulan.".pdf");
    }
}
