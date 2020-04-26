@extends('auth.admin.app')

@section('konten')
    <h1>Tambah Data Diskon</h1>
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
            <form class="forms-sample" action="/admin/produk/tambah_diskon" method="POST">
                @csrf
              <div class="form-group row">
                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Jumlah Diskon(%)</label>
                <div class="col-sm-9">
                  <input type="hidden" name="id_product" value="{{$id}}">
                  <input type="text" class="form-control" name="percentage" value="{{old('percentage')}}">
                </div>
              </div>
              <div class="form-group row">
                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Awal Diskon</label>
                <div class="col-sm-9">
                  <input type="date" class="form-control" name="start" required value="{{old('start')}}">
                </div>
              </div>
              <div class="form-group row">
                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Akhir Diskon</label>
                <div class="col-sm-9">
                  <input type="date" class="form-control" name="end" required value="{{old('end')}}">
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