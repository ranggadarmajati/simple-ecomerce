@extends('admin.layout.app')
@section('title')
Dashboard
@stop
@section('admin-content-header')
<section class="content-header">
      <h1>
        Dashboard
        <small>Admin Dashboard</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
@stop
@section('admin-main-content')
<div class="row">
<div class="col-lg-4 col-xs-6">
   <!-- small box -->
     <div class="small-box bg-aqua">
        <div class="inner">
            <h3>{{ $getCountTransaction }}</h3>

            <p>Transactions</p>
         </div>
         <div class="icon">
              <i class="ion ion-bag"></i>
         </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
     </div>
</div>

<div class="col-lg-4 col-xs-6">
   <!-- small box -->
     <div class="small-box bg-green">
        <div class="inner">
            <h3>{{ $getCountProduct }}</h3>

            <p>Produk</p>
         </div>
         <div class="icon">
              <i class="fa fa-cubes"></i>
         </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
     </div>
</div>

<div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{ $getCountUser }}</h3>

              <p>User Registrations</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
</div>
<!-- <div class="col-lg-6 col-xs-12"> -->
<div class="box box-warning color-palette-box">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-bar-chart"></i> Chart Transaction</h3>
    </div>
    <div class="box-body">
    <div class="form-inline">
    	<div class="form-group">
    		<label for="email">Filter Year:</label>
    		<select class="form-control" id="year">
        		<option>2018</option>
        		<option>2019</option>
        		<option>2020</option>
        		<option>2021</option>
        		<option>2022</option>
        		<option>2023</option>
        		<option>2024</option>
        		<option>2025</option>
        		<option>2026</option>
        		<option>2027</option>
        		<option>2028</option>
        		<option>2029</option>
        		<option>2030</option>
    		</select> 
  		</div>
    </div>
        <div class="chart">
			<canvas id="canvas" style="height: 230px; width: 511px;" width="511" height="230"></canvas>
		</div>
        <!-- </div> -->
    </div>
 <!-- /.box-body -->
</div>
<!-- </div> -->
@stop
@section('admin-custom-js')
<script type="text/javascript">

$(document).ready(function(){
	getDataChart()
});

function getDataChart(years = null){
	$.ajax({
			url:"{{ route('admin.DataTransactionChart') }}",
			method: 'GET',
			dataType: 'json',
			data:{
				year: years
			},
			success: function(d){
				var label = d.chartData.map(function(a){
					return a.month_name;
				});

				var trans = d.chartData.map(function(b){
					return b.transactions;
				});

				Data = {
					labels: label,
					datasets: [
						{
							fillColor : "rgba(151,187,205,0.5)",
							strokeColor : "rgba(151,187,205,0.8)",
							highlightFill : "rgba(151,187,205,0.75)",
							highlightStroke : "rgba(151,187,205,1)",
							data : trans
						}
					]

				}
				//here
				var ctx = $('#canvas').get(0).getContext('2d')
				var myBar = new Chart(ctx);
				myBar.Bar(Data, {
					responsive : true
				});
			}
		});
}

$('#year').on('change', function(){
	var year = $(this).val();
	getDataChart(year);
});
</script>
@stop