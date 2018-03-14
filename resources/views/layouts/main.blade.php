<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="url" content="{{ config('app.url')}}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ config('app.name', 'Agenet') }}</title>
  <!-- csrf_token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{asset('dist/css/skins/_all-skins.min.css')}}">
  <!-- PNotify -->
  <link rel="stylesheet" href="{{asset('plugins/pnotify/pnotify.custom.min.css')}}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  @yield('head')
</head>
<body class="hold-transition skin-yellow sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="{{ url('/') }}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><strong>SCC</strong></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">
        <strong>
          <img src="{{ asset('storage/img/page/logo.png')}}" alt="" class="img img-responsive" style="width:50px; height:50px; display: inline">
          {{ config('app.name', 'Sococo')}}
        </strong>
      </span>
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
              <img src="{{ (\Auth::user()->imgpath != null) ? asset('storage/'.\Auth::user()->imgpath) : asset('storage/img/page/no-image.png')}}" class="user-image" alt="User Image">
              <span class="hidden-xs">{{ \Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{ (\Auth::user()->imgpath != null) ? asset('storage/'.\Auth::user()->imgpath) : asset('storage/img/page/no-image.png')}}" class="img-circle" alt="User Image">
                <p>
                  {{ \Auth::user()->name }}
                  <small>{{ \Auth::user()->title }}</small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-right">
                  <a href="#" class="btn btn-default btn-flat"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    Salir
                    <i class="fa fa-sign-out"></i>
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
                  </form>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ (\Auth::user()->imgpath != null) ? asset('storage/'.\Auth::user()->imgpath) : asset('storage/img/page/no-image.png')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ \Auth::user()->name }}</p>
          <a href="#"><i class="fa fa-circle text-default"></i>{{ \Auth::user()->title }}</a>
        </div>
      </div>
      <!-- search form -->
      <!-- <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form> -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        @auth
        <li class="header">Menu</li>
        <li>
          <a href="{{ route('home') }}">
            <i class="fa fa-dashboard"></i> <span>Inicio</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
        @can('list employees')
        <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i>
            <span>Personal</span>
            <span class="pull-right-container">
              <i class="fa fa-arrow-circle-o-down pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            @can('list employees')<li><a href="{{ route('employees.index')}}"><i class="fa fa-circle-o"></i>Personal Activo</a></li>@endcan
            @can('list employees')<li><a href="{{ route('employees.down')}}"><i class="fa fa-circle-o"></i>Personal dado de baja</a></li>@endcan
            @can('create employees')<li><a href="{{ route('employees.create')}}"><i class="fa fa-plus-circle"></i> Nuevo Empleado</a></li>@endcan
          </ul>
        </li>
        @endcan
        @can('list equipment_types')
        <li>
          <a href="{{ route('equipmenttypes.index') }}">
            <i class="fa fa-truck"></i> <span>Equipos</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
        @endcan
        @can('list courses')
        <li>
          <a href="{{ route('courses.index') }}">
            <i class="fa fa-certificate"></i> <span>Competencias</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
        @endcan
        @can('list projects')
        <li>
          <a href="{{ route('projects.index') }}">
            <i class="fa fa-university"></i> <span>Proyectos</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
        @endcan
        @can('list groups')
        <li>
          <a href="{{ route('groups.index') }}">
            <i class="fa fa-calendar-times-o"></i> <span>Grupos</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
        @endcan
        @can('view reports')
        <li>
          <a href="{{ route('reports.home') }}">
            <i class="fa fa-file-word-o"></i> <span>Reportes</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
        @endcan
        @can('administrator')
        <li class="header">Otros</li>
        <li>
          <a href="{{ route('users.index') }}">
            <i class="fa fa-users"></i> <span>Usuarios</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
        @endcan
        <li>
          <a href="#" onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">
            <i class="fa fa-dot-circle-o text-warning"></i> <span>Salir</span>
            <span class="pull-right-container">
              <i class="fa fa-sign-out"></i>
            </span>
          </a>
        </li>
        @endauth
        <!-- <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Layout Options</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">4</span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../layout/top-nav.html"><i class="fa fa-circle-o"></i> Top Navigation</a></li>
            <li><a href="../layout/boxed.html"><i class="fa fa-circle-o"></i> Boxed</a></li>
          </ul>
        </li> -->
        <!-- <li>
          <a href="../widgets.html">
            <i class="fa fa-th"></i> <span>Widgets</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">Hot</small>
            </span>
          </a>
        </li>
        <li>
          <a href="../calendar.html">
            <i class="fa fa-calendar"></i> <span>Calendar</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-red">3</small>
              <small class="label pull-right bg-blue">17</small>
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-share"></i> <span>Multilevel</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
            <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> Level One
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                <li class="treeview">
                  <a href="#"><i class="fa fa-circle-o"></i> Level Two
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                  </ul>
                </li>
              </ul>
            </li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
          </ul>
        </li> -->
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" id="app">
    @yield('content')
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <strong>Sococo Dev. Team 2017-2018 <a href="http://www.socococr.com">Sococo de Costa Rica</a>.</strong> Todos los derechos reservados
  </footer>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<!-- jQuery 3 -->
<script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- SlimScroll -->
<script src="{{asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist/js/demo.js')}}"></script>
<!-- PNotify -->
<script src="{{asset('plugins/pnotify/pnotify.custom.min.js')}}"></script>
@include('laravelPnotify::notify')
<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree()
  })
</script>
@yield('script')
</body>
</html>
