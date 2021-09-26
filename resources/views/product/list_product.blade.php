@foreach($product as $key => $value)
<div class="col-sm-6 col-md-6 col-lg-3 p-b-50">
	<!-- Block2 -->
	<div class="block2">
		<div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelnew">
			<img src="{{ $value['images'][0]['src'] }}" alt="IMG-PRODUCT">

				<div class="block2-overlay trans-0-4">
					<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
						<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
						<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
					</a>

					<div class="block2-btn-addcart w-size1 trans-0-4">
					<!-- Button -->
					<a href="{{ route('product_detail', $value['id']) }}" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
						<p style="font-size: 10px; color: white;">Lihat Detail Barang</p>
					</a> <br>
						<!-- Button -->
					<!-- 	<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
							<p style="font-size: 10px; color: white;">Tambah ke Keranjang</p>
						</button> -->
					</div>
				</div>
		</div>

		<div class="block2-txt p-t-20">
			<a href="product-detail.html" class="block2-name dis-block s-text3 p-b-5">
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
@endforeach
