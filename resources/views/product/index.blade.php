@extends('layout.app')
@section('title')
  Shop
@stop
@section('content')
<!-- Title Page -->
	<section class="bg-title-page p-t-50 p-b-40 flex-col-c-m" style="background-image: url(fashe-colorlib/images/product/product_banner.jpg);">
		<h2 class="l-text2 t-center">
			Echa Kids
		</h2>
		<p class="m-text1 t-center">
		---------------------------------
		</p>
		<p class="m-text13 t-center">
			<b>Produk Barang Berkualitas Import</b>
		</p>
	</section>


	<!-- Content page -->
	<section class="bgwhite p-t-55 p-b-65">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
					<div class="leftbar p-r-20 p-r-0-sm">
						<!--  -->
						<h4 class="m-text14 p-b-7">
							Kategori
						</h4>

						<ul class="p-b-54">
							<li class="p-t-4">
								<a href="javascript:;" class="s-text13 active1" id="category_all">
									Semua
								</a>
							</li>
						
							@include('product.category')
							<input type="hidden" name="category_value" id="category_value" disabled="disabled">

						</ul>

						<h4 class="m-text14 p-b-32">
							Pencarian
						</h4>

						<div class="search-product pos-relative bo4 of-hidden">
							<input class="s-text7 size6 p-l-23 p-r-50" type="text" name="search-product" placeholder="Cari Produk..." id="search-product">

							<button class="flex-c-m size5 ab-r-m color2 color0-hov trans-0-4">
								<i class="fs-12 fa fa-search" aria-hidden="true"></i>
							</button>
						</div>
					</div>
				</div>

				<div class="col-sm-6 col-md-8 col-lg-9 p-b-50">
					<!--  -->
					<div class="flex-sb-m flex-w p-b-35">
						<div class="flex-w">
							<div class="rs2-select2 bo4 of-hidden w-size12 m-t-5 m-b-5 m-r-10">
								<select class="selection-1" name="sort" id="sort">
									<option value="">Urutkan Harga</option>
									<option value="price|asc">Harga:rendah ke tinggi</option>
									<option value="price|desc">Harga:tinggi ke rendah</option>
								</select>
							</div>

							<div class="rs2-select2 bo4 of-hidden w-size12 m-t-5 m-b-5 m-r-10">
								<select class="selection-2" name="price" id="price">
									<option value="all">Semua Harga</option>
									<option value="0-30000">Rp.0 - Rp.30,000</option>
									<option value="30000-50000">Rp.30,000 - Rp.50,000</option>
									<option value="50000-70000">Rp.50,000 - Rp.70,000</option>
									<option value="70000-100000">Rp.70,000 - Rp.100,000</option>
								</select>
							</div>
						</div>
						<span class="s-text8 p-t-5 p-b-5">
							Kategori: <span id="category_show">Semua</span>
						</span>
						<span class="s-text8 p-t-5 p-b-5" id="count">
							Showing 1–12 of 16 results
						</span>
					</div>

					<!-- Product -->
					<div id="data-container"></div>
					<div class="center-pagination">
					<div class="pagination-container"></div>
					</div>
				</div>
			</div>
		</div>
	</section>
@stop
@section('custom-js-script')
<script type="text/javascript">
	$(".selection-1").select2({
		minimumResultsForSearch: 20,
		placeholder: 'Urutkan Harga',
		dropdownParent: $('#dropDownSelect1')
	});
	
	$('#sort').on('change', function () {
        
         var price_id = $('#price').val(); 
         var sort_id = $(this).val();
         var search = $('#search-product').val();
         var ctgry = $('#category_value').val()
    	 getProduct(price_id, sort_id, search, ctgry);
    });

    $('#price').on('change', function(){
    	
    	var price_id = $(this).val();
    	var sort_id = $('#sort').val();
    	var search = $('#search-product').val();
    	var ctgry = $('#category_value').val()
    	getProduct(price_id, sort_id, search, ctgry);
    });

    $('#search-product').on('change', function(){
    	var price_id = $('#price').val();
    	var sort_id = $('#sort').val();
    	var search = $(this).val();
    	var ctgry = $('#category_value').val()
    	getProduct(price_id, sort_id, search, ctgry);
    });

		$(".selection-2").select2({
		minimumResultsForSearch: 20,
		placeholder: 'Harga Dari',
		dropdownParent: $('#dropDownSelect2')
	});
</script>
@foreach($category as $key => $value)
<script type="text/javascript">
	$('#category-{{ strtolower($value["name"]) }}').on('click', function(){
			$('#category_all').removeClass('active1');
			$('#category_show').text('{{ $value["name"] }}');
			var text_value = '{{ strtolower($value["id"]) }}'
			var category   = $('#category_value').val(text_value);
			var price_id = $('#price').val();
    		var sort_id = $('#sort').val();
    		var search = $('#search-product').val();
    		getProduct(price_id, sort_id, search, text_value);
    		CategorySign()
	});		
