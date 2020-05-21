@php
    $total = 0;
@endphp
<section class="section my-5 pb-5">
    <div class="table-responsive">
      <table class="table product-table table-cart-v-1">
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
            <th class="font-weight-bold">
              <strong>Amount</strong>
            </th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($carts as $item)
          <tr>
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
              <div class="btn-group radio-group ml-2" data-toggle="buttons">
                <label class="btn btn-sm btn-primary btn-rounded tombol-kurang">
                  <input type="radio" name="options" id="option1">&mdash;
                </label>
                <label class="btn btn-sm btn-primary btn-rounded tombol-tambah" >
                  <input type="radio" name="options" id="option2">+
                </label>
              </div>
            </td>
            <td class="font-weight-bold">
                @if ($hasil != 0)
                    <strong class="sub-total{{$loop->iteration-1}}">{{$hasil*$item->qty}}</strong>
                    @php
                        $total = $total + ($hasil*$item->qty);
                    @endphp
                @else
                    <strong class="sub-total{{$loop->iteration-1}}">{{$item->product->price*$item->qty}}</strong>
                    @php
                        $total = $total + ($item->product->price*$item->qty);
                    @endphp
                @endif
            </td>
            <td>
              <button type="button" class="btn btn-sm btn-primary tombolhapus" data-toggle="tooltip" data-placement="top"
                title="Remove item">X
              </button>
            </td>
          </tr>
          @endforeach
          <tr>
            <td colspan="2"></td>
            <td>
              <h4 class="mt-2">
                <strong>Total</strong>
              </h4>
            </td>
            <td class="text-right">
              <h4 class="mt-2">
                <strong class="total">{{$total}}</strong>
              </h4>
            </td>
            <input id="signup-token" name="_token" type="hidden" value="{{csrf_token()}}">
            <td colspan="3" class="text-right">
              <button type="button" class="btn btn-primary btn-rounded">Complete purchase
                <i class="fas fa-angle-right right"></i>
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </section>

  <script type="text/javascript" src="{{asset('/assets/js/jquery-3.4.1.min.js')}}"></script>

  <script>
    jQuery(document).ready(function(e){
        jQuery('.tombol-tambah').click(function(e){
          var index = $(".tombol-tambah").index(this);
          var jumlah = $(".qty"+index).text();
          var jumlah = parseInt(jumlah)+1
          $(".qty"+index).text(jumlah);
          var price = $('.price'+index).text();
          console.log('price: '+price);
  
          if(parseInt(jumlah) > parseInt($(".stock"+index).val())){
              $("#notif"+index).css('display','inline');
              $("#notif"+index).text('Jumlah stock melebihi stock produk');
              $("#notif"+index).append('<br>');
              $(".qty"+index).text(jumlah-1);
          }else{
            var subtotal = parseInt(jumlah)*parseInt(price);
            console.log('subtotal: ', + subtotal)
            $(".sub-total"+index).text(subtotal);
            var total = parseInt($(".total").text());
            total = total + parseInt(price);
            $(".total").text(total);
            $("#notif"+index).css('display','none');
  
            jQuery.ajax({
                url: "{{url('/update_qty')}}",
                method: 'post',
                data: {
                    _token: $('#signup-token').val(),
                    id: $('.id_cart'+index).val(),
                    qty: 1
                },
                success: function(result){
                    console.log(result.success);
                }
            });
          }
        });
  
        jQuery('.tombol-kurang').click(function(e){
          var index = $(".tombol-kurang").index(this);
          var jumlah = $(".qty"+index).text();
          var jumlah = parseInt(jumlah)-1
          $(".qty"+index).text(jumlah);
          var price = $('.price'+index).text();
          console.log('price: '+price);
  
          if(parseInt(jumlah) == 0){
              $("#notif"+index).css('display','inline');
              $("#notif"+index).text('Tolong stock tidak boleh 0');
              $("#notif"+index).append('<br>');
              $(".qty"+index).text(1);
          }else{
            var subtotal = parseInt(jumlah)*parseInt(price);
            console.log('subtotal: ', + subtotal)
            $(".sub-total"+index).text(subtotal);   
            var total = parseInt($(".total").text());
            total = total - parseInt(price);
            $(".total").text(total);
            $("#notif"+index).css('display','none');
            jQuery.ajax({
                url: "{{url('/update_qty')}}",
                method: 'post',
                data: {
                    _token: $('#signup-token').val(),
                    id: $('.id_cart'+index).val(),
                    qty: -1
                },
                success: function(result){
                    console.log(result.success);
                }
            });
          }
        });
  
        jQuery('.tombolhapus').click(function(e){
          var index = $(".tombolhapus").index(this);
          var konfirmasi = confirm('Apakah anda yakin ingin menghapus produk dari keranjang?');
            if(konfirmasi == true){
                jQuery.ajax({
                    url: "{{url('/update_qty')}}",
                    method: 'post',
                    data: {
                        _token: $('#signup-token').val(),
                        id: $('.id_cart'+index).val(),
                        user_id: $('#user_id').val(),
                        qty: 0
                    },
                    success: function(result){
                        $('.ganti').html(result.hasil);
                        jQuery('#jumlahcart').text(result.jumlah);
                        // console.log(result.success);
                    }
                });
            }
        });
    });
  </script>