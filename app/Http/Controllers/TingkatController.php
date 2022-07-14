<?php

namespace App\Http\Controllers;
use App\Models\Tingkat;
use App\Rules\TingkatRule;
use Yajra\DataTables\DataTables;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;


class TingkatController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Tingkat::get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->rawColumns(['action'])
                    ->make(true);
        }
        $tingkat = Tingkat::get()->count();
        return view('tingkat.index', compact('tingkat'));
    }

    public function create(){
        $tingkat = Tingkat::get();
        return view('tingkat.create', compact('tingkat'));
    }

    public function store(Request $request){
        $id = IdGenerator::generate(['table' => 'tingkat', 'field' => 'id_tingkat', 'length' => 8, 'prefix' =>'TKT-']);

        $request->validate([
            'nama_tingkat' => ['required', new TingkatRule],
        ], [
            'nama_tingkat.required' => 'Nama tingkat harus diisi!',
            'nama_tingkat.unique' => 'Nama tingkat Sudah ada!',
        ]);

        $tingkat = new Tingkat;
        $tingkat->id_tingkat = $id;
        $tingkat->nama_tingkat = $request->nama_tingkat;
        $tingkat->save();

        return redirect()->route('tingkat.index')->with('simpan', 'Data Berhasil Ditambah');
    }

    public function edit(Request $request, $id_tingkat){
        $tingkat = Tingkat::findorFail($id_tingkat);
        return view('tingkat.edit', compact('tingkat'));
    }

    public function update(Request $request, $id_tingkat){
        $tingkat = Tingkat::findorFail($id_tingkat);

        $request->validate([
            'nama_tingkat' => ['required', new TingkatRule],
        ], [
            'nama_tingkat.required' => 'Nama tingkat harus diisi!',
            'nama_tingkat.unique' => 'Nama tingkat Sudah ada!',
        ]);

        $tingkat->id_tingkat = $request->id_tingkat;
        $tingkat->nama_tingkat = $request->nama_tingkat;
        $tingkat->update();

        return redirect()->route('tingkat.index')->with('edit', 'Data Berhasil Diubah');
    }

    public function destroy($id_tingkat){
        $tingkat = Tingkat::find($id_tingkat);
        $tingkat -> delete();
        return redirect()->back();
    }
}
