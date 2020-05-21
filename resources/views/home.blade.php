@extends('app')
@section('css')  
    <style type="text/css">
        .multiple-select-dropdown li [type=checkbox]+label {
        height: 1rem;
        }
    </style>
@endsection

@section('konten')
  <!-- Main Container -->
  <div class="container mt-5 pt-3">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark primary-color mt-5 mb-5">

      <!-- Navbar brand -->
      <a class="font-weight-bold white-text mr-4" href="#">Cari Produk  </a>

      <!-- Collapse button -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent1"
        aria-controls="navbarSupportedContent1" aria-expanded="false" aria-label="Toggle navigation"><span
          class="navbar-toggler-icon"></span></button>

      <!-- Collapsible content -->
      <div class="collapse navbar-collapse" id="navbarSupportedContent1">

        <!-- Links -->
        <!-- Links -->
        <!-- Search form -->
        <form class="search-form" role="search">

          <div class="form-group md-form my-0 waves-light">

            <input type="text" class="form-control" placeholder="Search" id="search">

          </div>

        </form>

      </div>
      <!-- Collapsible content -->

    </nav>

    <!-- Navbar -->
    <div class="row pt-4">

      <!-- Sidebar -->
      <div class="col-lg-3">

        <div class="">

          <!-- Grid row -->
          <div class="row">
            <!-- Filter by category -->
            <div class="col-md-6 col-lg-12 mb-5">

              <h5 class="font-weight-bold dark-grey-text"><strong>Category</strong></h3>

                <div class="divider"></div>

                <!-- Radio group -->
                
                <div class="form-group ">

                  <input class="form-check-input radiobtn" name="group100" type="radio" id="radio100" checked value="0">

                  <label for="radio100" class="form-check-label dark-grey-text">All</label>

                </div>
                <input id="signup-token" name="_token" type="hidden" value="{{csrf_token()}}">
                @foreach ($kategori as $item)
                    @if ($item->product->count())
                      <div class="form-group">
                        <input class="form-check-input radiobtn" name="group100" type="radio" id="radio10{{$loop->iteration}}" value="{{$item->id}}">
                        <label for="radio10{{$loop->iteration}}" class="form-check-label dark-grey-text">{{$item->category_name}}</label>
                    </div>
                    @else
                        <input type="hidden" id="radio10{{$loop->iteration}}" class="radiobtn">
                    @endif
                @endforeach
                <!-- Radio group -->
            </div>
            <!-- Filter by category -->
          </div>
        </div>

      </div>
      <!-- Sidebar -->

      <!-- Content -->
      <div class="col-lg-9 ganti">
        <!-- Products Grid -->
        <section class="section pt-4">
          <!-- Grid row -->
          <div class="row">
            <!-- Grid column -->
            @foreach ($produks as $item)
            <div class="col-lg-4 col-md-12 mb-4">
                <!-- Card -->
                <div class="card card-ecommerce">
                  <!-- Card image -->
                  <div class="view overlay">
                    @foreach ($item->product_image as $image)
                        <img src="{{asset('/produk_image/'.$image->image_name)}}" class="img-fluid" alt="">
                        @break
                    @endforeach
                    <a>
                      <div class="mask rgba-white-slight"></div>
                    </a>
                  </div>
                  <!-- Card image --> 
                  <!-- Card content -->
                  <div class="card-body">
                    <!-- Category & Title -->
                    <h5 class="card-title mb-1"><strong><a href="/produk/{{$item->id}}" class="dark-grey-text">{{$item->product_name}}</a></strong></h5><span
                      class="badge badge-danger mb-2">Rating: {{$item->product_rate}} <i class="fas fa-star blue-text"></i></span>
                    <!-- Card footer -->
                    <div class="card-footer pb-0"> 
                      <div class="row mb-0"> 
                        @php
                            $home = new Home;
                            $hasil = $home->diskon($item->discount,$item->price);
                        @endphp
                        @if ($hasil != 0)
                                <span class="float-lef grey-text">Rp{{$hasil}}</li>
                                <span class="float-lef grey-text"><small><s>Rp{{$item->price}}</s></small></span>
                        @else
                                <span class="float-lef grey-text">Rp{{$item->price}}</li>
                        @endif
                      </div>
                    </div>
                  </div>
                  <!-- Card content -->
                </div>
                <!-- Card -->
              </div>
            @endforeach
          </div>
        </section>
        <!-- Products Grid -->
      </div>
      <!-- Content -->
    </div>
  </div>
  <!-- Main Container -->
@endsection

@section('javacript')
@endsection
<script type="text/javascript" src="{{asset('/assets/js/jquery-3.4.1.min.js')}}"></script>

<script>
    jQuery(document).ready(function(e){
        jQuery('.radiobtn').click(function(e){
            var index = $('.radiobtn').index(this);
            console.log(jQuery('#radio10'+index).val());
            jQuery.ajax({
                url: "{{url('/show_categori')}}",
                method: 'post',
                data: {
                    _token: $('#signup-token').val(),
                    id: jQuery('#radio10'+index).val(),
                },
                success: function(result){
                    $('.ganti').html(result.hasil);
                    // console.log(result.hasil);
                }
            });
        });

        jQuery('#search').keyup(function(e){
          var isi = $('#search').val();
          jQuery.ajax({
                url: "{{url('/show_categori')}}",
                method: 'post',
                data: {
                    _token: $('#signup-token').val(),
                    id: -1,
                    cari: isi 
                },
                success: function(result){
                    $('.ganti').html(result.hasil);
                    // console.log(result.hasil);
                }
            });
        });
    });
</script>
