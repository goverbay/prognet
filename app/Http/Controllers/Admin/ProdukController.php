<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Produk;
use App\Kategori;
use App\product_category_detail as pcd;
use App\product_image as pi;

class ProdukController extends Controller
{
    public function index(){
        $produks = Produk::with('category')->get();

        return view('auth.admin.produk', ['produks' => $produks]);
    }

    public function tambah(){
        return view('auth.admin.produk_tambah');
    }

    public function store(Request $request){
        $produk = new Produk;

        $produk->product_name = $request->product_name;
        $produk->price = $request->price;
        $produk->description = $request->description;
        $produk->product_rate = $request->product_rate;
        $produk->stock = $request->stock;
        $produk->weight = $request->weight;
        $produk->save();

        $id = Produk::max('id');

        return redirect('/admin/produk/show/'.$id.'#kategori');
    }

    public function edit($id){
        $produk = Produk::find($id);

        return view('auth.admin.produk_edit', ['produk' => $produk]);
    }

    public function update(Request $request){
        $produk = Produk::find($request->id);

        $produk->product_name = $request->product_name;
        $produk->price = $request->price;
        $produk->description = $request->description;
        $produk->product_rate = $request->product_rate;
        $produk->stock = $request->stock;
        $produk->weight = $request->weight;
        $produk->save();

        return redirect('/admin/produk/show/'.$produk->id);
    }

    public function hapus($id){
        $produk = Produk::find($id);

        $produk->delete();

        return redirect('/admin/produk');
    }

    public function show($id){
        $produk = Produk::with('product_image','product_category_detail','category','discount')->where('id','=',$id)->first();

        return view('auth.admin.produk_show',['produk' => $produk]);
    }

    public function tambah_kategori($id){
        $produk = Produk::with('category')->where('id','=',$id)->first();
        
        $kecuali = [];
        
        foreach($produk->category as $item){
            array_push($kecuali, $item->id);
        }
        $kategori = Kategori::all()->whereNotIn('id',$kecuali);
        return view('auth.admin.produk_tambah_kategori',['id' => $id, 'kategori' => $kategori]);
    }

    public function store_kategori(Request $request){
        $kategori = new pcd;

        $kategori->product_id = $request->product_id;
        $kategori->category_id = $request->category_id;
        $kategori->save();

        return redirect('/admin/produk/show/'.$request->product_id.'#kategori');
    }

    public function hapus_kategori($id){
        $kategori = pcd::find($id);
        $id_produk = $kategori->product_id;
        $kategori->delete();
        return redirect('/admin/produk/show/'.$id_produk.'#kategori');
    }

    public function tambah_gambar($id){
        return view('auth.admin.produk_tambah_gambar', ['id' => $id]);
    }

    public function store_gambar(Request $request){
        $this->validate($request, [
            'file' => 'required',
        ]);

        // dd($request->file('file'));
        // echo 'id';

        $file = $request->file('file');
        $path = 'produk_image';
        $nama_file = time()."_".$file->getClientOriginalName();

        $file->move($path,$nama_file);

        $gambar = new pi;

        $gambar->product_id = $request->product_id;
        $gambar->image_name = $nama_file;
        $gambar->save();
       
        return redirect('/admin/produk/show/'.$request->product_id.'#gambar');
    }

    public function hapus_gambar($id){
        $gambar = pi::find($id);
        $product_id = $gambar->product_id;
        $gambar->delete();

        return redirect('/admin/produk/show/'.$product_id.'#gambar');
    }
}
