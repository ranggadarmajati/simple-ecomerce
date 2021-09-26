@extends('admin.layout.app')
@section('title')
Produk
@stop
@section('admin-content-header')
<section class="content-header">
      <h1>
        Produk
        <small>Edit Produk</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Produk</a></li>
        <li class="active">Edit Produk</li>
      </ol>
    </section>
@stop
@section('admin-main-content')
<div class="row">
<div class="col-lg-12 col-xs-12">
@if(Session::has('success'))
    <div class="alert alert-success" id="successMessage"><em> {!! session('success') !!}</em></div>
@endif
@if(Session::has('failled'))
    <div class="alert alert-danger" id="successMessage"><em> {!! session('failled') !!}</em></div>
@endif
</div>
<div class="col-lg-6 col-xs-12">
<div class="box box-warning color-palette-box">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-cubes"></i> Edit Produk</h3>
    </div>
    <div class="box-body">
        {!! Form::open([
            'route' => ['admin.update_product', $product->id],
            'role' => 'form',
            'enctype' => 'multipart/form-data',
            'files' => true,
            'id' => 'form-update-product']) 
        !!}
        <div class="form-group">
            <label for="Nama Produk">Nama Produk</label>
            <input type="text" name="name" class="form-control" placeholder="nama produk" value="{{ $product->name }}">
        </div>
        <div class="form-group">
            <label for="Deskripsi">Deskripsi</label>
            <input type="text" name="desc" class="form-control" placeholder="deskripsi" value="{{ $product->desc }}">
        </div>
        <div class="form-group">
            <label for="Harga">Harga</label>
            <input type="text" name="price" class="form-control" placeholder="harga" value="{{ $product->price }}">
        </div>
        <div class="form-group">
            <label for="Kategori">Kategori</label>
            <select class="form-control" name="category">
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
            <input type="text" name="weight" class="form-control" placeholder="berat gr" value="{{ $product->weight }}">
        </div>
        <div class="form-group">
            <!-- <label>Ukuran</label>
            <input type="text" name="size" class="form-control" placeholder="ukuran, Ex:X,L,M,S" value="{{ $size }}"> -->
            <table class="table table-responsive table-hover">
                <thead>
                    <tr>
                        <th><center>Ukuran</center></th>
                        <th colspan="1"><center>Action</center></th>
                    </tr>
                </thead>
                <tbody>
                @if(count($product->sizes) > 0)
                @foreach($product->sizes as $size_value)
                    <tr>
                        <td><center>{{ $size_value->name }}</center><input type="hidden" id="id_size" value="{{ $size_value->id }}"><input type="hidden" id="value_size" value="{{ $size_value->name }}"></td>
                        <td><center><a href="#" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#myModal{{ $size_value->id }}">Edit</a> &nbsp;&nbsp;&nbsp;<a href="{{ route('admin.destroy_size', $size_value->id) }}" class="btn btn-danger btn-xs">Delete</a></center></td>
                    </tr>
                @endforeach
                @endif
                    <tr>
                        <td colspan="3" align="right">
                             <a class="btn btn-success btn-xs" href="javascript:;" data-toggle="modal" data-target="#myModal_add_size">+ Size</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="form-group">
            <!-- <label>Warna</label>
            <input type="text" name="color" class="form-control" placeholder="warna, Ex:hijau,kuning,merah" value="{{ $color }}"> -->
            <table class="table table-responsive table-hover">
                <thead>
                    <tr>
                        <th><center>Warna</center></th>
                        <th colspan="1"><center>Action</center></th>
                    </tr>
                </thead>
                <tbody>
                @if(count($product->colors) > 0)
                @foreach($product->colors as $color_value)
                    <tr>
                        <td><center>{{ $color_value->name }}</center><input type="hidden" id="id_size" value="{{ $color_value->id }}"><input type="hidden" id="value_size" value="{{ $color_value->name }}"></td>
                        <td><center><a href="#" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#myModal_color{{ $color_value->id }}">Edit </a> &nbsp;&nbsp;&nbsp;<a href="{{ route('admin.destroy_size', $color_value->id) }}" class="btn btn-danger btn-xs">Delete</a></center></td>
                    </tr>
                @endforeach
                @endif
                    <tr>
                        <td colspan="3" align="right">
                             <a class="btn btn-success btn-xs" href="javascript:;" data-toggle="modal" data-target="#myModal_add_color">+ Warna</a>
                        </td>
                    </tr>
                </tbody>
            </table>
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
        </div> -->
        <div class="form-group">
            <input type="submit" name="submit" class="btn btn-primary">
        </div>
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
        <a href="javascript:;" data-toggle="modal" data-target="{{ isset($product->images[0]->src) ? '#myModal_add_image1' : '#myModal_add_image' }}">    
        <img src="{{ isset($product->images[0]->src) ? $product->images[0]->src : URL::asset('fashe-colorlib/images/item-01.jpg') }}" class="img img-responsive" title="{{ isset($product->images[0]->image) ? $product->images[0]->image : URL::asset('fashe-colorlib/images/item-01.jpg') }}">
        </a>
    </div>
    <div class="col-md-6 col-lg-6 col-xs-6">
        <a href="javascript:;" data-toggle="modal" data-target="{{ isset($product->images[1]->src) ? '#myModal_add_image2' : '#myModal_add_image' }}">  
        <img src="{{ isset($product->images[1]->src) ? $product->images[1]->src : URL::asset('fashe-colorlib/images/item-01.jpg') }}" class="img img-responsive">
        </a>
    </div>
    <br>
    <p>&nbsp;</p>
    <br>
    <div class="col-md-6 col-lg-6 col-xs-6">
        <a href="javascript:;" data-toggle="modal" data-target="{{ isset($product->images[2]->src) ? '#myModal_add_image3' : '#myModal_add_image' }}">
        <img src="{{ isset($product->images[2]->src) ? $product->images[2]->src : URL::asset('fashe-colorlib/images/item-01.jpg') }}" class="img img-responsive">
        </a>
    </div>
    <div class="col-md-6 col-lg-6 col-xs-6">
        <a href="javascript:;" data-toggle="modal" data-target="{{ isset($product->images[3]->src) ? '#myModal_add_image4' : '#myModal_add_image' }}">
        <img src="{{ isset($product->images[3]->src) ? $product->images[3]->src : URL::asset('fashe-colorlib/images/item-01.jpg') }}" class="img img-responsive" id="image4_view">
        </a>
    </div>
    </div>
