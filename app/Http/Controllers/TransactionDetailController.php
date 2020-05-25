<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\transaction;
use App\Produk;
use App\product_review;
use App\response;
use App\Admin;
use App\User;
use App\Notifications\NotifyAdminProof;
use App\Notifications\NotifyUserStatus;
use App\Notifications\NotifyUserDelivered;
use Illuminate\Support\Facades\Auth;

class TransactionDetailController extends Controller
{
    public function index($id){
        $transaksi = transaction::with(['user','transaction_detail' => function($q){
            $q->with(['product' => function($qq){
                $qq->with('product_image');
            }]);
        }, 'courier'])->find($id);

        $review = product_review::where('user_id', '=', $transaksi->user_id)->get();

        if($transaksi->user_id != Auth::user()->id || is_null(Auth::user())){
            return abort(404);
        }else{
            return view('user.detail_transaksi',['transaksi' => $transaksi, 'review' => $review]);
        }
    }

    public function NotifyIndex($id, $id2){
        $transaksi = transaction::with(['user','transaction_detail' => function($q){
            $q->with(['product' => function($qq){
                $qq->with('product_image');
            }]);
        }, 'courier'])->find($id);

        $review = product_review::where('user_id', '=', $transaksi->user_id)->get();

        if($transaksi->user_id != Auth::user()->id || is_null(Auth::user())){
            return abort(404);
        }else{
            auth()->user()->unReadNotifications->where('id', $id2)->markAsRead();
            return view('user.detail_transaksi',['transaksi' => $transaksi, 'review' => $review]);
        }
    }

    public function membatalkanPesanan(Request $request){
        $transaksi = transaction::with('transaction_detail')->find($request->id);
        $user = User::where('id', $transaksi->user_id)->first();
       
        if($request->status == 1){
            $transaksi->status = 'canceled';
            $transaksi->save();
            $user->notify(new NotifyUserStatus($transaksi->id));
            return redirect('/transaksi/detail/'.$request->id);
        }elseif($request->status == 3){
            $transaksi->status = 'verified';
            $transaksi->save();

            // dd($transaksi->transaction_detail);
            foreach($transaksi->transaction_detail as $item){
                $produk = Produk::find($item->product_id);
                // dd($produk);
                $produk->stock = $produk->stock - $item->qty;
                // dd($produk->stock);
                $produk->save();
            }
            $user->notify(new NotifyUserStatus($transaksi->id));
            return redirect('admin/transaksi/detail/'.$request->id);
        }elseif($request->status == 2){
            $transaksi->status = 'success';
            $transaksi->save();
            $user->notify(new NotifyUserStatus($transaksi->id));
            return redirect('/transaksi/detail/'.$request->id);
        }else{
            $transaksi->status = 'delivered';
            $transaksi->save();
            $user->notify(new NotifyUserDelivered($transaksi->id));
            return redirect('admin/transaksi/detail/'.$request->id);
        }
    }

    public function uploadProof(Request $request){
        $transaksi = transaction::find($request->id);

        $file = $request->file('file');
        $path = 'proof_payment';
        $nama_file = time()."_".$file->getClientOriginalName();
        $file->move($path,$nama_file);

        $transaksi->proof_of_payment = $nama_file;
        $transaksi->save();
        
        $notrans = transaction::where('id',$transaksi->id)->first();
        $no=auth()->user()->id;
        $admin = Admin::all();
        $user = User::where('id',$no)->first();
        
        foreach($admin as $ad)
            $ad->notify(new NotifyAdminProof($user, $notrans->id));
    

        return redirect('/transaksi/detail/'.$request->id);
    }

    public function adminIndex($id){
        $transaksi = transaction::with(['transaction_detail' => function($q){
            $q->with(['product' => function($qq){
                $qq->with('product_image');
            }]);
        }, 'courier'])->find($id);

        if(is_null(Auth::guard('admin')->user())){
            return abort(404);
        }else{
            return view('auth.admin.detail_transaksi',['transaksi' => $transaksi]);
        }
        
        
    }

    public function adminNotifyIndex($id, $id2){
        $transaksi = transaction::with(['transaction_detail' => function($q){
            $q->with(['product' => function($qq){
                $qq->with('product_image');
            }]);
        }, 'courier'])->find($id);

        if(is_null(Auth::guard('admin')->user())){
            return abort(404);
        }else{
            Auth::guard('admin')->user()->unReadNotifications->where('id', $id2)->markAsRead();
            return view('auth.admin.detail_transaksi',['transaksi' => $transaksi]);
        }
        
        
    }
}
