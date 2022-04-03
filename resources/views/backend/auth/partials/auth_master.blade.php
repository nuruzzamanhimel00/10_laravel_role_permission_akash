<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('auth_title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include("backend.layouts.partials.style")

    @stack('css')
    <!-- modernizr css -->
    <script src="{{ asset('backend/assets/js/vendor/modernizr-2.8.3.min.js') }}"></script>
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>

    @yield('auth-content')


    @include("backend.layouts.partials.scripts")

    @stack('js')
</body>

</html>
