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
    public function dashboard() {
        $data['title'] = 'Dashboard';
        return view('dashboard.dashboard', $data);
    }

    public function katalog() {
        $data['title'] = 'Pesanan';
        return view('katalog.katalog', $data);
    }

    public function tambahkatalog() {
        $data['title'] = 'Tambah Katalog';
        return view('katalog.tambah_katalog', $data);
    }

    public function pesanan() {
        $data['title'] = 'Pesanan';
        return view('pesanan.pesanan', $data);
    }

    public function laporan() {
        $data['title'] = 'Laporan';
        return view('laporan.laporan', $data);
    }
   
    public function forgetpass() {
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
}
