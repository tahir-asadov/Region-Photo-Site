<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,700;1,400&family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('/css/public.css')}}">
    <title>Public - @yield('title', 'Region Photo')</title>
    <link rel="icon" href="favicon.png" type="image/x-icon"/>
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon"/>
    @yield('meta')
</head>
<body class="@yield('body_class')">

    <!--[if IE]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
    <![endif]-->

    <x-hero></x-hero>

    @yield('content')

    <div class="mobile-menu-overlay"></div><!-- .mobile-menu-overlay -->
    <div class="mobile-menu">
        <div class="mobile-menu-content">
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </div><!-- .mobile-menu-content -->
    </div><!-- .mobile-menu -->

    <script src="{{asset('/js/public.js')}}"></script>

</body>
    <link rel="stylesheet" href="{{asset('/css/public.css')}}">
</html>