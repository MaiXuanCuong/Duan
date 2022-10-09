<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ustora Demo</title>
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{ asset('shop1/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('shop1/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('shop1/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('shop1/style.css') }}">
    <link rel="stylesheet" href="{{ asset('shop1/css/responsive.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    @include('shop1.layouts.header')

            @yield('content')

        @include('shop1.layouts.footer')

        <script src="https://code.jquery.com/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script src="{{ asset('shop1/js/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('shop1/js/jquery.sticky.js') }}"></script>
        <script src="{{ asset('shop1/js/jquery.easing.1.3.min.js') }}"></script>
        <script src="{{ asset('shop1/js/main.js') }}"></script>
        <script type="text/javascript" src="{{ asset('shop1/js/bxslider.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('shop1/js/script.slider.js') }}"></script>
        <div
            style="text-align:right;position:fixed;bottom:3px;right:3px;width:100%;z-index:999999;cursor:pointer;line-height:0;display:block;">
            <a target="_blank" href="https://www.freewebhostingarea.com" title="Free Web Hosting with PHP5 or PHP7"><img
                    alt="Free Web Hosting" src="https://www.freewebhostingarea.com/images/poweredby.png"
                    style="border-width: 0px;width: 180px; height: 45px; float: right;"></a></div>
                    <script src="{{ asset('shop/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('shop/js/custom.js') }}"></script>

   
    
        </body>

    </html>
