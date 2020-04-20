@extends('auth.admin.app')

@section('konten')
    <h1>Tambah Data Produk</h1>
    <br>
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <form class="forms-sample" action="/admin/produk/store" method="POST">
                @csrf
              <div class="form-group row">
                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Nama Produk</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="product_name" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Harga Produk</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="price" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Deskripsi Produk</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="description" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Rating Produk</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="product_rate" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Stock Produk</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="stock" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Produk Weight</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="weight" required>
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