@extends('auth.admin.app')

@section('konten')

    <h1>Tambah Data Gambar Produk</h1>
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
            <form class="forms-sample" action="/admin/produk/tambah_gambar" method="POST" enctype="multipart/form-data">
                @csrf
              <div class="form-group row">
                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Masukkan Gambar</label>
                <div class="col-sm-9">
                    <input type="hidden" name="product_id" value="{{$id}}">
                    <input type="file" class="form-control" name="file" onchange="preview_image(event)">
                </div>
              </div>
              <div class="form-group row">
                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Preview Image</label>
                <img src="{{url('/produk_image/img.png')}}"  id="output_image" class="mb-2 mw-50 w-50 h-50 rounded" alt="image">
              </div>
              <input type="submit" class="btn btn-gradient-primary mr-2" value="Submit" onclick="return confirm('Are you sure?')">
            </form>
            <br>
            <a href="/admin/produk/show/{{$id}}" onclick="return confirm('Are you sure?')"><button class="btn btn-light">Cancel</button></a>
          </div>
        </div>
      </div>
@endsection

<script type="text/javascript">
    function preview_image(event){
      let reader = new FileReader();
      reader.onload = function(){
        let output = document.getElementById('output_image');
        output.src = reader.result;
      }
      if(event.target.files[0]){
        reader.readAsDataURL(event.target.files[0]);
      }
    }
</script>