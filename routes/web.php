<?php

use App\Http\Controllers\Katalog;
use App\Http\Controllers\Page_Katalog_Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\Page_Katalog;
use Illuminate\Http\Request;

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
    return view('head', ['title' => 'Head']);
})->name('head');


Route::get('/sidebar', function () {
    return view('partials.sidebar');
})->name('sidebar');

Route::get('/menu', function () {
    return view('menu');
})->name('menu');

// Route::get('/login', function () {
//     return view('layout.login'); // Memanggil view login.blade.php dari folder layout
// })->name('login');

Route::post('/login', [UserController::class, 'login_action'])->name('login.action');
 // router untuk login 
 Route::get('/login', [UserController::class, 'login'])->name('login');

 // router untuk dashboard
 Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');

 // router untuk katalog
 Route::get('/katalog', [Page_Katalog_Controller::class, 'katalog'])->name('katalog');
//  route tambah katalog
 Route::get('/tambah_katalog', [Page_Katalog_Controller::class, 'tambahkatalog'])->name('tambah_katalog');
 Route::post('/tambah_katalog_action', [Page_Katalog_Controller::class, 'tambahkatalog_action'])->name('tambah_katalog_action');

Route::get('/forgetpass', [UserController::class, 'forgetpass'])->middleware('guest')->name('forgetpass');
 
Route::post('/forgetpass', [UserController::class, 'forgetpass_action'])->middleware('guest')->name('forgetpass.action');



Route::get('/reset_password/{token}', [UserController::class, 'reset_password'])->middleware('guest')->name('password.reset');
Route::post('/reset_password', [UserController::class, 'reset_password_action'])->middleware('guest')->name('resetpass.action');
// Route::post('/reset-password', function (Request $request) {
//    return 'bisa direset';
// })->middleware('guest')->name('password.update');


Route::get('/send-email', [UserController:: class, 'index']);