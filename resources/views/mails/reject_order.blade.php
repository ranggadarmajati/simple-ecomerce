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
	<a href="{{ env('MY_URL', 'https://echakids.com') }}">ECHAKIDS-SHOP</a>
</h2>
</center>

<div style="padding: 30px; background: #b3deb8a1;border-bottom: 6px green solid;">
<center>
<p>Hi, {{ $mail['name'] }}</p>
<p>Orderan dengan No Order: {{ $mail['order_no'] }}</p>
<p>Telah di reject Otomatis By System Web ECHAKIDS, dikarenakan anda belum melakukan Konfirmasi Pembayaran(Transfer) lebih dari 2 hari terhitung sejak anda order pada tanggal {{ date("d-m-Y", strtotime($mail['transaction_date'])) }}</p>
<br>
<span>Terimakasih sudah berbelanja di <a href="{{ env('MY_URL', 'https://echakids.com') }}">www.echakids.com</a></span>
</center>
</div>