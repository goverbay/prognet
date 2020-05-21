<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produk;
use App\Kategori;
use App\product_category_detail as pcd;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $kategori = Kategori::with('product')->get();
        $produk = Produk::with('product_image','product_category_detail','category','discount', 'product_review')->get();
        return view('home', ['produks' => $produk, 'kategori' => $kategori]);
    }

    public function show($id){
        $produk = Produk::with(['product_image','product_category_detail','category','discount', 'product_review' => function($q){
            $q->with(['user', 'response' => function($qq){
                $qq->with('admin');
            }]);
        }])->where('id','=',$id)->first();

        return view('user.produk_detail', ['produk' => $produk]);
    }

    public function diskon($diskons,$harga){
        if($diskons->count()){
            $dsk = $diskons->sortByDesc('id');
            foreach($dsk as $d){
                $persen = $d;
                break;
            }

            if($persen->end >= date('Y-m-d')){
               return $hasil = $harga-($harga*$persen->percentage/100);
            }else{
                return $hasil = 0;
            }
        }else{
            return $hasil = 0;
        }
    }

    public function show_kategori(Request $request){
        if($request->id == 0){
            $kategori = Produk::with('product_image','discount')->get();
            $status = 0;
        }elseif($request->id == -1){
            $kategori = Produk::with('product_image','discount')->where('product_name','like','%'.$request->cari.'%')->get();
            $status = 0;
        }else{
            $kategori = Kategori::with(['product' => function($q){
                $q->with('discount', 'product_image');
            }])->where('id','=',$request->id)->first();
            $status = 1;
        }
        $hasil = view('filter', ['kategori' => $kategori, 'status' => $status])->render();
        // $hasil = $kategori;
        return response()->json(['success' => 'Produk berhasil dimasukkan dalam cart', 'hasil' => $hasil]);
    }
}
