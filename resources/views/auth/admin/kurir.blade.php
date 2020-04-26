@extends('auth.admin.app')

@section('konten')
    <h1>Manipulasi Data kurir Produk</h1>
    {{-- @php
        dd($kurir);
    @endphp --}}
    <br>
    <a href="/admin/kurir/tambah"> + Tambah Data Kurir Produk</a>
        
        <br/>
        <br/>

    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        
                        <th>No</th>
                        <th>Nama Kurir Produk</th>
                        <th>Opsi</th>
                    </tr>
                    @if ($kurirs->count())
                        @foreach ($kurirs as $kurir)
                            <tr>
                                {{-- {{dd($pegawai)}} --}}
                                <td>{{$loop->iteration}}</td>
                                <td>{{$kurir->courier}}</td>
                                <td>
                                    <a href="/admin/kurir/edit/{{$kurir->id}}"><i class="mdi mdi-border-color" ></i> </a>
                                    <a onclick="return confirm('Are you sure?')" href="/admin/kurir/hapus/{{$kurir->id}}"> <i class="mdi mdi-delete text-danger"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <td>Belum ada data kurir produk!</td>
                    @endif          
                    </table>
                </div>
            </div>
    </div>
@endsection