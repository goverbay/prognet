@extends('app')

@section('css')
    
@endsection

@section('konten')
  <!-- Main Container -->
  <div class="container mt-5 pt-3">

    <!-- Section: product details -->
    <section id="productDetails" class="pb-5">

      <!-- News card -->
      <div class="card mt-5 hoverable">

        <div class="row mt-5">

          <div class="col-lg-6">

            <div class="row mx-2">

              <!-- Carousel Wrapper -->
              <div id="carousel-thumb" class="carousel slide carousel-fade carousel-thumbnails mb-5 pb-4"
                data-ride="carousel">

                <!-- Slides -->
                <div class="carousel-inner text-center text-md-left" role="listbox">

                  

                  @foreach ($produk->product_image as $item)
                    @if ($loop->iteration == 1)
                        <div class="carousel-item active">

                            <img src="{{asset('/produk_image/'.$item->image_name)}}"
                            alt="Second slide" class="img-fluid" width="400px" height="190px">

                        </div>
                    @else
                        <div class="carousel-item">

                            <img src="{{asset('/produk_image/'.$item->image_name)}}"
                            alt="Second slide" class="img-fluid" width="400px" height="190px">

                        </div>
                    @endif
                  @endforeach


                </div>
                <!-- Slides -->

                <!-- Thumbnails -->
                <a class="carousel-control-prev" href="#carousel-thumb" role="button" data-slide="prev">

                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>

                  <span class="sr-only">Previous</span>

                </a>

                <a class="carousel-control-next" href="#carousel-thumb" role="button" data-slide="next">

                  <span class="carousel-control-next-icon" aria-hidden="true"></span>

                  <span class="sr-only">Next</span>

                </a>
                <!-- Thumbnails -->

              </div>

              
              <!-- Carousel Wrapper -->

            </div>

            <!-- Grid row -->

            <!-- Grid row -->

          </div>

          <div class="col-lg-5 mr-3 text-center text-md-left">

            <h2
              class="h2-responsive text-center text-md-left product-name font-weight-bold dark-grey-text mb-1 ml-xl-0 ml-4">

              <strong>{{$produk->product_name}} </strong>

            </h2>

            </strong>

            </h2>

            <span class="badge badge-success product mb-4 ml-2">SALE</span>

            <h3 class="h3-responsive text-center text-md-left mb-5 ml-xl-0 ml-4">
                @php
                    $home = new Home;
                    $hasil = $home->diskon($produk->discount,$produk->price);
                @endphp
                @if ($hasil != 0)
                    <span class="red-text font-weight-bold">
                        <strong>Rp</strong><strong id="price">{{$hasil}}</strong>
                    </span>
                    <span class="grey-text">
                        <small>
                        <s>Rp{{$produk->price}}</s>
                        </small>
                    </span>                
                @else
                    <span class="float-lef grey-text">Rp</span><span id="price" class="float-lef grey-text">{{$produk->price}}</li>
                @endif

            </h3>

            <p class="ml-xl-0 ml-4">{{$produk->description}}</p>


            <p class="ml-xl-0 ml-4">

              <strong>Weight: </strong>{{$produk->weight}}</p>


            <p class="ml-xl-0 ml-4">

              <strong>Availability: </strong>@if ($produk->stock <= 0)
                  Out of Stock
              @else
                In stock
              @endif </p>

            <section>
              
              <p class="text-danger" style="display:none" id="notif"></p>
              <strong>Jumlah Produk: </strong><span class="qtyx">1</span>

              <div class="btn-group radio-group ml-2" data-toggle="buttons">

                <label class="btn btn-sm btn-primary btn-rounded tombol-kurang">

                  <input type="radio" name="options" id="option1">&mdash;

                </label>

                <label class="btn btn-sm btn-primary btn-rounded tombol-tambah" >

                  <input type="radio" name="options" id="option2">+

                </label>
            </section>

            <!-- Add to Cart -->
            <section class="color">
              <div class="mt-5">
                <div class="row mt-3 mb-4">
                  <div class="col-md-12 text-center text-md-left text-md-right">
                    @if (is_null(Auth::user()))
                      <button class="btn btn-primary btn-rounded tombol1">
                        <i class="fas fa-cart-plus mr-2" aria-hidden="true"></i> Purchase</button>

                         <button class="btn btn-primary btn-rounded tombol1">
                        <i class="fas fa-cart-plus mr-2" aria-hidden="true"></i> Add to cart</button>
                     @else
                     <form action="/checkout" method="POST">
                      @csrf
                      <input type="hidden" name="product_id" value="{{$produk->id}}" id="product_id">
                      @if ($hasil != 0)
                          <input type="hidden" name="subtotal" id="subtotal" value="{{$hasil}}">
                      @else
                          <input type="hidden" name="subtotal" id="subtotal" value="{{$produk->price}}">
                      @endif
                      <input type="hidden" name="weight" value="{{$produk->weight}}">
                      <input type="hidden" name="qty" class="qty" value="1" readonly>
                     <button type="submit" class="btn btn-primary btn-rounded" class="tombol1" @if ($produk->stock == 0)
                         disabled
                     @endif>
                      <i class="fas fa-cart-plus mr-2" aria-hidden="true"></i> Purchase</button>
                    </form>
                      <input type="hidden" value="{{$produk->id}}" id="product_id">
                      <input type="hidden" value="{{Auth::user()->id}}" id="user_id">
                      <button class="btn btn-primary btn-rounded" id="ajaxSubmit" @if ($produk->stock == 0)
                          disabled
                      @endif>
                          <i class="fas fa-cart-plus mr-2" aria-hidden="true"></i> Add to cart</button>
                    @endif
                  </div>
                </div>
              </div>
            </section>
            <!-- Add to Cart -->
          </div>
        </div>
      </div>
      <!-- News card -->

    </section>

    <!-- Section: product details -->

    <!-- Table -->

    <!-- Product Reviews -->
    <section id="reviews" class="pb-5 mt-4">

      <hr>

      <h4 class="h4-responsive dark-grey-text font-weight-bold my-5 text-center">

        <strong>Product Reviews</strong>

      </h4>

      <hr class="mb-5">

      <!-- Main wrapper -->
      <div class="comments-list text-center text-md-left">
        @if (!$produk->product_review->count())
          <div class="d-flex justify-content-center">    
            <div class="row mb-5">
                 <p><strong>Belum ada review produk.</strong></p> 
            </div>
          </div>
        @else
          @foreach ($produk->product_review as $item)
            <!-- First row -->
            <div class="row mb-5">
              
              <!-- Image column -->
              <div class="col-sm-2 col-12 mb-3">

                <img src="{{asset('/user/'.$item->user->profile_image)}}" alt="sample image"
                  class="avatar rounded-circle z-depth-1-half">

              </div>
              <!-- Image column -->

              <!-- Content column -->
              <div class="col-sm-10 col-12">

                <a>
                  {{-- @php
                      dd(Auth::user()->id);
                  @endphp --}}
                  <h5 class="user-name font-weight-bold">{{$item->user->name}} @if (Auth::user()->id == $item->user_id)
                    <button class="edit"  style="background-color: transparent" data-toggle="modal" data-target="#modalEditReview"><i class="fas fa-pencil-alt prefix"></i></button>
                  @endif</h5>

                </a>

                <!-- Rating -->
                <ul class="rating">
                  @for ($i = 0; $i < $item->rate; $i++)
                    <li>
                      <i class="fas fa-star blue-text"></i>
                    </li>
                  @endfor
                </ul>
                <input type="hidden" class="rate{{$loop->iteration-1}}" value="{{$item->rate}}">
                <input type="hidden" class="content{{$loop->iteration-1}}" value="{{$item->content}}">
                <input type="hidden" class="review_id{{$loop->iteration-1}}" value="{{$item->id}}">
                <div class="card-data">
                  <ul class="list-unstyled mb-1">
                    <li class="comment-date font-small grey-text">
                      <i class="far fa-clock-o"></i> {{$item->created_at}}</li>
                  </ul>
                </div>

                <p class="dark-grey-text article">{{$item->content}}</p>

              </div>
              <!-- Content column -->

            </div>
            <!-- First row -->
                @if ($item->response->count())
                  <!-- Balasan -->
                  @foreach ($item->response as $balasan)
                  <div class="row mb-5" style="margin-left: 5%">
                    
                    <!-- Image column -->
                    <div class="col-sm-2 col-12 mb-3">

                      <img src="{{asset($balasan->admin->profile_image)}}" alt="sample image"
                        class="avatar rounded-circle z-depth-1-half">

                    </div>
                    <!-- Image column -->

                    <!-- Content column -->
                    <div class="col-sm-10 col-12">

                      <a>

                        <h5 class="user-name font-weight-bold"><span class="badge success-color">Admin</span>{{$balasan->admin->name}}</h5>

                      </a>
                      <!-- Rating -->
                      <div class="card-data">
                        <ul class="list-unstyled mb-1">
                          <li class="comment-date font-small grey-text">
                            <i class="far fa-clock-o"></i> {{$balasan->created_at}}</li>
                        </ul>
                      </div>

                      <p class="dark-grey-text article">{{$balasan->content}}</p>

                    </div>
                    <!-- Content column -->

                  </div>

                  @endforeach
                  <!-- Balasan -->

                @endif

          @endforeach

        @endif

      </div>
      <!-- Main wrapper -->

    </section>
    <!-- Product Reviews -->


    <!-- Section: Products v.5 -->

  </div>
  <!-- Main Container -->
