<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Kategori;


class KategoriController extends Controller
{
    public function index(){
        $kategoris = Kategori::all();
        return view('auth.admin.kategori', ['kategoris' => $kategoris]);
    }

    public function tambah_data(){
        return view('auth.admin.kategori_tambah');
    }

    public function store(Request $request){
        $messages = [
            'required' => ':attribute tidak boleh kosong',
        ];

        $this->validate($request,[
            'category_name' => 'required',
        ],$messages);

        $kategori = new Kategori;

        $kategori->category_name = $request->category_name;
        $kategori->save();

        return redirect('/admin/kategori_produk');
    }

    public function edit($id){
        $kategori = Kategori::find($id);

        return view('auth.admin.kategori_edit', ['kategori' => $kategori]);
    }

    public function update(Request $request){
        $messages = [
            'required' => ':attribute tidak boleh kosong',
        ];

        $this->validate($request,[
            'category_name' => 'required',
        ],$messages);
        
        $id = $request->id;
        $kategori = Kategori::find($id);

        $kategori->category_name = $request->category_name;
        $kategori->save();

        return redirect('/admin/kategori_produk');
    }

    public function hapus($id){
        $kategori = Kategori::find($id);

        $kategori->delete();

        return redirect('/admin/kategori_produk');
    }
}
