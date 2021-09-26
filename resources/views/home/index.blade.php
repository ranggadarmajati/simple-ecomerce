@extends('layout.app')
@section('title')
  Home
@stop
@section('content')
<!-- Slide1 -->
	@include('layout.slide1')
	<!-- End Slide1 -->

	<!-- Banner -->
	@include('layout.banner')
	<!-- End Banner -->

<!-- Shipping -->
	<section class="shipping bgwhite p-t-62 p-b-46">
		<div class="flex-w p-l-15 p-r-15">
			<div class="flex-col-c w-size5 p-l-15 p-r-15 p-t-16 p-b-15 respon1">
				<h4 class="m-text12 t-center">
					Order Grosir
				</h4>

				<a href="#" class="t-center">
					Silahkan Langsung Hubungi Kami:
				</a>
				<a href="#" class="s-text11 t-center">
					SMS/WA: 082316716717
				</a>
				<a href="#" class="s-text11 t-center">
					Email: echakidsshop@yahoo.com
				</a>
			</div>

			<div class="flex-col-c w-size5 p-l-15 p-r-15 p-t-16 p-b-15 bo2 respon2">
				<h4 class="m-text12 t-center">
					Kurir
				</h4>
				<a href="#" class="t-center">
					Kami Siap untuk kirim barang ke berbagai kurir:
				</a>
				<span class="s-text11 t-center">
					JNE, J&T, Pos Indonesia, Indah, Wahana
				</span>
			</div>

			<div class="flex-col-c w-size5 p-l-15 p-r-15 p-t-16 p-b-15 respon1">
				<h4 class="m-text12 t-center">
					Operasional Toko Offline
				</h4>

				<span class="s-text11 t-center">
					Toko Buka dari Senin s/d Sabtu Pukul 09.00 s/d 18.00
				</span>
				<span class="s-text11 t-center">
					Untuk cek Lokasi Toko bisa klik dibawah ini:
				</span>
				<span class="s-text11 t-center">
					<a href="{{ route('contact') }}" class="t-center">Kontak</a>
				</span>
			</div>
		</div>
	</section>

	<!-- Our product -->
	<section class="bgwhite p-t-45 p-b-58">
		<div class="container">
			<div class="sec-title p-b-22">
				<h3 class="m-text5 t-center">
					Produk
				</h3>
			</div>

			<!-- Tab01 -->
			<div class="tab01">
				<!-- Nav tabs -->
				<ul class="nav nav-tabs" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" data-toggle="tab" href="#best-seller" role="tab">Best Seller</a>
					</li>
				</ul>

				<!-- Tab panes -->
				<div class="tab-content p-t-35">
					<!-- - -->
					<div class="tab-pane fade show active" id="best-seller" role="tabpanel">
					<div class="content-product">
						
					</div>
						
					</div>

					<!-- - -->
					

					<!--  -->
				

					<!--  -->
				
				</div>
			</div>
		</div>
	</section>

	
@stop
@section('custom-js-script')
<script type="text/javascript">
	$(".selection-1").select2({
		minimumResultsForSearch: 20,
		dropdownParent: $('#dropDownSelect1')
	});
</script>
<script type="text/javascript">
$(document).ready(function(){
	loadData();
});
	function loadData()
        {
            $.ajax({
                url: '/product_home',
                type: 'GET',
                dataType: 'json'
            })
            .done(function (response) {
            	result = response;
                $('.content-product').html("");
                $('.content-product').html(result);
            	
            })
            .fail(function (response) {
            	console.log("===get product fail====");
            });
        }
</script>
@stop