</div>
 <!-- /.box-body -->
</div>
</div>
@foreach($product->sizes as $value_size)
<!-- Modal Edit size-->
<div class="modal fade" id="myModal{{ $value_size->id }}" role="dialog">
<div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content">
<div class="modal-header" style="background-color: orange;">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title" style="color: white;">Edit Size</h4>
</div>
<div class="modal-body">
{!! Form::open([
            'route' => ['admin.update_size', $value_size->id],
            'role' => 'form',
            'enctype' => 'multipart/form-data',
            'files' => true,
            'id' => 'form-update-size']) 
!!}
<input type="hidden" name="size_id" value="{{ $value_size->id }}">

<div class="form-group">
<label>Size</label>
<input type="text" name="size" class="form-control" value="{{ $value_size->name }}" required="required">      
</div>
<div class="modal-footer">  
<button type="submit" class="btn btn-success">Update</button>
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
{!! Form::close() !!}
</div>
</div>
</div>
</div>
@endforeach
<!-- Modal Add size-->
<div class="modal fade" id="myModal_add_size" role="dialog">
<div class="modal-dialog">
<!-- Modal content-->
<div class="modal-content">
<div class="modal-header" style="background-color: orange;">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title" style="color: white;">Tambah Size</h4>
</div>
<div class="modal-body">
{!! Form::open([
            'route' => ['admin.add_size', $product->id],
            'role' => 'form',
            'enctype' => 'multipart/form-data',
            'files' => true,
            'id' => 'form-add-size']) 
!!}
<div class="form-group">
<label>Size</label>
<input type="text" name="size" class="form-control" required="required">      
</div>
<div class="modal-footer">  
<button type="submit" class="btn btn-success">Simpan</button>
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
{!! Form::close() !!}
</div>
</div>
</div>
</div>
<!-- End Modal Add size-->

<!-- Modal Edit Color-->
@foreach($product->colors as $color_value)
<div class="modal fade" id="myModal_color{{ $color_value->id }}" role="dialog">
<div class="modal-dialog">
<!-- Modal content-->
<div class="modal-content">
<div class="modal-header" style="background-color: orange;">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title" style="color: white;">Edit Warna</h4>
</div>
<div class="modal-body">
{!! Form::open([
            'route' => ['admin.update_color', $color_value->id],
            'role' => 'form',
            'enctype' => 'multipart/form-data',
            'files' => true,
            'id' => 'form-update-color']) 
!!}
<input type="hidden" name="color_id" value="{{ $color_value->id }}">

<div class="form-group">
<label>Warna</label>
<input type="text" name="color" class="form-control" value="{{ $color_value->name }}" required="required">      
</div>
<div class="modal-footer">  
<button type="submit" class="btn btn-success">Update</button>
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
{!! Form::close() !!}
</div>
</div>
</div>
</div>
@endforeach
<!-- End Modal Edit Color-->

<!-- Modal Add Color-->
<div class="modal fade" id="myModal_add_color" role="dialog">
<div class="modal-dialog">
<!-- Modal content-->
<div class="modal-content">
<div class="modal-header" style="background-color: orange;">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title" style="color: white;">Tambah Warna</h4>
</div>
<div class="modal-body">
{!! Form::open([
            'route' => ['admin.add_color', $product->id],
            'role' => 'form',
            'enctype' => 'multipart/form-data',
            'files' => true,
            'id' => 'form-add-color']) 
!!}
<div class="form-group">
<label>Warna</label>
<input type="text" name="color" class="form-control" required="required">      
</div>
<div class="modal-footer">  
<button type="submit" class="btn btn-success">Simpan</button>
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
{!! Form::close() !!}
</div>
</div>
</div>
</div>
<!-- End Modal Add Color-->

@include('admin.product.modal_image')

@stop
@section('admin-custom-js')
<script type="text/javascript">
$('#myModal_add_image #photosnew').on('change', function(){
    var input = this;
    var namephotos1 = this;
    if(input.files && input.files[0]){
        var reader = new FileReader();
        reader.onload = function(e){
            $('#imagenew_view').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
});
$('#myModal_add_image1 #photos1').on('change', function(){
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
$('#myModal_add_image2 #photos2').on('change', function(){
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
$('#myModal_add_image3 #photos3').on('change', function(){
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
$('myModal_add_image4 #photos4').on('change', function(){
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
$("#successMessage").fadeTo(2000, 500).slideUp(500, function(){
    $("#successMessage").slideUp(500);
});
</script>
@stop