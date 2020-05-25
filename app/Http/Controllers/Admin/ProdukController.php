<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Produk;
use App\Kategori;
use App\product_category_detail as pcd;
use App\product_image as pi;
use App\product_review as review;
use App\response;
use Illuminate\Support\Facades\Auth;


class ProdukController extends Controller
{
    public function index(){
        $produks = Produk::with('category')->get();

        return view('auth.admin.produk', ['produks' => $produks]);
    }

    public function tambah(){
        $kategori = Kategori::all();
        return view('auth.admin.produk_tambah', ['kategori' => $kategori]);
    }

    public function store(Request $request){
        $messages = [
            'required' => ':attribute tidak boleh kosong',
            'numeric' => ':attribute tidak boleh selain bilangan',
            'min' => ':attribute tidak boleh kurang dari :min',
            'max' => ':attribute tidak boleh melebihi dari :max',
        ];

        $this->validate($request,[
            'product_name' => 'required',
            'price' => 'required|numeric|min:0',
            'description' => 'required',
            'stock' => 'required|numeric|min:1',
            'weight' => 'required|numeric|min:1',
        ],$messages);

        $produk = new Produk;

        $produk->product_name = $request->product_name;
        $produk->price = $request->price;
        $produk->description = $request->description;
        $produk->product_rate = 0;
        $produk->stock = $request->stock;
        $produk->weight = $request->weight;
        $produk->save();

        if(!is_null($request->kategori)){
            foreach($request->kategori as $item){
                $detail_kategori = new pcd;
                $detail_kategori->product_id = $produk->id;
                $detail_kategori->category_id = $item;
                $detail_kategori->save();
            }
        }

        if(!is_null($request->file)){
            foreach($request->file('file') as $item){
                $file = $item;
                $path = 'produk_image';
                $nama_file = time()."_".$file->getClientOriginalName();
        
                $file->move($path,$nama_file);
        
                $gambar = new pi;
        
                $gambar->product_id = $produk->id;
                $gambar->image_name = $nama_file;
                $gambar->save();      
            }
        }
        return redirect('/admin/produk');
    }

    public function edit($id){
        $produk = Produk::find($id);

        return view('auth.admin.produk_edit', ['produk' => $produk]);
    }

    public function update(Request $request){
        $messages = [
            'required' => ':attribute tidak boleh kosong',
            'numeric' => ':attribute tidak boleh selain bilangan',
            'min' => ':attribute tidak boleh kurang dari :min',
            'max' => ':attribute tidak boleh melebihi dari :max',
        ];

        $this->validate($request,[
            'product_name' => 'required',
            'price' => 'required|numeric|min:0',
            'description' => 'required',
            'product_rate' => 'required|numeric|min:0|max:5',
            'stock' => 'required|numeric|min:1',
            'weight' => 'required|numeric|min:1',
        ],$messages);

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
        $produk = Produk::with('product_image','product_category_detail','category','discount', 'product_review')->where('id','=',$id)->first();
        if($produk->discount->count()){
            
            $diskon = $produk->discount->sortByDesc('id');
            foreach($diskon as $item){
                $tgl_diskon = $item;
                break;
            }
        }else{
            $tgl_diskon = null;
        }

        $respon = response::all();
        
        return view('auth.admin.produk_show',['produk' => $produk, 'tgl_diskon' => $tgl_diskon, 'respon' => $respon]);
    }

    public function NotifyShow($id, $id2){
        $produk = Produk::with('product_image','product_category_detail','category','discount', 'product_review')->where('id','=',$id)->first();
        if($produk->discount->count()){
            
            $diskon = $produk->discount->sortByDesc('id');
            foreach($diskon as $item){
                $tgl_diskon = $item;
                break;
            }
        }else{
            $tgl_diskon = null;
        }

        $respon = response::all();
        Auth::guard('admin')->user()->unReadNotifications->where('id', $id2)->markAsRead();
        return view('auth.admin.produk_show',['produk' => $produk, 'tgl_diskon' => $tgl_diskon, 'respon' => $respon]);
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
            'file' => 'required|mimes:jpg,jpeg,png',
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

    public function hapus_review($id){
        $review = review::find($id);
        $produk_id = $review->product_id;
        $product_id = $review->product_id;
        $review->delete();

        $reviews = review::where('product_id', '=', $product_id)->get();
        $meanRate = 0;
        $count = $reviews->count();

        foreach($reviews as $item){
            $meanRate = $meanRate+$item->rate;
        }
        if($count == 0){
            $meanRate = 0;
        }else{
            $meanRate = $meanRate / $count;
        }

        $produk = Produk::find($product_id);
        $produk->product_rate = $meanRate;
        $produk->save();



        return redirect('/admin/produk/show/'.$product_id.'#review');
    }
}
