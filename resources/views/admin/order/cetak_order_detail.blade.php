<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin Echakids | @yield('title')</title>
  <link rel="stylesheet" href="{{URL::asset('admin_template/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
</head>
<body class="hold-transition skin-yellow-light sidebar-mini"  style="font-size: 10px;" onload="window.print()">
<div class="wrapper">

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="border: 5px;">

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
<div class="col-lg-12 col-xs-12" style="border-style: dashed; border-color: #ddd;">
<br>
<center><img src="{{ URL::asset('fashe-colorlib/images/icons/logo6.png') }}" width="100" height="20"></center>
<!-- <div class="box box-default color-palette-box"> -->
    <div class="box-body">
    <p>Item Order:</p>
    <table class="table table-bordered" id="table-order">
        <thead>
            <tr>
              <td>Nama</td>
              <!-- <td>Harga</td> -->
              <td>Qty</td>
              <td>Size</td>
              <td>Warna</td>
              <!-- <td>Qty x Harga</td> -->
            </tr>
        </thead>
        <tbody>
            @foreach($transaction_detail as $item)
            <tr>
              <td>{{ $item->productname }}</td>
              <!-- <td>Rp. {{ number_format($item->price, 2,".",",") }}</td> -->
              <td>{{ $item->qty }}</td>
              <td>{{ $item->size ? $item->size : '-' }}</td>
              <td>{{ $item->color ? $item->color : '-' }}</td>
             <!--  <td>Rp. {{ number_format($item->total, 2,".",",") }}</td>   -->
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
    <div class="box-body">
    <p>Kurir & Alamat Tujuan:</p>
    <table class="table">
      <tr>
        <td>Kurir: <span style="color: #FF8C00;">{{ strtoupper($transaction->couriers->courier) }}</span></td>
        <td>Paket: <span style="color: #FF8C00;">{{ strtoupper($transaction->couriers->package) }}</span></td>
        <td>Harga: <span style="color: #FF8C00;">Rp.{{ number_format($transaction->couriers->price, 2,".",",") }}</span></td>
      </tr>
      <tr>
        <td>Provinsi : <span style="color: #FF8C00;">{{ $courier_destination->province }}</span></td>
        <td>Kota/ Kab: <span style="color: #FF8C00;">{{ $courier_destination->county_town }}</span></td>
        <td>Kecamatan: <span style="color: #FF8C00;">{{ $courier_destination->district }}</span></td>
      </tr>
      <tr>
        <td>Kode Pos: <span style="color: #FF8C00;">{{ $courier_destination->post_code }}</span></td>
        <td colspan="2">No Hp: <span style="color: #FF8C00;">{{ $courier_destination->hp_no }}</span></td>    
      </tr>
      <tr>
        <td colspan="3">Alamat: <span style="color: #FF8C00;">{{ $courier_destination->address }}</span></td>
      </tr>
    </table>
    <table class="table table-bordered table-responsive">
    </table>
    </div>
<!-- </div> -->
 <!-- /.box-body -->
</div>
<!-- <div class="col-lg-6 col-xs-12">
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
</div> -->
</div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- <div class="control-sidebar-bg"></div> -->
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

@include('admin.layout.js-script')
</body>
</html>