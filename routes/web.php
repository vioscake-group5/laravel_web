<?php

use App\Http\Controllers\Katalog;
use App\Http\Controllers\Page_Katalog_Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\Page_Katalog;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('head', ['title' => 'Head']);
})->name('head');

// auth admin
 Route::post('/login', [UserController::class, 'login_action'])->name('login.action');
 Route::get('/login', [UserController::class, 'login'])->name('login');
 Route::get('/forgetpass', [UserController::class, 'forgetpass'])->middleware('guest')->name('forgetpass');
 Route::post('/forgetpass', [UserController::class, 'forgetpass_action'])->middleware('guest')->name('forgetpass.action');
 Route::get('/reset_password/{token}', [UserController::class, 'reset_password'])->middleware('guest')->name('password.reset');
 Route::post('/reset_password', [UserController::class, 'reset_password_action'])->middleware('guest')->name('resetpass.action');
 Route::get('/send-email', [UserController:: class, 'index']);

 // router untuk dashboard
 Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');

 // router untuk katalog
 Route::get('/katalog', [Page_Katalog_Controller::class, 'katalog'])->name('katalog');
//  route tambah katalog
 Route::get('/tambah_katalog', [Page_Katalog_Controller::class, 'tambahkatalog'])->name('tambah_katalog');
 Route::post('/tambah_katalog_action', [Page_Katalog_Controller::class, 'tambahkatalog_action'])->name('tambah_katalog_action');
//  route edit katalog
 Route::get('/edit_katalog/{id}', [Page_Katalog_Controller::class, 'editkatalog'])->name('edit_katalog');
 Route::get('/hapus_katalog/{id}', [Page_Katalog_Controller::class, 'hapuskatalog'])->name('hapus_katalog');
 Route::match(['get', 'post'], '/update_katalog/{id}' , [Page_Katalog_Controller::class, 'updatekatalog'])->name('update_katalog');

 // pesanan
 Route::get('/pesanan', [UserController::class, 'pesanan'])->name('pesanan');
  // laporan
 Route::get('/laporan', [UserController::class, 'laporan'])->name('laporan');