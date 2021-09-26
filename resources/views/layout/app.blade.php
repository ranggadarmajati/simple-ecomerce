<!DOCTYPE html>
<html lang="en">
<head>
	<title>@yield('title') | Echa Kids Online Shop</title>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="Echa Kids Online Shop">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	@include('layout.css-script')
	@yield('custom-css-script')
</head>

<body class="animsition">
	<!-- top noti -->
	@if( session('success_authenticate') )
	<div class="flex-c-m size22 s-text21 pos-relative" style="background-color: #00CC00;">
		{{ session('success_authenticate') }}
		<button class="flex-c-m pos2 size23 colorwhite eff3 trans-0-4 btn-romove-top-noti">
			<i class="fa fa-remove fs-13" aria-hidden="true"></i>
		</button>
	</div>
	@endif

	@if( session('success_logout') )
	<div class="flex-c-m size22 s-text21 pos-relative" style="background-color: #00CC00;">
		{{ session('success_logout') }}
		<button class="flex-c-m pos2 size23 colorwhite eff3 trans-0-4 btn-romove-top-noti">
			<i class="fa fa-remove fs-13" aria-hidden="true"></i>
		</button>
	</div>
	@endif

	@if( session('error-login') )
	<div class="flex-c-m size22 s-text21 pos-relative" style="background-color: red;">
		{{ session('error-login') }}
		<button class="flex-c-m pos2 size23 colorwhite eff3 trans-0-4 btn-romove-top-noti">
			<i class="fa fa-remove fs-13" aria-hidden="true"></i>
		</button>
	</div>
	@endif

	<!-- Header -->
	<header class="header2">
		<!-- Header desktop -->
		<div class="container-menu-header-v2 p-t-26">
			<!-- topbar2 -->
			@include('layout.topbar2')

			<div class="wrap_header">

				<!-- Menu -->
				@include('layout.menu')

				<!-- Header Icon -->
				<div class="header-icons">

				</div>
			</div>
		</div>

		<!-- Header Mobile -->
		@include('layout.header_mobile')
		<!-- End Header Mobile -->

		<!-- Menu Mobile -->
		@include('layout.menu-mobile')
		<!-- End Menu Mobile -->
	</header>

	@yield('content')

	<!-- Footer -->
	@include('layout.footer')
	<!-- End Footer -->



	<!-- Back to top -->
	<div class="btn-back-to-top bg0-hov" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="fa fa-angle-double-up" aria-hidden="true"></i>
		</span>
	</div>

	<!-- Container Selection1 -->
	<div id="dropDownSelect1"></div>
	<div id="dropDownSelect2"></div>
	@include('auth.modal_login')
	@include('auth.modal_lupa_password')
	@include('layout.js-script')
	@yield('custom-js-script')
	@if( session('success_add_cart') )
	<script type="text/javascript">
		$(document).ready(function() {
			swal({
				title: "Item",
				text: "Berhasil ditambahkan!",
				icon: "success",
				button: "Ok"
			});
		});
	</script>
	@endif
	@if( session('success_update_cart') )
	<script type="text/javascript">
		$(document).ready(function() {
			swal({
				title: "Item",
				text: "Berhasil diupdate!",
				icon: "success",
				button: "Ok"
			});
		});
	</script>
	@endif
	@if( session('success_remove_cart') )
	<script type="text/javascript">
		$(document).ready(function() {
			swal({
				title: "Item",
				text: "Berhasil dihapus!",
				icon: "success",
				button: "Ok"
			});
		});
	</script>
	@endif
	@if( session('success_order') )
	<script type="text/javascript">
		$(document).ready(function() {
			swal({
				title: "Order",
				text: "Berhasil, segera transfer dan konfirmasi pembayaran anda!",
				icon: "success",
				button: "Ok"
			});
		});
	</script>
	@endif
</body>
</html>