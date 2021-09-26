<div class="wrap_menu">
					<nav class="menu">
						<ul class="main_menu">
							@if($active == 'home')
								<li class="sale-noti">
							@else
								<li>
							@endif
									<a href="{{ route('home') }}">Home</a>
									<!-- <ul class="sub_menu">
										<li><a href="index.html">Homepage V1</a></li>
										<li><a href="home-02.html">Homepage V2</a></li>
										<li><a href="home-03.html">Homepage V3</a></li>
									</ul> -->
							</li>

							@if($active == 'product')
								<li class="sale-noti">
							@else
								<li>
							@endif
								<a href="{{ route('product') }}">Produk</a>
							</li>

							<!-- <li class="">
								<a href="product.html">Sale</a>
							</li>

							<li>
								<a href="cart.html">Features</a>
							</li>

							<li>
								<a href="blog.html">Blog</a>
							</li> -->

							@if($active == 'about')
								<li class="sale-noti">
							@else
								<li>
							@endif
								<a href="{{ route('about') }}">Tentang Kami</a>
							</li>

							@if($active == 'contact')
								<li class="sale-noti">
							@else
								<li>
							@endif
								<a href="{{ route('contact') }}">Kontak</a>
							</li>
							<li>
								<a href="javascript:">Tata Cara Order</a>
								<ul class="sub_menu">
									<li><a href="https://drive.google.com/file/d/179LlWvDqJW9echZdbpnpUzksjHumxpKl/view?usp=sharing" target="_blank">Web View</a></li>
									<li><a href="https://drive.google.com/file/d/1NCmruLYfAdENQeYKqfmEbPQWganqfimh/view?usp=sharing" target="_blank">Mobile View</a></li>
								</ul>
							</li>
						</ul>
					</nav>
				</div>