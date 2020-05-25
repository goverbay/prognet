@extends('auth.admin.app')

@push('script')
    <link href="https://canvasjs.com/assets/css/jquery-ui.1.11.2.min.css" rel="stylesheet" />

    {{-- <script>
        window.onload = function () {
        
        // Construct options first and then pass it as a parameter
        var options1 = {
            animationEnabled: true,
            title: {
                text: "Chart inside a jQuery Resizable Element"
            },
            data: [{
                type: "column", //change it to line, area, bar, pie, etc
                legendText: "Try Resizing with the handle to the bottom right",
                showInLegend: true,
                dataPoints: [
                    { y: 10 },
                    { y: 6 },
                    { y: 14 },
                    { y: 12 },
                    { y: 19 },
                    { y: 14 },
                    { y: 26 },
                    { y: 10 },
                    { y: 22 }
                    ]
                }]
        };
        
        $("#resizable").resizable({
            create: function (event, ui) {
                //Create chart.
                $("#chartContainer1").CanvasJSChart(options1);
            },
            resize: function (event, ui) {
                //Update chart size according to its container size.
                $("#chartContainer1").CanvasJSChart().render();
            }
        });
        
        }
        </script> --}}
@endpush

@section('konten')
<input id="signup-token" name="_token" type="hidden" value="{{csrf_token()}}">
<div class="row">
    <div class="col-md-6 stretch-card grid-margin">
      <div class="card bg-gradient-info card-img-holder text-white">
        <div class="card-body">
          {{-- <img src="{{asset('assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" /> --}}
          <h4 class="font-weight-normal mb-3">Transaksi Bulan  <i class="mdi mdi-bookmark-outline mdi-24px float-right"></i><select name="bulan" id="bulan" style="
            margin-bottom: 1em;
            padding: .25em;
            border: 0;
            font-weight: bold;
            letter-spacing: .15em;
            color: white;
            background-color: rgba(255,255,255,0.1);
            border-radius: 0;
            &:focus, &:active {
              outline: 0;
              border-bottom-color: red;
              color: black;
            }
          ">
              <option value="1" style="color:black" @if (date('m') == 1)
                  selected
              @endif>Januari</option>
              <option value="2" style="color:black"  @if (date('m') == 2)
              selected
          @endif>Februari</option>
              <option value="3" style="color:black"  @if (date('m') == 3)
              selected
          @endif>Maret</option>
              <option value="4" style="color:black"  @if (date('m') == 4)
              selected
          @endif>April</option>
              <option value="5" style="color:black"  @if (date('m') == 5)
              selected
          @endif>Mei</option>
              <option value="6" style="color:black"  @if (date('m') == 6)
              selected
          @endif>Juni</option>
              <option value="7" style="color:black"  @if (date('m') == 7)
              selected
          @endif>Juli</option>
              <option value="8" style="color:black"  @if (date('m') == 8)
              selected
          @endif>Agustus</option>
              <option value="9" style="color:black"  @if (date('m') == 9)
              selected
          @endif>September</option>
              <option value="10" style="color:black"  @if (date('m') == 10)
              selected
          @endif>Oktober</option>
              <option value="11" style="color:black"  @if (date('m') == 11)
              selected
          @endif>November</option>
              <option value="12" style="color:black"  @if (date('m') == 12)
              selected
          @endif>Desember</option>
          </select>
          </h4>
          @php
              setlocale(LC_MONETARY,"id_ID");
          @endphp
          <h2 class="mb-2">Jumlah Transaksi <span><strong id="total">{{$transaksi->count()}}</strong></span></h2>
          <p>Unverified Transaction <span> <strong id="unverified">{{$status['unverified']}}</strong></span></p>
          <p>Expired Transaction <span><strong id="expired">{{$status['expired']}}</strong></span></p>
          <p>Canceled Transaction <span><strong id="canceled">{{$status['canceled']}}</strong></span></p>
          <p>Verified Transaction <span><strong id="verified">{{$status['verified']}}</strong></span></p>
          <p>Delivered Transaction <span><strong id="delivered">{{$status['delivered']}}</strong></span></p>
          <p>Success Transaction <span><strong id="success">{{$status['success']}}</strong></span></p>
          <h4>Total Penghasil <span><strong id="harga">Rp {{number_format($status['harga'],0,',','.')}}</strong></span></h4>
        </div>
      </div>
    </div>
    <div class="col-md-6 stretch-card grid-margin">
      <div class="card bg-gradient-success card-img-holder text-white">
        <div class="card-body">
          {{-- <img src="{{asset('assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" /> --}}
          <h4 class="font-weight-normal mb-3">Transaksi Tahun <select name="tahun" id="tahun" style="
            margin-bottom: 1em;
            padding: .25em;
            border: 0;
            font-weight: bold;
            letter-spacing: .15em;
            color: white;
            background-color: rgba(255,255,255,0.1);
            border-radius: 0;
            &:focus, &:active {
              outline: 0;
              border-bottom-color: red;
              color: black;
            }
          ">
          @for ($i = 2019; $i <= date('Y'); $i++)
              <option value="{{$i}}" @if ($i == date('Y'))
                  selected
              @endif style="color:black">{{$i}}</option>
          @endfor
          </select> <i class="mdi mdi-diamond mdi-24px float-right"></i>
          </h4>
          <h2 class="mb-2">Jumlah Transaksi <span><strong id="total-tahun">{{$transaksi_tahun->count()}}</strong></span></h2>
          <p>Unverified Transaction <span> <strong id="unverified-tahun">{{$status_tahun['unverified']}}</strong></span></p>
          <p>Expired Transaction <span><strong id="expired-tahun">{{$status_tahun['expired']}}</strong></span></p>
          <p>Canceled Transaction <span><strong id="canceled-tahun">{{$status_tahun['canceled']}}</strong></span></p>
          <p>Verified Transaction <span><strong id="verified-tahun">{{$status_tahun['verified']}}</strong></span></p>
          <p>Delivered Transaction <span><strong id="delivered-tahun">{{$status_tahun['delivered']}}</strong></span></p>
          <p>Success Transaction <span><strong id="success-tahun">{{$status_tahun['success']}}</strong></span></p>
          <h4>Total Penghasil <span><strong id="harga-tahun">Rp {{number_format($status_tahun['harga'],0,',','.')}}</strong></span></h4>
        </div>
      </div>
    </div>
  </div>

  <div id="resizable" style="height: 370px;border:1px solid gray;">
	<div id="chartContainer1" style="height: 100%; width: 100%;"></div>
