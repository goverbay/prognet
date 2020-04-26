<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\courier as Kurir;

class KurirController extends Controller
{
    public function index(){
        $kurirs = Kurir::all();
        return view('auth.admin.kurir', ['kurirs' => $kurirs]);
    }

    public function tambah_data(){
        return view('auth.admin.kurir_tambah');
    }

    public function store(Request $request){
        $messages = [
            'required' => ':attribute tidak boleh kosong',
        ];

        $this->validate($request,[
            'courier' => 'required',
        ],$messages);

        $kurir = new Kurir;

        $kurir->courier = $request->courier;
        $kurir->save();

        return redirect('/admin/kurir');
    }

    public function edit($id){
        $kurir = Kurir::find($id);

        return view('auth.admin.kurir_edit', ['kurir' => $kurir]);
    }

    public function update(Request $request){
        $messages = [
            'required' => ':attribute tidak boleh kosong',
        ];

        $this->validate($request,[
            'courier' => 'required',
        ],$messages);
        
        $id = $request->id;
        $kurir = Kurir::find($id);

        $kurir->courier = $request->courier;
        $kurir->save();

        return redirect('/admin/kurir');
    }

    public function hapus($id){
        $kurir = Kurir::find($id);

        $kurir->delete();

        return redirect('/admin/kurir');
    }

}
