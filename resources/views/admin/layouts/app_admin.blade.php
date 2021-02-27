<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Panel - @yield('title')</title>
    <!--Admin Panel-->
    <link rel="stylesheet" href="{{adminAssets('plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{adminAssets('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{adminAssets('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <link rel="stylesheet" href="{{adminAssets('plugins/summernote/summernote-bs4.css')}}">
    <link rel="stylesheet" href="{{adminAssets('plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{adminAssets('dist/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{adminAssets('dist/css/custom-admin.css')}}">
    <!-- jQuery -->
    <script src="{{adminAssets('plugins/jquery/jquery.min.js')}}"></script>
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
@include('admin.includes.backend_js')
<div class="wrapper" id="app">

    @include('admin.includes.navbar')

    @include('admin.includes.sidebar')

    @yield('content')
    
    {{-- @include('admin.includes.footer') --}}
</div>
<!-- Bootstrap -->
<script src="{{adminAssets('plugins/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{adminAssets('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{adminAssets('dist/js/adminlte.min.js')}}"></script>
<script src="{{asset('js/app.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{adminAssets('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<script src="{{adminAssets('plugins/topbar/topbar.min.js')}}"></script>
<script src="{{adminAssets('plugins/select2/js/select2.min.js')}}"></script>
<!-- PAGE PLUGINS -->
<script src="{{adminAssets('plugins/jquery-mousewheel/jquery.mousewheel.js')}}"></script>
<script src="{{adminAssets('plugins/summernote/summernote-bs4.min.js')}}"></script>
<script src="{{adminAssets('dist/js/adminapp.js')}}"></script>
@yield('customScripts')

</body>
</html>