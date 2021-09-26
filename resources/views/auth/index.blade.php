<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login - Echa Kids Online Shop</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('login_asset/images/icons/favicon.ico') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('login_asset/vendor/bootstrap/css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('login_asset/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('login_asset/fonts/Linearicons-Free-v1.0.0/icon-font.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('login_asset/vendor/animate/animate.css') }}">	
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('login_asset/vendor/css-hamburgers/hamburgers.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('login_asset/vendor/animsition/css/animsition.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('login_asset/vendor/select2/select2.min.css') }}">	
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('login_asset/vendor/daterangepicker/daterangepicker.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('login_asset/css/util.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('login_asset/css/main.css') }}">
</head>
<body>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image: url(login_asset/images/bg-01.jpeg);">
					<span class="login100-form-title-2" style="color: white;">
						<b>Echa Kids Online Shop</b>
					</span>
					<span class="login100-form-title-1">
						Sign In
					</span>
				</div>
				@if( session('error-login') )
				<div class="alert alert-danger">
						<p class="text text-danger text-center">{!! session('error-login') !!}</p>
				</div>
				@endif
				@if( session('success-register') )
				<div class="alert alert-success">
						<p class="text text-success text-center">{!! session('success-register') !!}</p>
				</div>
				@endif
				{!! Form::open(['route' => 'auth.login', 'class' => 'login100-form validate-form', 'id' => 'form-login']) !!}
					<div class="wrap-input100 validate-input m-b-26" data-validate="Email is required">
						<span class="label-input100">Email</span>
						<input class="input100" type="text" name="email" placeholder="Enter Email">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
						<span class="label-input100">Password</span>
						<input class="input100" type="password" name="password" placeholder="Enter password">
						<span class="focus-input100"></span>
					</div>

					<div class="flex-sb-m w-full p-b-30">
						<div class="contact100-form-checkbox">
						</div>

						<div>
							<a href="#" class="txt1">
								Forgot Password?
							</a>
						</div>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit">
							Login
						</button>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
	
<!--===============================================================================================-->
	<script src="{{ URL::asset('login_asset/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ URL::asset('login_asset/vendor/animsition/js/animsition.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ URL::asset('login_asset/vendor/bootstrap/js/popper.js') }}"></script>
	<script src="{{ URL::asset('login_asset/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ URL::asset('login_asset/vendor/select2/select2.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ URL::asset('login_asset/vendor/daterangepicker/moment.min.js') }}"></script>
	<script src="{{ URL::asset('login_asset/vendor/daterangepicker/daterangepicker.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ URL::asset('login_asset/vendor/countdowntime/countdowntime.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ URL::asset('login_asset/js/main.js') }}"></script>

</body>
</html>