<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- Primary Meta Tags -->
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('volt/assets/img/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('volt/assets/img/brand/sukk.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('volt/assets/img/brand/sukk.png') }}">
    <link rel="manifest" href="{{ asset('volt/assets/img/favicon/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('volt/assets/img/favicon/safari-pinned-tab.svg') }}" color="#ffffff">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">

    <!-- Sweet Alert -->
    <link type="text/css" href="{{ asset('volt/vendor/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">

    <!-- Notyf -->
    <link type="text/css" href="{{ asset('volt/vendor/notyf/notyf.min.css') }}" rel="stylesheet">

    <!-- Volt CSS -->
    <link type="text/css" href="{{ asset('volt/css/volt.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/select2bs5/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/select2bs5/select2-bootstrap-5-theme.min.css') }}" />
    <!-- Or for RTL support -->
    <link rel="stylesheet" href="{{ asset('css/select2bs5/select2-bootstrap-5-theme.rtl.min.css') }}" />

    <style>
        .alignRight {
            float: right;
            padding-left: 15px;
        }
    </style>
    <!-- NOTICE: You can use the _analytics.html partial to include production code specific code & trackers -->
</head>

<body>
    <div id="app">
        @auth
            @include('layouts.sidebar')
            <main class="content">
                @include('layouts.navbar')
                @yield('content')
                {{-- @include('layouts.setting') --}}
                @include('layouts.footer-auth')
            </main>
        @else
            @include('layouts.header')
            <main>
                @yield('content')
            </main>
            @include('layouts.footer')
        @endauth
    </div>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
    <!-- Core -->
    <script src="{{ asset('volt/vendor/@popperjs/core/dist/umd/popper.min.js') }}"></script>
    {{-- <script src="{{ asset('volt/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script> --}}
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> --}}


    <!-- Vendor JS -->
    <script src="{{ asset('volt/vendor/onscreen/dist/on-screen.umd.min.js') }}"></script>

    <!-- Slider -->
    <script src="{{ asset('volt/vendor/nouislider/dist/nouislider.min.js') }}"></script>

    <!-- Smooth scroll -->
    <script src="{{ asset('volt/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js') }}"></script>

    <!-- Charts -->
    <script src="{{ asset('volt/vendor/chartist/dist/chartist.min.js') }}"></script>
    <script src="{{ asset('volt/vendor/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js') }}"></script>

    <!-- Datepicker -->
    <script src="{{ asset('volt/vendor/vanillajs-datepicker/dist/js/datepicker.min.js') }}"></script>

    <!-- Sweet Alerts 2 -->
    <script src="{{ asset('volt/vendor/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>

    <!-- Moment JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js"></script>

    <!-- Vanilla JS Datepicker -->
    <script src="{{ asset('volt/vendor/vanillajs-datepicker/dist/js/datepicker.min.js') }}"></script>

    <!-- Notyf -->
    <script src="{{ asset('volt/vendor/notyf/notyf.min.js') }}"></script>

    <!-- Simplebar -->
    <script src="{{ asset('volt/vendor/simplebar/dist/simplebar.min.js') }}"></script>

    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <!-- Volt JS -->
    <script src="{{ asset('volt/assets/js/volt.js') }}"></script>

    <script src="{{ asset('js/select2bs5/jquery.slim.min.js') }}"></script>
    <script src="{{ asset('js/select2bs5/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/select2bs5/select2.min.js') }}"></script>

    @yield('script')
</body>

</html>