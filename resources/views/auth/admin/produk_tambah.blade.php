@extends('auth.admin.app')

@section('konten')
    <h1>Tambah Data Produk</h1>
    <br>
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form class="forms-sample" action="/admin/produk/store" method="POST" enctype="multipart/form-data">
                @csrf
              <div class="form-group row">
                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Nama Produk</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="product_name" required value="{{old('product_name')}}">
                </div>
              </div>
              <div class="form-group row">
                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Harga Produk</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="price" required value="{{old('price')}}">
                </div>
              </div>
              <div class="form-group row">
                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Deskripsi Produk</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="description" required value="{{old('description')}}">
                </div>
              </div>
              <div class="form-group row">
                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Stock Produk</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="stock" required value="{{old('stock')}}">
                </div>
              </div>
              <div class="form-group row">
                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Produk Weight</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="weight" required value="{{old('weight')}}">
                </div>
              </div>
              <div class="form-group row">
                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Kategori</label>
                <div class="col-sm-9">
                  <select class="form-control" name="kategori[]" multiple>
                    @foreach ($kategori as $item)
                        <option value="{{$item->id}}">{{$item->category_name}}</option>
                    @endforeach
                  </select>                
                </div>
              </div>
              <div class="form-group row">
                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Masukkan Gambar</label>
                <div class="col-sm-9">
                    <input type="file" class="form-control" name="file[]" multiple>
                    <p>Dapat memilih lebih dari 1 gambar</p>
                </div>
              </div>  
              <input type="submit" class="btn btn-gradient-primary mr-2" value="Submit" onclick="return confirm('Are you sure?')">
            </form>
            <br>
            <a href="/admin/produk" onclick="return confirm('Are you sure?')"><button class="btn btn-light">Cancel</button></a>
          </div>
        </div>
      </div>
@endsection