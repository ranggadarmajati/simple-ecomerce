@extends('admin.layout.app')
@section('title')
Akun Bank
@stop
@section('admin-content-header')
<section class="content-header">
      <h1>
        Akun Bank
        <small>Tambah Akun Bank</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Akun Bank</a></li>
        <li class="active">Tambah Akun Bank</li>
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
        <h3 class="box-title"><i class="fa fa-credit-card"></i> Tambah Akun Bank</h3>
    </div>
    <div class="box-body">
        {!! Form::open([
            'route' => 'admin.store_baccount', 
            'role' => 'form',
            'enctype' => 'multipart/form-data',
            'files' => true,
            'id' => 'form-baccount']) 
        !!}
        <div class="form-group">
            <label for="rek_no">No Rekening</label>
            <input type="text" name="rek_no" class="form-control" placeholder="Nomor Rekening" required="required">
        </div>
        <div class="form-group">
            <label for="bank">Nama Bank</label>
            <input type="text" name="bank" class="form-control" placeholder="Nama Bank" required="required">
        </div>
        <div class="form-group">
            <label for="on_behalft">Atas Nama</label>
            <input type="text" name="on_behalft" class="form-control" placeholder="Atas Nama" required="required">
        </div>
        <div class="form-group">
            <label for="bank_logo">Logo Bank</label>
            <input type="file" name="bank_logo" multiple="multiple" id="photos1" required="required">
        </div>
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
        <h3 class="box-title"><i class="fa fa-image"></i> Logo Bank</h3>
    </div>
    <div class="box-body">
    <div class="col-md-12 col-lg-12 col-xs-12">
        <img src="{{ URL::asset('fashe-colorlib/images/bg-banner-01.jpg') }}" class="img img-responsive" id="image1_view">
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
</script>
@stop