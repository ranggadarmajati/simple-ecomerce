@extends('layout.app')
@section('title')
@if($type == 'order')
Confirm Order
@elseif($type == 'detail')
Order Detail
@else
Konfirmasi Pembayaran
@endif
@stop
@section('custom-css-script')
<style type="text/css">
	.error-help-block {
		color: red;
	}
</style>
@stop
@section('content')
<!-- Title Page -->
<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url('/fashe-colorlib/images/product/product_banner.jpg');">
	<h2 class="l-text2 t-center">
		Echa Kids
	</h2>
	<p class="m-text1 t-center">
		---------------------------------
	</p>
	<p class="m-text13 t-center">
		@if($type == 'order')
		<b>List Order</b>
		@elseif($type == 'detail')
		<b>Order Detail</b>
		@else
		<b>Konfirmasi Pembayaran</b>
		@endif
	</p>
</section>

<!-- Cart -->
<section class="cart bgwhite p-t-70 p-b-100">
	<div class="container">
		@if($type == 'order')
		<!-- table order -->
		<div class="container-table-cart pos-relative">
			<div class="wrap-table-shopping-cart bgwhite">
				<table class="table table-hover table-order" style="font-size: 12px">
					<thead>
						<tr>
							<th align="center">
								<center>No Order</center>
							</th>
							<th align="center">
								<center>Total Order</center>
							</th>
							<th align="center">
								<center>Total yang harus dibayar</center>
							</th>
							<th align="center">
								<center>Status Pembarayan</center>
							</th>
							<th align="center">
								<center>Status Kirim</center>
							</th>
							<th align="center">
								<center>No Tracking</center>
							</th>
							<th align="center">&nbsp;</th>
							<th>&nbsp;</th>
						</tr>
					</thead>
					<tbody>
						@if(isset($order_view) && count($order_view) > 0)
						@foreach($order_view as $order)
						<tr>
							<td align="center">{{ $order->order_no }}</td>
							<td align="center">Rp. {{ number_format($order->order_total, 2,".",",") }}</td>
							<td align="center">Rp. {{ number_format($order->total_to_be_paid, 2,".",",") }}</td>
							<td align="center">{{ ($order->customer_confirm) == 0 ? 'Belum dibayar' : 'Sudah dibayar' }}</td>
							<td align="center">{{ $order->status_send_flag == 0 ? 'Belum Dikirim' : 'Sudah Dikirim' }}</td>
							<td align="center">{{ isset($order->tracking_number) ? $order->tracking_number : '-' }}</td>
							<td align="center">
								<a href="{{ route('order_detail', $order->order_no) }}" alt="Detail Order" class="btn btn-success btn-sm">
									<span class="fa fa-eye"> Detail Order</span>
								</a>
							</td>
							@if(($order->customer_confirm) == 0)
							<td align="center">
								{!! Form::open(['route' => 'get_payment', 'class' => 'get_payment']) !!}
								<input type="hidden" name="order_number" value="{{ $order->order_no }}">
								<button class="btn badge-warning btn-sm" type="submit">
									<span class="fa fa-credit-card" alt="Konfirmasi Order"> Konfirmasi</span>
								</button>
								{!! Form::close() !!}
							</td>

							@else
							@if($order->admin_confirm == 0)
							<td align="center"> Menunggu konfirmasi Admin</td>
							@else
							<td align="center"> Sudah dikonfirmasi Admin</td>
							@endif
							@endif
						</tr>
						@endforeach
						@else
						<tr>
							<td align="center" colspan="5">Tidak ada order yang harus dibayar</td>
						</tr>

						@endif
					</tbody>
				</table>
			</div>
		</div>
		<br>
		<p style="font-size: 12px;">Note: Order Anda akan diproses jika anda sudah konfirmasi pembayaran dan Order akan di Reject jika Anda belum transfer selama 2hari terhitung sejak anda melakukan Order.</p>
		<!-- end table order -->
		@elseif($type == 'detail')
		<!-- table order detail -->
		<div class="container-table-cart pos-relative">
			<div class="wrap-table-shopping-cart bgwhite">
				<table class="table table-">

				</table>
				<table class="table table-bordered table-hover table-order-detail" style="font-size: 12.5px">
					<thead>
						<tr>
							<td align="center">Nama Produk</td>
							<td align="center">Qty</td>
							<td align="center">Price</td>
							<td align="center">Size</td>
							<td align="center">Color</td>
							<td align="center">Total</td>
						</tr>
					</thead>
					<tbody>
						@if(isset($order_detail) && count($order_detail) > 0)
						@foreach($order_detail as $order)
						<tr>
							<td align="center">{{ $order->name }}</td>
							<td align="center">{{ $order->qty }}</td>
							<td align="center">Rp. {{ number_format($order->price, 2,".",",") }}</td>
							<td align="center">{{ $order->size ? $order->size : '-' }}</td>
							<td align="center">{{ $order->color ? $order->color : '-' }}</td>
							<td align="center">Rp. {{ number_format($order->total, 2,".",",") }}</td>
						</tr>
						@endforeach
						@else
						<tr>
							<td align="center" colspan="6"> Data Tidak Ada </td>
						</tr>

						@endif
					</tbody>
				</table>
			</div>
		</div>
		<!-- end table order detail -->
		<br>
		<p style="font-size: 12px;">Note: Order Anda akan diproses jika anda sudah konfirmasi pembayaran.</p>
		@else
		<div class="pos-relative">
			<div class="bgwhite">
				<table class="table table-striped" style="font-size: 15px;">
					<tr>
						<td colspan="3">Untuk Konfirmasi Order, Silahkan Transfer Ke Rekening <i><a href="javascript:;">www.echakids.com</a></i> dibawah ini:</td>
					</tr>
					<tr>
						<td width="20%">BANK</td>
						<td width="3%">:</td>
						<td>BRI (kode bank: 23)</td>
					</tr>
					<tr>
						<td width="20%">No Rekening</td>
						<td width="3%">:</td>
						<td>9348662354809</td>
					</tr>
					<tr>
						<td width="20%">Atas Nama</td>
						<td width="3%">:</td>
						<td>Resti</td>
					</tr>
					<tr>
						<td width="20%">Total Order</td>
						<td width="3%">:</td>
						<td>Rp. {{ number_format($data_payment->order_total, 2,".",",") }}</td>
					</tr>
					<tr>
						<td width="20%">Total harus di bayar</td>
						<td width="3%">:</td>
						<td><button class="btn btn-success"><strong>Rp.{{ number_format($data_payment->total_to_be_paid, 2,".",",") }}</strong></button> &nbsp;<span style="font-size: 11px; text-align: left;">(note: jumlah nominal harus sesuai untuk validasi bahwa anda telah melakukan pembayaran dengan sistem transfer)</span></td>
					</tr>
					<tr>
						<td width="20%">Pembayaran untuk No Order</td>
						<td width="3%">:</td>
						<td>{{ $data_payment->order_no }}</td>
					</tr>
				</table>
				<p style="font-size: 12px;">Note: "Total harus di bayar" terdapat selisih dikarenakan sistem kami menambahkan nomor unik yang dijumlahkan dengan "Total Order" untuk validasi Nominal pembayaran anda</p>
				<br>
				<br>
				<table class="table table-striped" style="font-size: 15px;">
					<tr>
						<td colspan="3">Setelah Anda Transfer, silahkan isi field dibawah ini dengan benar</td>
					</tr>
				</table>
				{!! Form::open(['route' => 'store_payment', 'class' => 'store_payment', 'id' => 'store_payment' ]) !!}
				<table class="table" style="font-size: 12.5px">
					<tr>
						<td align="right">Nomor rekening anda</td>
						<td align="left">:</td>
						<td align="left">
							<div class="size13 bo4 m-b-22">
								<input type="text" name="rek_number" class="sizefull s-text7 p-l-15 p-r-15" placeholder="Nomor Rekening">
							</div>
						</td>
					</tr>
					<tr>
						<td align="right">Rekening A/N</td>
						<td align="left">:</td>
						<td align="left">
							<div class="size13 bo4 m-b-22">
								<input type="text" name="rek_name" class="sizefull s-text7 p-l-15 p-r-15" placeholder="Atas Nama Rekening">
							</div>
						</td>
					</tr>
					<tr>
						<td align="right">Bukti Transfer</td>
						<td align="left">:</td>
						<td align="left">
							<input type="file" name="proof_of_payment" class="sizefull s-text7 p-l-15 p-r-15" id="proof_of_payment">
							<img src="" class="img-responsive" id="photo_preview" height="120px" width="80px" hidden="hidden">
						</td>
					</tr>
					<tr>
						<td align="right">&nbsp;</td>
						<td align="left">&nbsp;</td>
						<td align="left">
							<input type="hidden" name="transaction_id" value="{{ $data_payment->transaction_id }}">
							<input type="text" name="image" id="image" hidden="hidden">
							<button class="btn btn-success" type="submit">Sumbit</button>
							{{ Form::close() }}
						</td>
					</tr>
				</table>
			</div>
		</div>
		<p style="font-size: 12px;">Note: Order Anda akan diproses jika anda sudah konfirmasi pembayaran.</p>
		@endif
	</div>
