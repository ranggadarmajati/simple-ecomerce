@extends('admin.layout.app')
@section('title')
Product
@stop
@section('admin-content-header')
<section class="content-header">
      <h1>
        Produk
        <small>Data Produk</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Produk</a></li>
        <li class="active">Data Produk</li>
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
        <h3 class="box-title"><i class="fa fa-bar-chart"></i> Data Produk &nbsp;<a class="btn btn-success btn-xs" href="{{ route('admin.create_product') }}" title="Tambah Barang"><b>+</b></a></h3>
    </div>
    <div class="box-body">
    <table class="table table-hover table-bordered" id="table-product">
        <thead>
            <tr>
              <th>id</th>
              <th>Nama</th>
              <th>Harga</th>
              <th>Kategori</th>
              <th>Berat (gr)</th>
              <th>Stok</th>
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
$('#table-product').DataTable({
  processing: true,
  serverSide: true,
  sScrollY: '250px',
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
  ajax:"{{ route('admin.datatable_product') }}",
  columns: [
      { data: 'id', name: 'id' },
      { data: 'name', name: 'name' },
      { data: 'price', name: 'price' },
      { data: 'category_desc', name: 'category_desc' },
      { data: 'weight', name: 'weight' },
      { data: 'available_desc', name: 'available_desc' },
      { data: 'action', name: 'action' }
  ]
});
</script>
@stop