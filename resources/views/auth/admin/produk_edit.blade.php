@extends('auth.admin.app')

@section('konten')
    <h1>Edit Data Produk</h1>
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
            <form class="forms-sample" action="/admin/produk/update" method="POST">
                @csrf
              <div class="form-group row">
                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Nama Produk</label>
                <div class="col-sm-9">
                  <input type="hidden" name="id" value="{{$produk->id}}">
                  <input type="text" class="form-control" name="product_name" value="{{$produk->product_name}}">
                </div>
              </div>
              <div class="form-group row">
                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Harga Produk</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="price" value="{{$produk->price}}">
                </div>
              </div>
              <div class="form-group row">
                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Deskripsi Produk</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="description" value="{{$produk->description}}">
                </div>
              </div>
              <div class="form-group row">
                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Rating Produk</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="product_rate" value="{{$produk->product_rate}}">
                </div>
              </div>
              <div class="form-group row">
                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Stock Produk</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="stock" value="{{$produk->stock}}">
                </div>
              </div>
              <div class="form-group row">
                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Produk Weight</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="weight" value="{{$produk->weight}}">
                </div>
              </div>
              <input type="submit" class="btn btn-gradient-primary mr-2" value="Submit" onclick="return confirm('Are you sure?')">
            </form>
            <br>
            <a href="/admin/produk/show/{{$produk->id}}" onclick="return confirm('Are you sure?')"><button class="btn btn-light">Cancel</button></a>
          </div>
        </div>
      </div>
@endsection