<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Admin;
use App\transaction;

class AdminController extends Controller
{
    public function index(){
        $transaksi = transaction::whereMonth('created_at','=', date('m'))->whereYear('created_at','=', date('Y'))->get();
        $status = ['unverified' => 0,'expired' => 0, 'canceled' => 0, 'verified' => 0, 'delivered' => 0, 'success' => 0, 'harga' => 0, 'total' => $transaksi->count()];
        $status['unverified'] = $this->findCountStatus('unverified',1);
        $status['expired'] = $this->findCountStatus('expired',1);
        $status['canceled'] = $this->findCountStatus('canceled',1);
        $status['verified'] = $this->findCountStatus('verified',1);
        $status['delivered'] = $this->findCountStatus('delivered',1);
        $status['success'] = $this->findCountStatus('success',1);

        foreach($transaksi as $item){
            if($item->status == 'verified' || $item->status == 'delivered' || $item->status == 'success'){
                $status['harga'] = $status['harga'] + $item->total;
            }
        }

        $transaksi_tahun = transaction::whereYear('created_at','=', date('Y'))->get();
        $status_tahun = ['unverified' => 0,'expired' => 0, 'canceled' => 0, 'verified' => 0, 'delivered' => 0, 'success' => 0, 'harga' => 0];
        $status_tahun['unverified'] = $this->findCountStatus('unverified',2);
        $status_tahun['expired'] = $this->findCountStatus('expired',2);
        $status_tahun['canceled'] = $this->findCountStatus('canceled',2);
        $status_tahun['verified'] = $this->findCountStatus('verified',2);
        $status_tahun['delivered'] = $this->findCountStatus('delivered',2);
        $status_tahum['success'] = $this->findCountStatus('success',2);

        foreach($transaksi_tahun as $item){
            if($item->status == 'verified' || $item->status == 'delivered' || $item->status == 'success'){
                $status_tahun['harga'] = $status_tahun['harga'] + $item->total;
            }
        }

        for($i = 1;$i<=12;$i++){
            $bulan[$i] = $transaksi = transaction::whereMonth('created_at','=', $i)->whereYear('created_at','=', date('Y'))->count();
        }
        return view('auth.admin.home', ['transaksi' => $transaksi, 'status' => $status,'transaksi_tahun' => $transaksi_tahun, 'status_tahun'=>$status_tahun, 'bulan' => $bulan]);
    }

    public function findCountStatus($status,$cek)
    {
        if($cek==1){
            $count = transaction::whereMonth('created_at','=', date('m'))->whereYear('created_at','=', date('Y'))->where('status','=',$status)->count();
        }else{
            $count = transaction::whereYear('created_at','=', date('Y'))->where('status','=',$status)->count();
        }
        return $count;
    }

    public function editProfile(){
        $id = Auth::guard('admin')->user()->id;
        $admin = Admin::find($id);

        return view('auth.admin.edit_profile', ['admin' => $admin]);
    }
}
