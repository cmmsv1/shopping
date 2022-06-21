<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>RoyalUI Admin</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{asset('dashboard/vendors/ti-icons/css/themify-icons.css')}}">
  <link rel="stylesheet" href="{{asset('dashboard/vendors/base/vendor.bundle.base.css')}}">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{asset('dashboard/css/style.css')}}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{asset('dashboard/images/favicon.png')}}" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
  <div class="container-scroller">
    <!-- navbar -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo me-5" href="index.html"><img src="{{asset('dashboard/images/logo.svg')}}" class="me-2" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="index.html"><img src="{{asset('dashboard/images/logo-mini.svg')}}" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="ti-view-list"></span>
        </button>
        <ul class="navbar-nav mr-lg-2">
          <li class="nav-item nav-search d-none d-lg-block">
            <div class="input-group">
              <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
                <span class="input-group-text" id="search">
                  <i class="ti-search"></i>
                </span>
              </div>
              <input type="text" class="form-control" id="navbar-search-input" placeholder="Search now" aria-label="search" aria-describedby="search">
            </div>
          </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item dropdown me-1">
            <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center" id="messageDropdown" href="#" data-bs-toggle="dropdown">
              <i class="ti-email mx-0"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="messageDropdown">
              <p class="mb-0 font-weight-normal float-left dropdown-header">Messages</p>
              <a class="dropdown-item">
                <div class="item-thumbnail">
                    <img src="{{asset('dashboard/images/faces/face4.jpg')}}" alt="image" class="profile-pic">
                </div>
                <div class="item-content flex-grow">
                  <h6 class="ellipsis font-weight-normal">David Grey
                  </h6>
                  <p class="font-weight-light small-text text-muted mb-0">
                    The meeting is cancelled
                  </p>
                </div>
              </a>
              <a class="dropdown-item">
                <div class="item-thumbnail">
                    <img src="{{asset('dashboard/images/faces/face2.jpg')}}" alt="image" class="profile-pic">
                </div>
                <div class="item-content flex-grow">
                  <h6 class="ellipsis font-weight-normal">Tim Cook
                  </h6>
                  <p class="font-weight-light small-text text-muted mb-0">
                    New product launch
                  </p>
                </div>
              </a>
              <a class="dropdown-item">
                <div class="item-thumbnail">
                    <img src="{{asset('dashboard/images/faces/face3.jpg')}}" alt="image" class="profile-pic">
                </div>
                <div class="item-content flex-grow">
                  <h6 class="ellipsis font-weight-normal"> Johnson
                  </h6>
                  <p class="font-weight-light small-text text-muted mb-0">
                    Upcoming board meeting
                  </p>
                </div>
              </a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
              <i class="ti-bell mx-0"></i>
              <span class="count"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="notificationDropdown">
              <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
              <a class="dropdown-item">
                <div class="item-thumbnail">
                  <div class="item-icon bg-success">
                    <i class="ti-info-alt mx-0"></i>
                  </div>
                </div>
                <div class="item-content">
                  <h6 class="font-weight-normal">Application Error</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    Just now
                  </p>
                </div>
              </a>
              <a class="dropdown-item">
                <div class="item-thumbnail">
                  <div class="item-icon bg-warning">
                    <i class="ti-settings mx-0"></i>
                  </div>
                </div>
                <div class="item-content">
                  <h6 class="font-weight-normal">Settings</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    Private message
                  </p>
                </div>
              </a>
              <a class="dropdown-item">
                <div class="item-thumbnail">
                  <div class="item-icon bg-info">
                    <i class="ti-user mx-0"></i>
                  </div>
                </div>
                <div class="item-content">
                  <h6 class="font-weight-normal">New user registration</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    2 days ago
                  </p>
                </div>
              </a>
            </div>
          </li>
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
              <img src="{{asset('dashboard/images/faces/face28.jpg')}}" alt="profile"/>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item">
                <i class="ti-settings text-primary"></i>
                Settings
              </a>
              <a class="dropdown-item" href="{{route('logout')}}" onclick="event.preventDefault();document.getElementById('logout_form').submit()">
                <i class="ti-power-off text-primary"></i>
                Logout
              </a>
            <form id="logout_form" action="{{route('logout')}}" method="POST">
                @csrf
            </form>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="ti-view-list"></span>
        </button>
      </div>
    </nav>
    <!-- body -->
    <div class="container-fluid page-body-wrapper">
      <!-- sidebar -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          @if (Auth::user()->type==="ADMIN")
            <li class="nav-item">
              <a class="nav-link" href="{{route('admin.dashboard')}}">
                <i class="ti-shield menu-icon"></i>
                <span class="menu-title">Trang Cá nhân</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('admin.users')}}">
                <i class="ti-receipt menu-icon"></i>
                <span class="menu-title">Quản lý người dùng</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('admin.sliders')}}">
                <i class="ti-receipt menu-icon"></i>
                <span class="menu-title">Quản lý home-slider</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('admin.categories')}}">
                <i class="ti-harddrives menu-icon"></i>
                <span class="menu-title">Quản lý danh mục</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('admin.products')}}">
                <i class="ti-shine menu-icon"></i>
                <span class="menu-title">Quản lý sản phẩm</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('admin.orders')}}">
                <i class="ti-receipt menu-icon"></i>
                <span class="menu-title">Quản lý đơn hàng</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('admin.banners')}}">
                <i class="ti-receipt menu-icon"></i>
                <span class="menu-title">Quản lý Banner</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('admin.custom')}}">
                <i class="ti-receipt menu-icon"></i>
                <span class="menu-title">Quản lý Custom HomePage</span>
              </a>
            </li>
          @else
            <li class="nav-item">
              <a class="nav-link" href="{{route('user.dashboard')}}">
                <i class="ti-shield menu-icon"></i>
                <span class="menu-title">Trang Cá nhân</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('user.profile')}}">
                <i class="ti-shield menu-icon"></i>
                <span class="menu-title">Thông tin cá nhân</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('user.address')}}">
                <i class="ti-shield menu-icon"></i>
                <span class="menu-title">Address</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('user.orders')}}">
                <i class="ti-shield menu-icon"></i>
                <span class="menu-title">Đơn hàng</span>
              </a>
            </li>
            
        @endif
          
        </ul>
      </nav>
      
      @if (Auth::user()->type==="ADMIN")
        <!-- main -->
            @yield('admin')
        
        @else 
            @yield('user')
      @endif
      @yield('content')
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="{{asset('dashboard/vendors/base/vendor.bundle.base.js')}}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  {{-- <script src="{{asset('dashboard/vendors/chart.js/Chart.min.js')}}"></script> --}}
  {{-- <script src="{{asset('dashboard/js/jquery.cookie.js" type="text/javascript')}}"></script> --}}
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="{{asset('dashboard/js/off-canvas.js')}}"></script>
  <script src="{{asset('dashboard/js/hoverable-collapse.js')}}"></script>
  <script src="{{asset('dashboard/js/template.js')}}"></script>
  <script src="{{asset('dashboard/js/todolist.js')}}"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="{{asset('dashboard/js/dashboard.js')}}"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <!-- End custom js for this page-->
</body>

</html>

