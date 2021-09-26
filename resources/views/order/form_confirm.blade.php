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
		.error-help-block{
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
<!-- Form -->
<section class="cart bgwhite p-t-70 p-b-100">
	<div class="container">
		<div class="pos-relative">
				<div class="bgwhite">
				<table class="table table-striped table-responsive" style="font-size: 15px;">
					<thead>
						<tr>
							<td colspan="4">Untuk Konfirmasi Order, Silahkan Transfer Ke salah satu Rekening <i><a href="javascript:;">www.echakids.com</a></i> yang tersedia dibawah ini:</td>
						</tr>
						<tr>
							<th>No. Rekening</th>
							<th>Bank</th>
							<th>Atas Nama</th>
							<th>Logo</th>
						</tr>
					</thead>
					<tbody>
					@if(isset($baccount))
						@foreach($baccount as $bank)
						<tr>
							<td>{{ $bank->rek_no }}</td>
							<td>{{ $bank->bank }}</td>
							<td>{{ $bank->on_behalft }}</td>
							<td><img src="{{ $bank->src }}" width="60" height="30"></td>
						</tr>
						@endforeach
					@endif
					</tbody>
				</table>
				<hr>
				<table class="table table-striped" style="font-size: 15px;">
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
								<!-- <div class="size13 bo4 m-b-22"> -->
								<input type="file" name="proof_of_payment" class="sizefull s-text7 p-l-15 p-r-15" id="proof_of_payment">
								<img src="" class="img-responsive" id="photo_preview" height="120px" width="80px" hidden="hidden">
								<!-- </div> -->
								</td>
							</tr>
							<tr>
								<td align="right">&nbsp;</td>
								<td align="left">&nbsp;</td>
								<td align="left">
								<input type="hidden" name="transaction_id" value="{{ $data_payment->transaction_id }}">
								<input type="text" name="image" id="image" hidden="hidden">
								<button class="btn btn-success" type="submit">Sumbit</button>
								</td>
							</tr>
					</table>
					{{ Form::close() }}
				</div>
			</div>
			<p style="font-size: 12px;">Note: Order Anda akan diproses jika anda sudah konfirmasi pembayaran.</p>
</div>
</section>
@stop
@section('custom-js-script')
{!! JsValidator::formRequest(App\Http\Requests\BuktiTransferRequest::class, '#store_payment') !!}
<script type="text/javascript">
	var proof_of_payment = $('#proof_of_payment');
	proof_of_payment.on('change', function(){
		var input = this;
		var nameFile = this;
		if(input.files && input.files[0]){
			var reader = new FileReader();
			 reader.onload = function(e) {
        $('#photo_preview').attr('src', e.target.result);
        $('#image').val(e.target.result);
      }
			var r = reader.readAsDataURL(input.files[0]);
			
		}
	});
</script>
@stop