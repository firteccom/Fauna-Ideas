<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | General Form Elements</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset('components/bootstrap/dist/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('components/font-awesome/css/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('components/Ionicons/css/ionicons.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css') }}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('components/select2/dist/css/select2.min.css') }}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ asset('dist/css/skins/_all-skins.min.css') }}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>


<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

	@include('shared.header')
	@include('shared.leftcol')

	@yield('content')

	@include('shared.controlsidebar')

</div>

	@include('shared.footer')
  
  <!-- ./wrapper -->

	<!-- jQuery 3 -->
	<script src="{{ asset('components/jquery/dist/jquery.min.js') }}"></script>
	<!-- Bootstrap 3.3.7 -->
	<script src="{{ asset('components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
	<!-- FastClick -->
	<script src="{{ asset('components/fastclick/lib/fastclick.js') }}"></script>
	<!-- AdminLTE App -->
	<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="{{ asset('dist/js/demo.js') }}"></script>
  <!-- Select2 -->
  <script src="{{ asset('components/select2/dist/js/select2.full.min.js') }}"></script>
    
  <!-- InputMask -->
  <script src="{{ asset('plugins/input-mask/jquery.inputmask.js') }}"></script>
  <script src="{{ asset('plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
  <script src="{{ asset('plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>
  <!-- SlimScroll -->
  <script src="{{ asset('components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
  <!-- iCheck 1.0.1 -->
  <script src="{{ asset('plugins/iCheck/icheck.min.js') }}"></script>
  <!-- FastClick -->
  <script src="{{ asset('components/fastclick/lib/fastclick.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>

    @yield('js')
	
  </body>
</html>