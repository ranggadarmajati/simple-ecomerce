<div class="wrap_header_mobile">
			<!-- Logo moblie -->
			<a href="{{ route('home') }}" class="logo-mobile">
				<img src="{{URL::asset('fashe-colorlib/images/icons/logo6.png')}}" alt="IMG-LOGO">
			</a>

			<!-- Button show menu -->
			<div class="btn-show-menu">
				<!-- Header Icon mobile -->
				<div class="header-icons-mobile">
					<a href="#" class="header-wrapicon1 dis-block">
						<?php if( session('authenticate') ){ ?>
						<!-- <img src="{{URL::asset('fashe-colorlib/images/icons/icon-header-01.png')}}" class="header-icon1" alt="ICON"> -->
						<!-- <a href="{{ route('auth.logout') }}" class="badge badge-danger">Logout</a><br> -->
						<a href="{{ isset($param) ? route('auth.admin_logout') : route('auth.logout') }}" class="badge badge-danger">Logout</a><br>
						<?php }else{ ?>
						
						<a href="javascript:;" class="badge badge-success" id="login">Login</a>
						<?php } ?>
					</a>

					<span class="linedivide2"></span>

					<div class="header-wrapicon2">
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
										View Cart 
									</a>
								</div>

								<!-- <div class="header-cart-wrapbtn">
									<a href="#" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
										Check Out
									</a>
								</div> -->
							</div>
						@else

						@endif
						</div>
					</div>
				</div>

				<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
					<span class="hamburger-box">
						<span class="hamburger-inner"></span>
					</span>
				</div>
			</div>
		</div>