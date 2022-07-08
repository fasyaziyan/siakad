<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Mapel;
use App\Models\Kelas;
use App\Models\Nilai;
use App\Models\KKM;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

use function Ramsey\Uuid\v1;

class SiswaController extends Controller
{
    public function index(Request $request) {
        if ($request->ajax()) {
            $data = Siswa::with('kelas.tingkat')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('siswa.index');
    }

    public function create(){
        $kelas = Kelas::get();
        return view('siswa.add', compact('kelas'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nisn' => 'required|numeric|min:10|unique:siswa',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'nama_ayah' => 'required',
            'nama_ibu' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
            'agama' => 'required',
            'email' => 'required|email',
            'id_kelas' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'nisn.required' => 'NISN harus diisi!',
            'nisn.min' => 'NISN harus 10 karakter!',
            'nisn.unique' => 'NISN sudah terdaftar!',
            'nisn.numeric' => 'NISN harus berupa angka!',
            'nama.required' => 'Nama harus diisi!',
            'jenis_kelamin.required' => 'Jenis kelamin harus diisi!',
            'tempat_lahir.required' => 'Tempat lahir harus diisi!',
            'tanggal_lahir.required' => 'Tanggal lahir harus diisi!',
            'nama_ayah.required' => 'Nama ayah harus diisi!',
            'nama_ibu.required' => 'Nama ibu harus diisi!',
            'alamat.required' => 'Alamat harus diisi!',
            'telepon.required' => 'Telepon harus diisi!',
            'telepon.integer' => 'Telepon harus berupa angka!',
            'agama.required' => 'Agama harus diisi!',
            'email.required' => 'Email harus diisi!',
            'email.email' => 'Email harus valid!',
            'id_kelas.required' => 'Kelas harus diisi!',
            'foto.image' => 'Foto harus berupa gambar!',
            'foto.mimes' => 'Foto harus berupa gambar!',
            'foto.max' => 'Foto tidak boleh lebih dari 2MB!',
        ]);
        $levels = 'siswa';
        $pass= strtok($request->nama, " ")."123";
        $bypass = Hash::make($pass);

        $siswa = new Siswa;
        $siswa->nisn = $request->nisn;
        $siswa->nama = $request->nama;
        $siswa->jenis_kelamin = $request->jenis_kelamin;
        $siswa->tempat_lahir = $request->tempat_lahir;
        $siswa->tanggal_lahir = $request->tanggal_lahir;
        $siswa->alamat = $request->alamat;
        $siswa->telepon = $request->telepon;
        $siswa->agama = $request->agama;
        $siswa->nama_ayah = $request->nama_ayah;
        $siswa->nama_ibu = $request->nama_ibu;
        $siswa->id_kelas = $request->id_kelas;
        $siswa->email = $request->email;
        $siswa->password = $bypass;
        $siswa->level = $levels;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('img/siswa/', $filename);
            $siswa->foto = $filename;
        } else {
            $siswa->foto = 'default.png';
        }

        $siswa->save();
        return redirect()->route('siswa.index')->with('simpan', 'Data Berhasil Ditambah');
    }
    public function edit(Request $request, $nisn){
        $siswa = Siswa::findorFail($nisn);
        $kelas = Kelas::get();
        return view('siswa.edit', compact('siswa', 'kelas'));
    }

