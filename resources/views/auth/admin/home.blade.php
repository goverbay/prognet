@extends('auth.admin.app')
@push('script')
<script>
    </script>    
@endpush
@section('konten')
{{-- @php
    dd($bulan);
@endphp --}}
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
          <h2 class="mb-2">Jumlah Transaksi <span><strong id="total">{{$status['total']}}</strong></span></h2>
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
  @for ($i = 1; $i <= 12; $i++)
      <input type="hidden" id='bulan{{$i}}' value="{{$bulan[$i]}}">
  @endfor
    <div class="d-flex flex-row bd-highlight mb-3">
        <div class="col-md-3 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    
                        <h4 class="card-title">Transaction Type</h4>
                        <br>
                        <div class="btn-group-vertical">
                            <button class="btn btn-success status" id="all">All</button>
                            <button class="btn btn-success status" id="unverified">Unverivied</button>
                            <button class="btn btn-success status" id="expired">Expired</button>
                            <button class="btn btn-success status" id="verified">Verified</button>
                            <button class="btn btn-success status" id="delivered">Delivered</button>
                            <button class="btn btn-success status" id="success">Success</button>
                            <button class="btn btn-success status" id="canceled">Cancceled</button>
                        </div>
                </div> 
            </div>
         </div>   
         <div class="col-md-9 grid-margin stretch-card"> 
             <div class="card">
                <div class="card-body">
                    <div id="chartContainer" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
                </div>
            </div> 
        </div> 
    </div>

@endsection
@push('scriptbody')
<script>
    window.onload = function () {
    
    //Better to construct options first and then pass it as a parameter
    
    
    var options = {
        axisX: {
            interval:1,
            labelMaxWidth: 180,           
            labelAngle: -45, //90,
            labelFontFamily:"verdana0"
        },
        title: {
            text: "Grafik Jumlah Transaksi Perbulan {{date('Y')}}"              
        },
        data: [              
        {
            // Change type to "doughnut", "line", "splineArea", etc.
            type: "column",
            dataPoints: [
                { label: "Januari",  y: parseInt($('#bulan1').val())},
                { label: "Februari", y: parseInt($('#bulan2').val())},
                { label: "Maret", y: parseInt($('#bulan3').val())},
                { label: "April", y: parseInt($('#bulan4').val())},
                { label: "Mei",  y: parseInt($('#bulan5').val())},
                { label: "Juni",  y: parseInt($('#bulan6').val())},
                { label: "Juli",  y: parseInt($('#bulan7').val())},
                { label: "Agustus", y: parseInt($('#bulan8').val())},
                { label: "September", y: parseInt($('#bulan9').val())},
                { label: "Oktober",  y: parseInt($('#bulan10').val())},
                { label: "November",  y: parseInt($('#bulan11').val())},
                { label: "Desember",  y: parseInt($('#bulan12').val())},
            ]
        }
        ]
    };
    
    $("#chartContainer").CanvasJSChart(options);
    }
</script>    

<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
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

    function creteChart(tahun, ttlTahun, judul = ''){
        var options = {
                            axisX: {
                                interval:1,
                                labelMaxWidth: 180,           
                                labelAngle: -45, //90,
                                labelFontFamily:"verdana0"
                            },
                            title: {
                                text: "Grafik Jumlah Transaksi "+judul+" Perbulan "+ttlTahun              
                            },
                            data: [              
                            {
                                // Change type to "doughnut", "line", "splineArea", etc.
                                type: "column",
                                dataPoints: [
                                    { label: "Januari",  y: tahun[1]},
                                    { label: "Februari", y: tahun[2]},
                                    { label: "Maret", y: tahun[3]},
                                    { label: "April", y: tahun[4]},
                                    { label: "Mei",  y: tahun[5]},
                                    { label: "Juni",  y: tahun[6]},
                                    { label: "Juli",  y: tahun[7]},
                                    { label: "Agustus", y: tahun[8]},
                                    { label: "September", y: tahun[9]},
                                    { label: "Oktober",  y: tahun[10]},
                                    { label: "November",  y: tahun[11]},
                                    { label: "Desember",  y: tahun[12]},
                                    
                                ]
                            }
                            ]
                        };
                        
                        $("#chartContainer").CanvasJSChart(options);

    }

      jQuery(document).ready(function(e){
          console.log($('#bulan1').val())
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
                        
                        creteChart(result.tahun, $('#tahun').val());
                    }

                });
          });

          $(".status").click(function(e){
            var index = $(".status").index(this);
            var myStatus = '';
            switch(index){
                case 0:
                    myStatus = 'all';
                    break;
                case 1:
                    myStatus = 'unverified';
                    break;
                case 2:
                    myStatus = 'expired';
                    break;
                case 3:
                    myStatus = 'verified';
                    break;
                case 4:
                    myStatus = 'delivered';
                    break;
                case 5:
                    myStatus = 'success';
                    break;
                case 6:
                    myStatus = 'canceled';
                    break;

            }

            
            jQuery.ajax({
                url: "{{url('/grafik')}}",
                method: 'post',
                data: {
                    _token: $('#signup-token').val(),
                    status: myStatus,
                    tahun: $('#tahun').val(),
                },
                success: function(result){
                    creteChart(result.grafik, $('#tahun').val(), myStatus);
                }
            });
        });

      });
    </script>

@endpush


