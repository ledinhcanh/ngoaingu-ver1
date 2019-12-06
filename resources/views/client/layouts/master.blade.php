<!DOCTYPE html>
<html lang="vi">

<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title')</title>
  <base href="{{ asset('') }}">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  
  <link rel="stylesheet" href="assets/client/fonts/fonts.css">
  {{-- <link rel="stylesheet" href="assets/client/css/open-iconic-bootstrap.min.css"> --}}
  <link rel="stylesheet" href="assets/client/css/animate.css">
  {{-- <link rel="stylesheet" href="assets/client/css/font-awesome.min.css"> --}}
  <link rel="stylesheet" href="assets/client/css/owl.carousel.min.css">
  <link rel="stylesheet" href="assets/client/css/owl.theme.default.min.css">
  <link rel="stylesheet" href="assets/client/css/magnific-popup.css">

  <link rel="stylesheet" href="assets/client/css/aos.css">

  <link rel="stylesheet" href="assets/client/css/ionicons.min.css">

  <link rel="stylesheet" href="assets/client/css/flaticon.css">
  <link rel="stylesheet" href="assets/client/css/icomoon.css">
  <link rel="stylesheet" href="assets/client/css/style.css">
  <link rel="stylesheet" href="assets/client/font-awesome/css/font-awesome.min.css">
  <link rel="shortcut icon" type="image/png" href="/logo.ico" />
  <link rel="stylesheet" href="assets/admin/css/toastr.css">
  @yield('css')
  <style>
    .social-button{
      display: inline-grid;
        position: fixed;
        bottom: 15px;
        right: 45px;
        min-width: 45px;
        text-align: center;
        z-index: 99999;
    }
    .social-button-content{
      display: inline-grid;   
    }
    .social-button a {padding:8px 0;cursor: pointer;position: relative;}
    .social-button i{
      width: 40px;
        height: 40px;
        background: #43a1f3;
        color: #fff;
        border-radius: 100%;
        font-size: 20px;
        text-align: center;
        line-height: 1.9;
        position: relative;
        z-index: 999;
    }
    .social-button span{
      display: none;
    }
    .alo-circle {
        animation-iteration-count: infinite;
        animation-duration: 1s;
        animation-fill-mode: both;
        animation-name: zoomIn;
        width: 50px;
        height: 50px;
        top: 3px;
        right: -3px;
        position: absolute;
        background-color: transparent;
        -webkit-border-radius: 100%;
        -moz-border-radius: 100%;
        border-radius: 100%;
        border: 2px solid rgba(30, 30, 30, 0.4);
        opacity: .1;
        border-color: #0089B9;
        opacity: .5;
    }
    .alo-circle-fill {
      animation-iteration-count: infinite;
      animation-duration: 1s;
      animation-fill-mode: both;
      animation-name: pulse;
        width: 60px;
        height: 60px;
        top: -2px;
        right: -8px;
        position: absolute;
        -webkit-transition: all 0.2s ease-in-out;
        -moz-transition: all 0.2s ease-in-out;
        -ms-transition: all 0.2s ease-in-out;
        -o-transition: all 0.2s ease-in-out;
        transition: all 0.2s ease-in-out;
        -webkit-border-radius: 100%;
        -moz-border-radius: 100%;
        border-radius: 100%;
        border: 2px solid transparent;
        background-color: rgba(0, 175, 242, 0.5);
        opacity: .75;
    }
    .call-icon:hover > span, .mes:hover > span, .sms:hover > span, .zalo:hover > span{display: block}
    .social-button a span {
        border-radius: 2px;
        text-align: center;
        background: rgb(103, 182, 52);
        padding: 9px;
        display: none;
        width: 180px;
        margin-left: 10px;
        position: absolute;
        color: #ffffff;
        z-index: 999;
        top: 9px;
        right: 65px;
        transition: all 0.2s ease-in-out 0s;
        -moz-animation: headerAnimation 0.7s 1;
        -webkit-animation: headerAnimation 0.7s 1;
        -o-animation: headerAnimation 0.7s 1;
        animation: headerAnimation 0.7s 1;
    }
    @-webkit-keyframes "headerAnimation" {
        0% { margin-top: -70px; }
        100% { margin-top: 0; }
    }
    @keyframes "headerAnimation" {
        0% { margin-top: -70px; }
        100% { margin-top: 0; }
    }
    .social-button a span:before {
      content: "";
      width: 0;
      height: 0;
      border-style: solid;
      border-width: 10px 10px 10px 0;
      border-color: transparent rgb(103, 182, 52) transparent transparent;
      position: absolute;
      transform: rotate(180deg);
      right: -10px;
      top: 10px;
    }
  </style>
  <script src="assets/client/js/jquery.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css"/>
