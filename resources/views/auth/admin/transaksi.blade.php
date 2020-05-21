@extends('auth.admin.app')

@section('konten')
    <div class="btn-group-horizontal">
        <button class="btn btn-success status" id="all">All</button>
        <button class="btn btn-success status" id="unverified">Unverivied</button>
        <button class="btn btn-success status" id="waiting">Waiting Confirmed</button>
        <button class="btn btn-success status" id="verified">Verified</button>
        <button class="btn btn-success status" id="delivered">Delivered</button>
        <button class="btn btn-success status" id="success">Success</button>
        <button class="btn btn-success status" id="canceled">Cancceled</button>
    </div>
    <br>
    <input id="signup-token" name="_token" type="hidden" value="{{csrf_token()}}">
    <!-- Main Container -->
    <div class="col-md-12 grid-margin stretch-card ganti">
        <div class="card">
          <!-- Shopping Cart table -->
          <div class="table-responsive">
            <table class="table">
              <!-- Table head -->
              <thead>
                <tr>
                  <th></th>
                  <th class="font-weight-bold">
                    <strong>ID Transaksi</strong>
                  </th>
                  <th class="font-weight-bold">
                    <strong>Alamat</strong>
                  </th>
                  <th class="font-weight-bold">
                    <strong>Kota</strong>
                  </th>
                  <th class="font-weight-bold">
                      <strong>Provinsi</strong>
                  </th>
                  <th class="font-weight-bold">
                      <strong>Total Pembayaran</strong>
                  </th>
                  <th class="font-weight-bold">
                      <strong>Status</strong>
                  </th>
                  <th class="font-weight-bold">
                    <strong>Opsi</strong>
                  </th>
                </tr>
  
              </thead>
              <!-- Table head -->
  
              <!-- Table body -->
              <tbody>
  
                <!-- First row -->
                @foreach ($transaksi as $item)
                
                <tr> 
                  <td>
                    @if ($item->status == 'unverified' & $item->timeout > date('Y-m-d H:i:s'))
                    @php
                        date_default_timezone_set("Asia/Makassar");
                        $date1 = new DateTime($item->timeout);
                        $date2 = new DateTime(date('Y-m-d H:i:s'));
                        $tenggat = $date1->diff($date2);
                    @endphp
                          <span class="badge danger-color">Sisa Waktu Pembayaran: {{$tenggat->h}} Jam, {{$tenggat->i}} Menit</span>
                     @endif
  
                  </td>               
                  <td>
  
                      <strong>{{$item->id}}</strong>
                  </td>
                  <td>
                      <strong>{{$item->address}}</strong>
                  </td>
                  <td>
                      <strong>{{$item->regency}}</strong>
                  </td>
                  <td>
                      <strong>{{$item->province}}</strong>
                  </td>
                  <td>
                      <strong>Rp{{$item->total}}</strong>
                  </td>
                  <td>
                      <strong>@if ($item->status == 'unverified' && !is_null($item->proof_of_payment))
                          Menunggu Konfirmasi
                          @else
                          {{$item->status}}
                      @endif</strong>
                  </td>
                  <td>
                    <a href="/admin/transaksi/detail/{{$item->id}}"><strong>Lihat Detail</strong></a>
                  </td>
                    
                </tr>
              
                @endforeach
                <!-- First row -->
  
  
              </tbody>
              <!-- Table body -->
  
            </table>
  
          </div>
          <!-- Shopping Cart table -->
  
      </div>
      <!-- Main Container -->
    </div>
  
@endsection

<script type="text/javascript" src="{{asset('/assets/js/jquery-3.4.1.min.js')}}"></script>

<script>
  $(document).ready(function(e){
      $(".status").click(function(e){
          var index = $(".status").index(this);
          var myStatus = '';
          console.log(index);
          switch(index){
            case 0:
                myStatus = 'all';
                break;
            case 1:
                myStatus = 'unverified';
                break;
            case 2:
                myStatus = 'waiting';
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

          console.log(myStatus);
        jQuery.ajax({
              url: "{{url('/admin/transaksi/sort')}}",
              method: 'post',
              data: {
                  _token: $('#signup-token').val(),
                  status: myStatus,
              },
              success: function(result){
                $('.ganti').html(result.hasil);
              }
          });
      });
    });
</script>
