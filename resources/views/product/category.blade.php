						@foreach($category as $key => $value)
							<li class="p-t-4">
								<a href="javascript:;" class="s-text13" id="category-{{ strtolower($value['name']) }}">
									{{ $value['name'] }}	
								</a>
							</li>
						@endforeach