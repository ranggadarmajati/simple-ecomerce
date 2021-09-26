<section class="relateproduct bgwhite p-t-45 p-b-138">
		<div class="container">
			<div class="sec-title p-b-60">
				<h3 class="m-text5 t-center">
					Produk Terkait
				</h3>
			</div>

			<!-- Slide2 -->
			<div class="wrap-slick2">
				<div class="slick2">
        			@foreach($results as $key => $value)
             			@include('product.item_list_related')
        			@endforeach
				</div>
			</div>

		</div>
</section>