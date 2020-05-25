<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\response as respon;
use App\User;
use App\Notifications\NotifyUserRespon;
use App\product_review as review;

class ResponseController extends Controller
{
    public function store(Request $request)
    {
        $respon = new respon;
        $respon->review_id = $request->review_id;
        $respon->admin_id = $request->admin_id;
        $respon->content = $request->content;
        $respon->save();
        $review = review::where('id', $request->review_id)->first();
        $user = User::where('id', $review->user_id)->first();
        $user->notify(new NotifyUserRespon($review->product_id));
        return response()->json(['success' => 'Balasan berhasil diberikan']);
    }
}
