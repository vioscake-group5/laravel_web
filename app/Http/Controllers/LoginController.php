<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('authentication.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $response = Http::withHeaders([
            'User' => 'Website'
        // ])->post('https://vioscake.my.id/api/login', [
        ])->post('http://127.0.0.1:8000/api/login', [
            'email' => $request->email,
            'password' => $request->password
        ]);


        if ($response->successful()) {
            $responseData = $response->json(); 
            Session::put('external_token', $responseData['token']);
            return redirect()->route('dashboard')->with('success', 'Login berhasil!');
        } else {
            return redirect()->back()->withErrors(['login' => 'Email atau password salah.']);
        }
    }

    public function logout(Request $request)
    {
        $externalToken = Session::get('external_token');
        if(!$externalToken) return redirect()->route('login')->withErrors(['message' => 'Please login.']);

        $request->session()->flush();

        return redirect()->route('login')->with('success', 'logout berhasil!');
    }
}