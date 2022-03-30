<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title','Dashboard | Role Permission Laravel')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @include("backend.layouts.partials.style")

    @stack('css')
    <!-- modernizr css -->
    <script src="{{ asset('backend/assets/js/vendor/modernizr-2.8.3.min.js') }}"></script>
</head>

<body>

    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
        <div class="sidebar-menu">
            <div class="sidebar-header">
                <div class="logo">
                    <a href="index.html"><img src="{{ asset('backend/assets/images/icon/logo.png') }}" alt="logo"></a>
                </div>
            </div>
            @include("backend.layouts.partials.menu")
        </div>
        <!-- sidebar menu area end -->
        <!-- main content area start -->
        <div class="main-content">
            <!-- header area start -->
            @include("backend.layouts.partials.header")

            @yield('content')

        </div>
        <!-- main content area end -->
        <!-- footer area start-->
       @include("backend.layouts.partials.footer")
        <!-- footer area end-->
    </div>
    <!-- page container area end -->
    <!-- offset area start -->
   @include("backend.layouts.partials.offset")
    <!-- offset area end -->
    <!-- jquery latest version -->
    @include("backend.layouts.partials.scripts")

    @stack('js')
</body>

</html>
