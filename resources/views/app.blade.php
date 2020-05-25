<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}"> 

  <title>E-Commerce - Praktikum</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="{{asset('/assets/css/bootstrap.min.css')}}" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="{{asset('/assets/css/mdb.min.css')}}" rel="stylesheet">
  @yield('css')
</head>
<body class="product-v2 hidden-sn white-skin animated">
  @php
      date_default_timezone_set("Asia/Makassar");
  @endphp
  <!-- Navigation -->
  <header>
    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-light scrolling-navbar white">
      <div class="container">
        <!-- SideNav slide-out button -->
        <a class="navbar-brand font-weight-bold" href="/home">
          <strong>SHOP</strong>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-4"
          aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
          <ul class="navbar-nav ml-auto">
              @if (is_null(Auth::user()))
                
                <li class="nav-item dropdown ml-3">
                    <a class="nav-link waves-effect waves-light dark-grey-text font-weight-bold" id="navbarDropdownMenuLink-4" href="/login">
                    <i class="fas fa-user blue-text"></i> Login </a>
                </li>  
              @else
                <li class="nav-item ">
                    <a class="nav-link dark-grey-text font-weight-bold" href="/cart">
                    <span class="badge danger-color" id="jumlahcart">{{Auth::user()->cart->where('status','=','notyet')->count()}}</span>
                    <i class="fas fa-shopping-cart blue-text" aria-hidden="true"></i>
                    <span class="clearfix d-none d-sm-inline-block">Cart</span>
                    </a>
                </li>
                <li class="nav-item dropdown ml-3">
                    <a class="nav-link dropdown-toggle waves-effect waves-light dark-grey-text font-weight-bold"
                    id="navbarDropdownMenuLink-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user blue-text"></i> {{Auth::user()->name}} </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-cyan" aria-labelledby="navbarDropdownMenuLink-4">
                    <a class="dropdown-item waves-effect waves-light" href="#">My account</a>
                    <a class="dropdown-item waves-effect waves-light" href="/transaksi/{{Auth::user()->id}}">Transaksi</a>
                    <form action="/logout" method="post">
                      @csrf
                      <span class="dropdown-item waves-effect waves-light">
                      <input type="submit"  class="dropdown-item waves-effect waves-light" value="Logout"></span>
                    </div>
                  </form>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
                    <i class="fa fa-bell blue-text"><span class="badge danger-color" id="jumlahcart">{{Auth::user()->unReadNotifications->count()}}</span></i>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                    <h6 class="p-3 mb-0"><a href="/notif">Show All Notifications</a></h6>
                    <div class="dropdown-divider"></div>
                        @foreach (auth()->user()->unReadNotifications as $notification)
                          <div class="preview-thumbnail">
                            <div class="preview-icon bg-warning">
                              <i class="mdi mdi-settings"></i>
                            </div>
                          </div>
                        @if ($notification->type != "App\Notifications\NotifyUserRespon")
                          <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                              <a class="text-decoration-none text-black" href="/transaksi/detail/{{$notification->data['notrans']}}/{{$notification->id}}"><h6  class="preview-subject font-weight-normal mb-1"> {{$notification->data['content']}} {{$notification->data['notrans']}} {{$notification->data['status']}}</h6></a>
                          </div>
                          <div class="dropdown-divider"></div>
                        @else 
                        <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                              <a class="text-decoration-none text-black" href="/produk/{{$notification->data['noprod']}}/{{$notification->id}}"><h6  class="preview-subject font-weight-normal mb-1"> {{$notification->data['content']}} {{$notification->data['status']}}</h6></a>
                          </div>
                          <div class="dropdown-divider"></div>
                          @endif
                        @endforeach
                  </div>
                </li>
              @endif
              
          </ul>
        </div>
      </div>
    </nav>
    <!-- Navbar -->
  </header>
  <!-- Navigation -->

  <!-- Main Container -->
        @yield('konten')
  <!-- Main Container -->

  <!-- Footer -->
  <footer class="page-footer text-center text-md-left stylish-color-dark pt-0">
    <div style="background-color: #4285f4;">
      <div class="container">
        <!-- Grid row -->
        <div class="row py-4 d-flex align-items-center">
          <!-- Grid column -->
          <div class="col-md-6 col-lg-5 text-center text-md-left mb-4 mb-md-0">
            <h6 class="mb-0 white-text">Get connected with us on social networks!</h6>
          </div>
          <!-- Grid column -->
          <!-- Grid column -->
          <div class="col-md-6 col-lg-7 text-center text-md-right">
            <!-- Facebook -->
            <a class="fb-ic ml-0 px-2">
              <i class="fab fa-facebook-f white-text"> </i>
            </a>
            <!-- Twitter -->
            <a class="tw-ic px-2">
              <i class="fab fa-twitter white-text"> </i>
            </a>
            <!-- Google + -->
            <a class="gplus-ic px-2">
              <i class="fab fa-google-plus-g white-text"> </i>
            </a>
            <!-- Linkedin -->
            <a class="li-ic px-2">
              <i class="fab fa-linkedin-in white-text"> </i>
            </a>
            <!-- Instagram -->
            <a class="ins-ic px-2">
              <i class="fab fa-instagram white-text"> </i>
            </a>
          </div>
          <!-- Grid column -->
        </div>
        <!-- Grid row -->
      </div>
    </div>

    <!-- Footer Links -->
    <!-- Footer Links -->

    <!-- Copyright -->
    <div class="footer-copyright py-3 text-center">
      <div class="container-fluid">
        © 2019 Copyright: <a href="https://mdbootstrap.com/education/bootstrap/" target="_blank"> MDBootstrap.com </a>
      </div>
    </div>
    <!-- Copyright -->
  </footer>
  <!-- Footer -->

  <!-- SCRIPTS -->
        @yield('javascript')
  <!-- SCRIPTS -->
          <!-- JQuery -->
          <script type="text/javascript" src="{{asset('/assets/js/jquery-3.4.1.min.js')}}"></script>
          <!-- Bootstrap tooltips -->
          <script type="text/javascript" src="{{asset('/assets/js/popper.min.js')}}"></script>
          <!-- Bootstrap core JavaScript -->
          <script type="text/javascript" src="{{asset('/assets/js/bootstrap.min.js')}}"></script>
          <!-- MDB core JavaScript -->
          <script type="text/javascript" src="{{asset('/assets/js/mdb.min.js')}}"></script>
</body>
</html>
