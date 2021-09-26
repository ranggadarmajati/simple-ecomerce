							<ul class="header-cart-wrapitem">
							@if($cart_count > 0)
								@foreach($cart as $item)
									<li class="header-cart-item">
										<div class="header-cart-item-img">
											<img src="{{ $item->options['image'] }}" alt="IMG">
										</div>

										<div class="header-cart-item-txt">
											<a href="#" class="header-cart-item-name">
												{{ $item->name }}
											</a>

											<span class="header-cart-item-info">
												{{ $item->qty }} x Rp. {{ $item->price }}
											</span>
										</div>
									</li>
								@endforeach
							@else
								<p style="text-align: center;">Tidak ada Item diKeranjang</p>
							@endif
							</ul>