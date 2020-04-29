<header class="main-header">
    <!-- Logo -->
    <a href="../../index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>F & I</b>D</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Fauna & Ideas</b> Diseño</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{'../storage/app/'.$user->sprofilepicture}}" class="user-image" alt="Imagen de perfil" >
              <span class="hidden-xs">{{$user->getFullName()}}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{'../storage/app/'.$user->sprofilepicture}}" class="img-circle" alt="Imagen de perfil">

                <p>
                  {{$user->getFullName()}} - Admin
                  <!--<small>CEO - Fundador</small>-->
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <!--<a href="#" class="btn btn-default btn-flat">Profile</a>-->
                </div>
                <div class="pull-left">
                  <a href="{{ route('admin.logout') }}" class="btn btn-default btn-flat">Cerrar sesión</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <!--<li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>-->
        </ul>
      </div>
    </nav>
</header>