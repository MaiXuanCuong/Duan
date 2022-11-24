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
    <link rel="stylesheet" href="{{ asset('shop/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('shop/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('shop/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('shop/styles/style.css') }}">
    <link rel="stylesheet" href="{{ asset('shop/css/responsive.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('shop/styles/bootstrap.min.css') }}">
 
    <link rel="stylesheet" type="text/css" href="{{ asset('shop/styles/main_styles.css') }}">

    @include('shop.layouts.header')

            @yield('content')

        @include('shop.layouts.footer')

        <script src="https://code.jquery.com/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script src="{{ asset('shop/js/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('shop/js/jquery.sticky.js') }}"></script>
        <script src="{{ asset('shop/js/jquery.easing.1.3.min.js') }}"></script>
        <script src="{{ asset('shop/js/main.js') }}"></script>
        <script type="text/javascript" src="{{ asset('shop/js/bxslider.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('shop/js/script.slider.js') }}"></script>
        </body>

    </html>
