<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
<a href="{{route('admin.index')}}" class="brand-link">
    <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
      style="opacity: .8">
    <span class="brand-text font-weight-light">
      @if(Auth::check())
      {{Auth::user()->username}}
      @endif</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="index.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Dashboard v1</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="index2.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Dashboard v2</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="index3.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Dashboard v3</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
        <a href="{{route('roles.list')}}" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Role
            </p>
          </a>
        </li>
        
        <li class="nav-item">
          <a href="{{route('users.list')}}" class="nav-link">
            <i class="nav-icon fas fa-user"></i>
            <p>
              User
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{route('events.list')}}" class="nav-link">
            <i class="nav-icon far fa-calendar-plus"></i>
            <p>
              Event
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{route('rooms.list')}}" class="nav-link">
            <i class="nav-icon fas fa-hospital"></i>
            <p>
              Room
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{route('bookings.list')}}" class="nav-link">
            <i class="nav-icon fas fa-bookmark"></i>
            <p>
              Booking
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="admin/logout" class="nav-link active">
            <i class="nav-icon fas fa-power"></i>
            <p>
              Logout
            </p>
          </a>
        </li>
        

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>