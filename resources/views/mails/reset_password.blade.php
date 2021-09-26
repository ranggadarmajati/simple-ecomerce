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
<p>Anda telah mengajukan reset password, dan kami kirimkan password baru untuk anda login di <a href="{{ env('MY_URL', 'http://localhost:8006') }}">www.echakids.com</a> dibawah ini :</p>
<p><b style="color: red;">{{ $new_password }}</b></p>
<br>
<p>*Gunakan Password tersebut untuk Login di www.echakids.com</p>
<span>Terimakasih sudah berkunjung di <a href="{{ env('MY_URL', 'http://localhost:8006') }}">www.echakids.com</a></span>
</center>
</div>