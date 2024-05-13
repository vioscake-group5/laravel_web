<?php

namespace App\Http\Controllers;
use App\Models\katalog;
use Illuminate\Http\Request;

class Page_Katalog_Controller extends Controller
{
    public function katalog() {
        // Mengambil semua data katalog dari database
        $katalogs = Katalog::all();

        // Menyimpan data katalog ke dalam var data
        $data['title'] = 'Katalog';
        $data['katalogs'] = $katalogs;

        // Mengirim data ke view 'katalog'
        return view('menu_page_katalog.katalog', $data);
    }
    public function tambahkatalog() {
        // untuk menampilkan judul halaman yg disimpan dalam var data 
        // Variabel $data akan digunakan untuk menyediakan data yang akan digunakan dalam tampilan (view).
        $data['title'] = 'Tambah Katalog';
        return view('menu_page_katalog.tambah_katalog', $data);
    }
    public function tambahkatalog_action(Request $request){
        // dd($request->all());
        $validatedData = $request->validate([
            'foto' => 'required|image|max:2048', // validasi untuk foto
            'deskripsi' => 'required', // validasi untuk deskripsi
        ]);

        $data = katalog::create($validatedData);

        if($request->hasFile('foto')){
            $request->file("foto")->move('katalog_foto/', $request->file('foto')->getClientOriginalName());
            $data->foto = $request->file('foto')->getClientOriginalName();
            $data->save();
        }
        return redirect()->route('katalog')->with('success', 'Data Berhasil Di Tambah');
    }
    public function editkatalog($id) {
        // untuk menampilkan judul halaman yg disimpan dalam var data 
        // Variabel $data akan digunakan untuk menyediakan data yang akan digunakan dalam tampilan (view).
        $katalogs = Katalog::findOrFail($id);
        return view('menu_page_katalog.edit_katalog', compact('katalog'));
        // $data['title'] = 'Tambah Katalog';
        // return view('menu_page_katalog.edit_katalog', $data);
    }
    public function hapuskatalog($id) {

        $katalogs = Katalog::findOrFail($id);
        $katalogs->delete();
        
        return redirect()->route('katalog')->with('success', 'Data Berhasil Di hapus');
    }
    
    public function updatekatalog(Request $request, $id=null) {
        if($request->method() == 'POST'){
            $katalogs = Katalog::find($id);
            
            if($request->hasFile('foto')){
                $request->file("foto")->move('katalog_foto/', $request->file('foto')->getClientOriginalName());
                $katalogs->foto = $request->file('foto')->getClientOriginalName();
            }
        
            if($request->filled('deskripsi')){
                $katalogs->deskripsi = $request->deskripsi;
            }
    
            $katalogs->save();
            return redirect()->back();
        }
    }
    
}
