@extends('admin.layout.app')
@section('title')
Banner
@stop
@section('admin-content-header')
<section class="content-header">
      <h1>
        Banner
        <small>Edit Banner</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Banner</a></li>
        <li class="active">Edit Banner</li>
      </ol>
    </section>
@stop
@section('admin-main-content')
<div class="row">
<div class="col-lg-12 col-xs-12">
<div class="box box-warning color-palette-box">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-image"></i> Foto Banner</h3>
    </div>
    <div class="box-body">
    <div class="col-md-12 col-lg-12 col-xs-12">
        <img src="{{ $banner->image_banner ? $banner->src : URL::asset('fashe-colorlib/images/Untitled-5.jpg') }}" class="img img-responsive" id="image1_view">
    </div>
    </div>
</div>
 <!-- /.box-body -->
</div>
<div class="col-lg-6 col-xs-12">
@if(Session::has('success'))
    <div class="alert alert-success" id="successMessage"><em> {!! session('success') !!}</em></div>
@endif
<div class="box box-warning color-palette-box">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-cubes"></i> Edit Banner</h3>
    </div>
    <div class="box-body">
        {!! Form::open([
            'route' => ['admin.update_banner', $banner->id], 
            'role' => 'form',
            'enctype' => 'multipart/form-data',
            'files' => true,
            'id' => 'form-banner']) 
        !!}
   <!--      <div class="form-group">
            <label for="Nama Produk">Judul</label>
            <input type="text" name="title" class="form-control" value="" placeholder="Judul" required="required">
        </div>
        <div class="form-group">
            <label for="Deskripsi">Konten</label>
            <input type="text" name="description" class="form-control" value="" placeholder="Konten" required="required">
        </div> -->
        <div class="form-group">
            <label for="Photo Produk">Gambar</label>
            <input type="file" name="photo" multiple="multiple" id="photos1">
        </div>
        <div class="form-group">
            <input type="submit" name="submit" class="btn btn-primary">
        </div>
        {!! Form::close() !!}
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
</script>
@stop