<?php

$alarm_long = array();
$alarm_long[1][0]="Short-circuit";
$alarm_long[1][1]="Discharging&nbsp;Over-current";
$alarm_long[1][2]="Charging&nbsp;Over-current";
$alarm_long[1][3]="Pack&nbsp;Under-voltage";
$alarm_long[1][4]="Pack&nbsp;Over-voltage";
$alarm_long[1][5]="Cell&nbsp;Under-voltage";
$alarm_long[1][6]="Cell&nbsp;Over-voltage";
$alarm_long[2][0]="Fully";
$alarm_long[2][1]="Environment&nbsp;Under-temperature";
$alarm_long[2][2]="Environment&nbsp;Over-temperature";
$alarm_long[2][3]="MOSFET&nbsp;Over-temperature";
$alarm_long[2][4]="Discharging&nbsp;Under-temperature";
$alarm_long[2][5]="Charging&nbsp;Under-temperature";
$alarm_long[2][6]="Discharging&nbsp;Over-temperature";
$alarm_long[2][7]="Charging&nbsp;Over-temperature";
$alarm_long[3][0]="State&nbsp;of&nbsp;heater";
$alarm_long[3][1]="AC-in";
$alarm_long[3][2]="Power&nbsp;supply";
$alarm_long[3][3]="Discharging&nbsp;MOSFET";
$alarm_long[3][4]="Charging&nbsp;MOSFET";
$alarm_long[3][5]="Current&nbsp;limiting&nbsp;circuit";
$alarm_long[4][0]="LED-Warning&nbsp;function";
$alarm_long[4][1]="Current limits&nbsp;function";
$alarm_long[4][2]="Current limits&nbsp;control";
$alarm_long[4][3]="Buzzer-Warning&nbsp;function";
$alarm_long[5][0]="Sampling";
$alarm_long[5][1]="Battery&nbsp;voltage";
$alarm_long[5][2]="Temperature&nbsp;NTC";
$alarm_long[5][3]="Charging&nbsp;MOSFET";
$alarm_long[5][4]="Discharging&nbsp;MOSFET";
$alarm_long[6][0]="Cell&nbsp;8&nbsp;balancing";
$alarm_long[6][1]="Cell&nbsp;7&nbsp;balancing";
$alarm_long[6][2]="Cell&nbsp;6&nbsp;balancing";
$alarm_long[6][3]="Cell&nbsp;5&nbsp;balancing";
$alarm_long[6][4]="Cell&nbsp;4&nbsp;balancing";
$alarm_long[6][5]="Cell&nbsp;3&nbsp;balancing";
$alarm_long[6][6]="Cell&nbsp;2&nbsp;balancing";
$alarm_long[6][7]="Cell&nbsp;1&nbsp;balancing";
$alarm_long[7][0]="Cell&nbsp;16&nbsp;balancing";
$alarm_long[7][1]="Cell&nbsp;15&nbsp;balancing";
$alarm_long[7][2]="Cell&nbsp;14&nbsp;balancing";
$alarm_long[7][3]="Cell&nbsp;13&nbsp;balancing";
$alarm_long[7][4]="Cell&nbsp;12&nbsp;balancing";
$alarm_long[7][5]="Cell&nbsp;11&nbsp;balancing";
$alarm_long[7][6]="Cell&nbsp;10&nbsp;balancing";
$alarm_long[7][7]="Cell&nbsp;9&nbsp;balancing";
$alarm_long[8][0]="Discharging&nbsp;Over-current";
$alarm_long[8][1]="Charging&nbsp;Over-current";
$alarm_long[8][2]="Cell&nbsp;Under-Voltage";
$alarm_long[8][3]="Cell&nbsp;Over-Voltage";
$alarm_long[8][4]="Pack&nbsp;Under-Voltage";
$alarm_long[8][5]="Pack&nbsp;Over-Voltage";
$alarm_long[9][0]="SOC&nbsp;Low";
$alarm_long[9][1]="MOS&nbsp;Over-temperature";
$alarm_long[9][2]="Environment&nbsp;Under-temperature";
$alarm_long[9][3]="Environment&nbsp;Over-temperature";
$alarm_long[9][4]="Discharging&nbsp;Under-temperature";
$alarm_long[9][5]="Charging&nbsp;Under-temperature";
$alarm_long[9][6]="Discharging&nbsp;Over-temperature";
$alarm_long[9][7]="Charging&nbsp;Over-temperature";

