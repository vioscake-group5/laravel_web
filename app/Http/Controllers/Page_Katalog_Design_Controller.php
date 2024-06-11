<?php

namespace App\Http\Controllers;
use App\Models\katalogDesign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class Page_Katalog_Design_Controller extends Controller
{
    public function katalogDesign() {
        /*
            // Mengambil semua data katalogDesign dari database
            $katalogDesigns = katalogDesign::all();

            // Menyimpan data katalogDesign ke dalam var data
            $data['title'] = 'katalogDesign';
            $data['katalogDesigns'] = $katalogDesigns;

            return view('katalogDesign.katalogDesign', $data);
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
            $data['title'] = 'katalogDesign';
            $cakes = $response->json();
            // return response()->json($cakes);
            return view('katalogDesign.katalogDesign', $cakes, $data);

        } else {
            return response()->json(['error' => 'Failed to fetch cakes'], $response->status());
        }

    }

    public function tambahkatalogDesign() {
        // untuk menampilkan judul halaman yg disimpan dalam var data 
        // Variabel $data akan digunakan untuk menyediakan data yang akan digunakan dalam tampilan (view).
        $data['title'] = 'Tambah katalogDesign';
        return view('katalogDesign.tambah_katalogDesign', $data);
    }
    public function tambahkatalogDesign_action(Request $request){
        /*
            dd($request->all());
            $validatedData = $request->validate([
                'gambar' => 'required|image|max:2048', // validasi untuk gambar
                'deskripsi' => 'required', // validasi untuk deskripsi
            ]);

            $data = katalogDesign::create($validatedData);

            if($request->hasFile('gambar')){
                $request->file("gambar")->move('katalogDesign_gambar/', $request->file('gambar')->getClientOriginalName());
                $data->gambar = $request->file('gambar')->getClientOriginalName();
                $data->save();
            }
            return redirect()->route('katalogDesign')->with('success', 'Data Berhasil Di Tambah');
        */    
    
        // validate data
        $validatedData = $request->validate([
            'nama_kue' => 'required',
            'deskripsi' => 'required',
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
        ->post('https://vioscake.my.id/api/cakes', [
            'nama_kue' => $validatedData['nama_kue'],
            'deskripsi' => $validatedData['deskripsi'],
            'harga' => $validatedData['harga'],
            // 'gambar' => $gambarName,
        ]);

        // check api response
        if ($response->successful()) {
            // Pindahkan file ke direktori lokal setelah berhasil mengunggah ke API
            $request->file('gambar')->move('cakes/', $gambarName);
    
            // Tindakan setelah berhasil
            return redirect()->route('katalogDesign')->with('success', 'Data Berhasil Ditambah');
        } else {
            // Tindakan jika gagal
            return back()->withErrors(['message' => 'Gagal mengunggah data ke API']);
        }
    }

    public function editkatalogDesign($id) {
        $cakes = katalogDesign::findOrFail($id);
        return view('katalogDesign.edit_katalogDesign', compact('katalogDesign'));
        /*
            $token = Session::get('external_token');

            // Check if the token exists
            if (!$token) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            $response = Http::withHeaders([
                'Authorization' => 'Bearer' . $token,
                // 'User' => 'Website'
            ])->post('https://vioscake.my.id/api/cakes/' . $id, [
                // Data yang ingin Anda perbarui, misalnya:
                'nama_kue' => 'Nama katalogDesign Baru',
                'deskripsi' => 'Deskripsi katalogDesign Baru',
                'harga' => '2000',
                'gambar' => 'png.png'
                // Dan seterusnya
            ]);

            if ($response->successful()) {
                $cakes = $response->json(); // Jika API mengembalikan data katalogDesign yang diperbarui
                return response()->json($cakes);
                // return view('katalogDesign.edit_katalogDesign', compact('katalogDesign'));
            } else {
                // Tindakan jika permintaan gagal
                return back()->withErrors(['message' => 'Gagal memperbarui katalogDesign']);
            }
        */
    }
    public function updatekatalogDesign(Request $request, $id=null) {
        /*
            if($request->method() == 'POST'){
                $katalogDesigns = katalogDesign::find($id);
                
                if($request->hasFile('gambar')){
                    $request->file("gambar")->move('katalogDesign_gambar/', $request->file('gambar')->getClientOriginalName());
                    $katalogDesigns->gambar = $request->file('gambar')->getClientOriginalName();
                }
            
                if($request->filled('deskripsi')){
                    $katalogDesigns->deskripsi = $request->deskripsi;
                }
        
                $katalogDesigns->save();
                return redirect()->back();
            }
        */
        $validatedData = $request->validate([
            'nama_kue' => 'required',
            'deskripsi' => 'required',
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
        ->post('https://vioscake.my.id/api/cakes/' . $id, [
            // Data yang ingin Anda perbarui, misalnya:
            'nama_kue' => $validatedData['nama_kue'],
            'deskripsi' => $validatedData['deskripsi'],
            'harga' => $validatedData['harga'],
            // 'gambar' => $validatedData['gambar'],
            // Dan seterusnya
        ]);

        if ($response->successful()) {
            // $cakes = $response->json(); // Jika API mengembalikan data katalogDesign yang diperbarui
            // return response()->json($cakes);
            // return view('katalogDesign.edit_katalogDesign', compact('katalogDesign'));

            // Pindahkan file ke direktori lokal setelah berhasil mengunggah ke API
            $request->file('gambar')->move('cakes/', $gambarName);
    
            // Tindakan setelah berhasil
            return redirect()->route('katalogDesign')->with('success', 'Data Berhasil Ditambah');

        } else {
            // Tindakan jika permintaan gagal
            return back()->withErrors(['message' => 'Gagal memperbarui katalogDesign']);
        }
    
    }

    public function hapuskatalogDesign($id) {
        // langsung di edit nya
        /*
            $katalogDesigns = katalogDesign::findOrFail($id);
            $katalogDesigns->delete();
            
            return redirect()->route('katalogDesign')->with('success', 'Data Berhasil Di hapus');
        */
    }
    
    
}
