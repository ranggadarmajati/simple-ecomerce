<div class="topbar2">
	<div class="topbar-social">
		<a href="{{ isset($contact->facebook_src) ? $contact->facebook_src : '#' }}" class="topbar-social-item fa fa-facebook" target="_blank"></a>
		<a href="{{ isset($contact->instagram_src) ? $contact->instagram_src : '#' }}" class="topbar-social-item fa fa-instagram" target="_blank"></a>
		<a href="{{ isset($contact->wa_no) ? $contact->srcw : '#' }}" class="topbar-social-item fa fa-whatsapp" {{ isset($contact->wa_no) ? 'target="_blank"' : '' }}></a>
		<a href="{{ isset($contact->youtube_src) ? $contact->youtube_src : '#' }}" class="topbar-social-item fa fa-youtube-play" {{ isset($contact->youtube_src) ? 'target="_blank"' : '' }}></a>
	</div>

	<!-- Logo2 -->
	<a href="{{ route('home') }}" class="logo2">
		<img src="{{ URL::asset('fashe-colorlib/images/icons/logo6.png') }}" alt="IMG-LOGO">
	</a>

	<div class="topbar-child2">
		<span class="topbar-email">
			@if(isset($name))
			<ul class="main_menu">
				<li>
					<a href="javascript:;" style="font-family: Montserrat-Regular; font-size: 13px;color: #888888; line-height: 1.7;">{{ $name }}</a>
					<ul class="sub_menu">
						<li><a href="{{ route('order_confirm') }}">Konfirmasi Orderan Anda </a></li>
					</ul>
				</li>
			</ul>
			@endif
		</span>

		<!--  -->
		<a href="#" class="header-wrapicon1 dis-block m-l-30">
			<?php if (session('authenticate')) { ?>
				<a href="{{ isset($param) ? route('auth.admin_logout') : route('auth.logout') }}" class="badge badge-danger">Logout</a><br>
			<?php } else { ?>

				<a href="#" class="badge badge-success" id="login">Login</a>
			<?php } ?>
		</a>

		<span class="linedivide1"></span>
		<!-- cart header -->
		<div class="header-wrapicon2 m-r-13">
			<img src="{{URL::asset('fashe-colorlib/images/icons/icon-header-02.png')}}" class="header-icon1 js-show-header-dropdown" alt="ICON">
			<span class="header-icons-noti">{{ $cart_count }}</span>
			<!-- Header cart noti -->
			<div class="header-cart header-dropdown">
				@include('layout.cart_header')
				@if($cart_count > 0)
				<div class="header-cart-total">
					Total: Rp. {{ $cart_total }}
				</div>
				<div class="header-cart-buttons">
					<div class="header-cart-wrapbtn">
						<!-- Button -->
						<a href="{{ route('cart') }}" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
							<p style="color: white; font-size: 10px;">View Cart & checkout</p>
						</a>
					</div>

					<!-- <div class="header-cart-wrapbtn"> -->
					<!-- Button -->
					<!-- <a href="#" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4"> -->
					<!-- Check Out -->
					<!-- </a> -->
				</div>
			</div>
			@else

			@endif
		</div>
	</div>
	<!-- end cart header -->
</div>
</div>