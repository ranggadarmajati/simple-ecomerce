	<div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
		<div class="block2">
			<div class="block2-img wrap-pic-w of-hidden pos-relative block2">
				<img src="{{URL::asset('fashe-colorlib/images/product')}}/{{$value['images'][0]['image'] }}" alt="IMG-PRODUCT">
					<div class="block2-overlay trans-0-4">
						<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
							<!-- <i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
							<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i> -->
						</a>
						<div class="block2-btn-addcart w-size1 trans-0-4">
						<!-- Button -->
							<a href="{{ route('product_detail', $value['id']) }}" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
									<p style="font-size: 10px; color: white;">Lihat Detail</p>
							</a> <br>
						{!! Form::open(['route' => 'add_chart_home', 'class' => 'login100-form validate-form']) !!}
							<input type="text" name="image" hidden="hidden" value="{{ $value['images'][0]['src'] }}">
							<input type="text" name="product_id" hidden="hidden" value="{{ $value['id'] }}">
							<input type="text" name="name" hidden="hidden" value="{{ $value['name'] }}">
							<input type="text" name="price" hidden="hidden" value="{{ $value['price'] }}">
							<input class="size8 m-text18 t-center num-product" hidden="hidden" type="number" name="qty" value="1">
							<!-- Button -->
							<!-- <button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
									<p style="font-size: 10px; color: white;">Tambah ke Keranjang</p>
							</button> -->

						{!! Form::close() !!}
						</div>
					</div>
			</div>
			<div class="block2-txt p-t-20">
				<a href="{{ route('product_detail', $value['id']) }}" class="block2-name dis-block s-text3 p-b-5">
					{{ ucwords($value['name']) }} 
				</a>
				<span class="block2-price m-text6 p-r-5">
					Rp.{{ $value['price'] }}
				</span>
				<span class="block2-price m-text6 p-r-5">
					&nbsp;
				</span>
				<span style="color: red; font-size: 13px;">
					<strike>Rp.{{ ($value['price'])+($value['price']*10/100) }}</strike>
				</span>
				<span class="block2-price m-text6 p-r-5">
					&nbsp;
				</span>
				<span style="color: green; font-size: 11px;">
					Diskon 10%
				</span>
			</div>
		</div>
	</div>