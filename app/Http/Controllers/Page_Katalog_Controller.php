<?php

namespace App\Http\Controllers;
use App\Models\katalog;
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

    public function tambahkatalog() {
        // untuk menampilkan judul halaman yg disimpan dalam var data 
        // Variabel $data akan digunakan untuk menyediakan data yang akan digunakan dalam tampilan (view).
        $data['title'] = 'Tambah Katalog';
        return view('katalog.tambah_katalog', $data);
    }
    public function tambahkatalog_action(Request $request){
        /*
            dd($request->all());
            $validatedData = $request->validate([
                'gambar' => 'required|image|max:2048', // validasi untuk gambar
                'deskripsi' => 'required', // validasi untuk deskripsi
            ]);

            $data = katalog::create($validatedData);

            if($request->hasFile('gambar')){
                $request->file("gambar")->move('katalog_gambar/', $request->file('gambar')->getClientOriginalName());
                $data->gambar = $request->file('gambar')->getClientOriginalName();
                $data->save();
            }
            return redirect()->route('katalog')->with('success', 'Data Berhasil Di Tambah');
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
            return redirect()->route('katalog')->with('success', 'Data Berhasil Ditambah');
        } else {
            // Tindakan jika gagal
            return back()->withErrors(['message' => 'Gagal mengunggah data ke API']);
        }

        /*
            // Validasi data
            $validatedData = $request->validate([
                'nama_kue' => 'required',
                'deskripsi' => 'required',
                'harga' => 'required',
                'gambar' => 'required|image|max:2048',
            ]);

            // Ambil token dari sesi
            $token = Session::get('external_token');

            // Periksa apakah token ada
            if (!$token) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            // Mengirim data ke API dengan file
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->attach(
                'gambar', file_get_contents($request->file('gambar')->getRealPath()), $request->file('gambar')->getClientOriginalName()
            )->post('https://vioscake.my.id/api/cakes', [
                'nama_kue' => $validatedData['nama_kue'],
                'deskripsi' => $validatedData['deskripsi'],
                'harga' => $validatedData['harga'],
            ]);

            // Periksa respons dari API
            if ($response->successful()) {
                // Mendapatkan nama file dari respons API
                $apiResponse = $response->json();

                // Periksa apakah 'gambar' ada dalam respons API
                if (isset($apiResponse['gambar'])) {
                    $gambarNameDatabase = $apiResponse['gambar']; // asumsikan nama file disimpan dalam 'gambar'

                    // Menunggu hingga nama file terlihat di direktori
                    $startTime = time();
                    while (!file_exists('katalog_gambar/' . $gambarNameDatabase)) {
                        // Tambahkan kondisi berhenti jika waktu tunggu melebihi batas tertentu (misalnya, 10 detik)
                        if (time() - $startTime > 10) {
                            return back()->withErrors(['message' => 'Gagal menyimpan data. Nama file tidak ditemukan di direktori']);
                        }
                        // Jeda sebelum cek kembali
                        sleep(1);
                    }

                    // Pindahkan file ke direktori lokal dengan nama file yang sesuai dengan yang ada di database
                    $request->file('gambar')->move('katalog_gambar/', $gambarNameDatabase);

                    // Tindakan setelah berhasil
                    return redirect()->route('katalog')->with('success', 'Data Berhasil Ditambah');
                } else {
                    // Jika respons API tidak mengandung kunci 'gambar', kembalikan respons yang sesuai
                    return back()->withErrors(['message' => 'Gagal menyimpan data. Respons API tidak mengandung nama gambar']);
                }
            } else {
                // Tindakan jika gagal
                return back()->withErrors(['message' => 'Gagal mengunggah data ke API']);
            }
        */

    }

    public function editkatalog($id) {
        $cakes = Katalog::findOrFail($id);
        return view('katalog.edit_katalog', compact('katalog'));
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
        */
    }
    public function updatekatalog(Request $request, $id=null) {
        /*
            if($request->method() == 'POST'){
                $katalogs = Katalog::find($id);
                
                if($request->hasFile('gambar')){
                    $request->file("gambar")->move('katalog_gambar/', $request->file('gambar')->getClientOriginalName());
                    $katalogs->gambar = $request->file('gambar')->getClientOriginalName();
                }
            
                if($request->filled('deskripsi')){
                    $katalogs->deskripsi = $request->deskripsi;
                }
        
                $katalogs->save();
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
            // $cakes = $response->json(); // Jika API mengembalikan data katalog yang diperbarui
            // return response()->json($cakes);
            // return view('katalog.edit_katalog', compact('katalog'));

            // Pindahkan file ke direktori lokal setelah berhasil mengunggah ke API
            $request->file('gambar')->move('cakes/', $gambarName);
    
            // Tindakan setelah berhasil
            return redirect()->route('katalog')->with('success', 'Data Berhasil Ditambah');

        } else {
            // Tindakan jika permintaan gagal
            return back()->withErrors(['message' => 'Gagal memperbarui katalog']);
        }
    
    }

    public function hapuskatalog($id) {
        /*
            $katalogs = Katalog::findOrFail($id);
            $katalogs->delete();
            
            return redirect()->route('katalog')->with('success', 'Data Berhasil Di hapus');
        */
    }
    
    
}
