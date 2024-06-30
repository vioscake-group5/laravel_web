<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Page_Katalog_Controller;
use App\Http\Controllers\Page_Katalog_Desain_Controller;
use App\Http\Middleware\SessionLogin;

// Route::get('/', function () {
//     return view('head', ['title' => 'Head']);
// })->name('head');

// auth admin
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login-auth', [LoginController::class, 'login'])->name('login.post');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
 Route::get('/forgetpass', [UserController::class, 'forgetpass'])->middleware('guest')->name('forgetpass');
 Route::post('/forgetpass', [UserController::class, 'forgetpass_action'])->middleware('guest')->name('forgetpass.action');
 Route::get('/reset_password/{token}', [UserController::class, 'reset_password'])->middleware('guest')->name('password.reset');
 Route::post('/reset_password', [UserController::class, 'reset_password_action'])->middleware('guest')->name('resetpass.action');
 Route::get('/send-email', [UserController:: class, 'index']);

 // router untuk dashboard
 Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard')->middleware(SessionLogin::class);

 // router untuk katalog
 Route::get('/katalog', [Page_Katalog_Controller::class, 'katalog'])
    ->name('katalog')
    ->middleware(SessionLogin::class);
 Route::get('/katalog_desain', [Page_Katalog_Desain_Controller::class, 'katalog_desain'])
    ->name('katalog_desain')
    ->middleware(SessionLogin::class);
//  route tambah katalog
 Route::get('/tambah_katalog', [Page_Katalog_Controller::class, 'tambahkatalog'])->name('tambah_katalog')->middleware(SessionLogin::class);
 Route::post('/tambah_katalog_action', [Page_Katalog_Controller::class, 'tambahkatalog_action'])->name('tambah_katalog_action')->middleware(SessionLogin::class);
 Route::get('/tambah_katalog_desain', [Page_Katalog_Desain_Controller::class, 'tambahkatalog_desain'])->name('tambah_katalog_desain')->middleware(SessionLogin::class);
 Route::post('/tambah_katalog_desain_action', [Page_Katalog_Desain_Controller::class, 'tambahkatalog_desain_action'])->name('tambah_katalog_desain_action')->middleware(SessionLogin::class);
//  route edit katalog
 Route::get('/edit_katalog/{id}', [Page_Katalog_Controller::class, 'editkatalog'])->name('edit_katalog')->middleware(SessionLogin::class);
 Route::get('/edit_katalog_desain/{id}', [Page_Katalog_Desain_Controller::class, 'editkatalog_desain'])->name('edit_katalog_desain')->middleware(SessionLogin::class);
//  route hapus katalog
 Route::get('/hapus_katalog/{id}', [Page_Katalog_Controller::class, 'hapuskatalog'])->name('hapus_katalog')->middleware(SessionLogin::class);
 Route::get('/hapus_katalog_desain/{id}', [Page_Katalog_Desain_Controller::class, 'hapuskatalog_desain'])->name('hapus_katalog_desain')->middleware(SessionLogin::class);
//  route update katalog
 Route::match(['get', 'post'], '/update_katalog/{id}' , [Page_Katalog_Controller::class, 'updatekatalog'])->name('update_katalog')->middleware(SessionLogin::class);
 Route::match(['get', 'post'], '/update_katalog_desain/{id}' , [Page_Katalog_Desain_Controller::class, 'updatekatalog_desain'])->name('update_katalog_desain')->middleware(SessionLogin::class);

 // pesanan
 Route::get('/pesanan', [UserController::class, 'pesanan'])->name('pesanan')->middleware(SessionLogin::class);
  // laporan
 Route::get('/laporan', [UserController::class, 'laporan'])->name('laporan')->middleware(SessionLogin::class);