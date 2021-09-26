<!-- js-script -->
<!--===============================================================================================-->
	<script type="text/javascript" src="{{URL::asset('fashe-colorlib/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="{{URL::asset('fashe-colorlib/vendor/animsition/js/animsition.min.js')}}"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="{{URL::asset('fashe-colorlib/vendor/bootstrap/js/popper.js')}}"></script>
	<script type="text/javascript" src="{{URL::asset('fashe-colorlib/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="{{URL::asset('fashe-colorlib/vendor/select2/select2.min.js')}}"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="{{URL::asset('fashe-colorlib/vendor/slick/slick.min.js')}}"></script>
	<script type="text/javascript" src="{{URL::asset('fashe-colorlib/js/slick-custom.js')}}"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="{{URL::asset('fashe-colorlib/vendor/countdowntime/countdowntime.js')}}"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="{{URL::asset('fashe-colorlib/vendor/lightbox2/js/lightbox.min.js')}}"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="{{URL::asset('fashe-colorlib/vendor/sweetalert/sweetalert.min.js')}}"></script>
	{!! Html::script('fashe-colorlib/vendor/datatables.net-bs/datatables.min.js') !!}
<!--===============================================================================================-->
	<!-- <script type="text/javascript" src="{{URL::asset('fashe-colorlib/vendor/pagination/pagination.min.js')}}"></script> -->
	<script type="text/javascript" src="{{URL::asset('fashe-colorlib/vendor/pagination/pagination.js')}}"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="{{URL::asset('fashe-colorlib/vendor/parallax100/parallax100.js')}}"></script>
	<script type="text/javascript" src="{{URL::asset('fashe-colorlib/vendor/noui/nouislider.min.js')}}"></script>
	<script type="text/javascript">
        $('.parallax100').parallax100();
	</script>
	{!! Html::script('vendor/jsvalidation/js/jsvalidation.js') !!}
<!--===============================================================================================-->
	<script src="{{URL::asset('fashe-colorlib/js/main.js')}}"></script>

	<script type="text/javascript">
		$('#login').click(function(){
        $('#modal_login').modal('show');
        // alert("di klik")
    });
		$('.header-icons-mobile #login').click(function(){
			$('#modal_login').modal('show');
		});
		$('#forgot_password').click(function(){
			$('#modal_login').modal('hide');
			$('#modal_lupa_password').modal('show');
			// alert('modal forgot password');
		});
	</script>
	@yield('push-javascript')