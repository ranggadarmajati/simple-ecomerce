<footer class="bg6 p-t-45 p-b-43 p-l-45 p-r-45">
		<div class="flex-w p-b-90">

			<div class="col-md-3">
				<h4 class="s-text12">
					Alamat
				</h4>

				<ul>
					<li class="p-b-9"><p class="s-text7 w-size27">
						{{ $contact->address }}
					</p></li>

		<!-- 			<div class="flex-m p-t-30">
						<a href="#" class="fs-18 color1 p-r-20 fa fa-facebook"></a>
						<a href="#" class="fs-18 color1 p-r-20 fa fa-instagram"></a>
						<a href="#" class="fs-18 color1 p-r-20 fa fa-pinterest-p"></a>
						<a href="#" class="fs-18 color1 p-r-20 fa fa-snapchat-ghost"></a>
						<a href="#" class="fs-18 color1 p-r-20 fa fa-youtube-play"></a>
					</div> -->
				</ul>
			</div>

			<div class="col-md-3">
				<h4 class="s-text12">
					Support Kurir
				</h4>

				<ul>
					<li class="p-b-9">
						<a href="https://jne.co.id" class="s-text7" target="_blank">
							JNE
						</a>
					</li>

					<li class="p-b-9">
						<a href="https://jet.co.id" class="s-text7" target="_blank">
							J&T
						</a>
					</li>

					<li class="p-b-9">
						<a href="https://posindonesia.co.id" class="s-text7" target="_blank">
							Pos Indonesia
						</a>
					</li>
					
					<li class="p-b-9">
						<a href="https://wahana.com" class="s-text7" target="_blank">
							Wahana
						</a>
					</li>

					<li class="p-b-9">
						<a href="https://indahonline.com" class="s-text7" target="_blank">
							Indah Cargo
						</a>
					</li>

				</ul>
			</div>

			<div class="col-md-3">
				<h4 class="s-text12">
					Kontak
				</h4>

				<ul>
					<li class="p-b-9">
						<a href="#" class="s-text7">
							Telp/SMS : {{ isset($contact->hp_no) ? $contact->hp_no : '-' }}
						</a>
					</li>

					<li class="p-b-9">
						<a href="{{ isset($contact->wa_no) ? $contact->srcw : '#' }}" class="s-text7" target="_blank">
							Whatapps : {{ isset($contact->wa_no) ? $contact->wa_no : '-' }}
						</a>
					</li>

					<li class="p-b-9">
						<a href="{{ isset($contact->facebook_src) ? $contact->facebook_src : '#' }}" class="s-text7" target="_blank">
							Facebook 
						</a>
					</li>

					<li class="p-b-9">
						<a href="{{ isset($contact->instagram_src) ? $contact->instagram_src : '#' }}" class="s-text7" target="_blank">
							Instagram 
						</a>
					</li>
				</ul>
			</div>


			<div class="col-md-3">
				<h4 class="s-text12">
					Links
				</h4>

				<ul>
					<li class="p-b-9">
						<a href="{{ route('home') }}" class="s-text7">
							Home
						</a>
					</li>

					<li class="p-b-9">
						<a href="{{ route('product') }}" class="s-text7">
							Produk
						</a>
					</li>

					<li class="p-b-9">
						<a href="{{ route('about') }}" class="s-text7">
							Tentang
						</a>
					</li>

					<li class="p-b-9">
						<a href="{{ route('contact') }}" class="s-text7">
							Kontak
						</a>
					</li>

				</ul>
			</div>

		</div>

		<div class="t-center p-l-15 p-r-15">
		@if(isset($baccount))
			@foreach($baccount as $account)
			<a href="#">
				<img class="h-size2" src="{{ $account->src }}" alt="{{ $account->bank }}" title="{{ strtoupper($account->bank) }}">
			</a>
			@endforeach
		@endif

			<div class="t-center s-text8 p-t-20">
				<!-- Copyright © 2018 echakids.com | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a> -->
				Copyright © <?php echo date('Y') ?> <a href="{{ route('home') }}">www.echakids.com</a> | Design by <a href="https://colorlib.com" target="_blank">Colorlib</a>
			</div>
		</div>
	</footer>