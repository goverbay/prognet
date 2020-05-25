<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\cart;
use App\Province as Provinsi;
use App\City;
use App\courier as kurir;
use App\Produk;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class CheckoutController extends Controller
{
    public function index(Request $request){
        if(!empty($request->product_id)){
            $cart = Produk::with('product_image', 'discount')->where('id', '=', $request->product_id)->get();
            $subtotal = $request->subtotal;
            $weight = $request->weight;
            $qty = $request->qty;
            $product_id = $request->product_id;
        }else{
            $cart = cart::with(['product' => function($q){
                $q->with('product_image','discount');
            }])->where('user_id', '=', $request->user_id)->where('status', '=', 'notyet')->get();
            $subtotal = $request->sub_total;

            $weight = 0;
        
            foreach($cart as $item){
               $weight = $weight + $item->product->weight;
            }
            
            $qty = 0;
            $product_id = 0;
        }
        $provinsi = Provinsi::all();
        $kurir = kurir::all();

        return view('user.checkout',[
            'cart'=>$cart,
            'subtotal'=>$subtotal,
            'provinsi' => $provinsi,
            'kurir' => $kurir,
            'weight'=>$weight,
            'qty'=>$qty,
            'product_id'=>$product_id]);
    }

    public function getCities($id){
        $city = City::where('province_id','=',$id)->pluck('title','city_id');
        return json_encode($city);
    }

    public function submit(Request $request){
        // dd($request->courier);
        $kurir = kurir::where('id','=',$request->courier)->first();
        if(empty($request->destination)){
            $city = City::where('province_id','=',$request->prov)->first();
            $request->destination = $city->city_id;
        }
        $cost = RajaOngkir::ongkosKirim([
            'origin' => 17,
            'destination' => $request->destination,
            'weight' => $request->weight,
            'courier' => $kurir->code,
        ])->get();

        $hasil = $cost[0]['costs'][0]['cost'][0];
        return response()->json(['success' => 'terkirim', 'hasil' => $hasil]);
    }
}
