<!DOCTYPE html>
<html lang="{{app()->getLocale() == 'ar' ? 'ar' : 'en'}}" dir="{{app()->getLocale() == 'ar' ? 'rtl' : 'ltr'}}">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title') {{ config('app.name') }}</title>
<link rel="stylesheet" href="{{asset('front/css/bootstrap.min.css')}}" type="text/css">
<link rel="stylesheet" href="{{asset('front/css/font-awesome.min.css')}}" type="text/css">
<link rel="stylesheet" href="{{asset('front/css/owl.carousel.min.css')}}" type="text/css">
<link rel="stylesheet" href="{{asset('front/css/owl.theme.default.css')}}" type="text/css">
<link rel="stylesheet" href="{{asset('front/css/main.css')}}" type="text/css">
<link rel="stylesheet" href="{{asset('front/css/swiper.min.css')}}" type="text/css">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

<link rel="stylesheet" href="{{asset('front/css/style.css?v=1.600')}}" type="text/css">
@stack('styles')
</head>
<body>
@include("partials.header")
@yield("content")

 @include("partials.footer")



<script src="{{asset('front/js/jquery.min.js')}}"></script>
<script src="{{asset('front/js/bootstrap.min.js')}}"></script>

<script>

    // global app configuration object
    var config = {
        routes: {
        }
    };
</script>

@stack('scripts')
</body>
</html>
