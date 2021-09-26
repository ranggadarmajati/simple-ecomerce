@extends('admin.layout.app')
@section('title')
Tentang Kami
@stop
@section('admin-content-header')
<section class="content-header">
      <h1>
        Tentang Kami
        <small>Data Tentang Kami</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Tentang Kami</a></li>
        <li class="active">Data Tentang Kami</li>
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
        <h3 class="box-title"><i class="fa fa-bar-chart"></i> Data Tentang Kami &nbsp;</h3>
    </div>
    <div class="box-body">
    <table class="table table-hover table-bordered" id="table-about">
        <thead>
            <tr>
              <th>Gambar</th>
              <th>Konten</th>
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
$('#table-about').DataTable({
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
  ajax:"{{ route('admin.datatable_about') }}",
  columns: [
      { data: 'image_about', name: 'image_about' },
      { data: 'content', name: 'content' },
      { data: 'action', name: 'action' }
  ]
});
</script>
@stop