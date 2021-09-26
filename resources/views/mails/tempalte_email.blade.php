<style>
#customers {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 50%;
}

#customers td, #customers th {
    border: 1px solid #ddd;
    padding: 8px;
    font-size: 10px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #4CAF50;
    color: white;
}
#no_order td, #no_order th {
	border: 1px solid #ddd;
    padding: 8px;
    font-size: 12px;
}
</style>
<center>
<h2 style="padding: 23px;background: #b3deb8a1;border-bottom: 6px green solid;">
	<a href="{{ env('MY_URL', 'http://localhost:8006') }}">ECHAKIDS-SHOP</a>
</h2>
</center>

<div style="padding: 30px; background: #b3deb8a1;border-bottom: 6px green solid;">
<center>
<p>Hi, Bro</p>
<p>Pesanan Anda dengan No Order: <b>18li72834yuery</b>, sudah di konfirmasi Admin <a href="{{ env('MY_URL', 'http://localhost:8006') }}">www.echakids.com</a>, dan bukti Transfer yang anda upload dinyatakan Valid.</p>
<p>Admin akan segara memproses Barang yang anda order/pesan.</p>
<table id="no_order">
	<tr>
		<td height="10%">No. Order:</td>
		<td>:</td>
		<td>18li72834yuery</td>
	</tr>
	<tr>
		<td>Nama Pemesan:</td>
		<td>:</td>
		<td>Bro</td>
	</tr>
</table>
<table border="1" id="customers">
	<thead>
		<tr>
			<th>Produk</th>
			<th>Qty</th>
			<th>Harga</th>
			<th>Size</th>
			<th>Warna</th>
			<th>Total</th>	
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>Baju 1</td>
			<td>2</td>
			<td>Rp. 13,700</td>
			<td>L</td>
			<td>Merah</td>
			<td>Rp. 27,400</td>
		</tr>
		<tr>
			<td>Baju 2</td>
			<td>1</td>
			<td>Rp. 15,000</td>
			<td>M</td>
			<td>Putih</td>
			<td>Rp. 15,000</td>
		</tr>
	</tbody>
</table>
<br>
<span>Terimakasih sudah berbelanja di <a href="{{ env('MY_URL', 'http://localhost:8006') }}">www.echakids.com</a></span>
</center>
</div>