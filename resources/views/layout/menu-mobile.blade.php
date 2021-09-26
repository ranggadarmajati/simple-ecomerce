<div class="wrap-side-menu" >
			<nav class="side-menu">
				<ul class="main-menu">
				<!-- 	<li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
						<span class="topbar-child1">
							Free shipping for standard order over $100
						</span>
					</li> -->

					<li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
						<div class="topbar-child2-mobile">
							<!-- <span class="topbar-email">
								{{ session('authenticate') ? $name : ''  }}
							</span> -->
							@if(isset($name))
							<ul class="main_menu">
							<li>
								<a href="javascript:;" style="font-family: Montserrat-Regular; font-size: 13px;color: #888888; line-height: 1.7;">{{ $name }}</a>
								<ul class="sub_menu">
									<li><a href="{{ route('order_confirm') }}">Konfirmasi Orderan Anda </a></li>
									<!-- <li><a href="home-02.html">Homepage V2</a></li>
									<li><a href="home-03.html">Homepage V3</a></li> -->
								</ul>
							</li>
							</ul>
						@endif
						</div>
					</li>

					<li class="item-topbar-mobile p-l-10">
						<div class="topbar-social-mobile">
							<a href="{{ isset($contact->facebook_src) ? $contact->facebook_src : '#' }}" class="topbar-social-item fa fa-facebook" target="_blank"></a>
							<a href="{{ isset($contact->instagram_src) ? $contact->instagram_src : '#' }}" class="topbar-social-item fa fa-instagram" target="_blank"></a>
							<a href="{{ isset($contact->wa_no) ? $contact->srcw : '#' }}" class="topbar-social-item fa fa-whatsapp" target="_blank"></a>
							<!-- <a href="#" class="topbar-social-item fa fa-snapchat-ghost"></a> -->
							<a href="{{ isset($contact->youtube_src) ? $contact->youtube_src : '#' }}" class="topbar-social-item fa fa-youtube-play" target="_blank"></a>
						</div>
					</li>

					<li class="item-menu-mobile">
						<a href="{{ route('home') }}">Home</a>
						<!-- <ul class="sub-menu">
							<li><a href="index.html">Homepage V1</a></li>
							<li><a href="home-02.html">Homepage V2</a></li>
							<li><a href="home-03.html">Homepage V3</a></li>
						</ul>
						<i class="arrow-main-menu fa fa-angle-right" aria-hidden="true"></i> -->
					</li>

					<li class="item-menu-mobile">
						<a href="{{ route('product') }}">Produk</a>
					</li>

				<!-- 	<li class="item-menu-mobile">
						<a href="product.html">Sale</a>
					</li>

					<li class="item-menu-mobile">
						<a href="cart.html">Features</a>
					</li>

					<li class="item-menu-mobile">
						<a href="blog.html">Blog</a>
					</li> -->

					<li class="item-menu-mobile">
						<a href="{{ route('about') }}">Tentang Kami</a>
					</li>

					<li class="item-menu-mobile">
						<a href="{{ route('contact') }}">Kontak</a>
					</li>
					<li class="item-menu-mobile">
						<a href="javascript:">Tata Cara Order</a>
						<ul class="sub-menu">
							<li><a href="https://drive.google.com/file/d/179LlWvDqJW9echZdbpnpUzksjHumxpKl/view?usp=sharing" target="_blank">Web View</a></li>
							<li><a href="https://drive.google.com/file/d/1NCmruLYfAdENQeYKqfmEbPQWganqfimh/view?usp=sharing" target="_blank">Mobile View</a></li>
						</ul>
						<i class="arrow-main-menu fa fa-angle-right" aria-hidden="true"></i>
					</li>
				</ul>
			</nav>
		</div>