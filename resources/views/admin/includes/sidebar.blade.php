<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/admin" class="brand-link">
      <img src="{{adminAssets('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Admin Panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <li class="nav-item">
            <a href="{{route('admin.dashboard')}}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
          
          @role('Super Admin')
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa fa-user-tie"></i>
              <p>Manage Admin<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.roles')}}" class="nav-link">
                  <i class="fas fa-sm fa-arrow-right"></i>&nbsp;Admin Roles
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.admin')}}" class="nav-link">
                  <i class="fas fa-sm fa-arrow-right"></i>&nbsp;Admin Users
                </a>
              </li>
            </ul>
          </li>
          @endrole

          @can('View User')
          <li class="nav-item">
            <a href="{{route('admin.user')}}" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>Register Users</p>
            </a>
          </li>
          @endcan

          @if(Auth::user()->can('View Category') || Auth::user()->can('View Category'))
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-eye"></i>
              <p>Manage Category<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              @can('View Category')
              <li class="nav-item">
                <a href="{{route('admin.category')}}" class="nav-link">
                  <i class="fas fa-sm fa-arrow-right"></i>&nbsp;Category
                </a>
              </li>
              @endcan
              @can('View SubCategory')
              <li class="nav-item">
                <a href="{{route('admin.subcategory')}}" class="nav-link">
                  <i class="fas fa-sm fa-arrow-right"></i>&nbsp;SubCategory
                </a>
              </li>
              @endcan
            </ul>
          </li>
          @endif

          @can('View Product')
          <li class="nav-item">
            <a href="{{route('admin.product')}}" class="nav-link">
              <i class="nav-icon fas fa-box"></i>
              <p>Product</p>
            </a>
          </li>
          @endcan

          @can('View Pages')
          <li class="nav-item">
            <a href="{{route('admin.pages')}}" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>Pages</p>
            </a>
          </li>
          @endcan

        </ul>
      </nav>
    </div>
  </aside>