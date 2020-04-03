@extends('auth.admin.app')

@section('konten')
<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <h4 class="card-title">Edit Data Admin</h4>
        <form class="forms-sample" action="/admin/edit_profile" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{$admin->id}}">
          <div class="form-group row">
            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Nama</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="nama" value="{{$admin->name}}">
            </div>
          </div>
          <div class="form-group row">
            <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Nomor Telp</label>
            <div class="col-sm-9">
              <input type="text" class="form-control"  name="alamat" value="{{$admin->phone}}">
            </div>
          </div>
          <div class="form-group row">
            <label for="exampleInputMobile" class="col-sm-3 col-form-label">Foto Profile</label>
            <div class="col-sm-9">
                <img src="{{asset($admin->profile_image)}}" class="mb-2 mw-50 w-25 rounded" alt="image">
                <br>
                <form action="/admin/edit-profile/image" method="POST">
                    <input type="file" class="btn btn-light" value="Ganti">
                    <button class="btn btn-light" action="/home">Ganti</button>
                </form>
              
            </div>
          </div>
          <input type="submit" class="btn btn-gradient-primary mr-2" value="Submit" onclick="return confirm('Are you sure?')">
          <a href="/admin/home" onclick="return confirm('Are you sure?')"><button class="btn btn-light">Cancel</button></a>
        </form>
      </div>
    </div>
  </div>
@endsection