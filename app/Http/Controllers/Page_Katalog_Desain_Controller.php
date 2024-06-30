<?php

namespace App\Http\Controllers;

use App\Models\katalogDesign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class Page_Katalog_Desain_Controller extends Controller
{
    public function katalog_desain() 
    {        
        // Get the user's token from session or wherever you store it after login
        $token = Session::get('external_token');

        // Check if the token exists
        if (!$token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Fetch data from the API with authentication headers
        $response = Http::withHeaders([
            'Authorization' => 'Bearer' . $token,
            // 'User' => 'Website'
        // ])->get('https://vioscake.my.id/api/desain');
        ])->get('http://127.0.0.1:8000/api/desain');

        // Check if the request was successful
        if ($response->successful()) {
            $data['title'] = 'Desain';
            $desains = $response->json();
            // return response()->json($desains);
            return view('katalog_desain.katalog_desain', $desains, $data);

        } else {
            return view('authentication.login');
        }

    }

    public function tambahkatalog_desain() 
    {
        // untuk menampilkan judul halaman yg disimpan dalam var data 
        // Variabel $data akan digunakan untuk menyediakan data yang akan digunakan dalam tampilan (view).
        $data['title'] = 'Tambah Katalog Desain';
        return view('katalog_desain.tambah_katalog_desain', $data);
    }
    public function tambahkatalog_desain_action(Request $request) 
    {        
        // validate data
        $validatedData = $request->validate([
            'harga' => 'required',
            'gambar' => 'required|image|max:2048',
        ]);

        // get token from session file
        $token = Session::get('external_token');

        // Check if the token exists
        if (!$token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Mengambil nama file asli
        $gambarName = $request->file('gambar')->getClientOriginalName();

        // Mengirim data ke API
        $response = Http::withHeaders([
            'Authorization' => 'Bearer' . $token,
            // 'User' => 'Website'
        ])
        ->attach(
            'gambar', file_get_contents($request->file('gambar')->getRealPath()), $gambarName
        )
        // ->post('https://vioscake.my.id/api/desain', [
        ->post('http://127.0.0.1:8000/api/desain', [
            'harga' => $validatedData['harga'],
        ]);

        // check api response
        if ($response->successful()) {
            // Pindahkan file ke direktori lokal setelah berhasil mengunggah ke API
            $request->file('gambar')->move('desain/', $gambarName);
    
            // Tindakan setelah berhasil
            return redirect()->route('katalog_desain')->with('success', 'Data Berhasil Ditambah');
        } else {
            // Tindakan jika gagal
            return back()->withErrors(['message' => 'Gagal mengunggah data ke API']);
        }
    }

    public function editkatalog_desain($id) 
    {
        $desains = katalogDesign::findOrFail($id);
        return view('katalog_desain.edit_katalog_desain', compact('katalog'));
    }
    public function updatekatalog_desain(Request $request, $id=null) 
    {
        $validatedData = $request->validate([
            'harga' => 'required',
            'gambar' => 'required|image|max:2048',
        ]);

        $token = Session::get('external_token');

        // Check if the token exists
        if (!$token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Mengambil nama file asli
        $gambarName = $request->file('gambar')->getClientOriginalName();

        // Mengirim data ke API
        $response = Http::withHeaders([
            'Authorization' => 'Bearer' . $token,
            // 'User' => 'Website'
        ])
        ->attach(
            'gambar', file_get_contents($request->file('gambar')->getRealPath()), $gambarName
        )
        // ->post('https://vioscake.my.id/api/desain/' . $id, [
        ->post('http://127.0.0.1:8000/api/desain/' . $id, [
            'harga' => $validatedData['harga'],
        ]);

        if ($response->successful()) {
            $request->file('gambar')->move('desain/', $gambarName);
    
            // Tindakan setelah berhasil
            return redirect()->route('katalog_desain')->with('success', 'Data Berhasil Ditambah');

        } else {
            // Tindakan jika permintaan gagal
            return back()->withErrors(['message' => 'Gagal memperbarui katalog']);
        }
    
    }

    public function hapuskatalog_desain($id) 
    {
        // langsung di edit nya
    }
}
