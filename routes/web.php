<?php

use App\Http\Controllers\CetakVakasiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardTahunAkademikController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\PengisianNilaiController;
use App\Http\Controllers\SettingVakasiController;
use App\Http\Controllers\VakasiNilaiController;

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

Route::get('/', function () {
    return view('login.index',[
        'title' => "Login"
    ]);
});

// Route::get('/about', function () {
//     return view('about', [
//         "title" => "About",
//         "name" => "Ilham Anugrah",
//         "email" => "ilham.anugrah@unpas.ac.id"
//     ]);
// });

// Route::get('/home', function () {
//     return view('home',[
//         "title" => "Home"
//     ]);
// });

Route::get('/posts', [PostController::class,'index']);

// halaman single post
Route::get('posts/{post:slug}',[PostController::class,'show']);

Route::get('login',[LoginController::class,'index'])->name('login')->middleware('guest');;
Route::post('login',[LoginController::class,'authenticate']);
Route::post('logout',[LoginController::class,'logout']);

// Route::get('register',[RegisterController::class,'index']);
// Route::post('register',[RegisterController::class,'store']);

// Route::get('/',[DashboardController::class,'index']);
// Route::get('dashboard',[DashboardController::class,'index'])->middleware('auth');

Route::get('dashboard', function () {
    return view('dashboard.index',[
        "title" => "Dashboard"
    ]);
})->middleware('auth');

Route::resource('/dashboard/users', DashboardUserController::class)->middleware('auth');
Route::resource('/dashboard/tahunakademiks', DashboardTahunAkademikController::class)->middleware('auth');
Route::resource('/dashboard/settingvakasis', SettingVakasiController::class)->middleware('auth');
Route::get('/dashboard/settingvakasis/edit/{id}', [SettingVakasiController::class,'edit'])->middleware('auth');
Route::delete('/dashboard/settingvakasis/delete/{id}', [SettingVakasiController::class,'destroy'])->middleware('auth');
// Route::resource('/dashboard/vakasinilais', VakasiNilaiController::class)->middleware('auth');

Route::get('/dashboard/vakasinilais', [VakasiNilaiController::class,'index'])->middleware('auth');
Route::get('/dashboard/vakasinilais/edit/{id}', [VakasiNilaiController::class,'edit'])->middleware('auth');
Route::get('/dashboard/getvakasinilais',[VakasiNilaiController::class,'getVakasiNilai'])->middleware('auth');
Route::post('/dashboard/deletevakasinilai/{id}',[VakasiNilaiController::class,'destroy'])->middleware('auth');



// Route::get('/dashboard/tahunakademiks', function () {
//     return 'ini halaman dashboard tahun akademik';
// });
// Route::get('dashboard/tahunakademiks/{tahunakademik:id}',[TahunAkademikController::class,'show']);

Route::post('/import-excel', [VakasiNilaiController::class, 'importExcel']);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// pengisian nilai
Route::get('/dashboard/pengisiannilai', [PengisianNilaiController::class,'index'])->middleware('auth');
Route::get('/dashboard/getpengisiannilai',[PengisianNilaiController::class,'getPengisianNilai'])->middleware('auth');
Route::get('/dashboard/pengisiannilai/edit/{id}', [PengisianNilaiController::class,'edit'])->middleware('auth');
Route::put('/dashboard/pengisiannilai/update/{id}', [PengisianNilaiController::class, 'update'])->middleware('auth');
Route::get('/dashboard/pengisiannilai/show/{id}', [PengisianNilaiController::class, 'mkVakasiNilai'])->middleware('auth');

Route::get('/dashboard/cetakvakasi', [CetakVakasiController::class,'index'])->middleware('auth');
Route::get('/dashboard/getcetakvakasi',[CetakVakasiController::class,'getVakasiNilai'])->middleware('auth');

Route::get('/dashboard/detailcetakvakasi/{nip}/{periode}',[CetakVakasiController::class,'detailCetakVakasi'])->middleware('auth');
Route::get('/dashboard/datavakasinilai/{id}',[CetakVakasiController::class,'getDataVakasi'])->middleware('auth');
Route::post('/dashboard/createvakasinilai',[CetakVakasiController::class,'storeDataVakasi'])->middleware('auth');
Route::post('/dashboard/updatevakasinilai',[CetakVakasiController::class,'updateDataVakasi'])->middleware('auth');

// cetak pdf
Route::get('/dashboard/cetakpdfvakasi/{nip}/{periode}/{jenis_vakasi}',[CetakVakasiController::class,'cetakpdf'])->middleware('auth');
Route::get('/dashboard/cetakpdfalert/{nip}/{periode}/{jenis_vakasi}',[CetakVakasiController::class,'cetakalert'])->middleware('auth');
