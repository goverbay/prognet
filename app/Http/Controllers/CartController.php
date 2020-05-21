<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function store(Request $request){
        $cek = cart::where('product_id', '=', $request->product_id)->where('user_id', '=', $request->user_id)->where('status','=','notyet')->first();
        
        if(is_null($cek)){
            $cart = new cart;

            $cart->product_id = $request->product_id;
            $cart->user_id = $request->user_id;
            $cart->qty = $request->qty;
            $cart->status = 'notyet';
            $cart->save();    
        }else{
            $cek->product_id = $request->product_id;
            $cek->user_id = $request->user_id;
            $cek->qty = $cek->qty + $request->qty;
            $cek->status = 'notyet';
            $cek->save();
        }

        $cek1 = cart::where('user_id', '=', $request->user_id)->where('status','=','notyet')->get();
        $jumlah = $cek1->count();

        return response()->json(['success' => 'Produk berhasil dimasukkan dalam cart', 'jumlah' => $jumlah]);
    }

    public function show(){
        if(is_null(Auth::user())){
            return redirect('/login');
        }else{
            $id = Auth::user()->id;
            $cart = cart::with(['product' => function($q){
                $q->with('product_image','discount');
            }])->where('user_id', '=', $id)->where('status', '=', 'notyet')->get();

            return view('user.cart', ['cart'=>$cart]);
        }
    }

    public function update(Request $request){
        $cart = cart::find($request->id);

        if($request->qty == 0){
            $cart->status = 'cancelled';
            $cart->save();
            $carts = cart::with(['product' => function($q){
                $q->with('product_image','discount');
            }])->where('user_id', '=', $request->user_id)->where('status', '=', 'notyet')->get();
            $hasil = view('recart',['carts' => $carts])->render();
            $jumlah = $carts->count();
            return response()->json(['success' => 'berhasil diganti', 'hasil' => $hasil, 'jumlah' => $jumlah]);
        }else{
            $cart->qty = $cart->qty+$request->qty;
            $cart->save();

            return response()->json(['success' => 'berhasil nambah']);
        }
    }
}
