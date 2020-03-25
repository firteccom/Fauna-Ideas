<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{ asset('img/profile/nadia_ferrari.jpg') }}" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>Nadia Ferrari</p>
        <a href="#"><i class="fa fa-circle text-success"></i> En línea</a>
      </div>
    </div>
    <!-- search form -->
    <!--
    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
      </div>
    </form> 
    -->
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">Administración</li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-dashboard"></i> <span>Mantenimiento</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{ route('admin.parameter.form') }}"><i class="fa fa-gears"></i> Configuración</a></li>
          <li><a href="../../index2.html"><i class="fa fa-user"></i> Usuarios</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-dashboard"></i> <span>Tienda</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{ route('admin.type.form') }}"><i class="fa fa-book"></i> Tipos de valor</a></li>
          <li><a href="{{ route('admin.category.form') }}"><i class="fa fa-bars"></i> Categorías</a></li>
          <li><a href="{{ route('admin.product.form') }}"><i class="fa fa-book"></i> Productos</a></li>
          <li><a href="{{ route('admin.attribute.form') }}"><i class="fa fa-book"></i> Atributos de productos</a></li>
          <!--<li><a href="{{ route('admin.product.form') }}"><i class="fa fa-book"></i> Repositorio imágenes</a></li>
          <li><a href="../../index.html"><i class="fa fa-shopping-bag"></i> Catálogos</a></li>-->
        </ul>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>