@extends('admin.layout.app')
@section('title')
Produk
@stop
@section('admin-content-header')
<section class="content-header">
      <h1>
        Produk
        <small>Detail Produk</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Produk</a></li>
        <li class="active">Detail Produk</li>
      </ol>
    </section>
@stop
@section('admin-main-content')
<div class="row">
<div class="col-lg-6 col-xs-12">
@if(Session::has('success'))
    <div class="alert alert-success" id="successMessage"><em> {!! session('success') !!}</em></div>
@endif
<div class="box box-warning color-palette-box">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-cubes"></i> Detail Produk</h3>
    </div>
    <div class="box-body">
        <div class="form-group">
            <label for="Nama Produk">Nama Produk</label>
            <input type="text" name="name" class="form-control" placeholder="nama produk" value="{{ $product->name }}" disabled="disabled">
        </div>
        <div class="form-group">
            <label for="Deskripsi">Deskripsi</label>
            <input type="text" name="desc" class="form-control" placeholder="deskripsi" value="{{ $product->desc }}" disabled="disabled">
        </div>
        <div class="form-group">
            <label for="Harga">Harga</label>
            <input type="text" name="price" class="form-control" placeholder="harga" value="{{ $product->price }}" disabled="disabled">
        </div>
        <div class="form-group">
            <label for="Kategori">Kategori</label>
            <select class="form-control" name="category" disabled="disabled">
            @foreach($category as $item)
                @if($item-> id == $product->category)
                <option value="{{ $item->id }}" selected="selected">{{ $item->name }}</option>
                @else
                <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endif
            @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Berat</label>
            <input type="text" name="weight" class="form-control" placeholder="berat gr" value="{{ $product->weight }}" disabled="disabled">
        </div>
        <div class="form-group">
            <label>Ukuran</label>
            <input type="text" name="size" class="form-control" placeholder="ukuran, Ex:X,L,M,S" value="{{ $size }}" disabled="disabled">
        </div>
        <div class="form-group">
            <label>Warna</label>
            <input type="text" name="color" class="form-control" placeholder="warna, Ex:hijau,kuning,merah" value="{{ $color }}" disabled="disabled">
        </div>
       <!--  <div class="form-group">
            <label for="Photo Produk">Photo Produk 1</label>
            <input type="file" name="photos[]" multiple="multiple" id="photos1">
        </div>
        <div class="form-group">
            <label for="Photo Produk">Photo Produk 2</label>
            <input type="file" name="photos[]" multiple="multiple" id="photos2">
        </div>
        <div class="form-group">
            <label for="Photo Produk">Photo Produk 3</label>
            <input type="file" name="photos[]" multiple="multiple" id="photos3">
        </div>
        <div class="form-group">
            <label for="Photo Produk">Photo Produk 4</label>
            <input type="file" name="photos[]" multiple="multiple" id="photos4">
        </div>
        <div class="form-group">
            <input type="submit" name="submit" class="btn btn-primary">
        </div> -->
        {!! Form::close() !!}
    </div>
</div>
 <!-- /.box-body -->
</div>

<div class="col-lg-6 col-xs-12">
<div class="box box-warning color-palette-box">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-image"></i> Foto Produk</h3>
    </div>
    <div class="box-body">
    <div class="col-md-6 col-lg-6 col-xs-6">
        <img src="{{ isset($product->images[0]->src) ? $product->images[0]->src : URL::asset('fashe-colorlib/images/item-01.jpg') }}" class="img img-responsive" id="image1_view">
    </div>
    <div class="col-md-6 col-lg-6 col-xs-6">
        <img src="{{ isset($product->images[1]->src) ? $product->images[1]->src : URL::asset('fashe-colorlib/images/item-01.jpg') }}" class="img img-responsive" id="image2_view">
    </div>
    <br>
    <p>&nbsp;</p>
    <br>
    <div class="col-md-6 col-lg-6 col-xs-6">
        <img src="{{ isset($product->images[2]->src) ? $product->images[2]->src : URL::asset('fashe-colorlib/images/item-01.jpg') }}" class="img img-responsive" id="image3_view">
    </div>
    <div class="col-md-6 col-lg-6 col-xs-6">
        <img src="{{ isset($product->images[3]->src) ? $product->images[3]->src : URL::asset('fashe-colorlib/images/item-01.jpg') }}" class="img img-responsive" id="image4_view">
    </div>
    </div>
</div>
 <!-- /.box-body -->
</div>
</div>
@stop
@section('admin-custom-js')
<script type="text/javascript">
$('#photos1').on('change', function(){
    var input = this;
    var namephotos1 = this;
    if(input.files && input.files[0]){
        var reader = new FileReader();
        reader.onload = function(e){
            $('#image1_view').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
});
$('#photos2').on('change', function(){
    var input = this;
    var namephotos1 = this;
    if(input.files && input.files[0]){
        var reader = new FileReader();
        reader.onload = function(e){
            $('#image2_view').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
});
$('#photos3').on('change', function(){
    var input = this;
    var namephotos1 = this;
    if(input.files && input.files[0]){
        var reader = new FileReader();
        reader.onload = function(e){
            $('#image3_view').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
});
$('#photos4').on('change', function(){
    var input = this;
    var namephotos1 = this;
    if(input.files && input.files[0]){
        var reader = new FileReader();
        reader.onload = function(e){
            $('#image4_view').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
});
</script>
@stop