<section class="slide1">
		<div class="wrap-slick1">
			<div class="slick1">
			@if(isset($slide))
				@foreach($slide as $slides)
				<div class="item-slick1 item1-slick1" style="background-image: url(fashe-colorlib/images/slide/{{ $slides->image_slide  }});">
					<div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
						<h2 class="caption1-slide1 xl-text2 t-center bo14 p-b-6 animated visible-false m-b-22" data-appear="fadeInUp">
							{{ $slides->title }}
						</h2>

						<span class="caption2-slide1 m-text1 t-center animated visible-false m-b-33" data-appear="fadeInDown">
							{{ $slides->description }}
						</span>

						<div class="wrap-btn-slide1 w-size1 animated visible-false" data-appear="zoomIn">
							<!-- Button -->
							<a href="{{ route('product') }}" class="flex-c-m size2 bo-rad-23 s-text2 bgwhite hov1 trans-0-4">
								Belanja
							</a>
						</div>
					</div>
				</div>
				@endforeach
			@endif
			</div>
		</div>
</section>