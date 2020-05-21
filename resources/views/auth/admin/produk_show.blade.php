@extends('auth.admin.app')

@section('konten')
    <h1>Rincian Data Produk</h1>
   
    <br>
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <form class="forms-sample" action="/admin/produk/store" method="POST">
                @csrf
                <h4>Data Produk</h4>
              <div class="form-group row">
                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Nama Produk</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="product_name" value="{{$produk->product_name}}" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Harga Produk</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="price" value="{{$produk->price}}" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Deskripsi Produk</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="description" value="{{$produk->description}}" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Rating Produk</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="product_rate" value="{{$produk->product_rate}}" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Stock Produk</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="product_rate" value="{{$produk->stock}}" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Produk Weight</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="product_rate" value="{{$produk->weight}}" readonly>
                </div>
              </div>
            </form>
            <br>
            <a href="/admin/produk/edit/{{$produk->id}}"><button class="btn btn-warning">Edit Produk</button></a>
          </div>
        </div>
      </div>

      <div id="kategori">
        <div class="col-md-12 grid-margin stretch-card" >
          <div class="card">
            <div class="card-body">
              <form class="forms-sample" action="/admin/produk/store" method="POST">
                  @csrf
                  <h4>Data Kategori Produk</h4>
                  <a href="/admin/produk/tambah_kategori/{{$produk->id}}">+ Tambah kategori</a>
                  <div class="table-responsive">
                      <table class="table">
                          <tr>     
                              <th>No</th>
                              <th>Nama Kategori Produk</th>
                              <th>Opsi</th>
                          </tr>
                          @if (!is_null($produk->category))
                          @foreach ($produk->category as $kategori)
                              <tr>
                                  <td>{{$loop->iteration}}</td>
                                  <td>{{$kategori->category_name}}</td>
                                  <td>
                                      <a onclick="return confirm('Are you sure?')" href="/admin/produk/kategori_produk/hapus/{{$kategori->pivot->id}}"> <i class="mdi mdi-delete text-danger"></i></a>
                                  </td>
                              </tr>
  
                          @endforeach
                          @else
                              <td>Belum ada data kategori produk!</td>
                          @endif          
                          </table>
                      </div>
                  
              </form>
              <br>
              <a href="/admin/produk" onclick="return confirm('Are you sure?')"><button class="btn btn-light">Back</button></a>
            </div>
          </div>
        </div>
      </div>
      

      <div class="col-md-12 grid-margin stretch-card" id="gambar">
        <div class="card">
          <div class="card-body">
            <form class="forms-sample" action="/admin/produk/store" method="POST">
                @csrf
                
                <h4>Data Gambar Produk</h4>
                <a href="/admin/produk/tambah_gambar/{{$produk->id}}">+ Tambah Gambar</a>
                <div class="table-responsive">
                    <table class="table">
                        <tr>     
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Opsi</th>
                        </tr>
                        @if ($produk->product_image->count())
                        @foreach ($produk->product_image as $image)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>
                                    <img src="{{url('/produk_image/'.$image->image_name)}}"  class="mb-2 mw-50 w-50 h-50 rounded" alt="image" >
                                </td>
                                <td>
                                    <a onclick="return confirm('Are you sure?')" href="/admin/produk/gambar/hapus/{{$image->id}}"> <i class="mdi mdi-delete text-danger"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        @else
                            <td>Belum ada data gambar produk!</td>
                        @endif          
                        </table>
                    </div>
            </form>
            <br>
            <a href="/admin/produk" onclick="return confirm('Are you sure?')"><button class="btn btn-light">Back</button></a>
          </div>
        </div>
      </div>

      <div class="col-md-12 grid-margin stretch-card" id="diskon">
        <div class="card">
          <div class="card-body">
            <form class="forms-sample" action="" method="POST">
                @csrf
                
                <h4>Data Diskon Produk</h4>
                {{-- @php
                    echo gettype($produk->discount);
                    dd($tgl_diskon);
                    
                @endphp --}}
                @if (!$produk->discount->count())
                    <a href="/admin/produk/tambah_diskon/{{$produk->id}}">+ Tambah Diskon</a>
                @else
                  @if (date('Y-m-d') > date($tgl_diskon->end))
                      <a href="/admin/produk/tambah_diskon/{{$produk->id}}">+ Tambah Diskon</a>
                  @endif                
                @endif
                
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th>No</th>
                            <th>Diskon (%)</th>
                            <th>Awal Diskon</th>
                            <th>Akhir Diskon</th>
                            <th>Opsi</th>
                        </tr>
                        @if ($produk->discount->count())
                        @foreach ($produk->discount->sortByDesc('id') as $diskon)
                            <tr>
                                <td>@if (date('Y-m-d') > date($diskon->end))
                                      <label class="badge badge-gradient-secondary">Expired</label>
                                    @endif {{$loop->iteration}}
                                </td>
                                <td>{{$diskon->percentage}}</td>
                                <td>{{$diskon->start}}</td>
                                <td>{{$diskon->end}}</td>
                                <td>
                                  <a href="/admin/produk/diskon/edit/{{$diskon->id}}"><i class="mdi mdi-border-color" ></i> </a>
                                  <a onclick="return confirm('Are you sure?')" href="/admin/produk/diskon/hapus/{{$diskon->id}}"> <i class="mdi mdi-delete text-danger"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        @else
                            <td>Belum ada data diskon produk!</td>
                        @endif          
                        </table>
                    </div>
            </form>
            <br>
            <a href="/admin/produk" onclick="return confirm('Are you sure?')"><button class="btn btn-light">Back</button></a>
          </div>
        </div>
      </div>

      <div class="col-md-12 grid-margin stretch-card" id="review">
        <div class="card">
          <div class="card-body">
                
                <h4>Data Review Produk</h4>
                <div class="table-responsive">
                    <table class="table">
                        <tr>     
                            <th>No</th>
                            <th>Rate</th>
                            <th>Riview</th>
                            <th>User</th>
                        </tr>
                        @if ($produk->product_review->count())
                        @foreach ($produk->product_review as $item)
                        @php
                            $status = 0;
                        @endphp
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->rate}}</td>
                                <td>{{$item->content}}</td>
                                <td>{{$item->user->name}}</td>
                                    
                                <td>
                                    
                                    <div class="d-flex flex-row bd-highlight mb-3">
                                      <input type="hidden" name="review_id" id="review_id{{$loop->iteration-1}}" value="{{$item->id}}">
                                      @foreach ($respon as $r)
                                          @if ($item->id == $r->review_id)
                                              @php
                                                  $status = $status + 1;
                                              @endphp
                                          @else
                                              @php
                                                  $status = $status;
                                              @endphp
                                          @endif
                                      @endforeach
                                      @if ($status !=0)
                                          <button class="btn-sm btn-success tambah-respon" data-toggle="modal" data-target="#modalTambahReview" disabled>Review telah diberi balasan</button>
                                      @else
                                          <button class="btn-sm btn-success tambah-respon" data-toggle="modal" data-target="#modalTambahReview">Balas Review</button>
                                      @endif
                      
                                    <a onclick="return confirm('Are you sure?')" href="/admin/produk/review/hapus/{{$item->id}}"> <i class="mdi mdi-delete text-danger mdi-5x"></i></a>
                                </div>
                                </td>
                            </tr>
                        @endforeach
                        @else
                            <td>Belum ada data review produk!</td>
                        @endif          
                        </table>
                    </div>
            <br>
            <a href="/admin/produk" onclick="return confirm('Are you sure?')"><button class="btn btn-light">Back</button></a>
          </div>
        </div>
      </div>


