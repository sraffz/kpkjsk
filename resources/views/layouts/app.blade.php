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

    <!-- Select2 BS4 -->
    <link type="text/css" href="{{ asset('volt/css/volt.css') }}" rel="stylesheet">

    {{-- <!-- sweetalert2 -->
    <link rel="stylesheet" href="{{ asset('sweetalert/sweetalert2.min.css') }}"> --}}

    <!-- Select2 BS5 -->
    <link rel="stylesheet" href="{{ asset('css/select2bs5/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/select2bs5/select2-bootstrap-5-theme.min.css') }}" />
    <!-- Or for RTL support -->
    <link rel="stylesheet" href="{{ asset('css/select2bs5/select2-bootstrap-5-theme.rtl.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/plugins/datatables-bs5/datatables.min.css') }}" />
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
                @if (Session::has('message'))
                    @php
                        $n = 1;
                    @endphp
                    {{-- <div class="alert {{ Session::get('alert-class') }} alert-dismissible fade show" role="alert">
                        <span class="fas fa-bullhorn me-1"></span>
                        {{ Session::get('message') }}
                        <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div> --}}
                @else
                    @php
                        $n = 0;
                    @endphp
                @endif
                @yield('content')
                {{-- @include('layouts.setting') --}}
                @php
                    $kp = Auth::user()->nokp;
                    $pass = Auth::user()->password;
                @endphp
                @if (Hash::check($kp, $pass))
                    <!-- Modal -->
                    <div class="modal fade" id="myModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                        role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tukar Kata Laluan</h5>

                                </div>
                                <form action="{{ url('tukar-password') }}" method="post">
                                    {{ csrf_field() }}
                                    <div class="modal-body">
                                        <div class="container-fluid">
                                            <div class="form-group mb-2">
                                                <label for="password">Kata Laluan Baru</label>
                                                <input type="password"
                                                    class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                                    name="password" id="password" aria-describedby="helpId"
                                                    aria-invalid="true" required autofocus>
                                                <small id="helpId" class="error invalid-feedback">
                                                    {{ $errors->first('password') }}
                                                </small>
                                            </div>

                                            <div class="form-group">
                                                <label for="confirmpassword">Taip Semula Kata Laluan Baru</label>
                                                <input type="password"
                                                    class="form-control {{ $errors->has('confirmpassword') ? ' is-invalid' : '' }}"
                                                    name="confirmpassword" id="confirmpassword" aria-invalid="true"
                                                    aria-describedby="helpId" required>
                                                <small id="helpId" class="error invalid-feedback">
                                                    {{ $errors->first('confirmpassword') }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                            class="btn btn-secondary"> <i class="fas fa-sign-out-alt"></i> Log Keluar</a>
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>
                                            Simpan</button>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
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

    <!-- Select2 BS5-->
    <script src="{{ asset('js/select2bs5/jquery.slim.min.js') }}"></script>
    <script src="{{ asset('js/select2bs5/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/select2bs5/select2.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('/plugins/datatables-bs5/datatables.min.js') }}"></script>

    <!-- SweetAlert -->
    {{-- <script src="{{ asset('sweetalert/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('sweetalert/sweetalert2.min.js') }}"></script> --}}

    @yield('script')

    <script>
        $(document).ready(function() {
            $('.datatables').DataTable({
                "language": {
                "emptyTable": "Tiada data",
                "lengthMenu": "_MENU_ Rekod setiap halaman",
                "zeroRecords": "Tiada padanan rekod yang dijumpai.",
                "info": "Paparan dari _START_ hingga _END_ dari _TOTAL_ rekod",
                "infoEmpty": "Paparan 0 hingga 0 dari 0 rekod",
                "infoFiltered": "(Ditapis dari jumlah _MAX_ rekod)",
                "search": "Carian:",
                "oPaginate": {
                    "sFirst": "Pertama",
                    "sPrevious": "Sebelum",
                    "sNext": "Seterusnya",
                    "sLast": "Akhir"
                }
            },
            });
        });

        $(document).ready(function() {
            $('.select2bs4').select2({
                theme: "bootstrap-5",
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                    'style',

            });
        });
    </script>
    <script type="text/javascript">
        $(window).on('load', function() {
            $('#myModal').modal('show');
        });
    </script>

    <!---- Notification ----->
    <script>
         var num = {{ $n }};
        if (num == 1) {
                 const notyf = new Notyf({
                    position: {
                        x: 'right',
                        y: 'top',
                    },
                    types: [{
                        type: 'primary',
                        background: 'green',
                        icon: {
                            className: 'fas fa-comment-dots',
                            tagName: 'span',
                            color: '#fff'
                        },
                        dismissible: false
                    }]
                });
                notyf.open({
                    type: '{{ Session::get('alert-class') }}',
                    message: '{{ Session::get('message') }}'
                });
         }
    </script>
    {{-- @include('sweetalert::alert') --}}
</body>

</html>
