<center>
<h2 style="padding: 23px;background: #b3deb8a1;border-bottom: 6px green solid;">
	<a href="{{ env('MY_URL', 'http://localhost:8006') }}">ECHAKIDS-SHOP</a>
</h2>
</center>

<div style="padding: 30px; background: #b3deb8a1;border-bottom: 6px green solid;">
<center>
<p>Hi, {{ $mail['name'] }}</p>
<p>Pesanan Anda dengan No Order: <b>{{ $mail['order_no'] }}</b>, sudah di konfirmasi Admin <a href="{{ env('MY_URL', 'http://localhost:8006') }}">www.echakids.com</a>, dan bukti Transfer yang anda upload dinyatakan Valid.</p>
<p>Admin akan segara memproses Barang yang anda order/pesan.</p>
<table id="no_order">
	<tr>
		<td style="padding: 8px; font-size: 12px;">No. Order:</td>
		<td style="padding: 8px; font-size: 12px;" >:</td>
		<td style="padding: 8px; font-size: 12px;">{{ $mail['order_no'] }}</td>
	</tr>
	<tr>
		<td style="padding: 8px; font-size: 12px;">Nama Pemesan:</td>
		<td style="padding: 8px; font-size: 12px;">:</td>
		<td style="padding: 8px; font-size: 12px;">{{ $mail['name'] }}</td>
	</tr>
</table>
<table style="font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif; border-collapse: collapse; width: 100%;">
	<thead>
		<tr>
			<th style="padding-top: 12px; padding-bottom: 12px; font-size: 10px; text-align: center; background-color: #4CAF50; color: white;">Produk</th>
			<th style="padding-top: 12px; padding-bottom: 12px; font-size: 10px; text-align: center; background-color: #4CAF50; color: white;">Qty</th>
			<th style="padding-top: 12px; padding-bottom: 12px; font-size: 10px; text-align: center; background-color: #4CAF50; color: white;">Harga</th>
			<th style="padding-top: 12px; padding-bottom: 12px; font-size: 10px; text-align: center; background-color: #4CAF50; color: white;">Size</th>
			<th style="padding-top: 12px; padding-bottom: 12px; font-size: 10px; text-align: center; background-color: #4CAF50; color: white;">Warna</th>
			<th style="padding-top: 12px; padding-bottom: 12px; font-size: 10px; text-align: center; background-color: #4CAF50; color: white;">Total</th>	
		</tr>
	</thead>
	<tbody>
	@foreach($detail_order as $item)
		<tr style="background-color: #f2f2f2;">
			<td style="border: 1px solid #ddd; padding: 8px; font-size: 10px; text-align: center;">{{ $item->name }}</td>
			<td style="border: 1px solid #ddd; padding: 8px; font-size: 10px; text-align: center;">{{ $item->qty }}</td>
			<td style="border: 1px solid #ddd; padding: 8px; font-size: 10px; text-align: center;">{{ $item->price }}</td>
			<td style="border: 1px solid #ddd; padding: 8px; font-size: 10px; text-align: center;">{{ $item->size ? $item->size : '-' }}</td>
			<td style="border: 1px solid #ddd; padding: 8px; font-size: 10px; text-align: center;">{{ $item->color ? $item->color : '-' }}</td>
			<td style="border: 1px solid #ddd; padding: 8px; font-size: 10px; text-align: center;">{{ $item->total }}</td>
		</tr>
	@endforeach
	</tbody>
</table>
<br>
<span>Terimakasih sudah berbelanja di <a href="{{ env('MY_URL', 'http://localhost:8006') }}">www.echakids.com</a></span>
</center>
</div>