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
        $data = katalog::create($request->all());

        if($request->hasFile('foto')){
            $request->file("foto")->move('katalog_foto/', $request->file('foto')->getClientOriginalName());
            $data->foto = $request->file('foto')->getClientOriginalName();
            $data->save();
        }
        return redirect()->route('katalog')->with('success', 'Data Berhasil Di Tambah');
    }
}
