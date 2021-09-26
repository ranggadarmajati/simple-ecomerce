@extends('layout.app')
@section('title')
Cart
@stop
@section('content')
<!-- Title Page -->
<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(fashe-colorlib/images/product/product_banner.jpg);">
	<h2 class="l-text2 t-center">
		Echa Kids
	</h2>
	<p class="m-text1 t-center">
		---------------------------------
	</p>
	<p class="m-text13 t-center">
		<b>KERANJANG BELANJA</b>
	</p>
</section>

<!-- Cart -->
<section class="cart bgwhite p-t-70 p-b-100">
	<div class="container">
		<!-- Cart item -->
		<div class="container-table-cart pos-relative">
			<div class="wrap-table-shopping-cart bgwhite">
				<table class="table-shopping-cart">
					<tr class="table-head">
						<th class="column-1"></th>
						<th class="column-2">Produk</th>
						<th class="column-3">Harga</th>
						<th class="column-4 p-l-70">Jumlah</th>
						<!-- <th class="column-4 p-l-70">Berat</th> -->
						<th class="column-5">Total</th>
					</tr>
					@if(count($cart) > 0)
					@foreach($cart as $item)
					<tr class="table-row">
						<td class="column-1">
							<a href="{{ route('cart_remove', $item->rowId) }}">
								<div class="cart-img-product b-rad-4 o-f-hidden">
									<img src="{{ $item->options['image'] }}" alt="IMG-PRODUCT">
								</div>
							</a>
						</td>
						<td class="column-2">{{ $item->name }}</td>
						<td class="column-3">Rp.{{ number_format($item->price, 2,".",",") }}</td>
						<td class="column-4">
							<div class="flex-w bo5 of-hidden w-size17">
								<a href="{{ route('cart_update') }}?product_id={{$item->rowId}}&decrease=1" class="color1 flex-c-m size7 bg8 eff2">
									<i class="fs-12 fa fa-minus" aria-hidden="true"></i>
								</a>

								<input class="size8 m-text18 t-center num-product" type="number" name="num-product2" value="{{ $item->qty }}" disabled="disabled" style="background-color: white;">
								<a href="{{ route('cart_update') }}?product_id={{$item->rowId}}&increment=1" class="color1 flex-c-m size7 bg8 eff2">
									<i class="fs-12 fa fa-plus" aria-hidden="true"></i>
								</a>
							</div>
						</td>
						<td class="column-5">Rp.{{ number_format((($item->qty) * ($item->price)), 2,".",",") }}</td>
					</tr>
					@endforeach
					@else
					<tr class="table-row">
						<td class="column-1" colspan="5" align="center">
							Tidak ada Item dikeranjang
						</td>
					</tr>
					@endif
				</table>
			</div>
		</div>

		<div class="flex-w flex-sb-m p-t-25 p-b-25 bo8 p-l-35 p-r-60 p-lr-15-sm">
			<div class="flex-w flex-m w-full-sm">
				<div class="size12 trans-0-4 m-t-10 m-b-10 m-r-10">
					<!-- Button -->
					@if(count($cart) > 0)
					<a href="{{ route('product') }}">
						<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
							Lanjutkan Belanja
						</button>
					</a>
					@else
					<a href="{{ route('product') }}">
						<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
							Belanja
						</button>
					</a>
					@endif
				</div>
			</div>
			@if(count($cart) > 0)
			<?php if (!session('authenticate')) { ?>
				<div class="size10 trans-0-4 m-t-10 m-b-10">
					<!-- Button -->
					<a class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4 open_modal" style="color: white;" href="javascript:void(0);">
						Checkout
					</a>
				</div>
			<?php } ?>
			@endif
		</div>
		<?php if (session('authenticate')) { ?>
			<!-- Total -->
			<div class="bo9 w-size18 p-l-40 p-r-40 p-t-30 p-b-38 m-t-30 m-r-0 m-l-auto p-lr-15-sm">
				<h5 class="m-text20 p-b-24">
					Cart Totals
				</h5>

				<!--  -->
				<div class="flex-w flex-sb-m p-b-12">
					<span class="s-text18 w-size19 w-full-sm">
						Subtotal:
					</span>

					<span class="m-text21 w-size20 w-full-sm">
						Rp. {{ $cart_total }}
					</span>
				</div>

				<!--  -->
				{!! Form::open(['route' => 'order', 'class' => 'order-validate-form']) !!}
				<div class="flex-w flex-sb bo10 p-t-15 p-b-20">
					<span class="s-text18 w-size19 w-full-sm">
						Pengiriman:
					</span>

					<div class="w-size20 w-full-sm">
						<span class="s-text19">
							Hitung Pengiriman
						</span>
						<div class="rs2-select2 rs3-select2 rs4-select2 bo4 of-hidden w-size21 m-t-8 m-b-12">
							<select class="selection-2" name="courier" id="courier">
								<option>Pilih Kurir</option>
								<option value="jne">JNE</option>
								<option value="jnt">J&T</option>
								<!-- <option value="tiki">TIKI</option> -->
								<option value="pos">POS Indonesia</option>
								<option value="indah">Indah Cargo</option>
								<option value="wahana">Wahana</option>
							</select>
						</div>

						<div class="rs2-select2 rs3-select2 rs4-select2 bo4 of-hidden w-size21 m-t-8 m-b-12">
							<select class="selection-2" name="province_id" id="province">
								<option>Pilih Provinsi</option>
							</select>
							<input type="text" name="province" id="province_name" hidden="hidden">
						</div>

						<div class="rs2-select2 rs3-select2 rs4-select2 bo4 of-hidden w-size21 m-t-8 m-b-12">
							<select class="selection-2" name="country" id="city">
								<option>Pilih Kota/Kab</option>
							</select>
							<input type="text" name="county_town" id="county_town" hidden="hidden">
						</div>

						<div class="rs2-select2 rs3-select2 rs4-select2 bo4 of-hidden w-size21 m-t-8 m-b-12">
							<select class="selection-2" name="district" id="district">
								<option>Pilih Desa/Kecamatan</option>
							</select>
							<input type="text" name="district_real" id="district_real" hidden="hidden">
						</div>

						<div class="size13 bo4 m-b-22">
							<input class="sizefull s-text7 p-l-15 p-r-15" type="text" name="post_code" placeholder="Kode Pos" value="">
						</div>

						<div class="m-b-22">
							<textarea class="sizefull s-text7 p-l-15 p-r-15" style="height: 120px; resize: none; width: 215px; border-color: rgb(230, 230, 230);" name="address" placeholder="Alamat"></textarea>
						</div>

						<div class="size13 bo4 m-b-22">
							<input class="sizefull s-text7 p-l-15 p-r-15" type="text" name="hp_no" placeholder="Nomor Handphone" value="">
						</div>

						<div class="rs2-select2 rs3-select2 rs4-select2 bo4 of-hidden w-size21 m-t-8 m-b-12">
							<select class="selection-2" name="price" id="package">
								<option>Pilih Paket</option>
							</select>
							<input type="text" name="package" id="name_package" hidden="hidden">
						</div>

						<div class="size13 bo4 m-b-22" hidden="hidden">
							<input type="text" name="weight" placeholder="{{ $total_weight }} gr" disabled="disabled" value="{{ $total_weight }}" id="weight">
						</div>
						<div class="size13 bo4 m-b-22">
							<input class="sizefull s-text7 p-l-15 p-r-15" type="text" name="price" placeholder="Ongkos Kirim" disabled="disabled" value="" id="ongkir" hidden="hidden">
							<input class="sizefull s-text7 p-l-15 p-r-15" type="text" name="price_view" placeholder="Ongkos Kirim" disabled="disabled" value="" id="ongkir_view">
						</div>
					</div>
				</div>
				<!--  -->
				<div class="flex-w flex-sb-m p-t-26 p-b-30">
					<span class="m-text22 w-size19 w-full-sm">
						Total:
					</span>

					<span class="m-text21 w-size20 w-full-sm">
						<input type="text" name="subtotal" hidden="hidden" id="subtotal" value="{{ str_replace(',','',$cart_total) }}"> <span id="total_view">Rp. {{ $cart_total }}</span>
						<input type="text" name="order_total" hidden="hidden" id="total">
					</span>
				</div>

				<div class="size15 trans-0-4">
					<!-- Button -->
					<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4" hidden="hidden" id="button" type="submit">Lanjut ke Pembayaran
					</button>
				</div>
				{!! Form::close() !!}
			</div>
		<?php } ?>
	</div>
