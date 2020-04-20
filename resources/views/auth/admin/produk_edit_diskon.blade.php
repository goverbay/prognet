@extends('auth.admin.app')

@section('konten')
    <h1>Edit Data Diskon</h1>
    <br>
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <form class="forms-sample" action="/admin/produk/diskon/edit" method="POST">
                @csrf
              <div class="form-group row">
                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Jumlah Diskon(%)</label>
                <div class="col-sm-9">
                  <input type="hidden" name="id_product" value="{{$diskon->id_product}}">
                  <input type="hidden" name="id" value="{{$diskon->id}}">
                  <input type="text" class="form-control" name="percentage" value="{{$diskon->percentage}}">
                </div>
              </div>
              <div class="form-group row">
                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Awal Diskon</label>
                <div class="col-sm-9">
                  <input type="date" class="form-control" name="start" value="{{$diskon->start}}">
                </div>
              </div>
              <div class="form-group row">
                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Akhir Diskon</label>
                <div class="col-sm-9">
                  <input type="date" class="form-control" name="end" value="{{$diskon->end}}">
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