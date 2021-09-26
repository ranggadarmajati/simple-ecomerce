<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin Echakids | @yield('title')</title>
@include('admin.layout.css-script')
@yield('admin-custom-css')
</head>
<body class="hold-transition skin-yellow-light sidebar-mini">
<div id="fakeLoader"></div>
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>E</b>K</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Echa</b> Kids</span>
    </a>

    <!-- Header Navbar -->
    @include('admin.layout.header-navbar')
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
   @include('admin.layout.user-panel')

      <!-- Sidebar Menu -->
   @include('admin.layout.sidebar-menu')
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @yield('admin-content-header')
   
   <!--  <section class="content-header">
      <h1>
        Page Header
        <small>Optional description</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol>
    </section> -->

    <!-- Main content -->
    <section class="content container-fluid">
    @yield('admin-main-content')
      <!--------------------------
        | Your Page Content Here |
        -------------------------->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer" style="color: orange;">
    <!-- To the right -->
    <div class="pull-right hidden-xs" style="color: orange;">
      Developed By Rangga Darmajati
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2018 <a href="#">Echakids</a>.</strong> All rights reserved.
  </footer>
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

@include('admin.layout.js-script')
@yield('admin-custom-js')
 <script type="text/javascript">
  $("#fakeLoader").fakeLoader();
 </script>
</body>
</html>