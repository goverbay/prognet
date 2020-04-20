<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Produk;
use App\discount;

class DiscountController extends Controller
{
    public function tambah($id){
        return view('auth.admin.produk_tambah_diskon', ['id' => $id]);
    }

    public function store(Request $request){
        $diskon = new discount;

        $diskon->id_product = $request->id_product;
        $diskon->percentage = $request->percentage;
        $diskon->start = $request->start;
        $diskon->end = $request->end;
        $diskon->save();

        return redirect('/admin/produk/show/'.$request->id_product.'#diskon');
    }

    public function edit($id){
        $diskon = discount::find($id);

        return view('auth.admin.produk_edit_diskon', ['diskon' => $diskon]);
    }

    public function update(Request $request){
        $diskon = discount::find($request->id);

        $diskon->id_product = $request->id_product;
        $diskon->percentage = $request->percentage;
        $diskon->start = $request->start;
        $diskon->end = $request->end;
        $diskon->save();

        return redirect('/admin/produk/show/'.$request->id_product.'#diskon');
    }

    public function hapus($id){
        $diskon = discount::find($id);
        $id_product = $diskon->id_product;
        $diskon->delete();

        return redirect('/admin/produk/show/'.$id_product.'#diskon');
    }
}
