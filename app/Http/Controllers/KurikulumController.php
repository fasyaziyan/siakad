<?php

namespace App\Http\Controllers;
use App\Models\Kurikulum;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Yajra\DataTables\DataTables;

use Illuminate\Http\Request;

class KurikulumController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Kurikulum::get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('kurikulum.index');
    }

    public function create()
    {
        $kurikulum = Kurikulum::get();
        return view('kurikulum.create',compact('kurikulum'));
    }

    public function store(Request $request)
    {
        $id = IdGenerator::generate(['table' => 'kurikulum', 'field' => 'id_kuri', 'length' => 10, 'prefix' =>'KRK-']);

        $request->validate([
            'tahun_ajaran1' => 'required|numeric',
            'tahun_ajaran2' => 'required|numeric',
            'semester' => 'required',
        ],
        [
            'tahun_ajaran1.required' => 'Tahun ajaran 1 harus diisi',
            'tahun_ajaran1.numeric' => 'Tahun ajaran harus berupa angka',
            'tahun_ajaran2.required' => 'Tahun ajaran 2 harus diisi',
            'tahun_ajaran2.numeric' => 'Tahun ajaran harus berupa angka',
            'semester.required' => 'Semester harus diisi',
        ]);
        $tahun_ajaran = $request->tahun_ajaran1.'/'.$request->tahun_ajaran2;

        $kurikulum = new Kurikulum;
        $kurikulum->id_kuri = $id;
        $kurikulum->tahun_ajaran = $tahun_ajaran;
        $kurikulum->semester = $request->semester;
        $kurikulum->save();

        return redirect()->route('kurikulum.index')->with('simpan', 'Data Berhasil Ditambah');
    }

    public function edit(Request $request, $id_kuri){
        $kurikulum = Kurikulum::find($id_kuri);
        $tahun_ajaran1 = substr($kurikulum->tahun_ajaran, 0, 4);
        $tahun_ajaran2 = substr($kurikulum->tahun_ajaran, 5, 4);
        return view('kurikulum.edit', compact('kurikulum', 'tahun_ajaran1', 'tahun_ajaran2'));
    }

    public function update(Request $request, $id_kuri){
        $kurikulum = Kurikulum::find($id_kuri);

        $request->validate([
            'tahun_ajaran1' => 'required|numeric',
            'tahun_ajaran2' => 'required|numeric',
            'semester' => 'required',
        ],
        [
            'tahun_ajaran1.required' => 'Tahun ajaran 1 harus diisi',
            'tahun_ajaran1.numeric' => 'Tahun ajaran harus berupa angka',
            'tahun_ajaran2.required' => 'Tahun ajaran 2 harus diisi',
            'tahun_ajaran2.numeric' => 'Tahun ajaran harus berupa angka',
            'semester.required' => 'Semester harus diisi',
        ]);

        $tahun_ajaran = $request->tahun_ajaran1.'/'.$request->tahun_ajaran2;

        $kurikulum -> id_kuri = $request->id_kuri;
        $kurikulum -> tahun_ajaran = $tahun_ajaran;
        $kurikulum-> semester = $request->semester;
        $kurikulum -> update();
        return redirect()->route('kurikulum.index')->with('edit', 'Data Berhasil Diubah');
    }

    public function destroy($id_kuri){
        $kurikulum = Kurikulum::find($id_kuri);
        $kurikulum -> delete();
        return redirect()->back();
    }
}
