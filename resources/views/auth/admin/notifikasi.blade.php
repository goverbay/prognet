@extends('auth.admin.app')

@section('konten')


<div class="col-md-12 grid-margin stretch-card" id="review">
        <div class="card">
          <div class="card-body">
                
                <h4>Notifikasi</h4>
                <div class="table-responsive">
                    <table class="table">
                        <tr>     
                            <th>Message</th>
                            <th>Time</th>
                            <th>Action</th>
                        </tr>
                        @if(!is_null(Auth::guard('admin')->user()->Notifications))
                        @foreach (Auth::guard('admin')->user()->Notifications as $notification)
                            @if ($notification->type != "App\Notifications\NotifyAdminReview" && isset($notification->read_at) )
                                <tr>
                                    <td>
                                        <a class="text-decoration-none text-black" href="/admin/transaksi/detail/{{$notification->data['notrans']}}/{{$notification->id}}">
                                            {{$notification->data['content']}} {{$notification->data['name']}}</td>
                                        </a>
                                    <td>{{$notification->created_at}}</td>
                                </tr>
                            @elseif($notification->type != "App\Notifications\NotifyAdminReview" && !isset($notification->read_at))
                                <tr>
                                    <td>
                                        <a class="text-decoration-none text-black" href="/admin/transaksi/detail/{{$notification->data['notrans']}}/{{$notification->id}}">
                                            {{$notification->data['content']}} {{$notification->data['name']}}
                                        </a>    
                                    </td>
                                    <td>{{$notification->created_at}}</td>
                                    <td><a href='/admin/mark/{{$notification->id}}'>Mark As Read</a></td>
                                </tr>
                            @elseif($notification->type = "App\Notifications\NotifyAdminReview" && !isset($notification->read_at) )
                                <tr>
                                    <td>
                                        <a class="text-decoration-none text-black" href="/admin/produk/show/{{$notification->data['noprod']}}/{{$notification->id}}">
                                            {{$notification->data['content']}} {{$notification->data['name']}}
                                        </a>
                                    </td>
                                    <td>{{$notification->created_at}}</td>
                                    <td><a href='/admin/mark/{{$notification->id}}'>Mark As Read</a></td>
                                <tr>
                            @elseif($notification->type = "App\Notifications\NotifyAdminReview" && isset($notification->read_at) )
                                <tr>
                                    <td>
                                        <a class="text-decoration-none text-black" href="/admin/produk/show/{{$notification->data['noprod']}}/{{$notification->id}}">
                                            {{$notification->data['content']}} {{$notification->data['name']}}
                                        <a class="text-decoration-none text-black" href="/admin/produk/show/{{$notification->data['noprod']}}/{{$notification->id}}">
                                    </td>
                                    <td>{{$notification->created_at}}</td>
                                <tr>
                            @endif
                        @endforeach
                        @endif
                        <tr>
                            <td></td>
                            <td></td>
                            <td>
                                <form action="/admin/read" method="GET">
                                @csrf
                                    <input type="submit" class="btn btn-primary btn-rounded" value="Mark All Read"> 
                                     
                                    </input>
                                </form>
                            </td>
                        </tr>
                    </table>
                </div>
          </div>
        </div>
</div>
<br><br><br><br><br><br><br>                     
                                    
@endsection