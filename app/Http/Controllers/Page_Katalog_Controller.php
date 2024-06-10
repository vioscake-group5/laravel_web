<?php

namespace App\Http\Controllers;
// use App\Models\katalog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class Page_Katalog_Controller extends Controller
{
    public function katalog() {
        /*
        // Mengambil semua data katalog dari database
        $katalogs = Katalog::all();

        // Menyimpan data katalog ke dalam var data
        $data['title'] = 'Katalog';
        $data['katalogs'] = $katalogs;

        return view('katalog.katalog', $data);
        */
        
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
        ])->get('https://vioscake.my.id/api/cakes');

        // Check if the request was successful
        if ($response->successful()) {
            $data['title'] = 'Katalog';
            $cakes = $response->json();
            // return response()->json($cakes);
            return view('katalog.katalog', $cakes, $data);

        } else {
            return response()->json(['error' => 'Failed to fetch cakes'], $response->status());
        }

    }
    // public function tambahkatalog() {
    //     // untuk menampilkan judul halaman yg disimpan dalam var data 
    //     // Variabel $data akan digunakan untuk menyediakan data yang akan digunakan dalam tampilan (view).
    //     $data['title'] = 'Tambah Katalog';
    //     return view('katalog.tambah_katalog', $data);
    // }
    // public function tambahkatalog_action(Request $request){
    //     // dd($request->all());
    //     $validatedData = $request->validate([
    //         'foto' => 'required|image|max:2048', // validasi untuk foto
    //         'deskripsi' => 'required', // validasi untuk deskripsi
    //     ]);

    //     $data = katalog::create($validatedData);

    //     if($request->hasFile('foto')){
    //         $request->file("foto")->move('katalog_foto/', $request->file('foto')->getClientOriginalName());
    //         $data->foto = $request->file('foto')->getClientOriginalName();
    //         $data->save();
    //     }
    //     return redirect()->route('katalog')->with('success', 'Data Berhasil Di Tambah');
    // }
    public function editkatalog($id) {
        // $cakes = Katalog::findOrFail($id);
        // return view('katalog.edit_katalog', compact('katalog'));

        $token = Session::get('external_token');

        // Check if the token exists
        if (!$token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer' . $token,
            // 'User' => 'Website'
        ])->put('https://vioscake.my.id/api/cakes/' . $id, [
            // Data yang ingin Anda perbarui, misalnya:
            'nama_kue' => 'Nama Katalog Baru',
            'deskripsi' => 'Deskripsi Katalog Baru',
            'harga' => '2000',
            'gambar' => 'png.png'
            // Dan seterusnya
        ]);

        if ($response->successful()) {
            $cakes = $response->json(); // Jika API mengembalikan data katalog yang diperbarui
            return response()->json($cakes);
            // return view('katalog.edit_katalog', compact('katalog'));
        } else {
            // Tindakan jika permintaan gagal
            return back()->withErrors(['message' => 'Gagal memperbarui katalog']);
        }
    }
    // public function hapuskatalog($id) {

    //     $katalogs = Katalog::findOrFail($id);
    //     $katalogs->delete();
        
    //     return redirect()->route('katalog')->with('success', 'Data Berhasil Di hapus');
    // }
    
    // public function updatekatalog(Request $request, $id=null) {
    //     if($request->method() == 'POST'){
    //         $katalogs = Katalog::find($id);
            
    //         if($request->hasFile('foto')){
    //             $request->file("foto")->move('katalog_foto/', $request->file('foto')->getClientOriginalName());
    //             $katalogs->foto = $request->file('foto')->getClientOriginalName();
    //         }
        
    //         if($request->filled('deskripsi')){
    //             $katalogs->deskripsi = $request->deskripsi;
    //         }
    
    //         $katalogs->save();
    //         return redirect()->back();
    //     }
    // }
    
}
