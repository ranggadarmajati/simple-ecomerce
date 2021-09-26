@extends('layout.app')
@section('title')
  Detail Product
@stop
@section('content')
<!-- breadcrumb -->
	<div class="bread-crumb bgwhite flex-w p-l-52 p-r-15 p-t-30 p-l-15-sm">
		<a href="index.html" class="s-text16">
			Home
			<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
		</a>

		<a href="product.html" class="s-text16">
			{{ $product->categories['name'] }}
			<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
		</a>

<!-- 		<a href="#" class="s-text16">
			T-Shirt
			<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
		</a> -->

		<span class="s-text17">
			Detail {{ ucwords($product->name) }}
		</span>
	</div>

	<!-- Product Detail -->
	<div class="container bgwhite p-t-35 p-b-80">
		<div class="flex-w flex-sb">
			<div class="w-size13 p-t-30 respon5">
				<div class="wrap-slick3 flex-sb flex-w">
					<div class="wrap-slick3-dots"></div>

					<div class="slick3">
					 @if (count($product->images) >= 1)
        				@foreach($product->images as $key => $value)
             			<div class="item-slick3" data-thumb="{{ $value['src'] }}">
							<div class="wrap-pic-w">
								<img src="{{ $value['src'] }}" alt="IMG-PRODUCT">
							</div>
						</div>	
        				@endforeach
    				 @endif
					</div>
				</div>
			</div>
			
			<div class="w-size14 p-t-30 respon5">
				<h4 class="product-detail-name m-text16 p-b-13">
				{!! Form::open(['route' => 'add_chart', 'class' => 'login100-form', 'id' => 'validate-form']) !!}
					{{ ucwords($product->name) }}
					<input type="text" name="image" hidden="hidden" value="{{ $product->images[0]['src'] }}">
					<input type="text" name="product_id" hidden="hidden" value="{{ $product->id }}">
					<input type="text" name="name" hidden="hidden" value="{{ $product->name }}">
				</h4>
				<span class="m-text17">
					Rp. {{ $product->price }}
					<input type="text" name="price" hidden="hidden" value="{{ $product->price }}">
				</span>
				<span class="block2-price m-text6 p-r-5">
					&nbsp;
				</span>
				<span style="color: red; font-size: 13px;">
					<strike>Rp.{{ ($product->price)+($product->price*10/100) }}</strike>
				</span>
				<span class="block2-price m-text6 p-r-5">
					&nbsp;
				</span>
				<span style="color: green; font-size: 11px;">
					Diskon 10%
				</span>

				<!--  -->
				<div class="p-t-33 p-b-60">
					<div class="flex-m flex-w p-b-10">
						<div class="s-text15 w-size15 t-center">
							Ukuran
						</div>

						<div class="rs2-select2 rs3-select2 bo4 of-hidden w-size16">
							<select class="selection-2" name="size" required="required">
								<!-- <option value="">Pilih Ukuran</option> -->
							@if (count($product->sizes) >= 1)
        						@foreach($product->sizes as $key => $value)
									<option value="{{ $value['name'] }}">{{ $value['name'] }}</option>	
        						@endforeach
    				 		@endif
							</select>
						</div>
					</div>

					<div class="flex-m flex-w">
						<div class="s-text15 w-size15 t-center">
							Warna
						</div>

						<div class="rs2-select2 rs3-select2 bo4 of-hidden w-size16">
							<select class="selection-2" name="color" required="required">
									<!-- <option value="">Pilih Warna</option> -->
							@if (count($product->colors) >= 1)
        						@foreach($product->colors as $key => $value)
									<option value="{{ $value['name'] }}">{{ $value['name'] }}</option>	
        						@endforeach
    				 		@endif
							</select>
						</div>
					</div>

					<div class="flex-r-m flex-w p-t-10">
						<div class="w-size16 flex-m flex-w">
							<div class="flex-w bo5 of-hidden m-r-22 m-t-10 m-b-10">
								<button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2">
									<i class="fs-12 fa fa-minus" aria-hidden="true"></i>
								</button>

								<input class="size8 m-text18 t-center num-product" type="number" name="qty" value="1">

								<button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2">
									<i class="fs-12 fa fa-plus" aria-hidden="true"></i>
								</button>
							</div>

							<div class="btn-addcart-product-detail size9 trans-0-4 m-t-10 m-b-10">
								<!-- Button -->
								<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4" type="submit">
									<p style="font-size: 10px; color: white;">Tambah ke Keranjang</p>
								</button>
							</div>
						</div>
					</div>
				</div>

				<div class="p-b-45">
					<!-- <span class="s-text8 m-r-35">SKU: MUG-01</span> -->
					<span class="s-text8">Kategori: {{ $product->categories['name'] }}</span>
				</div>

				<!--  -->
				<div class="wrap-dropdown-content bo6 p-t-15 p-b-14 active-dropdown-content">
					<h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
						Deskripsi
						<i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
						<i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
					</h5>

					<div class="dropdown-content dis-none p-t-15 p-b-23">
						<p class="s-text8">
							{{ $product->desc }}
						</p>
					</div>
				</div>

				<div class="wrap-dropdown-content bo7 p-t-15 p-b-14">
					<h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
						Informasi Tambahan
						<i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
						<i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
					</h5>

					<div class="dropdown-content dis-none p-t-15 p-b-23">
						<p class="s-text8">
							Barang :
							@if($product->available_desc == 'Tersedia') 
								 <span class="badge badge-success">{{ $product->available_desc }}</span> 
							@else
								<span class="badge badge-danger">{{ $product->available_desc }}</span>
							@endif
						</p>
						<p class="s-text8">
							Berat : {{ $product->weight }} gr
						</p>
						<input type="hidden" name="weight" value="{{ $product->weight }}">
					</div>
				</div>
			</div>
			{!! Form::close() !!}
		</div>
	</div>

	<div class="related_product">
		<!-- Relate Product -->
		@include('product.related_product')
		<!-- End Relate Product -->
	</div>
	@stop
	@section('custom-js-script')
	{!! JsValidator::formRequest(App\Http\Requests\Product\ProductRequest::class, '#validate-form') !!}
	<script type="text/javascript">
		$(".selection-1").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect1')
		});

		$(".selection-2").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect2')
		});
		
	</script>
	@stop