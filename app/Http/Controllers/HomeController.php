<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Produk;
use App\Kategori;
use Illuminate\Support\Facades\Auth;
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

    public function NotifyShow($id, $id2){
        $produk = Produk::with(['product_image','product_category_detail','category','discount', 'product_review' => function($q){
            $q->with(['user', 'response' => function($qq){
                $qq->with('admin');
            }]);
        }])->where('id','=',$id)->first();
        auth()->user()->unReadNotifications->where('id', $id2)->markAsRead();
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

    public function ShowNotification(){
        return view('user.notifikasi');
    }

    public function MarkNotification($id){
        auth()->user()->unReadNotifications->where('id', $id)->markAsRead();
        return redirect('/notif');
    }

    public function MarkAll(){
        $user = User::find(Auth::user()->id);
        dd($user);
        foreach ($user->unReadNotifications as $notification){
            $notification->markAsRead();
        }
        return redirect('/notif');
    }

    public function ShowAdminNotification(){
        return view('auth.admin.notifikasi');
    }

    public function MarkAdminNotification($id){
        Auth::guard('admin')->user()->unReadNotifications->where('id', $id)->markAsRead();
        return redirect('/admin/notif');
    }

    public function MarkAdminAll(){
        $admin = Admin::find(1);
        dd($admin);
        foreach($admin->unReadNotifications as $notification){
            $notification->markAsRead();
        }
        redirect()->back();
    }

    
}
