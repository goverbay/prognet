<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\product_review;
use App\Produk;
use App\admin;

class ProductReviewController extends Controller
{
    public function store(Request $request){
        $review = new product_review;
        $review->product_id = $request->product_id;
        $review->user_id = $request->user_id;
        $review->rate = $request->rate;
        $review->content = $request->content;

        $review->save();

        
        $reviews = product_review::where('product_id', '=', $request->product_id)->get();
        $meanRate = 0;
        $count = $reviews->count();

        foreach($reviews as $item){
            $meanRate = $meanRate+$item->rate;
        }

        $meanRate = $meanRate / $count;

        $produk = Produk::find($request->product_id);
        $produk->product_rate = $meanRate;
        $produk->save();

        return response()->json(['success' => 'Review Produk berhasil ditambahkan']);
    }

    public function update(Request $request){
        $review = product_review::find($request->review_id);
        $review->rate = $request->rate;
        $review->content = $request->content;
        $review->save();

        $reviews = product_review::where('product_id', '=', $review->product_id)->get();
        $meanRate = 0;
        $count = $reviews->count();

        foreach($reviews as $item){
            $meanRate = $meanRate+$item->rate;
        }

        $meanRate = $meanRate / $count;

        $produk = Produk::find($review->product_id);
        $produk->product_rate = $meanRate;
        $produk->save();

        return redirect('/produk/'.$review->product_id);
    }

    // public function readNotif(Request $request){
    //     $admin = Admin::find($request->id);

    //     $admin->unreadNotifications->markAsRead();

    //     return response()->json(['success' => 'berhasil merubah notif menjadi terbaca']);
    // }
}
