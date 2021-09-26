<!DOCTYPE html>
<html lang="en">

<head>
	<title>Register - Echa Kids Online Shop</title>
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
	<style type="text/css">
		.error-help-block {
			margin: 0px;
			padding: 0px;
			box-sizing: 0px;
			color: red;
			font-size: 12px
		}
	</style>
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
						Register
					</span>
				</div>
				@if( session('failed-register') )
				<div class="alert alert-danger">
					<p class="text text-danger text-center">{!! session('failed-register') !!}</p>
				</div>
				@endif
				@if( session('success-register') )
				<div class="alert alert-success">
					<p class="text text-success text-center">{!! session('success-register') !!}</p>
				</div>
				@endif
				{!! Form::open(['route' => 'auth.register_user', 'class' => 'login100-form validate-form', 'id' => 'form-register']) !!}
				<div class="wrap-input100 validate-input m-b-26">
					<span class="label-input100">Nama Depan</span>
					<input class="input100" type="text" name="first_name" placeholder="masukan nama depan anda">
					<span class="focus-input100"></span>
				</div>
				<div class="wrap-input100 validate-input m-b-26">
					<span class="label-input100">Nama Belakang</span>
					<input class="input100" type="text" name="last_name" placeholder="masukan nama belakang anda">
					<span class="focus-input100"></span>
				</div>
				<div class="wrap-input100 validate-input m-b-26">
					<span class="label-input100">Email</span>
					<input class="input100" type="text" name="email" placeholder="Enter Email">
					<span class="focus-input100"></span>
				</div>
				<div class="wrap-input100 validate-input m-b-18">
					<span class="label-input100">Password</span>
					<input class="input100" type="password" name="password" placeholder="Masukan password">
					<span class="focus-input100"></span>
				</div>
				<div class="wrap-input100 validate-input m-b-18">
					<span class="label-input100">Password Konfirmasi</span>
					<input class="input100" type="password" name="password_confirmation" placeholder="Ketik ulang password">
					<span class="focus-input100"></span>
				</div>

				<div class="flex-sb-m w-full p-b-30">
					<div class="contact100-form-checkbox">

					</div>

					<div>
						<a href="#" class="txt1" style="display: none">
							Forgot Password?
						</a>
					</div>
				</div>

				<div class="container-login100-form-btn">
					<button class="login100-form-btn" type="submit">
						Register
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
	{!! Html::script('vendor/jsvalidation/js/jsvalidation.js') !!}
	{!! JsValidator::formRequest(App\Http\Requests\auth\RegisterRequest::class, '#form-register') !!}

</body>

</html>