</div>


  @endsection

  
  <script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
  <script src="https://canvasjs.com/assets/script/jquery-ui.1.11.2.min.js"></script>
  <script src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>

    <script type="text/javascript" src="{{asset('/assets/js/jquery-3.4.1.min.js')}}"></script>
    <script>
    function formatRupiah(angka, prefix){
			var number_string = angka.toString(),
			split   		= number_string.split(','),
			sisa     		= split[0].length % 3,
			rupiah     		= split[0].substr(0, sisa),
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
 
			// tambahkan titik jika yang di input sudah menjadi angka ribuan
			if(ribuan){
				separator = sisa ? '.' : '';
				rupiah += separator + ribuan.join('.');
			}
 
			rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
			return prefix == undefined ? rupiah : (rupiah ? 'Rp ' + rupiah : '');
	}
      jQuery(document).ready(function(e){
          jQuery('#bulan').change(function(e){
                jQuery.ajax({
                    url: "{{url('/report-bulan')}}",
                    method: 'post',
                    data: {
                        _token: $('#signup-token').val(),
                        bulan: $('#bulan').val(),
                        tahun: $('#tahun').val(),
                    },
                    success: function(result){
                        // console.log(result.data['total']);
                        $('#total').text(result.data['total']);
                        $('#unverified').text(result.data['unverified']);
                        $('#expired').text(result.data['expired']);
                        $('#canceled').text(result.data['canceled']);
                        $('#verified').text(result.data['verified']);
                        $('#delivered').text(result.data['delivered']);
                        $('#success').text(result.data['success']);
                        var uang = formatRupiah(result.data['harga'],'Rp ');
                        $('#harga').text(uang);
                    }
                });
          });

          jQuery('#tahun').change(function(e){
                jQuery.ajax({
                    url: "{{url('/report-tahun')}}",
                    method: 'post',
                    data: {
                        _token: $('#signup-token').val(),
                        bulan: $('#bulan').val(),
                        tahun: $('#tahun').val(),
                    },
                    success: function(result){
                        $('#total').text(result.data_bulan['total']);
                        $('#unverified').text(result.data_bulan['unverified']);
                        $('#expired').text(result.data_bulan['expired']);
                        $('#canceled').text(result.data_bulan['canceled']);
                        $('#verified').text(result.data_bulan['verified']);
                        $('#delivered').text(result.data_bulan['delivered']);
                        $('#success').text(result.data_bulan['success']);
                        var uang = formatRupiah(result.data_bulan['harga'],'Rp ');
                        $('#harga').text(uang);

                        $('#total-tahun').text(result.data['total']);
                        $('#unverified-tahun').text(result.data['unverified']);
                        $('#expired-tahun').text(result.data['expired']);
                        $('#canceled-tahun').text(result.data['canceled']);
                        $('#verified-tahun').text(result.data['verified']);
                        $('#delivered-tahun').text(result.data['delivered']);
                        $('#success-tahun').text(result.data['success']);
                        var uang_tahun = formatRupiah(result.data['harga'],'Rp ');
                        $('#harga-tahun').text(uang_tahun);
                    }
                });
          });



      });
    </script>