</head>
<body>
  @include('client.layouts.header')
  @include('client.layouts.menu')
  <!-- END nav -->
  @yield('slide')

  @yield('content')

  <div class="social-button">
    <div class="social-button-content">
       <a href="lich" class="sms">
          <i class="fa fa-calendar" aria-hidden="true"></i>
          <div class="animated alo-circle"></div>
          <div class="animated alo-circle-fill"></div>
           <span>Lịch sinh hoạt, chào cờ</span>
        </a>
       {{-- <a type="button" data-toggle="modal" data-target="#exampleModal1" class="sms">
          <i class="fa fa-calendar" aria-hidden="true"></i>
          <div class="animated alo-circle"></div>
          <div class="animated alo-circle-fill"></div>
           <span>Lịch sinh hoạt, chào cờ</span>
        </a> --}}
        <a href="{{ route('lienhe.create') }}" class="sms">
          <i class="fa fa-envelope" aria-hidden="true"></i>
          <span>Liên hệ</span>
        </a>
        <a class="sm" id="myBtn2" type="button">
          <i class="fa fa-arrow-up" aria-hidden="true"></i>
        </a>
    </div>
       
    <a class="user-support">
      <i class="fa fa-user-circle-o" aria-hidden="true"></i>
      <div class="animated alo-circle"></div>
      <div class="animated alo-circle-fill"></div>
    </a>
  </div>
  @include('client.layouts.footer')
  <div id="fb-root"></div>
  <!-- Modal -->
<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Sự kiện</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="calendar">
           {!! $calendar->calendar() !!}
          {!! $calendar->script() !!}
        </div>
      </div>
    </div>
  </div>
</div>
  <script src="assets/client/js/jquery-migrate-3.0.1.min.js"></script>
  <script src="assets/client/js/popper.min.js"></script>
  <script src="assets/client/js/bootstrap.min.js"></script>
  <script src="assets/client/js/jquery.easing.1.3.js"></script>
  <script src="assets/client/js/jquery.waypoints.min.js"></script>
  <script src="assets/client/js/jquery.stellar.min.js"></script>
  <script src="assets/client/js/owl.carousel.min.js"></script>
  <script src="assets/client/js/jquery.magnific-popup.min.js"></script>
  <script src="assets/client/js/aos.js"></script>
  <script src="assets/client/js/jquery.animateNumber.min.js"></script>
  <script src="assets/client/js/scrollax.min.js"></script>
  <script src="assets/client/js/main.js"></script>
  <script src="assets/admin/js/toastr.min.js"></script>
  <script src="assets/admin/js/ajax.js"></script>
  <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
  <script>
    $(document).ready(function(){
      $('.user-support').click(function(event) {
        $('.social-button-content').slideToggle();
      });
      });
  </script>
  <script>
    var options = {
    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
  };
  </script>

  <script>
    if($("textarea").length > 0){
       CKEDITOR.replace('my-editor', options);
    }
  </script>
  <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v5.0&appId=496014390953114&autoLogAppEvents=1"></script>
  @if(session('thongbao'))
  <script>
    toastr.success('{{ session('thongbao') }}','Thông báo!', {timeOut: 2000});
        // setTimeout(function(){
        //     location.reload();
        // }, 1000)
  </script>
  @endif
  @if(session('error'))
  <script>
    toastr.options.progressBar = true;
        toastr.error('{{ session('error') }}','Thông báo!', {timeOut: 3000});
  </script>
  @endif
  @yield('js')
</body>
</html>