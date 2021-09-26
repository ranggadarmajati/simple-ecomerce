@extends('admin.layout.app')
@section('title')
Tentang Kami
@stop
@section('admin-content-header')
<section class="content-header">
      <h1>
        Tentang Kami
        <small>Edit Tentang Kami</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Tentang Kami</a></li>
        <li class="active">Edit Tentang Kami</li>
      </ol>
    </section>
@stop
@section('admin-main-content')
<div class="row">
<div class="col-lg-12 col-xs-12">
<div class="box box-warning color-palette-box">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-image"></i> Foto</h3>
    </div>
    <div class="box-body">
    <div class="col-md-12 col-lg-12 col-xs-12">
    <center>
        <img src="{{ $about->image_about? $about->src : URL::asset('fashe-colorlib/images/bg-banner-01.jpg') }}" class="img img-responsive" id="image1_view">
    </center>
    </div>
    </div>
</div>
 <!-- /.box-body -->
</div>
<div class="col-lg-12 col-xs-12">
@if(Session::has('success'))
    <div class="alert alert-success" id="successMessage"><em> {!! session('success') !!}</em></div>
@endif
<div class="box box-warning color-palette-box">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-cubes"></i> Edit Tentang Kami</h3>
    </div>
    <div class="box-body">
        {!! Form::open([
            'route' => ['admin.update_about', $about->id], 
            'role' => 'form',
            'enctype' => 'multipart/form-data',
            'files' => true,
            'id' => 'form-about']) 
        !!}
        <div class="form-group">
            <label for="Kontent">Konten</label>
            <textarea class="form-control" name="content" rows="5" resize='none'>
                {{ $about->content }}
            </textarea>
        </div>
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