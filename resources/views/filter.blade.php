@if ($status == 0)
<section class="section pt-4">
    <div class="row">
      @foreach ($kategori as $item)
      <div class="col-lg-4 col-md-12 mb-4">
          <div class="card card-ecommerce">
            <div class="view overlay">
              @foreach ($item->product_image as $image)
                  <img src="{{asset('/produk_image/'.$image->image_name)}}" class="img-fluid" alt="">
                  @break
              @endforeach
              <a>
                <div class="mask rgba-white-slight"></div>
              </a>
            </div>
            <div class="card-body">
              <h5 class="card-title mb-1"><strong><a href="/produk/{{$item->id}}" class="dark-grey-text">{{$item->product_name}}</a></strong></h5><span
                class="badge badge-danger mb-2">Rating: {{$item->product_rate}} <i class="fas fa-star blue-text"></i></span>
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
          </div>
        </div>
      @endforeach
    </div>
  </section> 
@else
<section class="section pt-4">
    <div class="row">
      @foreach ($kategori->product as $item)
      <div class="col-lg-4 col-md-12 mb-4">
          <div class="card card-ecommerce">
            <div class="view overlay">
              @foreach ($item->product_image as $image)
                  <img src="{{asset('/produk_image/'.$image->image_name)}}" class="img-fluid" alt="">
                  @break
              @endforeach
              <a>
                <div class="mask rgba-white-slight"></div>
              </a>
            </div>
            <div class="card-body">
              <h5 class="card-title mb-1"><strong><a href="/produk/{{$item->id}}" class="dark-grey-text">{{$item->product_name}}</a></strong></h5><span
                class="badge badge-danger mb-2">Rating: {{$item->product_rate}} <i class="fas fa-star blue-text"></i></span>
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
          </div>
        </div>
      @endforeach
    </div>
  </section>
@endif
