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
<p>Hi, {{ $name }}</p>
<p>Terimakasih sudah mendaftar di <a href="{{ env('MY_URL', 'http://localhost:8006') }}">www.echakids.com</a>, untuk dapat login silahkan klik link verifikasi dibawah ini:</p>
<p><a href="{{ env('APP_URL', 'https://echakids.com') }}/{{ $verification_code }}/verifikasi_akun">VERIFIKASI AKUN</a></p>
<br>
<p>*Mohon abaikan pesan ini jika bukan Anda yang melakukan atau bukan atas sepengetahuan Anda.</p>
<span>Terimakasih sudah berkunjung di <a href="{{ env('MY_URL', 'http://localhost:8006') }}">www.echakids.com</a></span>
</center>
</div>