<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{ url('assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/plugins/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/plugins/ionicons-2.0.1/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/dist/css/AdminLTE.css') }}">
    <link rel="stylesheet" href="{{ url('assets/dist/css/skins/_all-skins.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/plugins/iCheck/flat/blue.css') }}">
    <link rel="stylesheet" href="{{ url('assets/plugins/datepicker/datepicker3.css') }}">
    <link rel="stylesheet" href="{{ url('assets/plugins/sweetalert-master/themes/facebook/facebook.css') }}">
    <link rel="stylesheet" href="{{ url('assets/plugins/sweetalert2-1.0.5/dist/sweetalert2.min.css') }}">
    <link rel="icon" href="" type="image/x-icon"/>
    <style type="text/css">
      .dataTable td{
        font-size: 10pt !important;
      }
      .form-group{
        margin-bottom: 4px;
      }
      .box-header.with-border {border-bottom: thin solid #d0ced8 !important;}
      .col-xs-1, .col-sm-1, .col-md-1, .col-lg-1, .col-xs-2, .col-sm-2, .col-md-2, .col-lg-2, .col-xs-3, .col-sm-3, .col-md-3, .col-lg-3, .col-xs-4, .col-sm-4, .col-md-4, .col-lg-4, .col-xs-5, .col-sm-5, .col-md-5, .col-lg-5, .col-xs-6, .col-sm-6, .col-md-6, .col-lg-6, .col-xs-7, .col-sm-7, .col-md-7, .col-lg-7, .col-xs-8, .col-sm-8, .col-md-8, .col-lg-8, .col-xs-9, .col-sm-9, .col-md-9, .col-lg-9, .col-xs-10, .col-sm-10, .col-md-10, .col-lg-10, .col-xs-11, .col-sm-11, .col-md-11, .col-lg-11, .col-xs-12, .col-sm-12, .col-md-12, .col-lg-12 {
          padding-right: 5px !important;
          padding-left: 5px !important;
      }
      .row {
        margin-right: -5px !important;
        margin-left: -5px !important;
      }
      .box {
        margin-bottom: 10px !important;
      }
      .main-sidebar {
        padding-top: 0px !important;
      }
      @media only screen and (min-width: 768px) {
        .mobile-display-logo{
          display: none;
        }
        .display-logo{
          display: block;
        }
      }
      @media only screen and (max-width: 767px) {
        .display-logo{
          display: none;
        }
        .main-sidebar {
          padding-top: 100px !important;
        }
        .mobile-logo-img{
          padding-left: 10px;
          position: absolute;
          top: 50%;
          -ms-transform: translateY(-50%);
          transform: translateY(-50%);
        }
        .mobile-logo-name{
          padding-left: 10px;
          padding-right: 10px;
          font-size: 15px;
          color: #fcfbff;
        }
      }
      .logo-panel{
        position: relative;
        width: 100%;
        height: 100px;
        overflow: hidden;
        background-color: #9258f0;
      }
      .logo-panel > .image > img {
        width: 100%;
        padding: 5px;
        max-height: 100px;
        width: auto;
      }
      .logo-name{
        color: #ffffff;
        background-color: #0277bd;
        text-align: center;
        padding: 10px;
        font-size: 14px;
        font-weight: 800;
        width: 230px;
        display:inline-block;
        position:relative;
      }
      .user-panel{
        background-color: #004c8c;
      }
      .main-header .time-sidebar {
        float: left;
        background-color: transparent;
        background-image: none;
        color: #fff;
        padding-left: 20px;
        position: absolute;
        top: 50%;
        -ms-transform: translateY(-50%);
        transform: translateY(-50%);
      }
      .main-header .time-sidebar:hover {
        color: #58a5f0;
      }
      .main-header .time-sidebar:focus,
      .main-header .time-sidebar:active {
        background: transparent;
      }
      .skin-blue .sidebar-menu>li.header {
        color: #58a5f0;
      }
    </style>
    @stack('css')
  </head>
  <body class="hold-transition skin-blue fixed sidebar-mini" >
    <div class="wrapper">
      <header class="main-header">
        @yield('logo-mobile')
        <nav class="navbar navbar-static-top">
          <a href="#" onclick="hide_logo_func()" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <a href="#" class="time-sidebar" role="button">
          <span style="font-size: 10px">Waktu Server</span><br> <b><span id="digital-time"></span></b>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  @yield('user-profile')
                </a>
              </li>
              <li class="dropdown user user-menu">
                <a href="{{ route('logout') }}" class="dropdown-toggle" data-toggle="">
                  <i class="fa fa-sign-out" aria-hidden="true"></i>
                  <span class="hidden-xs">Logout</span>
                </a>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <aside class="main-sidebar">
        <section class="sidebar">
          @yield('logo')
          @yield('user-panel')
          @yield('sidebar-menu')
        </section>
      </aside>
      <div class="content-wrapper">
        <section class="content-header">
          @yield('breadcrumb')
        </section>
        <section class="content">
          <div class="row">
            @yield('content')
          </div>
        </section>
      </div>
      <footer class="main-footer"></footer>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="{{ url('/js/jquery-ui.min.js') }}"></script>
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <script src="{{ url('/assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ url('/assets/dist/js/moment.min.js') }}"></script>
    <script src="{{ url('/assets/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{URL::asset('assets/plugins/timepicker/bootstrap-timepicker.js')}}"></script>
    <script src="{{ url('assets/dist/js/sweetalert2.all.min.js') }}"></script>
    <script src="{{ url('/assets/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ url('/assets/plugins/fastclick/fastclick.js') }}"></script>
    <script src="{{ url('/assets/dist/js/app.js') }}"></script>
    <script>
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $(".numOnly").keydown(function (e) {
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
          (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
          (e.keyCode >= 35 && e.keyCode <= 40)) {
            return;
        }
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
          e.preventDefault();
        }
      });
    </script>
    <script>
      function hide_logo_func() {
        var x = document.getElementById("logo_name");
        var width = screen.width;
        if (x.style.display === "none") {
          x.style.display = "block";
        } else {
          x.style.display = "none";
        }
      }
    </script>
    <script>
      var x = waktu();
      function waktu() {
        const days = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
        const months = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
        const nowTime = new Date();
        const clockTime = nowTime.toLocaleTimeString('en-GB', {timeZone: 'Asia/Jakarta'});
        const dayIndex = nowTime.getDay();
        const dayName = days[dayIndex];
        const date = nowTime.getDate();
        const monthIndex = nowTime.getMonth();
        const monthName = months[monthIndex];
        const year = nowTime.getFullYear();
        document.getElementById("digital-time").innerHTML = dayName+', '+date+' '+monthName+'/'+year+', '+clockTime+"s WIB";
        setTimeout("waktu()", 1000);
      }
    </script>
    @stack('scripts')
  </body>
</html>
