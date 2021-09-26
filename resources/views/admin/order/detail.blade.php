@extends('admin.layout.app')
@section('title')
Order Detail
@stop
@section('admin-custom-css')
<style type="text/css">
  .dataTables_info{
    display: none;
  }
</style>
@stop
@section('admin-content-header')
<section class="content-header">
      <h1>
        Transaksi
        <small>Order Detail</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Transaksi</a></li>
        <li class="active">Order Detail</li>
      </ol>
    </section>
@stop
@section('admin-main-content')
<div class="row">
<div class="col-lg-12 col-xs-12">
<div class="box box-warning color-palette-box">
    <div class="box-header with-border">
        <h3 class="box-title">No Order: <span style="color: #FF8C00;">{{ $transaction->order_no }}</span></h3>
    </div>
    <div class="box-header with-border">
        <h3 class="box-title">Tanggal Order: <span style="color: #FF8C00;">{{ $transaction->transaction_date }}</span></h3>
    </div> 
    <div class="box-body">
    <h4>Item Order:</h4>
    <table class="table table-hover table-bordered table-responsive" id="table-order">
        <thead>
            <tr>
              <th width="20%">&nbsp;</th>
              <th width="20%">Nama</th>
              <th>Harga</th>
              <th>Qty</th>
              <th>Size</th>
              <th>Warna</th>
              <th>Qty x Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaction_detail as $item)
            <tr>
              <td align="center"><img src="{{ $item->imagesrc }}" height="120px" width="90px"></td>
              <td>{{ $item->productname }}</td>
              <td>Rp. {{ number_format($item->price, 2,".",",") }}</td>
              <td>{{ $item->qty }}</td>
              <td>{{ $item->size ? $item->size : '-' }}</td>
              <td>{{ $item->color ? $item->color : '-' }}</td>
              <td>Rp. {{ number_format($item->total, 2,".",",") }}</td>  
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</div>
 <!-- /.box-body -->
</div>
<div class="col-lg-12 col-xs-12">
<div class="box box-warning color-palette-box">
    <div class="box-header with-border">
        <h3 class="box-title">Kurir & Tujuan</h3>
    </div>
    <div class="box-body">
    <table class="table table-bordered table-responsive">
      <tr>
        <th>Kurir: <span style="color: #FF8C00;">{{ strtoupper($transaction->couriers->courier) }}</span></th>
        <th>Paket: <span style="color: #FF8C00;">{{ strtoupper($transaction->couriers->package) }}</span></th>
        <th>Harga: <span style="color: #FF8C00;">Rp.{{ number_format($transaction->couriers->price, 2,".",",") }}</span></th>
      </tr>
    </table>
    <h4>Alamat Tujuan:</h4>
    <table class="table table-bordered table-responsive">
      <tr>
        <th>Provinsi : <span style="color: #FF8C00;">{{ $courier_destination->province }}</span></th>
        <th>Kota/ Kab: <span style="color: #FF8C00;">{{ $courier_destination->county_town }}</span></th>
        <th>Kecamatan: <span style="color: #FF8C00;">{{ $courier_destination->district }}</span></th>
      </tr>
      <tr>
        <th>Kode Pos: <span style="color: #FF8C00;">{{ $courier_destination->post_code }}</span></th>
        <th colspan="2">No Hp: <span style="color: #FF8C00;">{{ $courier_destination->hp_no }}</span></th>    
      </tr>
      <tr>
        <th colspan="3">Alamat: <span style="color: #FF8C00;">{{ $courier_destination->address }}</span></th>
      </tr>
    </table>
    </div>
</div>
 <!-- /.box-body -->
</div>

<div class="col-lg-6 col-xs-12">
<div class="box box-warning color-palette-box">
    <div class="box-header with-border">
        <h3 class="box-title">Total Order & Harga Kurir</h3>
    </div>
    <div class="box-body">
    <table class="table table-bordered table-responsive">
      <tr>
        <th style="background-color: #F8F8FF;">
        <h2>Total: <span style="color: orange;"><b>Rp.{{ number_format($transaction->order_total, 2,".",",") }}</b></span></h2></th>
      </tr>
    </table>
    </div>
</div>
 <!-- /.box-body -->
</div>

<div class="col-lg-6 col-xs-12">
 <div class="box box-warning color-palette-box">
    <div class="box-header with-border">
        <h3 class="box-title">Cetak Order Alamat</h3>
    </div>
    <div class="box-body">
      <a href="{{ route('admin.print_order_detail', $transaction->id) }}" class="btn btn-success btn-block" target="_blank">Cetak</a>
    </div>
  </div>
 <!-- /.box-body -->
</div>
</div>
@stop
@section('admin-custom-js')
<script type="text/javascript">
  $('#table-order').dataTable({
      sScrollY: '500px',
      sScrollX: '100%',
      sScrollXInner: '100%',
      bScrollCollapse: true,
      bPaginate:false,
      searching: false
  });
</script>
@stop