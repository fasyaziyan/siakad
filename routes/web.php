<?php

use App\Http\Controllers\SiswaController;
use App\Http\Controllers\WaliController;
use Doctrine\Inflector\Rules\Word;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



// Route::get('/', 'HomeController@index1')->name('login');
// Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');
// Route::post('/', 'Auth\LoginController@login')->name('login');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/', function () {
    return view('layout.login');
});
Route::get('/login',function () {
    return view('auth.login');
})->name('login');
Route::post('/postlogin','LoginController@postlogin')->name('postlogin');
Route::get('/logout','LoginController@logout')->name('logout');

Route::group(['middleware' => ['auth:user,siswa,guru','ceklevel:admin,siswa,guru']],function () {
    Route::get('/dashboard', 'HomeController@index')->name('dashboard');
    Route::get('/dashboard/peringkat', 'HomeController@peringkat')->name('peringkat');
    Route::get('/dashboard2', 'HomeController@index_siswa')->name('dashboard2');
    Route::get('/profileguru', 'GuruController@profile')->name('profile.gur');
    Route::prefix('kelas')->group(function () {
        Route::get('/', 'KelasController@index')->name('kelas.index');
        Route::get('/create', 'KelasController@create')->name('kelas.create');
        Route::post('/', 'KelasController@store')->name('kelas.store');
        Route::get('/edit/{id_kelas}', 'KelasController@edit')->name('kelas.edit');
        Route::post('/update/{id_kelas}', 'KelasController@update')->name('kelas.update');
        Route::post('/delete/{id_kelas}', 'KelasController@destroy')->name('kelas.destroy');
        Route::get('/show/{id_kelas}', 'KelasController@detail_kelas')->name('kelas.detail_kelas');
        Route::get('/absen/{kelas_id}', 'KelasController@absen')->name('kelas.absen');
    });
    Route::prefix('guru')->group(function () {
        Route::get('/', 'GuruController@index')->name('guru.index');
        Route::get('/create', 'GuruController@create')->name('guru.create');
        Route::post('/', 'GuruController@store')->name('guru.store');
        Route::get('/edit/{nip}', 'GuruController@edit')->name('guru.edit');
        Route::post('/update/{nip}', 'GuruController@update')->name('guru.update');
        Route::post('/delete/{nip}', 'GuruController@destroy')->name('guru.destroy');
        Route::get('/change_password', 'GuruController@change_password')->name('guru.change_password');
    });
    
    Route::prefix('mapel')->group(function () {
        Route::get('/', 'MapelController@index')->name('mapel.index');
        Route::get('/create', 'MapelController@create')->name('mapel.create');
        Route::post('/', 'MapelController@store')->name('mapel.store');
        Route::get('/edit/{id_mapel}', 'MapelController@edit')->name('mapel.edit');
        Route::post('/update/{id_mapel}', 'MapelController@update')->name('mapel.update');
        Route::post('/delete/{id_mapel}', 'MapelController@destroy')->name('mapel.destroy');
        Route::get('/json', 'MapelController@json')->name('mapel.json');

    });
    
    Route::prefix('rapot')->group(function () {
        Route::get('/', 'RaportController@index')->name('raport.index');
        Route::get('/index2', 'RaportController@index2')->name('raport.index2');
        Route::get('/create', 'RaportController@create')->name('raport.create');
        Route::get('/create2', 'RaportController@create2')->name('raport.create2');
        Route::get('/create3', 'RaportController@create3')->name('raport.create3');
        Route::post('/', 'RaportController@store')->name('raport.store');
        Route::get('/edit/{id_rapot}', 'RaportController@edit')->name('raport.edit');
        Route::post('/update/{id_rapot}', 'RaportController@update')->name('raport.update');
        Route::post('/delete/{id_rapot}', 'RaportController@destroy')->name('raport.destroy');
        Route::get('/cetak/{id_rapot}', 'RaportController@cetakpdf')->name('raport.cetakpdf');
        Route::post('/nilaikurang', 'RaportController@nilai_kurang')->name('raport.nilaikurang');

        Route::get('/mapel', 'GuruController@raport')->name('raport.mapel');
        Route::get('/mapel/{id_mapel}', 'NilaiController@shownilai')->name('nilai.show');
        Route::post('/mapel/create', 'NilaiController@store')->name('nilai.store');
        Route::post('/update', 'NilaiController@update')->name('nilai.update');

    });
    
    Route::prefix('kurikulum')->group(function () {
        Route::get('/', 'KurikulumController@index')->name('kurikulum.index');
        Route::get('/create', 'KurikulumController@create')->name('kurikulum.create');
        Route::post('/', 'KurikulumController@store')->name('kurikulum.store');
        Route::get('/edit/{id_kuri}', 'KurikulumController@edit')->name('kurikulum.edit');
        Route::post('/update/{id_kuri}', 'KurikulumController@update')->name('kurikulum.update');
        Route::post('/delete/{id_kuri}', 'KurikulumController@destroy')->name('kurikulum.destroy');
    });
    
    Route::prefix('siswa')->group(function () {
        Route::get('/', 'SiswaController@index')->name('siswa.index');
        Route::get('/create', 'SiswaController@create')->name('siswa.create');
        Route::post('/', 'SiswaController@store')->name('siswa.store');
        Route::get('/edit/{nisn}', 'SiswaController@edit')->name('siswa.edit');
        Route::post('/update/{nisn}', 'SiswaController@update')->name('siswa.update');
        Route::post('/delete/{nisn}', 'SiswaController@destroy')->name('siswa.destroy');
        Route::get('/profil', 'SiswaController@profile')->name('siswa.profile');
        Route::get('/rapot', 'SiswaController@index_rapot')->name('siswa.index_rapot');
        Route::get('/rapot/{id_kuri}', 'SiswaController@rapot_detail')->name('siswa.rapot_detail');
        Route::get('/rapot_cetak/{id_kuri}', 'SiswaController@rapot_cetak')->name('siswa.rapot_cetak');
    });

    Route::prefix('admin')->group(function () {
        Route::get('/', 'AdminController@index')->name('admin.index');
        Route::get('/create', 'AdminController@create')->name('admin.create');
        Route::post('/', 'AdminController@store')->name('admin.store');
        Route::get('/edit/{id}', 'AdminController@edit')->name('admin.edit');
        Route::post('/update/{id}', 'AdminController@update')->name('admin.update');
        Route::post('/delete/{id}', 'AdminController@destroy')->name('admin.destroy');
    });
    Route::prefix('nilai')->group(function () {
        Route::get('/mapels', 'NilaiController@nilaimapel')->name('nilai.mapel');
        Route::get('/show', 'NilaiController@show')->name('nilai.show2');
        Route::get('/show/{nisn}', 'NilaiController@shownilaiadmin')->name('nilai.showadmin');
        Route::get('/showmapel/{id_kelas}', 'NilaiController@showmapel')->name('nilai.showmapel');
        Route::get('/mapel/detail/{id_mapel}', 'NilaiController@showmapel_detail')->name('nilai.showmapel_detail');
        Route::post('/setkkm', 'NilaiController@setkkm')->name('nilai.setkkm');
    });
    Route::prefix('wali')->group(function () {
        Route::get('/', 'WaliController@index_rapot')->name('wali.index_rapot');
        Route::get('/{id_kelas}', 'WaliController@index_kelas')->name('wali.index_kelas');
        Route::get('/rapot/{nisn}', 'WaliController@detail_rapot')->name('wali.detail_rapot');
        Route::post('/catatan', 'WaliController@set_catatan')->name('wali.set_catatan');
        Route::get('/cetak/{nisn}', 'WaliController@cetak')->name('wali.cetak');
        Route::get('/profil/{nisn}', 'WaliController@profil_siswa')->name('wali.profil_siswa');
    });
    Route::prefix('tingkat')->group(function () {
        Route::get('/', 'TingkatController@index')->name('tingkat.index');
        Route::get('/create', 'TingkatController@create')->name('tingkat.create');
        Route::post('/', 'TingkatController@store')->name('tingkat.store');
        Route::get('/edit/{id_tingkat}', 'TingkatController@edit')->name('tingkat.edit');
        Route::post('/update/{id_tingkat}', 'TingkatController@update')->name('tingkat.update');
        Route::post('/delete/{id_tingkat}', 'TingkatController@destroy')->name('tingkat.destroy');
    });
    
    Route::get('/spp', function () {
        return view('spp/index');
    });
    
    Route::get('/staff', function () {
        return view('staff/index');
    });
    
    Route::get('/users', function () {
        return view('users/index');
    });
    
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/coba', 'RaportController@coba');
});

// Route::prefix('siswas')->name('siswas.')->group(function () {
//     Route::view('/login', 'page.siswa.login')->name('login');
//     Route::post('/check', 'SiswaController@check')->name('check');
//     Route::middleware(['auth:siswa'])->group(function () {
//         Route::view('/home', 'page.siswa.home')->name('home');
//         Route::post('/logout', 'SiswaController@logout')->name('logout');
//     });
// });
// Auth::routes();