@endsection

        <!-- Modal: Tambah Review -->
        <div class="modal fade" id="modalEditReview" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog cascading-modal" role="document">
          <!-- Content -->
          <div class="modal-content">

            <!-- Header -->
            <div class="modal-header light-blue darken-3 white-text">
              <h4 class="">Edit Rating dan Review Produk</h4>
              <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <!-- Body -->
            <div class="modal-body mb-0">
              <form action="/edit/review" method="POST">
                @csrf
                <input type="hidden" name="review_id" id="review_id" value="">
              <div class="md-form form-sm">
                Masukkan Rate untuk Produk
                <select name="rate" id="rate" class="form-control form-control-sm">
                  @for ($i = 0; $i < 6; $i++)
                  <option value="{{$i}}">{{$i}}</option>
                  @endfor
                </select>
              </div>

              <div class="md-form form-sm">
                <textarea type="text" name="content" id="content" class="md-textarea form-control form-control-sm" rows="3" required></textarea>
                <label for="form8">Masukkan Review</label>
              </div>

              
              <div class="text-center mt-1-half">
                <button type="submit" class="btn btn-info mb-2" id="kirim-review">Send <i class="fas fa-paper-plane ml-1"></i></button>
              </div>
            </form>
            </div>
          </div>
          <!-- Content -->
        </div>
      </div>
      <!-- Modal: Tambah Review -->


