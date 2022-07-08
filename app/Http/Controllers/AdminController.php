<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;
class AdminController extends Controller
{
    public function index(Request $request) {
        if ($request->ajax()) {
            $data = User::get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('admin.index');
    }

    public function create(){
        return view('admin.create');
    }

    public function store(Request $request){
        $levels = 'admin';

        $admin = new User;
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = Hash::make($request['password']);
        $admin->level = $levels;
        $admin->save();

        return redirect()->route('admin.index')->with('simpan', 'Data Berhasil Ditambah');
    }

    public function edit(Request $request, $id){
        $admin = User::findorFail($id);
        return view('admin.edit', compact('admin'));
    }

    public function update(Request $request, $id){
        $admin = User::find($id);

        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = Hash::make($request['password']);

        $admin -> update();
        return redirect()->route('admin.index')->with('edit', 'Data Berhasil Diubah');
    }

    public function destroy($id){
        $admin = User::find($id);
        $admin -> delete();
        return redirect()->back();
    }
}
