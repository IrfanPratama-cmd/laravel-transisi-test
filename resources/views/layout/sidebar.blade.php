<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <h2 class="brand-text font-weight-light text-center">TRANSISI</h2>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('lte/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{auth()->user()->name}}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          @can('read-user-management')
          <li class="nav-header">USER MANAGEMENT</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <p>
                  User Management
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
            @endcan
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/roles" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Roles</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/permissions" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Permission</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/users" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>User</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-header">MASTER DATA</li>
          <li class="nav-item">
            <a href="/divisions" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>
                Division
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/positions" class="nav-link">
              <i class="nav-icon fas fa-business-time"></i>
              <p>
                Position
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/companies" class="nav-link">
              <i class="nav-icon fas fa-globe"></i>
              <p>
                Company
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="/employees" class="nav-link">
              <i class="nav-icon fas fa-link"></i>
              <p>
                Employee
              </p>
            </a>
          </li>


        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