</script>
@endforeach
<script type="text/javascript">
	$('#category_all').on('click', function(){
		$('#category_show').text('Semua');
		$(this).addClass('active1');
	@foreach($category as $key => $value)
		$('#category-{{ strtolower($value["name"]) }}').removeClass('active1');
	@endforeach
		var text_value = null;
		var category = $('#category_value').val(text_value);
		var price_id = $('#price').val();
    	var sort_id = $('#sort').val();
    	var search = $('#search-product').val();
    	getProduct(price_id, sort_id, search, text_value);
	});
</script>
<script type="text/javascript">
function CategorySign(){

var category_value = $('#category_show').text();

	@foreach($category as $key => $value)
		var value = '{{ $value["name"] }}';
		if(category_value == value){
			$('#category-{{ strtolower($value["name"]) }}').addClass('active1');
		}else{
			$('#category-{{ strtolower($value["name"]) }}').removeClass('active1');
		}
	@endforeach

}
</script>
<script type="text/javascript">
var _doc = $(document);
_doc.ready(function(){
	getProduct();
});

function getProduct(price = null, sort = null, search = null, category = null){

    $('.pagination-container').pagination({
        dataSource: '{{ route("get_product") }}',
        locator: 'contents.data',
        totalNumberLocator: function(response) {
            
            $('#count').text('Menampilkan urutan '+ response.contents.from +' s/d '+ response.contents.to +' dari '+ response.contents.total +' hasil')
            
            // you can return totalNumber by analyzing response content
            return response.contents.total;
        },
        pageSize: 12,
        alias:{
            pageSize: 'limit',
            pageNumber: 'page',
        },
        ajax: {
            beforeSend: function() {
                $('#data-container').html('<br><br><div class="center-pagination"><img src="{{URL::asset("fashe-colorlib/images/loading-icon.gif")}}"></img><p>Load data from server ...</p></div><br><br><br>');
            },
            data: { 
                category: category,
                price: price,
                sort: sort,
                search: search
            }
        },
        callback: function(data, pagination) {
            // template method of yourself
            var count = Object.keys(data).length;
            if(count > 0){

            	var html = simpleTemplating(data);
            }else{
            	var html ='<br><br><div class="center-pagination"><img src="{{URL::asset("fashe-colorlib/images/imagenotfound2.png")}}"></img><p>Data Not Found From server ...</p></div><br><br><br>';
            }
            
            $('#data-container').html(html);
        }
    });
}

        // this template html
function simpleTemplating(data) {

   var html = '<div class="row">';

   		$.each(data, function(index, item){
            	
            var price_cut = parseInt(item.price) + (item.price*10/100);
            var id = item.id;
            var route_id = '{{ url("/product/") }}/'+id+'/detail';

            html += '<div class="col-6 col-sm-6 col-md-6 col-lg-3 p-b-50"><div class="block2"><div class="block2-img wrap-pic-w of-hidden pos-relative"><img src="'+ item.images[0]['src'] +'" alt="IMG-PRODUCT"><div class="block2-overlay trans-0-4"><div class="block2-btn-addcart w-size1 trans-0-4"><a href="'+route_id+'" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4"><p style="font-size: 10px; color: white;">Lihat Detail</p></a><br>{!! Form::open(["route" => "add_cart_product", "class" => "login100-form validate-form"]) !!}<input type="text" name="image" hidden="hidden" value="'+item.images[0]['src']+'"><input type="text" name="product_id" hidden="hidden" value="'+id+'"><input type="text" name="name" hidden="hidden" value="'+ item.name +'"><input type="text" name="price" hidden="hidden" value="'+ item.price +'"><input class="size8 m-text18 t-center num-product" hidden="hidden" type="number" name="qty" value="1"><input class="size8 m-text18 t-center num-product" hidden="hidden" type="number" name="weight" value="'+ item.weight +'"><!--<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4" type="submit"><p style="font-size: 10px; color: white;">Tambah ke Keranjang</p></button>-->{!! Form::close() !!}</div></div></div><div class="block2-txt p-t-20"><a href='+route_id+' class="block2-name dis-block s-text3 p-b-5">'+ item.name +'</a><span class="block2-price m-text6 p-r-5">Rp.'+ item.price +'</span><span style="color: red; font-size: 13px;"></span><span style="color: red; font-size: 13px;"><strike>'+ price_cut +'</strike></span><span class="block2-price m-text6 p-r-5">&nbsp;</span><span style="color: green; font-size: 11px;">Diskon 10%</span></div></div></div>';
            });
            html +='</div>';
            
            return html;
        }
</script>

@stop