@extends('auth.admin.app')

@section('konten')
    <h1>Manipulasi Data Kategori Produk</h1>
    {{-- @php
        dd($kategori);
    @endphp --}}
    <br>
    <a href="/admin/kategori_produk/tambah"> + Tambah Data Kategori Produk</a>
        
        <br/>
        <br/>

    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        
                        <th>No</th>
                        <th>Nama Kategori Produk</th>
                        <th>Opsi</th>
                    </tr>
                    @if (isset($kategoris))
                        @foreach ($kategoris as $kategori)
                            <tr>
                                {{-- {{dd($pegawai)}} --}}
                                <td>{{$loop->iteration}}</td>
                                <td>{{$kategori->category_name}}</td>
                                <td>
                                    <a href="/admin/kategori_produk/edit/{{$kategori->id}}"><i class="mdi mdi-border-color" ></i> </a>
                                    <a onclick="return confirm('Are you sure?')" href="/admin/kategori_produk/hapus/{{$kategori->id}}"> <i class="mdi mdi-delete text-danger"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <td>Belum ada data kategori produk!</td>
                    @endif          
                    </table>
                </div>
            </div>
    </div>
@endsection