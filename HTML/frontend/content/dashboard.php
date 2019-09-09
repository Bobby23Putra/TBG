<style>
	.nav-tabs > li.active > a,
	.nav-tabs > li.active > a:hover,
	.nav-tabs > li.active > a:focus
	{
		background-color:#00897b;
		color:#FFFFFF;
	}
	
	.nav-tabs > li > a
	{
		margin-right: 2px;
		line-height: 1.42857143;
		border: 1px solid #cccccc;
		border-radius: 4px 4px 0 0;
		background-color:#9e9e9e;
		color:#FFFFFF;
	}
</style>
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Dashboard <small>TBG RTU</small>
        </h1>
        <ol class="breadcrumb">
            <li>
               <a href="main.php?page_id=dashboard&pack_id=all">
					<i class="fa fa-dashboard"></i> Dashboard
			   </a>
            </li>
			<li class="active">Status</li>
        </ol>
    </div>
</div>
<!-- /.row -->
<?php
$q="select * from log where id = '1'";
$r=myQueryDb($q);
$row=myFetchDb($r);
?>

<div class="row">
	<div class="col-lg-12">
		<button class="btn btn-primary form-control refresh">Refresh Data</button>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		&nbsp;
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<ol class="breadcrumb">
			<li class="active">Last Update : <span id="data_datetime"></span></li>
		</ol>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<ol class="breadcrumb">
			<li class="active">Connection Status : <span id="data_con"></span></li>
		</ol>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-info">
			<div class="panel-heading">RECTIFIER</div>
			<div class="panel-body">
				
				<div class="row">
					<div class="col-lg-2">
						<div class="panel panel-success">
							<div class="panel-heading">AC Volt</div>
							<div class="panel-body"><span id="data_ac_volt"></span> V</div>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="panel panel-success">
							<div class="panel-heading">Battery Capacity</div>
							<div class="panel-body"><span id="data_bat_cap"></span> </div>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="panel panel-success">
							<div class="panel-heading">Battery Current</div>
							<div class="panel-body"><span id="data_bat_cur"></span> A</div>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="panel panel-success">
							<div class="panel-heading">Bus Voltage</div>
							<div class="panel-body"><span id="data_bus_v"></span> V</div>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="panel panel-success">
							<div class="panel-heading">Load Current</div>
							<div class="panel-body"><span id="data_load_c"></span> A</div>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="panel panel-success">
							<div class="panel-heading">Load Power</div>
							<div class="panel-body"><span id="data_load_p"></span> W</div>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="panel panel-success">
							<div class="panel-heading">AC Phase 1</div>
							<div class="panel-body"><span id="data_phase_1"></span> V</div>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="panel panel-success">
							<div class="panel-heading">AC Phase 2</div>
							<div class="panel-body"><span id="data_phase_2"></span> V</div>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="panel panel-success">
							<div class="panel-heading">AC Phase 3</div>
							<div class="panel-body"><span id="data_phase_3"></span> V</div>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="panel panel-success">
							<div class="panel-heading">Battery Temperature</div>
							<div class="panel-body"><span id="data_tempr"></span> &deg;C</div>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="panel panel-success">
							<div class="panel-heading">Rect. Active Module</div>
							<div class="panel-body"><span id="data_active_module"></span></div>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="panel panel-success">
							<div class="panel-heading">Rect Failed Module</div>
							<div class="panel-body"><span id="data_failed_module"></span></div>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="panel panel-success">
							<div class="panel-heading">Rect. Comm Lost Module</div>
							<div class="panel-body"><span id="data_comm_lost"></span></div>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="panel panel-success">
							<div class="panel-heading">System Power</div>
							<div class="panel-body"><span id="data_system_power"></span></div>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="panel panel-success">
							<div class="panel-heading">Rectifier Current</div>
							<div class="panel-body"><span id="data_rec_current"></span> A</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="col-lg-12">
		<div class="panel panel-info">
			<div class="panel-heading">EXTERNAL SENSOR</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-2">
						<div class="panel panel-success">
							<div class="panel-heading">Env. Temperature</div>
							<div class="panel-body"><span id="data_env_temp"> &deg;C</div>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="panel panel-success">
							<div class="panel-heading">Env. Humidity</div>
							<div class="panel-body"><span id="data_env_hum"></div>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="panel panel-success">
							<div class="panel-heading">Door Rectifier</div>
							<div class="panel-body"><span id="data_env_door_1"></div>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="panel panel-success">
							<div class="panel-heading">Door Battery</div>
							<div class="panel-body"><span id="data_env_door_2"></div>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="panel panel-success">
							<div class="panel-heading">Battery Stolen</div>
							<div class="panel-body"><span id="data_env_batt_stolen"></div>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="panel panel-success">
							<div class="panel-heading">Grounding Cut</div>
							<div class="panel-body"><span id="data_env_ground"></div>
						</div>
					</div>
			
					
				</div>
			</div>
		</div>
	</div>
		
		
	</div>
	<div class="row">
	<div class="col-lg-12">
		<button class="btn btn-primary form-control refresh">Refresh Data</button>
	</div>
</div>
</div>

<!-- end row -->

<script type="text/javascript">
$(function(){
	function load_sensor(){
		$('.refresh').html("Loading Data...");
		$('.refresh').attr('disabled', true);
		$(".container-fluid").css("opacity", 0.5);
		$.get( "../../ajax/getdata.php" ).done(function( data ) {
			data = data.split(";");
			$("#data_datetime").html(data[0]);
			$("#data_ac_volt").html(data[1]);
			$("#data_bat_cap").html(data[2]);
			$("#data_bat_cur").html(data[3]);
			$("#data_bus_v").html(data[4]);
			$("#data_load_c").html(data[5]);
			$("#data_load_p").html(data[6]);
			$("#data_phase_1").html(data[7]);
			$("#data_phase_2").html(data[8]);
			$("#data_phase_3").html(data[9]);
			$("#data_tempr").html(data[10]);
			$("#data_active_module").html(data[11]);
			$("#data_failed_module").html(data[12]);
			$("#data_comm_lost").html(data[13]);
			$("#data_system_power").html(data[14]);
			$("#data_rec_current").html(data[15]);
			
			$("#data_env_temp").html(data[16] +" &deg;C");
			$("#data_env_hum").html(data[17]);
			if(data[18] == '1'){
				var door_1 = "Closed";
			}else{
				var door_1 = "Open";
			}
			if(data[19] == '1'){
				var door_2 = "Closed";
			}else{
				var door_2 = "Open";
			}
			if(data[20] == '1'){
				var batt = "Disconnected";
			}else{
				var batt = "Connected";
			}
			if(data[21] == '1'){
				var gr = "Disconnected";
			}else{
				var gr = "Connected";
			}
			$("#data_env_door_1").html(door_1);
			$("#data_env_door_2").html(door_2);
			$("#data_env_batt_stolen").html(batt);
			$("#data_env_ground").html(gr);
			$("#data_con").html(data[23]);
			
			alert("Data Refreshed");
			$('.refresh').html("Refresh Data");
			$(".container-fluid").css("opacity", 1);
			$('.refresh').attr('disabled', false);
		});
		
	}
	load_sensor();
	$(".refresh").click(function(){
		load_sensor();
	});
});
</script>
