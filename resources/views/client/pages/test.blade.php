<!DOCTYPE html>
<html lang="vi">

<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title')</title>
  <base href="{{ asset('') }}">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <script src="assets/client/js/jquery.min.js"></script>
  <!-- <script src="assets/client/js/jquery-migrate-3.0.1.min.js"></script> -->
  	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
</head>

<body>
  {!! $calendar->calendar() !!}
                                {!! $calendar->script() !!}
 
  
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

 <!--  <script>
    $(document).ready(function(){
      $('.user-support').click(function(event) {
        $('.social-button-content').slideToggle();
      });
      });
  </script>
   -->
</body>

</html>