@endsection

        <!-- Modal: Tambah Review -->
        <div class="modal fade" id="modalTambahReview" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog cascading-modal" role="document">
          <!-- Content -->
          <div class="modal-content">

            <!-- Header -->
            <div class="modal-header light-blue darken-3 white-text">
              <h4 class="">Tambah Rating dan Review Produk</h4>
              <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <!-- Body -->
            <div class="modal-body mb-0">
              <input id="signup-token" name="_token" type="hidden" value="{{csrf_token()}}">

                <input type="hidden" name="review_id" id="review_id" value="">
                <input type="hidden" name="admin_id" id="admin_id" value="{{Auth::guard('admin')->user()->id}}">

              <div class="md-form form-sm">
                <label for="form8">Masukkan Review</label>
                <textarea type="text" id="content" class="md-textarea form-control form-control-sm" rows="3" required></textarea>
              </div>

              
              <div class="text-center mt-1-half">
                <button type="submit" class="btn btn-info mb-2" id="kirim-review">Send <i class="fas fa-paper-plane ml-1"></i></button>
              </div>
            </div>
          </div>
          <!-- Content -->
        </div>
      </div>
      <!-- Modal: Tambah Review -->

<script type="text/javascript" src="{{asset('/assets/js/jquery-3.4.1.min.js')}}"></script>

<script>
  $(document).ready(function(e){
        $(".tambah-respon").click(function(e){
        var index = $(".tambah-respon").index(this);
        var review_id = $("#review_id"+index).val();
        $("#review_id").val(review_id);
        console.log(review_id);
      });
      
      $("#kirim-review").click(function(e){
        jQuery.ajax({
              url: "{{url('/respon')}}",
              method: 'post',
              data: {
                  _token: $('#signup-token').val(),
                  review_id: $("#review_id").val(),
                  admin_id: $("#admin_id").val(),
                  content: $("#content").val(),
              },
              success: function(result){
                $('#modalTambahReview').modal('hide');
                alert(result.success);
              }
          });
      });

  });
</script>
      