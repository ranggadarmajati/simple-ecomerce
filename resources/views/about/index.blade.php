@extends('layout.app')
@section('title')
  Tentang Kami
@stop
@section('content')
<!-- Title Page -->
	<section class="bg-title-page p-t-50 p-b-40 flex-col-c-m" style="background-image: url(fashe-colorlib/images/product/banner_head2.jpeg);">
		<h2 class="l-text2 t-center">
			Echa Kids
		</h2>
		<p class="m-text1 t-center">
		---------------------------------
		</p>
		<p class="m-text13 t-center">
			<b>Tentang Kami</b>
		</p>
	</section>


	<!-- content page -->
	<section class="bgwhite p-t-66 p-b-38">
		<div class="container">
			<div class="row">
				<div class="col-md-4 p-b-30">
					<div class="hov-img-zoom">
						<img src="{{ $about->src }}" alt="IMG-ABOUT">
					</div>
				</div>

				<div class="col-md-8 p-b-30">
					<h3 class="m-text26 p-t-15 p-b-16">
						Cerita Kami
					</h3>

					<p class="p-b-28">
						{{ $about->content }}
					</p>
				</div>
			</div>
		</div>
	</section>
@stop