    public function update(Request $request, $nisn){
        $siswa = Siswa::find($nisn);
        $this->validate($request, [
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'nama_ayah' => 'required',
            'nama_ibu' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
            'agama' => 'required',
            'email' => 'required|email',
            'id_kelas' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'nama.required' => 'Nama harus diisi!',
            'jenis_kelamin.required' => 'Jenis kelamin harus diisi!',
            'tempat_lahir.required' => 'Tempat lahir harus diisi!',
            'tanggal_lahir.required' => 'Tanggal lahir harus diisi!',
            'nama_ayah.required' => 'Nama ayah harus diisi!',
            'nama_ibu.required' => 'Nama ibu harus diisi!',
            'alamat.required' => 'Alamat harus diisi!',
            'telepon.required' => 'Telepon harus diisi!',
            'telepon.integer' => 'Telepon harus berupa angka!',
            'agama.required' => 'Agama harus diisi!',
            'email.required' => 'Email harus diisi!',
            'email.email' => 'Email harus valid!',
            'id_kelas.required' => 'Kelas harus diisi!',
            'foto.image' => 'Foto harus berupa gambar!',
            'foto.mimes' => 'Foto harus berupa gambar!',
            'foto.max' => 'Foto tidak boleh lebih dari 2MB!',
        ]);

        $siswa->nisn = $request->nisn;
        $siswa->nama = $request->nama;
        $siswa->jenis_kelamin = $request->jenis_kelamin;
        $siswa->tempat_lahir = $request->tempat_lahir;
        $siswa->tanggal_lahir = $request->tanggal_lahir;
        $siswa->alamat = $request->alamat;
        $siswa->telepon = $request->telepon;
        $siswa->agama = $request->agama;
        $siswa->nama_ayah = $request->nama_ayah;
        $siswa->nama_ibu = $request->nama_ibu;
        $siswa->id_kelas = $request->id_kelas;
        $siswa->email = $request->email;

        if ($request->hasFile('foto')) {
            if ($request->oldfoto){
                unlink('img/siswa/'.$request->oldfoto);
            }
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('img/siswa/', $filename);
            $siswa->foto = $filename;
        } else {
            $siswa->foto = 'default.png';
        }
        
        $siswa->update();
        return redirect()->route('siswa.index')->with('edit', 'Data Berhasil Diubah');
    }
    public function destroy($nisn){
        $siswa = Siswa::find($nisn);
        if ($siswa->foto) {
            unlink('img/siswa/'.$siswa->foto);
        }
        $siswa->delete();
        return redirect()->back();
    }
    public function profile (Request $request){
        $siswa = Auth::guard('siswa')->user();
        // dd($siswa);
        return view('siswa.profile', compact('siswa'));
    }

    //craete function validate check
    public function check(Request $request){
        $request->validate([
            'email' => 'required|exists:siswa,email',
            'password' => 'required'
        ]);

        $creds = $request->only('email', 'password');

        if( Auth::guard('siswa')->attempt($creds)){
            return redirect()->route('siswas.home');
        }else {
            return redirect()->route('siswas.login')->with('fail', 'Incorrect Credentials');
        }
    }

    //create function Logout
    public function logout(){
        Auth::guard('siswa')->logout();
        return redirect()->route('siswas.login');
    }

    public function index_rapot (Request $request) {
        if ($request->ajax()) {
            $data = Nilai::with('kurikulum')->where('nisn', Auth::guard('siswa')->user()->nisn)->distinct()->get(['id_kuri']);
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('siswa.rapot');
    }

    public function rapot_detail (Request $request, $id_kuri){
        $id_kelas = Auth::guard('siswa')->user()->id_kelas;
        $nisn = Auth::guard('siswa')->user()->nisn;
        $siswa = Siswa::find(Auth::guard('siswa')->user()->nisn);
        $kkm = Kkm::first()->set_kkm;
        $nilai = Mapel::leftJoin('detnilai', 'mapel.id_mapel', '=', 'detnilai.id_mapel')->leftjoin('rapot', 'rapot.nisn', '=', 'detnilai.nisn')->where('mapel.id_kelas', $id_kelas)->where('detnilai.nisn', '=', $nisn)->where('detnilai.id_kuri', '=', $id_kuri)->get();

        $jumlah = [];
        foreach ($nilai as $key => $value) {
            $jumlah[$key] = $value->nilai;
        }
        $total = array_sum($jumlah);
        $rata_rata = $total / count($jumlah);
        return view('siswa.detail', compact('nilai', 'siswa', 'kkm', 'total', 'rata_rata'));
    }

    public function rapot_cetak (Request $request, $id_kuri){
        $siswa = Siswa::find(Auth::guard('siswa')->user()->nisn);
        $nisn = Siswa::where('nisn', $siswa->nisn)->value('nisn');
        $id_kelas = Siswa::where('nisn', $nisn)->value('id_kelas');
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
        // return view('siswa.cetak', compact('nilai', 'no', 'total', 'rata_rata', 'kkm', 'siswa'));
        $pdf = PDF::loadview('siswa.cetak',compact('nilai', 'no', 'total', 'rata_rata', 'kkm', 'siswa'));
        return $pdf->stream($judul.".pdf");
    }
}