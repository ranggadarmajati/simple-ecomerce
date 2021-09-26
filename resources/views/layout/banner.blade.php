	<div class="banner bgwhite p-t-40 p-b-40">
		<div class="container">
			<div class="row">
			@if(isset($banner))
				@foreach($banner as $banners)
				<div class="col-sm-10 col-md-8 col-lg-4 m-l-r-auto">
					<!-- block1 -->
					<div class="block1 hov-img-zoom pos-relative m-b-30">
						<img src="{{ $banners->src }}" alt="IMG-BENNER">

						<div class="block1-wrapbtn w-size2">
							<!-- Button -->
							<!-- <a href="#" class="flex-c-m size2 m-text2 bg3 hov1 trans-0-4">
								Sunglasses
							</a> -->
						</div>
					</div>
				</div>
				@endforeach
			@endif
			</div>
		</div>
	</div>