@section('javascript')
    
@endsection
<script type="text/javascript" src="{{asset('/assets/js/jquery-3.4.1.min.js')}}"></script>

<script>

    jQuery(document).ready(function(e){
        jQuery('#ajaxSubmit').click(function(e){
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: "{{url('/tambah_cart')}}",
                method: 'post',
                data: {
                    product_id: jQuery('#product_id').val(),
                    user_id: jQuery('#user_id').val(),
                    qty: jQuery('.qty').val(),
                },
                success: function(result){
                    jQuery('#jumlahcart').text(result.jumlah);
                    console.log(result.jumlah);
                }
            });
        });

        jQuery('.tombol1').click(function(e){
                e.preventDefault();
                alert('Login terlebih dahulu');
                window.location = "{{url('/login')}}"
        });


      jQuery('.tombol-tambah').click(function(e){
        console.log($("#price").text());
        var jumlah = $(".qty").val();
        var jumlah = parseInt(jumlah)+1;
        var subtotal = 0;
        var price = parseInt($("#price").text());
        $(".qty").val(jumlah);
        $(".qtyx").text(jumlah);
        
        
        if(parseInt(jumlah) > {{$produk->stock}}){
            $("#notif").css('display','inline');
            $("#notif").text('Jumlah stock melebihi stock produk');
            $("#notif").append('<br>');
            $(".qty").val(jumlah-1);
            $(".qtyx").text(jumlah-1);
        }else{
          $("#notif").css('display','none');
        }

        subtotal = price * jumlah;
        $("#subtotal").val(subtotal);
      });

      jQuery('.tombol-kurang').click(function(e){
        var jumlah = $(".qty").val();
        var jumlah = parseInt(jumlah)-1;
        var subtotal = 0;
        var price = parseInt($("#price").text());
        $(".qty").val(jumlah);
        $(".qtyx").text(jumlah);

        if(parseInt(jumlah) == 0){
            $("#notif").css('display','inline');
            $("#notif").text('Tolong stock tidak boleh 0');
            $("#notif").append('<br>');
            $(".qty").val(1);
            $(".qtyx").text(1);
        }else{
          $("#notif").css('display','none');
        }
        subtotal = price * jumlah;
        $("#subtotal").val(subtotal);
      });

      jQuery('.edit').click(function(e){
          var index = jQuery('.edit').index(this);
          var rating = jQuery('.rate'+index).val();
          var konten = jQuery('.content'+index).val();
          var id = jQuery('.review_id'+index).val();
          jQuery('#rate').val(rating);
          jQuery('#content').val(konten);
          jQuery('#review_id').val(id);

          // jQuery('#kirim-review').click(function(e){
          //   jQuery.ajax({
          //     url: "{{url('/edit/review')}}",
          //     method: 'post',
          //     data: {
          //         _token: $('#signup-token').val(),
          //         review_id: id,
          //         rate: rating,
          //         content: konten,
          //     },
          //     success: function(result){
          //       $('#modalEditReview').modal('hide');
          //       alert(result.success);
          //     }
          // });

          // });
      });

    });
</script>

