<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard Dokter - @yield('title')</title>
    @vite('resources/css/app.css')

    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('cms/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('cms/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('cms/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('cms/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('cms/vendors/ti-icons/css/themify-icons.css') }}">
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('js/select.dataTables.min.css') }}"> --}}
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('cms/css/vertical-layout-light/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('cms/images/favicon.png') }}" />

    {{-- Tailwind --}}
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}

    {{-- fontawsome --}}
    <script src="https://kit.fontawesome.com/d79b975262.js" crossorigin="anonymous"></script>

    <style>
        .nav-item .collapse{
            visibility: visible;
        }
    </style>

    @livewireStyles
    {{-- Alpine JS --}}
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body>
    <style>
        [x-cloak] { display: none !important; }
    </style>
    <div class="container-scroller">
        {{-- SECTION FOR NAVBAR --}}
        @include('cms.partials.navbar_dokter')
        <div class="container-fluid page-body-wrapper">
                {{-- SIDEBAR SECTION --}}
                @include('cms.partials.sidebar_dokter')
                <div class="main-panel">
                    <div class="content-wrapper">
                        <div class="card bg-base-100 shadow-xl p-4">
                            {{-- MAIN CONTENT SECTION --}}
                            @yield('heading-content')
                            @yield('main-content')
                        </div>
                    </div>
                    <!-- content-wrapper ends -->
                    <!-- partial -->
                </div>
                <!-- main-panel ends -->
        </div>
            <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <!-- plugins:js -->
    <script src="{{ asset('cms/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('cms/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('cms/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('cms/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('cms/js/dataTables.select.min.js') }}"></script>

    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('cms/js/off-canvas.js') }}"></script>
    <script src="{{ asset('cms/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('cms/js/template.js') }}"></script>
    <script src="{{ asset('cms/js/settings.js') }}"></script>
    <script src="{{ asset('cms/js/todolist.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{ asset('cms/js/dashboard.js') }}"></script>
    <script src="{{ asset('cms/js/Chart.roundedBarCharts.js') }}"></script>
    <!-- End custom js for this page-->
    @livewireScripts
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    {{-- Tiny MCE --}}
    <script src="https://cdn.tiny.cloud/1/04ziebv0314chbsscja67sj6ccikvj7c581zbrw9p3wun0rf/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    @yield('after-script')
    @yield('component-script')
</body>

</html>

