<!DOCTYPE html>
<html lang="en">
<head>
<title>OneTech</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="OneTech shop project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="{{ asset('styles/bootstrap4/bootstrap.min.css') }}">
<link href="{{ asset('plugins/fontawesome-free-5.0.1/css/fontawesome-all.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/OwlCarousel2-2.2.1/owl.carousel.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/OwlCarousel2-2.2.1/owl.theme.default.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/OwlCarousel2-2.2.1/animate.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/slick-1.8.0/slick.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('styles/main_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('styles/responsive.css') }}">
 <!-- chart -->
 <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">

</head>

<body>

<div class="super_container">
        @include('layouts.header')
        @yield('content')

        @include('layouts.footer')
</div>     
    
<script src="{{ asset('js/jquery-3.3.1.min.js ') }}"></script>
<script src="{{ asset('styles/bootstrap4/popper.js ') }}"></script>
<script src="{{ asset(' styles/bootstrap4/bootstrap.min.js') }}"></script>
<script src="{{ asset('plugins/greensock/TweenMax.min.js ') }}"></script>
<script src="{{ asset(' lugins/greensock/TimelineMax.min.js') }}p"></script>
<script src="{{ asset(' plugins/scrollmagic/ScrollMagic.min.js') }}"></script>
<script src="{{ asset(' plugins/greensock/animation.gsap.min.js') }}"></script>
<script src="{{ asset(' plugins/greensock/ScrollToPlugin.min.js') }}"></script>
<script src="{{ asset('plugins/OwlCarousel2-2.2.1/owl.carousel.js ') }}"></script>
<script src="{{ asset(' plugins/slick-1.8.0/slick.js') }}"></script>
<script src="{{ asset('plugins/easing/easing.js ') }}"></script>
<script src="{{ asset('js/custom.js ') }}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

  <script src="{{ asset('https://unpkg.com/sweetalert/dist/sweetalert.min.js')}}"></script>


 <script>
        @if(Session::has('messege'))
          var type="{{Session::get('alert-type','info')}}"
          switch(type){
              case 'info':
                   toastr.info("{{ Session::get('messege') }}");
                   break;
              case 'success':
                  toastr.success("{{ Session::get('messege') }}");
                  break;
              case 'warning':
                 toastr.warning("{{ Session::get('messege') }}");
                  break;
              case 'error':
                  toastr.error("{{ Session::get('messege') }}");
                  break;
          }
        @endif
     </script>  
</body>

</html>