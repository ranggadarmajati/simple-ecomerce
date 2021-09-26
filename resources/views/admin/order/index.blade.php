@extends('admin.layout.app')
@section('title')
Transactions
@stop
@section('admin-content-header')
<section class="content-header">
      <h1>
        Transaksi
        <small>Konfirmasi Pembayaran</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Transaksi</a></li>
        <li class="active">Konfirmasi Pembayaran</li>
      </ol>
    </section>
@stop
@section('admin-main-content')
<div class="row">
<div class="col-lg-12 col-xs-12">
@if(Session::has('success'))
    <div class="alert alert-success" id="successMessage"><em> {!! session('success') !!}</em></div>
@endif
<div class="box box-warning color-palette-box">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-bar-chart"></i> Data Order Belum di Konfirmasi</h3>
    </div>
    <div class="box-body">
    <table class="table table-hover table-bordered" id="table-order">
        <thead>
            <tr>
              <th>No Order</th>
              <th>Customer</th>
              <th>Tgl Order</th>
              <th>Order Total</th>
              <th>Umur Order</th>
              <th><center>Actions</center></th>
            </tr>
        </thead>
    </table>
    </div>
</div>
 <!-- /.box-body -->
</div>

<div class="col-lg-12 col-xs-12">
<div class="box box-warning color-palette-box">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-bar-chart"></i> Data Order Sudah di Konfirmasi</h3>
    </div>
    <div class="box-body">
    <table class="table table-hover table-bordered" id="table-order-confirm">
        <thead>
            <tr>
              <th>No Order</th>
              <th>Customer</th>
              <th>Tgl Order</th>
              <th>Order Total</th>
              <th><center>Actions</center></th>
            </tr>
        </thead>
    </table>
    </div>
</div>
 <!-- /.box-body -->
</div>
</div>
@stop
@section('admin-custom-js')
<script type="text/javascript">
$('#table-order').DataTable({
  processing: true,
  serverSide: true,
  sScrollY: '500px',
  sScrollX: '100%',
  sScrollXInner: '100%',
  bScrollCollapse: true,
  language:{
    "sEmptyTable":   "Tidak ada data yang tersedia pada tabel ini",
    "sProcessing":   "Sedang memproses...",
    "sLengthMenu":   "Tampilkan _MENU_ entri",
    "sZeroRecords":  "Tidak ditemukan data yang sesuai",
    "sInfo":         "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
    "sInfoEmpty":    "Menampilkan 0 sampai 0 dari 0 entri",
    "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
    "sInfoPostFix":  "",
    "sSearch":       "Cari:",
    "sUrl":          "",
    "oPaginate": {
        "sFirst":    "Pertama",
        "sPrevious": "Sebelumnya",
        "sNext":     "Selanjutnya",
        "sLast":     "Terakhir"
    }
  },
  ajax:"{{ route('admin.datatable_order') }}",
  columns: [
      { data: 'order_no', name: 'order_no' },
      { data: 'customer', name: 'customer' },
      { data: 'transaction_date', name: 'transaction_date' },
      { data: 'order_total', name: 'order_total' },
      { data: 'aging', name: 'aging' },
      { data: 'action', name: 'action' }
  ]
});

$('#table-order-confirm').DataTable({
  processing: true,
  serverSide: true,
  sScrollY: '500px',
  sScrollX: '100%',
  sScrollXInner: '100%',
  bScrollCollapse: true,
  language:{
    "sEmptyTable":   "Tidak ada data yang tersedia pada tabel ini",
    "sProcessing":   "Sedang memproses...",
    "sLengthMenu":   "Tampilkan _MENU_ entri",
    "sZeroRecords":  "Tidak ditemukan data yang sesuai",
    "sInfo":         "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
    "sInfoEmpty":    "Menampilkan 0 sampai 0 dari 0 entri",
    "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
    "sInfoPostFix":  "",
    "sSearch":       "Cari:",
    "sUrl":          "",
    "oPaginate": {
        "sFirst":    "Pertama",
        "sPrevious": "Sebelumnya",
        "sNext":     "Selanjutnya",
        "sLast":     "Terakhir"
    }
  },
  ajax:"{{ route('admin.datatable_order_confirm') }}",
  columns: [
      { data: 'order_no', name: 'order_no' },
      { data: 'customer', name: 'customer' },
      { data: 'transaction_date', name: 'transaction_date' },
      { data: 'order_total', name: 'order_total' },
      { data: 'action', name: 'action' }
  ]
});
</script>
@stop