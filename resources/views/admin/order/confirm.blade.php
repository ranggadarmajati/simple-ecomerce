@extends('admin.layout.app')
@section('title')
Order Confirm
@stop

@section('admin-content-header')
<section class="content-header">
      <h1>
        Transaksi
        <small>Order Confirm</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Transaksi</a></li>
        <li class="active">Order Confirm</li>
      </ol>
    </section>
@stop
@section('admin-main-content')
<div class="row">
<div class="col-lg-6 col-xs-12">
<div class="box box-warning color-palette-box">
    <div class="box-header with-border">
        <h3 class="box-title">Data Order</h3>
    </div>
    <div class="box-body">
         <p class="box-title">No Order: <span style="color: #FF8C00;">{{ $get_data->order_no }}</span></p>
         <p class="box-title">Tanggal Order: <span style="color: #FF8C00;">{{ $get_data->transaction_date }}</span></p>
         <p class="box-title">Customer: <span style="color: #FF8C00;">{{ $get_data->customer }}</span></p>
         <p class="box-title">Email: <span style="color: #FF8C00;">{{ $get_data->email }}</span></p>
         <p class="box-title">Total Order: <span style="color: #FF8C00;">Rp. {{number_format($get_data->order_total, 2,".",",") }}</span></p>
         <p class="box-title">Total yg harus ditransfer: <span style="color: #FF8C00;">Rp. {{ number_format($get_data->total_to_be_paid, 2,".",",") }}</span></p>
         <p class="box-title">No Rekening: <span style="color: #FF8C00;">{{ $get_data->rek_number ? $get_data->rek_number : '-'  }}</span></p>
         <p class="box-title">Nama Rekening: <span style="color: #FF8C00;">{{ $get_data->rek_name ? $get_data->rek_name : '-' }}</span></p>
         <p class="box-title">Tgl Transfer: <span style="color: #FF8C00;">{{ $get_data->transfer_date ? $get_data->transfer_date : '-' }}</span></p>
         <p class="box-title">Status: <span style="color: #FF8C00;">{{ $get_data->customer_confirm == 1 ? 'Sudah di Transfer' : 'Belum di Transfer'  }}</span></p>
    </div>
</div>
</div>
<div class="col-lg-6 col-xs-12">
<div class="box box-warning color-palette-box">
    <div class="box-header with-border">
        <h3 class="box-title">Bukti Transfer</h3>
    </div>
    <div class="box-body">
    @if(isset($get_data->proof_of_payment))
    <center>
         <img src="{{ url('/fashe-colorlib/images/proof_of_payment') }}/{{ $get_data->proof_of_payment }}" class="img img-responsive" height="650px" width="280px">
    </center>
    <br>
    @else
    <center><h3 style="color: #FF8C00;">BUKTI TRANSFER BELUM DI UPLOAD</h3></center>
    @endif
    </div>
</div>
</div>

<div class="col-lg-6 col-xs-12">
<div class="box box-warning color-palette-box">
    <div class="box-header with-border">
        <!-- <h3 class="box-title">Bukti Transfer</h3> -->
    </div>
    <div class="box-body">
    {!! Form::open(['route' => 'admin.confirm_order']) !!}
    <input type="hidden" name="user_id" value="{{ $get_data->user_id }}">
    <input type="hidden" name="transaction_id" value="{{ $get_data->transaction_id }}">
    @if(isset($get_data->proof_of_payment))
    <input type="submit" name="submit" class="btn btn-success btn-lg btn-block" value="Konfirmasi">
    @else
    <input type="submit" name="submit" class="btn btn-success btn-lg btn-block" value="Konfirmasi" disabled="disabled">
    @endif
    {!! Form::close() !!}
    </div>
</div>
</div>
</div>
@stop