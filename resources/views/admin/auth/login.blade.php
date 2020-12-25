<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in (v2)</title>

  <!--Admin Panel-->
  <link rel="stylesheet" href="{{adminAssets('plugins/fontawesome-free/css/all.min.css')}}">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="{{adminAssets('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{adminAssets('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <link rel="stylesheet" href="{{adminAssets('plugins/summernote/summernote-bs4.css')}}">
  <link rel="stylesheet" href="{{adminAssets('dist/css/adminlte.min.css')}}">
  <!-- jQuery -->
  <script src="{{adminAssets('plugins/jquery/jquery.min.js')}}"></script>
  {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a class="h2"><b>Admin</b>LTE</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      @include('includes.alert_msg')

      <form method="POST" action="{{ route('admin.login') }}">
        
        {{ csrf_field() }}

        <div class="input-group mb-3">
          <input type="text" name="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- Bootstrap -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<script src="{{adminAssets('plugins/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{adminAssets('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{adminAssets('dist/js/adminlte.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{adminAssets('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- PAGE PLUGINS -->
<script src="{{adminAssets('plugins/jquery-mousewheel/jquery.mousewheel.js')}}"></script>
<script src="{{adminAssets('plugins/summernote/summernote-bs4.min.js')}}"></script>
<script src="{{adminAssets('dist/js/adminapp.js')}}"></script>
</body>
</html>