@extends('auth.admin.app')

@section('konten')
    <h1>Manipulasi Data Produk</h1>
    {{-- @php
        dd($produks);
    @endphp --}}
    <br>
    <a href="/admin/produk/tambah"> + Tambah Data Produk</a>
        
        <br/>
        <br/>

    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Deskripsi Produk</th>
                        <th>Produk Rate</th>
                        <th>Stok</th>
                        <th>Weight</th>
                        <th>Kategori</th>
                        <th>Opsi</th>
                    </tr>
                    @if ($produks->count())
                        @foreach ($produks as $produk)
                            <tr>
                                {{-- {{dd($pegawai)}} --}}
                                <td>{{$loop->iteration}}</td>
                                <td>{{$produk->product_name}}</td>
                                <td>{{$produk->price}}</td>
                                <td>{{$produk->description}}</td>
                                <td>{{$produk->product_rate}}</td>
                                <td>{{$produk->stock}}</td>
                                <td>{{$produk->weight}}</td>
                                <td>
                                    @foreach ($produk->category as $item)
                                        @if ($loop->iteration == $produk->category->count())
                                            {{$item->category_name}}
                                        @else
                                            {{$item->category_name}},
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    <a href="/admin/produk/show/{{$produk->id}}"><i class="mdi mdi-border-color" ></i> </a>
                                    <a onclick="return confirm('Are you sure?')" href="/admin/produk/hapus/{{$produk->id}}"> <i class="mdi mdi-delete text-danger"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <td>Belum ada data produk!</td>
                    @endif          
                    </table>
                </div>
            </div>
    </div>
@endsection