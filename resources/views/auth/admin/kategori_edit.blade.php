@extends('auth.admin.app')

@section('konten')
    <h1>Edit Data Kategori Produk</h1>
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
            <form class="forms-sample" action="/admin/kategori_produk/update" method="POST">
                @csrf
              <div class="form-group row">
                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Nama Kategori Produk</label>
                <div class="col-sm-9">
                  <input type="hidden" name="id" value="{{$kategori->id}}">
                  <input type="text" class="form-control" name="category_name" value="{{$kategori->category_name}}">
                </div>
              </div>
              <input type="submit" class="btn btn-gradient-primary mr-2" value="Submit" onclick="return confirm('Are you sure?')">
            </form>
            <br>
            <a href="/admin/kategori_produk" onclick="return confirm('Are you sure?')"><button class="btn btn-light">Cancel</button></a>
          </div>
        </div>
      </div>
@endsection