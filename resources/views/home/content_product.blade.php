<div class="row">
	 @if (count($results) >= 1)
        @foreach($results as $key => $value)
             @include('home.content_list_product')
        @endforeach
    @else
        <div class="col-sm-12 col-md-12 col-lg-12 p-b-50">
            <center><h4 class="text text-danger"><i><b>PRODUCT TIDAK ADA</b></i></h4></center>
        </div>
    @endif
</div>