$alarm_short = array();
$alarm_short[1][0]="Short-circuit";
$alarm_short[1][1]="Dsg&nbsp;OC";
$alarm_short[1][2]="Chg&nbsp;OC";
$alarm_short[1][3]="PUV";
$alarm_short[1][4]="POV";
$alarm_short[1][5]="CUV";
$alarm_short[1][6]="COV";
$alarm_short[2][0]="Fully";
$alarm_short[2][1]="Env&nbsp;UT";
$alarm_short[2][2]="Env&nbsp;OT";
$alarm_short[2][3]="MOS&nbsp;OT";
$alarm_short[2][4]="Dsg&nbsp;UT";
$alarm_short[2][5]="Chg&nbsp;UT";
$alarm_short[2][6]="Dsg&nbsp;OT";
$alarm_short[2][7]="Chg&nbsp;OT";
$alarm_short[3][0]="SOH";
$alarm_short[3][1]="AC-in";
$alarm_short[3][2]="Power&nbsp;supply";
$alarm_short[3][3]="Dsg&nbsp;MOS";
$alarm_short[3][4]="Chg&nbsp;MOS";
$alarm_short[3][5]="Cur&nbsp;Limiting&nbsp;Circuit";
$alarm_short[4][0]="LED&nbsp;Func";
$alarm_short[4][1]="CL&nbsp;Func";
$alarm_short[4][2]="CL&nbsp;Control";
$alarm_short[4][3]="Buzzer&nbsp;Func";
$alarm_short[5][0]="Sampling";
$alarm_short[5][1]="Batt&nbsp;V";
$alarm_short[5][2]="Tempr&nbsp;NTC";
$alarm_short[5][3]="Chg&nbsp;MOS";
$alarm_short[5][4]="Dsg&nbsp;MOS";
$alarm_short[6][0]="Cell&nbsp;8&nbsp;balancing";
$alarm_short[6][1]="Cell&nbsp;7&nbsp;balancing";
$alarm_short[6][2]="Cell&nbsp;6&nbsp;balancing";
$alarm_short[6][3]="Cell&nbsp;5&nbsp;balancing";
$alarm_short[6][4]="Cell&nbsp;4&nbsp;balancing";
$alarm_short[6][5]="Cell&nbsp;3&nbsp;balancing";
$alarm_short[6][6]="Cell&nbsp;2&nbsp;balancing";
$alarm_short[6][7]="Cell&nbsp;1&nbsp;balancing";
$alarm_short[7][0]="Cell&nbsp;16&nbsp;balancing";
$alarm_short[7][1]="Cell&nbsp;15&nbsp;balancing";
$alarm_short[7][2]="Cell&nbsp;14&nbsp;balancing";
$alarm_short[7][3]="Cell&nbsp;13&nbsp;balancing";
$alarm_short[7][4]="Cell&nbsp;12&nbsp;balancing";
$alarm_short[7][5]="Cell&nbsp;11&nbsp;balancing";
$alarm_short[7][6]="Cell&nbsp;10&nbsp;balancing";
$alarm_short[7][7]="Cell&nbsp;9&nbsp;balancing";
$alarm_short[8][0]="Dsg&nbsp;OC";
$alarm_short[8][1]="Chg&nbsp;OC";
$alarm_short[8][2]="CUV";
$alarm_short[8][3]="COV";
$alarm_short[8][4]="PUV";
$alarm_short[8][5]="POV";
$alarm_short[9][0]="SOC&nbsp;Low";
$alarm_short[9][1]="MOS&nbsp;OT";
$alarm_short[9][2]="Env&nbsp;UT";
$alarm_short[9][3]="Env&nbsp;OT";
$alarm_short[9][4]="Dsg&nbsp;UT";
$alarm_short[9][5]="Chg&nbsp;UT";
$alarm_short[9][6]="Dsg&nbsp;OT";
$alarm_short[9][7]="Chg&nbsp;OT";

