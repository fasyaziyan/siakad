<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function postLogin(Request $request){
           if(Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password])){
        return redirect('/dashboard');  
    }
    elseif(Auth::guard('siswa')->attempt(['email' => $request->email, 'password' => $request->password])){
        return redirect('/dashboard2');
    }
    elseif(Auth::guard('guru')->attempt(['email' => $request->email, 'password' => $request->password])){
        return redirect('/dashboard');
    }
    return redirect('/')->with('error', 'Email or Password is incorrect');
}
public function logout(Request $request){
    // dd($request-> all());
    if (Auth::guard('user')->check()){
        Auth::guard('user')->logout();
    }
    elseif (Auth::guard('siswa')->check()){
        Auth::guard('siswa')->logout();
    }
    elseif (Auth::guard('guru')->check()){
        Auth::guard('guru')->logout();
    }
    return redirect('/');
}
}