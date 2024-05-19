<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestSendEmail;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;

class UserController extends Controller
{
    
    // controller untuk login
        public function login() {
            // untuk menampilkan judul halaman yg disimpan dalam var data 
            // Variabel $data akan digunakan untuk menyediakan data yang akan digunakan dalam tampilan (view).
            $data['title'] = 'Login';
            return view('authentication.login', $data);
        }
        
        // controller untuk btn login
        public function login_action(Request $request) {
            // Validasi data yang diterima dari formulir login
            $credentials = $request->validate([
                'username'=> ['required', 'string'],
                'password'=> ['required'],
            ]);
            // Mencoba untuk melakukan otentikasi pengguna dengan username dan password yang diterima
            if (Auth::attempt($credentials)) {
                // Jika otentikasi berhasil, regenerate session
                $request->session()->regenerate();
                
                // Arahkan pengguna ke halaman dashboard
                return redirect()->route('dashboard')->with('success', 'Login berhasil!');
            }
            
            // Jika otentikasi gagal, arahkan kembali pengguna ke halaman login dengan pesan gagal
            return redirect()->route('login')->withErrors(['password' => 'Username atau password salah']);
            
        }

    public function dashboard() {
        // untuk menampilkan judul halaman yg disimpan dalam var data 
        // Variabel $data akan digunakan untuk menyediakan data yang akan digunakan dalam tampilan (view).
        $data['title'] = 'Dashboard';
        return view('menu_page_dashboard.dashboard', $data);
    }

    public function pesanan() {
        // untuk menampilkan judul halaman yg disimpan dalam var data 
        // Variabel $data akan digunakan untuk menyediakan data yang akan digunakan dalam tampilan (view).
        $data['title'] = 'Pesanan';
        return view('pesanan.pesanan', $data);
    }

    public function laporan() {
        // untuk menampilkan judul halaman yg disimpan dalam var data 
        // Variabel $data akan digunakan untuk menyediakan data yang akan digunakan dalam tampilan (view).
        $data['title'] = 'Laporan';
        return view('laporan.laporan', $data);
    }
   
    public function forgetpass() {
        // untuk menampilkan judul halaman yg disimpan dalam var data 
        // Variabel $data akan digunakan untuk menyediakan data yang akan digunakan dalam tampilan (view).
        $data['title'] = 'Forget Password';
        return view('authentication.forgetpass', $data);
    }

    public function forgetpass_action(Request $request) {
        $request->validate(['email' => 'required|email']);


        $status = Password::sendResetLink(
            $request->only('email')
        );
     
        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);

    }

    public function reset_password($token) {
        $data['title'] = 'Reset Password';
        return view('authentication.resetpass', ['token' => $token], $data);
 
    }

   
    public function reset_password_action(Request $request) {
       
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);
     
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
     
                $user->save();
     
                event(new PasswordReset($user));
            }
        );
     
        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);

    }

    // public function index(){
    //     Mail::to('moacantik@gmail.com')->send(new TestSendEmail());
                
                
                
    // }
}
