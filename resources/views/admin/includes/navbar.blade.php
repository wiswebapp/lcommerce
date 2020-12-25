<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a class="nav-link"><strong>Date : </strong>{{ date('d-m-Y (h:ia)') }}</a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a class="nav-link">Welcome {{ Auth::user()->name }}</a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Notifications Dropdown Menu -->
    <li class="nav-item dropdown">
      <a class="nav-link btn btn-default" data-toggle="dropdown" onclick="event.preventDefault();
      document.getElementById('logout-form').submit();">
        <i class="far fa-bell"></i> Logout
      </a>
      <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
          {{ csrf_field() }}
      </form>
    </li>
  </ul>
</nav>