if($_GET['short'] == 'no'){
	$alarm=$alarm_long;
}else{
	$alarm=$alarm_short;
}
//echo "<pre>";
//print_r($alarm);
function get_alarm($val,$status){
	$val= trim($val);
	if($status == "0"){
		if($val == "0"){
			$alarm='<span class="label label-success">Normal</span>';
		}elseif($val == "1"){
			$alarm='<span class="label label-warning">Below Lower Limit</span>';
		}elseif($val == "2"){
			$alarm='<span class="label label-warning">Above Higher Limit</span>';
		}else{
			$alarm='<span class="label label-warning">Other Error</span>';
		}
	}else{
		if($status == "1"){
			if(substr($val,1,1) == "0"){
				$alarm[]="Normal";
			}else{
				$alarm[]="Protect";
			}
			if(substr($val,2,1) == "0"){
				$alarm[]="Normal";
			}else{
				$alarm[]="Protect";
			}
			if(substr($val,3,1) == "0"){
				$alarm[]="Normal";
			}else{
				$alarm[]="Protect";
			}
			if(substr($val,4,1) == "0"){
				$alarm[]="Normal";
			}else{
				$alarm[]="Protect";
			}
			if(substr($val,5,1) == "0"){
				$alarm[]="Normal";
			}else{
				$alarm[]="Protect";
			}
			if(substr($val,6,1) == "0"){
				$alarm[]="Normal";
			}else{
				$alarm[]="Protect";
			}
			if(substr($val,7,1) == "0"){
				$alarm[]="Normal";
			}else{
				$alarm[]="Protect";
			}
		}elseif($status == "2"){
			if(substr($val,0,1) == "0"){
				$alarm[]="No";
			}else{
				$alarm[]="Yes";
			}
			if(substr($val,1,1) == "0"){
				$alarm[]="Normal";
			}else{
				$alarm[]="Protect";
			}
			if(substr($val,2,1) == "0"){
				$alarm[]="Normal";
			}else{
				$alarm[]="Protect";
			}
			if(substr($val,3,1) == "0"){
				$alarm[]="Normal";
			}else{
				$alarm[]="Protect";
			}
			if(substr($val,4,1) == "0"){
				$alarm[]="Normal";
			}else{
				$alarm[]="Protect";
			}
			if(substr($val,5,1) == "0"){
				$alarm[]="Normal";
			}else{
				$alarm[]="Protect";
			}
			if(substr($val,6,1) == "0"){
				$alarm[]="Normal";
			}else{
				$alarm[]="Protect";
			}
			if(substr($val,7,1) == "0"){
				$alarm[]="Normal";
			}else{
				$alarm[]="Protect";
			}
		}elseif($status == "3"){
			if(substr($val,0,1) == "0"){
				$alarm[]="Off";
			}else{
				$alarm[]="On";
			}
			if(substr($val,2,1) == "0"){
				$alarm[]="No";
			}else{
				$alarm[]="Yes";
			}
			if(substr($val,4,1) == "0"){
				$alarm[]="Off";
			}else{
				$alarm[]="On";
			}
			if(substr($val,5,1) == "0"){
				$alarm[]="Off";
			}else{
				$alarm[]="On";
			}
			if(substr($val,6,1) == "0"){
				$alarm[]="Off";
			}else{
				$alarm[]="On";
			}
			if(substr($val,7,1) == "0"){
				$alarm[]="Off";
			}else{
				$alarm[]="On";
			}
		}elseif($status == "4"){
			
			if(substr($val,2,1) == "0"){
				$alarm[]="Disable";
			}else{
				$alarm[]="Enable";
			}
			if(substr($val,3,1) == "0"){
				$alarm[]="Disable";
			}else{
				$alarm[]="Enable";
			}
			if(substr($val,4,1) == "0"){
				$alarm[]="10A";
			}else{
				$alarm[]="5A";
			}
			
			if(substr($val,7,1) == "0"){
				$alarm[]="Disable";
			}else{
				$alarm[]="Enable";
			}
		}elseif($status == "5"){
			if(substr($val,2,1) == "0"){
				$alarm[]="Normal";
			}else{
				$alarm[]="Fault";
			}
			if(substr($val,3,1) == "0"){
				$alarm[]="Normal";
			}else{
				$alarm[]="Fault";
			}
			if(substr($val,5,1) == "0"){
				$alarm[]="Normal";
			}else{
				$alarm[]="Fault";
			}
			if(substr($val,6,1) == "0"){
				$alarm[]="Normal";
			}else{
				$alarm[]="Fault";
			}
			if(substr($val,7,1) == "0"){
				$alarm[]="Normal";
			}else{
				$alarm[]="Fault";
			}
		}elseif($status == "6"){
			if(substr($val,0,1) == "0"){
				$alarm[]="Off";
			}else{
				$alarm[]="On";
			}
			if(substr($val,1,1) == "0"){
				$alarm[]="Off";
			}else{
				$alarm[]="On";
			}
			if(substr($val,2,1) == "0"){
				$alarm[]="Off";
			}else{
				$alarm[]="On";
			}
			if(substr($val,3,1) == "0"){
				$alarm[]="Off";
			}else{
				$alarm[]="On";
			}
			if(substr($val,4,1) == "0"){
				$alarm[]="Off";
			}else{
				$alarm[]="On";
			}
			if(substr($val,5,1) == "0"){
				$alarm[]="Off";
			}else{
				$alarm[]="On";
			}
			if(substr($val,6,1) == "0"){
				$alarm[]="Off";
			}else{
				$alarm[]="On";
			}
			if(substr($val,7,1) == "0"){
				$alarm[]="Off";
			}else{
				$alarm[]="On";
			}
		}elseif($status == "7"){
			if(substr($val,0,1) == "0"){
				$alarm[]="Off";
			}else{
				$alarm[]="On";
			}
			if(substr($val,1,1) == "0"){
				$alarm[]="Off";
			}else{
				$alarm[]="On";
			}
			if(substr($val,2,1) == "0"){
				$alarm[]="Off";
			}else{
				$alarm[]="On";
			}
			if(substr($val,3,1) == "0"){
				$alarm[]="Off";
			}else{
				$alarm[]="On";
			}
			if(substr($val,4,1) == "0"){
				$alarm[]="Off";
			}else{
				$alarm[]="On";
			}
			if(substr($val,5,1) == "0"){
				$alarm[]="Off";
			}else{
				$alarm[]="On";
			}
			if(substr($val,6,1) == "0"){
				$alarm[]="Off";
			}else{
				$alarm[]="On";
			}
			if(substr($val,7,1) == "0"){
				$alarm[]="Off";
			}else{
				$alarm[]="On";
			}
		}elseif($status == "8"){
			if(substr($val,2,1) == "0"){
				$alarm[]="Normal";
			}else{
				$alarm[]="Warning";
			}
			if(substr($val,3,1) == "0"){
				$alarm[]="Normal";
			}else{
				$alarm[]="Warning";
			}
			if(substr($val,4,1) == "0"){
				$alarm[]="Normal";
			}else{
				$alarm[]="Warning";
			}
			if(substr($val,5,1) == "0"){
				$alarm[]="Normal";
			}else{
				$alarm[]="Warning";
			}
			if(substr($val,6,1) == "0"){
				$alarm[]="Normal";
			}else{
				$alarm[]="Warning";
			}
			if(substr($val,7,1) == "0"){
				$alarm[]="Normal";
			}else{
				$alarm[]="Warning";
			}
		}elseif($status == "9"){
			if(substr($val,0,1) == "0"){
				$alarm[]="Normal";
			}else{
				$alarm[]="Warning";
			}
			if(substr($val,1,1) == "0"){
				$alarm[]="Normal";
			}else{
				$alarm[]="Warning";
			}
			if(substr($val,2,1) == "0"){
				$alarm[]="Normal";
			}else{
				$alarm[]="Warning";
			}
			if(substr($val,3,1) == "0"){
				$alarm[]="Normal";
			}else{
				$alarm[]="Warning";
			}
			if(substr($val,4,1) == "0"){
				$alarm[]="Normal";
			}else{
				$alarm[]="Warning";
			}
			if(substr($val,5,1) == "0"){
				$alarm[]="Normal";
			}else{
				$alarm[]="Warning";
			}
			if(substr($val,6,1) == "0"){
				$alarm[]="Normal";
			}else{
				$alarm[]="Warning";
			}
			if(substr($val,7,1) == "0"){
				$alarm[]="Normal";
			}else{
				$alarm[]="Warning";
			}
		}
		$alarm=implode(",",$alarm);
	}
	return $alarm;
}
	$latest_qid="select qid from tmp_alarm where pack_id = '1' order by id desc limit 0,1";
	$rq=myQueryDb($latest_qid);
	$latest_qid=myFetchDb($rq);
	$latest_qid=$latest_qid['qid'];
	
	if ($_GET['pack_id']=="all")
	{
		$sql = "select * from tmp_alarm where qid = '".$latest_qid."' order by waktu desc limit 0,1";
		$res=myQueryDb($sql);
		$data=myFetchDb($res);
	}
	else
	{
		$sql = "select * from tmp_alarm where qid = '".$latest_qid."' and pack_id=".$_GET['pack_id']." order by waktu desc limit 0,1";
		$res=myQueryDb($sql);
		$data=myFetchDb($res);
	}
	
    //$sql_addr="select pack_id from tmp_alarm where waktu = '".$data['waktu']."' order by pack_id asc";
    $sql_addr="select pack_id from tmp_alarm where qid = '".$latest_qid."' order by pack_id asc";
	$radd=myQueryDb($sql_addr);