</section>
@stop
@section('custom-js-script')
<script type="text/javascript">
	$('#courier').select2({
		minimumResultsForSearch: Infinity
	});
	$('#province').select2({
		minimumResultsForSearch: Infinity,
		ajax: {
			url: '{{ route("get_province") }}',
			dataType: 'json',
			delay: 250,
			processResults: function(data) {
				return {
					results: data.result.results
				};

				var id = $(this).find("option:selected").data('id');
				var text = $(this).find("option:selected").text();
			},
			cache: true
		}
	});
	$('#province').on('change', function() {
		var id = $(this).val();
		var text = $(this).find('option:selected').text();
		$('#province_name').val(text);
	});
	$('#city').select2({
		minimumResultsForSearch: Infinity,
		ajax: {
			url: '{{ route("get_city") }}',
			dataType: 'json',
			delay: 250,
			data: function(params) {
				return {
					province: $('#province').val()
				};
			},
			processResults: function(data) {
				return {
					results: data.result.results
				};

				var id = $(this).find("option:selected").data('id');
				var text = $(this).find("option:selected").text();
			},
			cache: true
		}
	});
	$('#city').on('change', function() {
		var id = $(this).val();
		var text = $(this).find('option:selected').text();
		$('#county_town').val(text);
	});
	$('#district').select2({
		inimumResultsForSearch: Infinity,
		ajax: {
			url: '{{ route("get_subdistrict") }}',
			dataType: 'json',
			delay: 250,
			data: function(params) {
				return {
					city: $('#city').val()
				};
			},
			processResults: function(data) {
				return {
					results: data.result.results
				};

				var id = $(this).find("option:selected").data('id');
				var text = $(this).find("option:selected").text();
			},
			cache: true
		}
	});
	$('#district').on('change', function() {
		var id = $(this).val();
		var text = $(this).find('option:selected').text();
		$('#district_real').val(text);
	});
	$('#package').select2({
		minimumResultsForSearch: Infinity,
		ajax: {
			url: '{{ route("get_cost") }}',
			dataType: 'json',
			delay: 250,
			data: function(params) {
				return {
					// this old
					// destination:$('#city').val(),
					// weight:$('#weight').val(),
					// courier:$('#courier').val()
					// this new
					origin: 23,
					originType: 'city',
					destination: $('#district').val(),
					destinationType: 'subdistrict',
					courier: $('#courier').val(),
					weight: $('#weight').val()
				};
			},
			processResults: function(data) {
				return {
					results: data.result.results
				};

				var id = $(this).find("option:selected").data('id');
				var text = $(this).find("option:selected").text();
			},
			cache: true
		}
	});
	$('#package').on('change', function() {
		var id = $(this).val();
		var text = $(this).find("option:selected").text();
		$('#name_package').val(text);
		$('#ongkir_view').val('Ongkos Kirim Rp.' + id);
		$('#ongkir').val(id);
		var subtotal = $('#subtotal').val();
		var total = (parseInt(id) + parseInt(subtotal));
		var total_string = total.toString(),
			sisa = total_string.length % 3,
			rupiah = total_string.substr(0, sisa),
			ribuan = total_string.substr(sisa).match(/\d{3}/g);
		if (ribuan) {
			separator = sisa ? '.' : '';
			rupiah += separator + ribuan.join(',');
		}

		$('#total_view').text('Rp. ' + rupiah + '.00');
		$('#total').val((parseInt(id) + parseInt(subtotal)));
		$('#button')[0].removeAttribute('hidden');
	});
	$('.login').click(function() {
		$('#modal_login').modal('show');
	});
	$('.open_modal').click(function() {
		$('#modal_login').modal('show');
	});
</script>
@stop