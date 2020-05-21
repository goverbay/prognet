@extends('app')

@section('css')
    
@endsection
@section('konten')
     <!-- Main Layout -->
     {{-- @php
         dd($cart);
     @endphp --}}
  <main>

    <div class="container mt-5 pt-3">

      <!-- Grid row -->
      <div class="row" style="margin-top: -140px;">

        <!-- Grid column -->
        <div class="col-md-12">

          <div class="card pb-5">

            <div class="card-body">

              <div class="container">

                <!-- Section: Contact v.3 -->
                <section class="contact-section my-5">
                  <form action="/beli" method="POST">
                    @csrf
                  <!-- Form with header -->
                  <div class="card">

                    <!-- Grid row -->
                    <div class="row">

                      <!-- Grid column -->
                      <div class="col-lg-8">

                        <div class="card-body form">

                          <!-- Header -->
                          <h3 class="mt-4"><i class="fas fa-envelope pr-2"></i>CheckOUT</h3>
                          
                          <!-- Grid row -->
                          <div class="row">

                            <!-- Grid column -->
                            <div class="col-md-12">

                              <div class="md-form mb-0">

                                <input type="text" id="nama" class="form-control" name="name" value="{{Auth::user()->name}}" disabled>

                                <label for="form-contact-name" class="">Nama Penerima*</label>

                              </div>

                            </div>
                            <!-- Grid column -->

                            <!-- Grid column -->
                            <div class="col-md-12">

                              <div class="md-form mb-0">

                                <input type="email" id="email" class="form-control" name="email" value="{{Auth::user()->email}}" disabled>

                                <label for="form-contact-email" class="">Email*</label>

                              </div>

                            </div>
                            <!-- Grid column -->

                          </div>
                          <!-- Grid row -->

                          <!-- Grid row -->
                          <div class="row">

                            <!-- Grid column -->
                            <div class="col-md-12">

                              <div class="md-form mb-0">

                                <input type="text" id="nomor-telp" class="form-control" name="no_telp" autofocus required>

                                <label for="form-contact-phone" class="">Nomor Telepon*</label>

                              </div>

                            </div>
                            <!-- Grid column -->

                            <!-- Grid column -->
                            <div class="col-md-12">

                              <div class="md-form mb-0">
                                <select name="province" id="provinsi" class="form-control cekongkir">
                                    <option>Provinsi*</option>
                                    @foreach ($provinsi as $prov)
                                        <option value="{{$prov->id}}">{{$prov->title}}</option>
                                    @endforeach
                                </select>
                              </div>

                            </div>
                            <div class="col-md-12">

                                <div class="md-form mb-0">
                                    <select name="regency" id="kota" class="form-control cekongkir">
                                        <option value="">Kota</option>
                                    </select>
  
                                </div>
  
                            </div>
                            <div class="col-md-12">

                                <div class="md-form mb-0">
  
                                  <input type="text" id="alamat" class="form-control" name="address" required>
  
                                  <label for="form-contact-company" class="">Alamat*</label>
  
                                </div>
  
                            </div>
                            <div class="col-md-12">
                                <div class="md-form mb-0">
                                    <select name="courier" id="kurir" class="form-control cekongkir">
                                        <option>Kurir*</option>
                                        @foreach ($kurir as $k)
                                            <option value="{{$k->id}}">{{$k->courier}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Grid column -->

                          </div>
                          <!-- Grid row -->

                          <!-- Grid row -->


                        </div>

                      </div>
                      <!-- Grid column -->

                      <!-- Grid column -->
                      <div class="col-lg-4">

                        <div class="card-body contact text-center h-100 white-text">

                          <h3 class="my-4 pb-2">Rangkuman Pesanan</h3>

                          <ul class="text-lg-left list-unstyled ml-4">

                            <li>
                                <h6>Sub Biaya: Rp{{$subtotal}}</h6>
                            </li>

                            <li>

                                <h6 id="biaya-ongkir">Biaya Pengiriman</h6>
                            </li>
                            <li>
                                <h6>Total Biaya: Rp<span id="total-biaya">0</span></h6>
                            </li>

                            <li>
                                    <input type="hidden" name="sub_total" value="{{$subtotal}}">
                                    <input type="hidden" name="total" id="totalbiaya">
                                    <input type="hidden" name="shipping_cost" id="ongkir">
                                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                    <input type="hidden" name="product_id" value="{{$product_id}}">
                                    <input type="hidden" name="qty" value="{{$qty}}">

                                    <button type="submit" class="btn btn-primary btn-rounded" id="beli">Beli</button>

                            </li>

                          </ul>
                        </div>
                      </div>
                      <!-- Grid column -->

                    </div>
                    <!-- Grid row -->

                  </div>
                  <!-- Form with header -->
                  </form>
                </section>
                <!-- Section: Contact v.3 -->

              </div>

            </div>

          </div>

        </div>
        <!-- Grid column -->

      </div>
      <!-- Grid row -->

    </div>

  </main>
  <!-- Main Layout -->
      <!-- Main Container -->
      
      <div class="container ganti">
        <section class="section my-5 pb-5">
  
          <!-- Shopping Cart table -->
          <div class="table-responsive">
            <h1>Rincian Produk</h1>

            <table class="table product-table table-cart-v-1">
  
              <!-- Table head -->
              <thead>
  
                <tr>
  
                  <th></th>
  
                  <th class="font-weight-bold">
  
                    <strong>Product</strong>
  
                  </th>
  
                  <th></th>
  
                  <th class="font-weight-bold">
  
                    <strong>Price</strong>
  
                  </th>
  
                  <th class="font-weight-bold">
  
                    <strong>QTY</strong>
  
                  </th>  
                  <th></th>
  
                </tr>
  
              </thead>
              <!-- Table head -->
  
              <!-- Table body -->
              <tbody>
  
                <!-- First row -->
                @foreach ($cart as $item)
                <tr>

                  @if (is_null($item->product))
                  <th scope="row">
                    <input type="hidden" class="id_cart{{$loop->iteration-1}}" value="{{$item->id}}">
                    <input type="hidden" id="user_id" value="{{$item->user_id}}">
                    <input type="hidden" class="stock{{$loop->iteration-1}}" value="{{$item->stock}}">
                      @foreach ($item->product_image as $image)
                      
                          <img src="{{asset('/produk_image/'.$image->image_name)}}" alt=""
                          class="img-fluid z-depth-0">
                          @break
                      @endforeach
                  </th>
  
                  <td>
                    <h5 class="mt-3">
                      <strong>{{$item->product_name}}</strong>
                    </h5>
                  </td>
                  <td></td>
                  @php
                      $home = new Home;
                      $hasil = $home->diskon($item->discount,$item->price);
                  @endphp
                  @if ($hasil != 0)
                         <td> Rp<span class="float-lef grey-text price{{$loop->iteration-1}}">{{$hasil}}</li>
                          Rp<span class="float-lef grey-text"><small><s>{{$item-price}}</s></small></span></td>
                  @else
                          <td>Rp<span class="float-lef grey-text price{{$loop->iteration-1}}">{{$item->price}}</li></td>
                  @endif
                  <td class="text-center text-md-left">
  
                    <span class="qty{{$loop->iteration-1}}">{{$qty}} </span>
  
                  </td>    

                  @else
                  <th scope="row">
                    <input type="hidden" class="id_cart{{$loop->iteration-1}}" value="{{$item->id}}">
                    <input type="hidden" id="user_id" value="{{$item->user_id}}">
                    <input type="hidden" class="stock{{$loop->iteration-1}}" value="{{$item->product->stock}}">
                      @foreach ($item->product->product_image as $image)
                      
                          <img src="{{asset('/produk_image/'.$image->image_name)}}" alt=""
                          class="img-fluid z-depth-0">
                          @break
                      @endforeach
                  </th>
  
                  <td>
                    <h5 class="mt-3">
                      <strong>{{$item->product->product_name}}</strong>
                    </h5>
                  </td>
                  <td></td>
                  @php
                      $home = new Home;
                      $hasil = $home->diskon($item->product->discount,$item->product->price);
                  @endphp
                  @if ($hasil != 0)
                         <td> Rp<span class="float-lef grey-text price{{$loop->iteration-1}}">{{$hasil}}</li>
                          Rp<span class="float-lef grey-text"><small><s>{{$item->product->price}}</s></small></span></td>
                  @else
                          <td>Rp<span class="float-lef grey-text price{{$loop->iteration-1}}">{{$item->product->price}}</li></td>
                  @endif
                  <td class="text-center text-md-left">
                    <p class="text-danger" style="display:none" id="notif{{$loop->iteration-1}}">plislah</p>
  
                    <span class="qty{{$loop->iteration-1}}">{{$item->qty}} </span>
  
                  </td>    

                  @endif
  
                </tr>
                @endforeach
  
              </tbody>
              <!-- Table body -->
  
            </table>
  
          </div>
          <!-- Shopping Cart table -->
  
        </section>
        <input id="signup-token" name="_token" type="hidden" value="{{csrf_token()}}">
        <input type="hidden" value="{{$weight}}" id="weight">
      </div>
      <!-- Main Container -->
@endsection
@section('javascript')
    
@endsection
<script type="text/javascript" src="{{asset('/assets/js/jquery-3.4.1.min.js')}}"></script>

<script>
    $(document).ready(function(e){
        $('#provinsi').change(function(e){
            var id_provinsi = $('#provinsi').val()
            if(id_provinsi){
                jQuery.ajax({
                    url: '/kota/'+id_provinsi,
                    type: "GET",
                    dataType: "json",
                    success:function(data){
                        $('#kota').empty();
                        $.each(data, function(key,value){
                            $('#kota').append('<option value="'+key+'">'+value+'</option>');
                        });
                    },
                });
            }else{
                $('#kota').empty();
            }
        });

        $('.cekongkir').change(function(e){
            var kurir = $('#kurir').val();
            var provinsi = $('#provinsi').val();
            var kota = $('#kota').val();
            var berat = parseInt($('#weight').val());
            if(provinsi>0 && kurir>0){
                jQuery.ajax({
                    url: "{{url('/ongkir')}}",
                    method: 'post',
                    data: {
                        _token: $('#signup-token').val(),
                        destination: kota,
                        weight: berat,
                        courier: kurir,
                        prov: provinsi, 
                    },
                    success: function(result){
                        console.log(result.success);
                        console.log(result.hasil["etd"]);
                        $('#biaya-ongkir').text('Biaya Pengiriman: Rp'+result.hasil["value"]);
                        $('#ongkir').val(result.hasil["value"]);
                        $('#biaya-ongkir').append('<input type="hidden" id="biaya-ongkir" value="'+result.hasil["value"]+'">');
                        $('#biaya-ongkir').append('<li><h7>Estimasi sampai: '+result.hasil["etd"]+' Hari</h7></li>');
                        $('#total-biaya').text({{$subtotal}}+result.hasil["value"]);
                        $('#totalbiaya').val({{$subtotal}}+result.hasil["value"]);
                    }
                });
                // console.log('wrong');
                // console.log('kota: '+kota+' provinsi: '+provinsi+' Kurir: '+kurir)
            }else{
                console.log('wrong');
                console.log('provinsi: '+provinsi+' Kurir: '+kurir)
            }

        });

        $('#beli').click(function(e){
          var kurir = $('#kurir').val();
          var provinsi = $('#provinsi').val();
          var kota = $('#kota').val();
          var alamat = $('#alamat').val();
          var totals = parseInt($('#total-biaya').text());
          var subtotal = parseInt('{{$subtotal}}');
          var ongkir = $('#biaya-ongkir').val();
          var user = $('#user_id').val();
          console.log(totals)
          if(totals==0){
            alert('Tolong Lengkapi Masukan Data');
            return false;
          }
        });
    });
</script>