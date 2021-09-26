@extends('admin.layout.app')
@section('title')
Profile
@stop
@section('admin-content-header')
<section class="content-header">
      <h1>
        Profile
        <small>{{ $type == 'view' ? 'Profile' : 'Edit Profile' }} </small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Profile</a></li>
        <li class="active">{{ $type == 'view' ? 'Profile' : 'Edit Profile' }}</li>
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
<div class="box box-warning color-palette-box">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-image"></i> {{ $type == 'view' ? 'Profile' : 'Edit Profile' }}</h3>
    </div>
    <div class="box-body">
    <div class="col-md-6 col-lg-6 col-xs-6">
         @if($type == 'view')
            <div class="form-group">
                <label>Nama Depan</label>
                <p>{{ $user->first_name }}</p>
            </div>
            <div class="form-group">
                <label>Nama Belakang</label>
                <p>{{ $user->last_name }}</p>
            </div>
            <div class="form-group">
                <label>Email</label>
                <p>{{ $user->email }}</p>
            </div>
            <div class="form-group">
                <a href="{{ route('admin.profile_edit') }}" class="btn btn-warning"><span class="fa fa-edit"></span>Edit</a>
            </div>
         @else

         {!! Form::open([
            'route' => 'admin.profile_update', 
            'role' => 'form',
            'id' => 'form-profile']) 
         !!}
            <div class="form-group">
                <label>Nama Depan</label>
                <input type="text" name="first_name" class="form-control" value="{{ isset($user) ? $user->first_name : '-' }}">
            </div>
            <div class="form-group">
                <label>Nama Belakang</label>
                <input type="text" name="last_name" class="form-control" value="{{ isset($user) ? $user->last_name : '-' }}">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" class="form-control" value="{{ isset($user) ? $user->email : '-' }}">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="form-group">
                <label>Password Konfirmasi</label>
                <input type="password" name="password_confirmation" class="form-control">
            </div>
            <div class="form-group">
                <input type="submit" name="simpan" class="btn btn-success" value="simpan">
            </div>
  
         
                {!! Form::close() !!}
        @endif
    </div>
    </div>
</div>
 <!-- /.box-body -->
</div>
</div>
@stop
@section('admin-custom-js')
{!! Html::script('vendor/jsvalidation/js/jsvalidation.js') !!}
{!! JsValidator::formRequest(App\Http\Requests\Profile\ProfileRequest::class, '#form-profile') !!}
@stop
