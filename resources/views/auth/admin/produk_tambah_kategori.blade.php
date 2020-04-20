@extends('auth.admin.app')

@section('konten')

    <h1>Tambah Data Kategori Produk</h1>
    <br>
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <form class="forms-sample" action="/admin/produk/tambah_kategori" method="POST">
                @csrf
              <div class="form-group row">
                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Nama Produk</label>
                <div class="col-sm-9">
                    <input type="hidden" name="product_id" value="{{$id}}">
                    <select name="category_id" class="form-control" autofocus>
                      @if (!$kategori->count())
                          <option>Produk telah memiliki seluruh kategori!</option>
                      @else
                          @foreach ($kategori as $item)
                              <option value="{{$item->id}}">{{$item->category_name}}</option>
                          @endforeach
                      @endif
                    </select>
                </div>
              </div>
              @if (!$kategori->count())
                  
              @else
                <input type="submit" class="btn btn-gradient-primary mr-2" value="Submit" onclick="return confirm('Are you sure?')">
              @endif
              
            </form>
            <br>
            <a href="/admin/produk/show/{{$id}}#kategori" onclick="return confirm('Are you sure?')"><button class="btn btn-light">Cancel</button></a>
          </div>
        </div>
      </div>
@endsection