</section>
@stop
@section('custom-js-script')
{!! JsValidator::formRequest(App\Http\Requests\BuktiTransferRequest::class, '#store_payment') !!}
<script type="text/javascript">
	var proof_of_payment = $('#proof_of_payment');
	proof_of_payment.on('change', function() {
		var input = this;
		var nameFile = this;
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('#photo_preview').attr('src', e.target.result);
				$('#image').val(e.target.result);
			}
			var r = reader.readAsDataURL(input.files[0]);

		}
	});
</script>
<script type="text/javascript">
	$('.table-order').DataTable({
		processing: false,
		serverSide: false,
		sScrollY: '500px',
		sScrollX: '100%',
		sScrollXInner: '100%',
		bScrollCollapse: true,
		language: {
			"sEmptyTable": "Tidak ada data yang tersedia pada tabel ini",
			"sProcessing": "Sedang memproses...",
			"sLengthMenu": "Tampilkan _MENU_ entri",
			"sZeroRecords": "Tidak ditemukan data yang sesuai",
			"sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
			"sInfoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
			"sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
			"sInfoPostFix": "",
			"sSearch": "Cari:",
			"sUrl": "",
			"oPaginate": {
				"sFirst": "Pertama",
				"sPrevious": "Sebelumnya",
				"sNext": "Selanjutnya",
				"sLast": "Terakhir"
			}
		}
	});
</script>
@stop