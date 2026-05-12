<?php

use App\Http\Controllers\PegawaiController;
use App\Models\Pegawai;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//route biasa
Route::get('/pegawai', function () {
    return view('pegawai');
});

//route parameter
// Route::get('/pegawai/detail/{nama}', function (string $nama){
//     return "Nama pegawai ini adalah : $nama";
// });

//route parameter optional
Route::get('/pegawai/detail/{nama?}', function (string $nama = null) {
    return "Nama pegawai ini adalah : $nama";
});

//name route
Route::get('/pegawai/cek_absensi/maret', function () {
    return "Absensi pegawai pada bulan maret";
})->name('cek_absensi');

//follback route
Route::fallback(function () {
    return view('404');
});

Route::get('/coba_query', function () {
    // $pegawai = Pegawai::all();//==Select * from pegawais;
    // dd($pegawai->toArray());
    // $pegawai = Pegawai::find(29);//==Select * from pegawais where id = 29;
    // dd($pegawai->toArray());

    //$pegawai = Pegawai::where('nama_pegawai', "Gatra Wasita")->first();
    //$pegawai = Pegawai::where('umur', '<', 35)->get();

    //Pegawai::where('nama_pegawai', 'Gatra Wasita')->delete();
    //Pegawai::destroy(30);

    Pegawai::where('id', 40)->update([
        'nama_pegawai' => 'ahmad santoso'
    ]);
    //dd($pegawai->toArray());
});

Route::resource('pegawai', PegawaiController::class);

//route redirect
// Route::get('/test', function (){
//     return redirect()->route('cek_absensi');
//     // return redirect()->to('/pegawai/cek_absensi/januari');
//     // return redirect()->away('https://laravel.com/');
// });