?>
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
            Dashboard <small>Battery Data Logger</small>
        </h1>
        <ol class="breadcrumb">
            <li>
               <a href="main.php?page_id=dashboard&pack_id=all">
					<i class="fa fa-dashboard"></i> Alarm
			   </a>
            </li>
			<li class="active">Alarm Overview</li>
        </ol>
    </div>
</div>
<!-- /.row -->

<div class="row">
    <div class="col-lg-12">
        <ul class="nav nav-tabs">
			<li id="packall"><a data-toggle="tab" href="#packall">Pack All</a></li>
            <?php
            while($rowadd=myFetchDb($radd))
            {
				$pack_array [] = $rowadd['pack_id'];
            }
			asort($pack_array);
			for ($i=1;$i<=count($pack_array);$i++)
			{
				?>
					<li id="pack<?=$i?>"><a data-toggle="tab" href="#pack<?=$i?>">Pack <?=$i?></a></li>
				<?php	
			}
            ?>
        </ul>

        <div class="tab-content">
            <!-- tab content home -->
            <?php
            while($rowadd=myFetchDb($radd))
            {
            	for ($i=1;$i<=16;$i++)
            	{
            		if (($data['cell_'.$i]=="" && $data['temp_'.$i]==""))
            		{
            			echo "-";
            		}
            	}
            ?>
			
            <div id="pack<?=$rowadd['pack_id']?>" class="tab-pane fade in">
               <div class="row">
                    <div class="col-sm-6">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-info"></i> Cell Alarm (Pack <?=$rowadd['pack_id']?>)</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr class="bg-warning">
                                                <th>Cell</th>
                                                <th>Voltage</th>
                                                <th>Temperature</th>
                                                <th>Balancing</th>
                                                <?php
                                                	$all_balance_1 = get_alarm($data['status_6'],6);
                                                	$all_balance_2 = get_alarm($data['status_7'],7);
                                                	$balance[1]=explode(',',$all_balance_1)[7];
                                                	$balance[2]=explode(',',$all_balance_1)[6];
                                                	$balance[3]=explode(',',$all_balance_1)[5];
                                                	$balance[4]=explode(',',$all_balance_1)[4];
                                                	$balance[5]=explode(',',$all_balance_1)[3];
                                                	$balance[6]=explode(',',$all_balance_1)[2];
                                                	$balance[7]=explode(',',$all_balance_1)[1];
                                                	$balance[8]=explode(',',$all_balance_1)[0];
                                                	
                                                	$balance[9]=explode(',',$all_balance_2)[7];
                                                	$balance[10]=explode(',',$all_balance_2)[6];
                                                	$balance[11]=explode(',',$all_balance_2)[5];
                                                	$balance[12]=explode(',',$all_balance_2)[4];
                                                	$balance[13]=explode(',',$all_balance_2)[3];
                                                	$balance[14]=explode(',',$all_balance_2)[2];
                                                	$balance[15]=explode(',',$all_balance_2)[1];
                                                	$balance[16]=explode(',',$all_balance_2)[0];
                                                ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
                                        	for($i=1;$i<17;$i++){ ?>
                                        		<tr>
                                        			<td>Cell <?=$i?></td>
                                        			<td><?=get_alarm($data['cell_'.$i],0)?></td>
                                        			<td><?=get_alarm($data['temp_'.$i],0)?></td>
                                        			<?php
                                        			if($balance[$i] == 'Off'){
                                        				echo '<td><span class="label label-success">'.$balance[$i].'</span></td>';
                                        			}else{
                                        				echo '<td><span class="label label-primary">'.$balance[$i].'</span></td>';
                                        			}
                                        			?>
                                        			
                                        		</tr>
                                        	<?php
                                        	}
                                        	?>
                                        	
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                	<i class="fa fa-info"></i> Common Alarm (Pack <?=$rowadd['pack_id']?>)
                                </h3>
                            </div>
                            <div class="panel-body">
                            	<?php
                            	if($_GET['short'] == 'no'){
                            		$url=str_replace("&short=no","",$_SERVER['REQUEST_URI']);
                            		$url="http://".$_SERVER['SERVER_NAME'].$url."&short=yes";
                            		$bv="Short Alarm Name";                      		
                            	}else{
                            		$url=str_replace("&short=yes","",$_SERVER['REQUEST_URI']);
                            		$url="http://".$_SERVER['SERVER_NAME'].$url."&short=no";
                            		$bv="Long Alarm Name";
                            	}
                            	?>
                            	<p><button type="button" class="btn btn-primary btn-sm" onclick="location.href='<?=$url?>';" data-toggle="button"><?=$bv?></button></p>
                                <div class="table">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr class="bg-warning">
                                                <th>Detail Name</th>
                                                <th>Value</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td width="50%">Battery Voltage</td>
                                                <td><?=get_alarm($data['bat_volt'],0)?></td>
                                            </tr>
                                            <tr>
                                                <td>Battery Current</td>
                                                <td><?=get_alarm($data['bat_cur'],0)?></td>
                                            </tr>
                                            <tr>
                                                <td>Discharge Current</td>
                                                <td><?=get_alarm($data['dis_cur'],0)?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    								
									<table class="table table-bordered table-hover table-striped">
										<thead>
											<tr class="bg-warning">
												<th>System Status</th>
											</tr>
										</thead>
										<tbody>
											<tr style="background-color: #ffffff;color:#FFFFFF;">
												<td>
													<div class="row">
														
														<div class="col-sm-12">
															<?php															
											            	$tmp=get_alarm($data['status_3'],3);
											            	$tmp_al=explode(",",$tmp);
											            	foreach($tmp_al as $key => $val){
											            		if( ($val == "Normal") || ($val == "No") || ($val == "Off") || ($val == "Disable") || ($val == "10A") ){
											            			echo '<span class="label label-success">'.$alarm[3][$key]."&nbsp;:&nbsp;".$val.'</span> ';
												            	}else{
												            		echo '<span class="label label-primary">'.$alarm[3][$key]."&nbsp;:&nbsp;".$val.'</span> ';
												            	}
												            }
															?>
														</div>
													</div>
												</td>		
											</tr>
										</tbody>
									</table>	
									
									<table class="table table-bordered table-hover table-striped">
										<thead>
											<tr class="bg-warning">
												<th>Alarm Status</th>
											</tr>
										</thead>
										<tbody>
											<tr style="background-color: #ffffff;color:#FFFFFF;">
												<td>
													<div class="row">
														
														<div class="col-sm-12">
															<?php															
											            	$tmp=get_alarm($data['status_8'],8);
											            	$tmp_al=explode(",",$tmp);
											            	foreach($tmp_al as $key => $val){
											            		if( ($val == "Normal") || ($val == "No") || ($val == "Off") || ($val == "Disable") || ($val == "10A") ){
											            			echo '<span class="label label-success">'.$alarm[8][$key]."&nbsp;:&nbsp;".$val.'</span> ';
												            	}else{
												            		echo '<span class="label label-danger">'.$alarm[8][$key]."&nbsp;:&nbsp;".$val.'</span> ';
												            	}
												            }
												            $tmp=get_alarm($data['status_9'],9);
											            	$tmp_al=explode(",",$tmp);
											            	foreach($tmp_al as $key => $val){
											            		if( ($val == "Normal") || ($val == "No") || ($val == "Off") || ($val == "Disable") || ($val == "10A") ){
											            			echo '<span class="label label-success">'.$alarm[9][$key]."&nbsp;:&nbsp;".$val.'</span> ';
												            	}else{
												            		echo '<span class="label label-danger">'.$alarm[9][$key]."&nbsp;:&nbsp;".$val.'</span> ';
												            	}
												            }
															?>
														</div>
													</div>
												</td>		
											</tr>
										</tbody>
									</table>
									
									<table class="table table-bordered table-hover table-striped">
										<thead>
											<tr class="bg-warning">
												<th>Protect Status</th>
											</tr>
										</thead>
										<tbody>
											<tr style="background-color: #ffffff;color:#FFFFFF;">
												<td>
													<div class="row">
														
														<div class="col-sm-12">
															<?php
															$tmp=get_alarm($data['status_1'],1);
											            	$tmp_al=explode(",",$tmp);
											            	foreach($tmp_al as $key => $val){
											            		if( ($val == "Normal") || ($val == "No") || ($val == "Off") || ($val == "Disable") || ($val == "10A") ){
											            			echo '<span class="label label-success">'.$alarm[1][$key]."&nbsp;:&nbsp;".$val.'</span> ';
												            	}else{
												            		echo '<span class="label label-danger">'.$alarm[1][$key]."&nbsp;:&nbsp;".$val.'</span> ';
												            	}
												            }
												            $tmp=get_alarm($data['status_2'],2);
											            	$tmp_al=explode(",",$tmp);
											            	foreach($tmp_al as $key => $val){
											            		if( ($val == "Normal") || ($val == "No") || ($val == "Off") || ($val == "Disable") || ($val == "10A") ){
											            			echo '<span class="label label-success">'.$alarm[2][$key]."&nbsp;:&nbsp;".$val.'</span> ';
												            	}else{
												            		echo '<span class="label label-danger">'.$alarm[2][$key]."&nbsp;:&nbsp;".$val.'</span> ';
												            	}
												            }
															?>
														</div>
													</div>
												</td>		
											</tr>
										</tbody>
									</table>
									
									<table class="table table-bordered table-hover table-striped">
										<thead>
											<tr class="bg-warning">
												<th>Fault Status</th>
											</tr>
										</thead>
										<tbody>
											<tr style="background-color: #ffffff;color:#FFFFFF;">
												<td>
													<div class="row">
														
														<div class="col-sm-12">
															<?php
															$tmp=get_alarm($data['status_5'],5);
											            	$tmp_al=explode(",",$tmp);
											            	foreach($tmp_al as $key => $val){
											            		if( ($val == "Normal") || ($val == "No") || ($val == "Off") || ($val == "Disable") || ($val == "10A") ){
											            			echo '<span class="label label-success">'.$alarm[5][$key]."&nbsp;:&nbsp;".$val.'</span> ';
												            	}else{
												            		echo '<span class="label label-primary">'.$alarm[5][$key]."&nbsp;:&nbsp;".$val.'</span> ';
												            	}
												            }
															?>
														</div>
													</div>
												</td>		
											</tr>
										</tbody>
									</table>
									
									<table class="table table-bordered table-hover table-striped">
										<thead>
											<tr class="bg-warning">
												<th>Switch Control</th>
											</tr>
										</thead>
										<tbody>
											<tr style="background-color: #ffffff;color:#FFFFFF;">
												<td>
													<div class="row">
														
														<div class="col-sm-12">
															<?php
															$tmp=get_alarm($data['status_4'],4);
											            	$tmp_al=explode(",",$tmp);
											            	foreach($tmp_al as $key => $val){
											            		if( ($val == "Normal") || ($val == "No") || ($val == "Off") || ($val == "Disable") || ($val == "10A") ){
											            			echo '<span class="label label-primary">'.$alarm[4][$key]."&nbsp;:&nbsp;".$val.'</span> ';
												            	}else{
												            		echo '<span class="label label-primary">'.$alarm[4][$key]."&nbsp;:&nbsp;".$val.'</span> ';
												            	}
												            }
															?>
														</div>
													</div>
												</td>		
											</tr>
										</tbody>
									</table>
									
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- div pack -->
            <?php
            } //end while
			
			//PACK ALL			
			if ($_GET['pack_id'] =="all")
			{
				?>
				<div class="container-fluid">
					<div class="row">
						<div class="panel panel-info" style="width: 100% !important">
							 <div class="panel-heading">
								<h3 class="panel-title"><i class="fa fa-info"></i> Alarm Overview (All Pack)</h3>
							</div>
						<div class="panel-body">
							<div class="table-responsive">
							<table class="table table-bordered table-hover table-striped" style="font-size: x-small">
								 <thead>
									<tr class="bg-warning">
										<td>
											<a href="http://<?=$_SERVER['SERVER_NAME'].'/download.php?type=alarm';?>">Download&nbsp;Log</a>
										</td>
										<th>Batt&nbsp;Volt</th>
										<th>Batt&nbsp;Curr</th>
										<th>Disc&nbsp;Curr</th>
										<?php
											for($c=1;$c<=16;$c++)
											{
												?>
												<th>
													Cell&nbsp;<?=$c?>
												</th>
												<?php
											}
										?>
										<?php
											for($t=1;$t<=16;$t++)
											{
												?>
												<th>
													Temp&nbsp;<?=$t?> 
												</th>
												<?php
											}
										?>
									</tr>
									<?php
										while($rowadd=myFetchDb($radd))
										{
											$pack_array_all[] = $rowadd['pack_id'];
										}
										asort($pack_array_all);
										for ($k=1;$k<=count($pack_array_all);$k++)
										{
											?>
												<tr>
													<th class="bg-success">
														Pack&nbsp;<?=$k?>
													</th>
													<?php
													$sql_pack = "select * from tmp_alarm where pack_id ='".$k."' order by waktu desc";
													$res_pack=myQueryDb($sql_pack);
													$main_pack=myFetchDb($res_pack);
													?>
													<td><?=get_alarm($main_pack['bat_cur'],0)?></td>
													<td><?=get_alarm($main_pack['bat_volt'],0)?></td>
													<td><?=get_alarm($main_pack['dis_cur'],0)?></td>
													<?php
														for($m=1;$m<=16;$m++)
														{
															?>
																<td><?=get_alarm($main_pack['cell_'.$m],0)?></td>
															<?php
														}
													?>
													<?php
														for($n=1;$n<=16;$n++)
														{
															?>
																<td><?=get_alarm($main_pack['temp_'.$n],0)?></td>
															<?php
														}
													?>
												</tr>
											<?php	
										}
									?>
								</thead>
							</table>
							</div>
						</div>
					</div>
				</div>
			</div>
				<?php
			}
            ?>
			
        </div>
        <!--  tab content      -->

    </div>
</div>
<!-- end row -->
