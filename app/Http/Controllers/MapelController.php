<?php

namespace App\Http\Controllers;
use App\Models\Mapel;
use App\Models\Guru;
use App\Models\Kelas;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class MapelController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Mapel::with('kelas.tingkat', 'guru')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->rawColumns(['action'])
                    ->make(true);
        }
        
        return view('mapel.index');
    }
    public function create()
    {
        $mapel = Mapel::get();
        $guru = Guru::get();
        $kelas = Kelas::get();
        return view('mapel.add',compact('guru', 'mapel', 'kelas'));
    }
    public function store(Request $request)
    {
        $id = IdGenerator::generate(['table' => 'mapel', 'field' => 'id_mapel', 'length' => 10, 'prefix' =>'MPL-']);

        $request->validate([
            'nama_mapel' => 'required',
            'nip' => 'required',
            'id_kelas' => 'required',
        ], [
            'nama_mapel.required' => 'Nama mapel harus diisi!',
            'nip.required' => 'NIP harus diisi!',
            'id_kelas.required' => 'Kelas harus diisi!',
        ]);

        $mapel = new Mapel;
        $mapel->id_mapel = $id;
        $mapel->nama_mapel = $request->nama_mapel;
        $mapel->nip = $request->nip;
        $mapel->id_kelas = $request->id_kelas;
        $mapel->save();
        // $mapel = ['Al-Quran Hadits', 'Aqidah Akhlaq', 'Fiqih', 'Sejarah Kebudayaan Islam', 'Pendidikan Kewarganegaraan', 'Bahasa Indonesia', 'Bahasa Arab', 'Bahasa Inggris', 'Matematika', 'Ilmu Pengetahuan Alam', 'Ilmu Pengetahuan Sosial', 'Seni Budaya', 'Pendidikan Jasmani', 'Informatika', 'Bahasa Jawa'];
        // foreach ($mapel as $key => $value) {
        //     $nip = Guru::inRandomOrder()->first()->nip;
        //     $mapel = new Mapel;
        //     $mapel->id_mapel = IdGenerator::generate(['table' => 'mapel', 'field' => 'id_mapel', 'length' => 10, 'prefix' =>'MPL-']);
        //     $mapel->nama_mapel = $value;
        //     $mapel->nip = $nip;
        //     $mapel->id_kelas = 'KLS-000006';
        //     $mapel->save();
        // }
        return redirect()->route('mapel.index')->with('simpan', 'Data Berhasil Ditambah');
    }
    public function edit(Request $request, $id_mapel){
        $mapel = Mapel::findorFail($id_mapel);
        $guru = Guru::get();
        $kelas = Kelas::get();
        return view('mapel.edit', compact('mapel', 'guru', 'kelas'));
    }
    public function update(Request $request, $id_mapel){
        $mapel = Mapel::find($id_mapel);

        $request->validate([
            'nama_mapel' => 'required',
            'nip' => 'required',
            'id_kelas' => 'required',
        ], [
            'nama_mapel.required' => 'Nama mapel harus diisi!',
            'nip.required' => 'NIP harus diisi!',
            'id_kelas.required' => 'Kelas harus diisi!',
        ]);

        $mapel -> id_mapel = $request->id_mapel;
        $mapel -> nama_mapel = $request->nama_mapel;
        $mapel -> nip = $request->nip;
        $mapel->id_kelas = $request->id_kelas;

        $mapel -> update();
        return redirect()->route('mapel.index')->with('edit', 'Data Berhasil Diubah');
    }
    public function destroy($id_mapel){
        $mapel = Mapel::find($id_mapel);
        $mapel -> delete();
        return redirect()->back();
    }
}
