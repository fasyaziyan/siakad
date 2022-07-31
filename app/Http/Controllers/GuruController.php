<?php

namespace App\Http\Controllers;
use App\Models\Guru;
use App\Models\Mapel;
use App\Models\Kelas;
use App\Models\Detail_guru;
use App\Models\Siswa;
use App\Models\Nilai;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class GuruController extends Controller
{
    public function index(Request $request) {
        if ($request->ajax()) {
            $data = Guru::get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('guru.index');
    }

    public function create(){
        return view('guru.create');
    }

    public function store(Request $request){
        $request->validate(
            [
                'nip' => 'required|numeric',
                'nama_guru' => 'required',
                'tempat_lahir' => 'required',
                'alamat' => 'required',
                'telepon' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|max:15|min:10',
                'jenis_kelamin' => 'required',
                'tanggal_lahir' => 'required',
                'agama' => 'required',
                'pendidikan' => 'required',
                'email' => 'required|email:rfc,dns',
                'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
            [
                'nip.required' => 'NIP harus diisi!',
                'nip.numeric' => 'NIP harus berupa angka!',
                'nama_guru.required' => 'Nama harus diisi!',
                'tempat_lahir.required' => 'Tempat lahir harus diisi!',
                'alamat.required' => 'Alamat harus diisi!',
                'telepon.required' => 'Telepon harus diisi!',
                'telepon.regex' => 'Telepon harus berupa angka!',
                'telepon.max' => 'Telepon maksimal 15 karakter!',
                'telepon.min' => 'Telepon minimal 10 karakter!',
                'agama.required' => 'Agama harus diisi!',
                'pendidikan.required' => 'Pendidikan harus diisi!',
                'email.required' => 'Email harus diisi!',
                'email.email' => 'Email harus valid!',
                'foto.image' => 'Foto harus berupa gambar!',
                'foto.mimes' => 'Foto harus berupa gambar!',
                'foto.max' => 'Foto maksimal 2 Mb',
                'jenis_kelamin.required' => 'Jenis kelamin harus diisi!',
                'tanggal_lahir.required' => 'Tanggal lahir harus diisi!',
            ]
        );
        $data = $request->all();
        $levels = 'guru';
        $pass= strtok($request->nama_guru, " ")."123";
        $bypass = Hash::make($pass);

        $guru = new Guru;
        $guru->nip = $request->nip;
        $guru->nama_guru = $request->nama_guru;
        $guru->jenis_kelamin = $request->jenis_kelamin;
        $guru->tempat_lahir = $request->tempat_lahir;
        $guru->tanggal_lahir = $request->tanggal_lahir;
        $guru->alamat = $request->alamat;
        $guru->telepon = $request->telepon;
        $guru->agama = $request->agama;
        $guru->pendidikan = $request->pendidikan;
        $guru->email = $request->email;
        $guru->level = $levels;
        $guru->password = $bypass;

        if ($request->file('foto')) {
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('img/guru/', $filename);
            $guru->foto = $filename;
        }
        // dd($data);
        $guru->save();

        return redirect()->route('guru.index')->with('simpan', 'Data Berhasil Ditambah');
    }
    public function edit(Request $request, $nip){
        $guru = Guru::findorFail($nip);
        $mapel = Mapel::get();
        $kelas = Kelas::get();
        $detguru = Detail_guru::where('nip', $nip)->get();
        return view('guru.edit', compact('guru', 'kelas', 'mapel', 'detguru'));
    }
    public function update(Request $request, $nip){
        $guru = guru::find($nip);
        $data = $request->all();

        $request->validate(
            [
                'nama_guru' => 'required',
                'tempat_lahir' => 'required',
                'alamat' => 'required',
                'telepon' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|max:15|min:10',
                'jenis_kelamin' => 'required',
                'tanggal_lahir' => 'required',
                'agama' => 'required',
                'pendidikan' => 'required',
                'email' => 'required|email:rfc,dns',
                'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
            [
                'nama_guru.required' => 'Nama harus diisi!',
                'tempat_lahir.required' => 'Tempat lahir harus diisi!',
                'alamat.required' => 'Alamat harus diisi!',
                'telepon.required' => 'Telepon harus diisi!',
                'telepon.regex' => 'Telepon harus berupa angka!',
                'telepon.max' => 'Telepon maksimal 15 karakter!',
                'telepon.min' => 'Telepon minimal 10 karakter!',
                'agama.required' => 'Agama harus diisi!',
                'pendidikan.required' => 'Pendidikan harus diisi!',
                'email.required' => 'Email harus diisi!',
                'email.email' => 'Email harus valid!',
                'foto.image' => 'Foto harus berupa gambar!',
                'foto.mimes' => 'Foto harus berupa gambar!',
                'foto.max' => 'Foto maksimal 2 Mb',
                'jenis_kelamin.required' => 'Jenis kelamin harus diisi!',
                'tanggal_lahir.required' => 'Tanggal lahir harus diisi!',
            ]
        );

        $guru->nip = $request->nip;
        $guru->nama_guru = $request->nama_guru;
        $guru->jenis_kelamin = $request->jenis_kelamin;
        $guru->tempat_lahir = $request->tempat_lahir;
        $guru->tanggal_lahir = $request->tanggal_lahir;
        $guru->alamat = $request->alamat;
        $guru->telepon = $request->telepon;
        $guru->agama = $request->agama;
        $guru->pendidikan = $request->pendidikan;
        $guru->email = $request->email;

        //update foto
        if ($request->file('foto')) {
            if ($request->oldfoto) {
                unlink('img/guru/' . $request->oldfoto);
            }
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('img/guru/', $filename);
            $guru->foto = $filename;
        }
        $guru -> update();

        return redirect()->route('guru.index')->with('edit', 'Data Berhasil Diubah');
    }
    public function destroy($nip){
        $guru = guru::find($nip);
        if ($guru->foto) {
            unlink('img/guru/' . $guru->foto);
        }
        $guru->delete();
        return redirect()->back();
    }
    public function profile (Request $request){

        $guru = Auth::guard('guru')->user();

        return view('guru.profile', compact('guru'));
    }
    public function raport (Request $request){
        $nip = Auth::guard('guru')->user()->nip;
        if ($request->ajax()) {
            $data = Mapel::where('nip', $nip)->with('kelas.tingkat')->orderBy('id_kelas', 'asc')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->rawColumns(['action'])
                    ->make(true);
        }
        // $cek = Kelas::where('nip', $nip)->exists();
        // dd($cek);
        return view('guru_new.raport');
    }
    public function change_password(){
        return view('guru_new.change_password');
    }
}