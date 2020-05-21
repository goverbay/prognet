@extends('app')


@section('css')

@endsection

@section('konten')
    <!-- Main Container -->
    <div class="container ganti" style="margin-top: 140px">
      <section class="section my-5 pb-5">
        <!-- Shopping Cart table -->
        <div class="table-responsive">
          <table class="table product-table table-cart-v-1">
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
                    <strong>{{$item->status}}</strong>
                </td>
                <td>
                  <a href="/transaksi/detail/{{$item->id}}"><strong>Lihat Detail</strong></a>
                </td>
                  
              </tr>
            
              @endforeach
              <!-- First row -->


            </tbody>
            <!-- Table body -->

          </table>

        </div>
        <!-- Shopping Cart table -->

      </section>

    </div>
    <!-- Main Container -->
@endsection

@section('javacript')
    
@endsection
