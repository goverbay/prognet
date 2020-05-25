<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\product_review;
use App\Produk;
use App\Admin;
use App\User;
use App\transaction;
use App\Notifications\NotifyAdminReview;

class ProductReviewController extends Controller
{
    public function store(Request $request){
        $review = new product_review;
        $review->product_id = $request->product_id;
        $review->user_id = $request->user_id;
        $review->rate = $request->rate;
        $review->content = $request->content;
        
        
        $review->save();

        $noprod = produk::where('id',$request->product_id)->first();
        $no=auth()->user()->id;
        $admin = Admin::all();
        $user = User::where('id',$no)->first();
        foreach($admin as $ad)
            $ad->notify(new NotifyAdminReview($user, $noprod->id));
        
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

        

        return redirect('/transaksi/detail/'.$request->id);

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
}
