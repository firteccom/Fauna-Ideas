<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>

<style>
	body {
		
	}
</style>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Catálogo en línea</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset('public/components/bootstrap/dist/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('public/components/font-awesome/css/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('public/components/Ionicons/css/ionicons.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('public/dist/css/AdminLTE.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('public/plugins/iCheck/square/blue.css') }}">


  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page" style="background:url('{{ URL::to('/') }}{{'/storage/app/images/wallpaper-background.jpg'}}')">
	<div class="login-box">
	  <div class="login-logo">
	    <a href="../../index2.html"><b>Fauna</b> & Ideas</a>
	  </div>
	  <!-- /.login-logo -->
	  <div class="login-box-body">
	    <p class="login-box-msg">Ingrese sus datos para iniciar sesión</p>

	    <form class="form-login form" method="post" action="{{ route('admin.login') }}">
	    	{{ csrf_field() }}

	    	@if(session('success'))
				<div class="alert alert-success fade in">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					{{ session('success') }}
				</div>
			@elseif(session('improper'))
				<div class="alert alert-danger fade in">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					{{ session('improper') }}
				</div>
			@endif
	      <div class="form-group has-feedback">
	        <input type="email" name="semail" class="form-control" placeholder="Email">
	        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
	      </div>
	      <div class="form-group has-feedback">
	        <input type="password" name="spassword"class="form-control" placeholder="Password">
	        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
	      </div>
	      <div class="row">
	        <div class="col-xs-8">
	          
	        </div>
	        <!-- /.col -->
	        <div class="col-xs-4">
	          <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>
	        </div>
	        <!-- /.col -->
	      </div>
	    </form>

	  </div>
	  <!-- /.login-box-body -->
	</div>
	<!-- /.login-box -->
<!-- jQuery 3 -->
<script src="{{ asset('public/components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('public/components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- iCheck -->
<script src="{{ asset('public/plugins/iCheck/icheck.min.js') }}"></script>

</body>
</html>