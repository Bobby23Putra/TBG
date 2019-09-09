<?php
ini_set('session.save_path','/media/data/log');
//session_start();
require_once("config/db_con.php");
myOpenDb();
$site=mySingleData('setting','setting_value','setting_name','site_id');

if($_GET['type'] == "data"){
	$query="SELECT * FROM log order by id asc";
	$result = myQueryDb($query);

	$headers = array();
	//$headers[] = 'ID';
	$headers[] = 'Date';
	$headers[] = 'Pack';
	$headers[] = 'Cell 1 (V)';
	$headers[] = 'Cell 2';
	$headers[] = 'Cell 3';
	$headers[] = 'Cell 4';
	$headers[] = 'Cell 5';
	$headers[] = 'Cell 6';
	$headers[] = 'Cell 7';
	$headers[] = 'Cell 8';
	$headers[] = 'Cell 9';
	$headers[] = 'Cell 10';
	$headers[] = 'Cell 11';
	$headers[] = 'Cell 12';
	$headers[] = 'Cell 13';
	$headers[] = 'Cell 14';
	$headers[] = 'Cell 15';
	$headers[] = 'Cell 16';
	$headers[] = 'Temp 1 (C)';
	$headers[] = 'Temp 2';
	$headers[] = 'Temp 3';
	$headers[] = 'Temp 4';
	$headers[] = 'Temp 5';
	$headers[] = 'Temp 6';
	$headers[] = 'Temp 7';
	$headers[] = 'Temp 8';
	$headers[] = 'Temp 9';
	$headers[] = 'Temp 10';
	$headers[] = 'Temp 11';
	$headers[] = 'Temp 12';
	$headers[] = 'Temp 13';
	$headers[] = 'Temp 14';
	$headers[] = 'Temp 15';
	$headers[] = 'Temp 16';
	$headers[] = 'Temp Mossfet';
	$headers[] = 'Temp Env';
	$headers[] = 'Batt Current (A)';
	$headers[] = 'Batt Volt (V)';
	$headers[] = 'SOC';
	$headers[] = 'Full Cap';
	$headers[] = 'Dis - Charge Cycle Count';
	$headers[] = 'Design Cap';

	$fp = fopen('php://output', 'w');
	$fn = "LOG_DATA_UNIT_".$site."_".date('Y_m_d_H_M');
	if ($fp && $result) {
		header('Content-Type: text/csv');
		header('Content-Disposition: attachment; filename="'.$fn.'.csv"');
		header('Pragma: no-cache');
		header('Expires: 0');
		fputcsv($fp, $headers);
				
		while($row=myFetchDb($result)){
			unset($row['id']);
			unset($row['site_id']);
			unset($row['synced']);
			unset($row['balance']);
			unset($row['qid']);
			fputcsv($fp, array_values($row));
		}
	}
}else{
	$query="SELECT * FROM alarm order by id asc";
	$result = myQueryDb($query);

	$headers = array();
	$headers[] = 'Date';
	$headers[] = 'Pack';
	$headers[] = 'Cell 1 (V)';
	$headers[] = 'Cell 2';
	$headers[] = 'Cell 3';
	$headers[] = 'Cell 4';
	$headers[] = 'Cell 5';
	$headers[] = 'Cell 6';
	$headers[] = 'Cell 7';
	$headers[] = 'Cell 8';
	$headers[] = 'Cell 9';
	$headers[] = 'Cell 10';
	$headers[] = 'Cell 11';
	$headers[] = 'Cell 12';
	$headers[] = 'Cell 13';
	$headers[] = 'Cell 14';
	$headers[] = 'Cell 15';
	$headers[] = 'Cell 16';
	$headers[] = 'Temp 1 (C)';
	$headers[] = 'Temp 2';
	$headers[] = 'Temp 3';
	$headers[] = 'Temp 4';
	$headers[] = 'Temp 5';
	$headers[] = 'Temp 6';
	$headers[] = 'Temp 7';
	$headers[] = 'Temp 8';
	$headers[] = 'Temp 9';
	$headers[] = 'Temp 10';
	$headers[] = 'Temp 11';
	$headers[] = 'Temp 12';
	$headers[] = 'Temp 13';
	$headers[] = 'Temp 14';
	$headers[] = 'Temp 15';
	$headers[] = 'Temp 16';
	$headers[] = 'Temp Mossfet';
	$headers[] = 'Temp Env';
	$headers[] = 'Charging Current';
	$headers[] = 'Voltage';
	$headers[] = 'Discharging Current';
	$headers[] = 'Status 1 - Short Circuit';
	$headers[] = 'Status 1 - Disch Over Current';
	$headers[] = 'Status 1 - Charging Over Current';
	$headers[] = 'Status 1 - Pack Under Voltage';
	$headers[] = 'Status 1 - Pack Over Voltage';
	$headers[] = 'Status 1 - Cell Under Voltage';
	$headers[] = 'Status 1 - Cell Over Voltage';
	
	$headers[] = 'Status 2 - Fully';
	$headers[] = 'Status 2 - Env Under Tempr';
	$headers[] = 'Status 2 - Env Over Tempr';
	$headers[] = 'Status 2 - MOSFET Over Tempr';
	$headers[] = 'Status 2 - Disch Under Tempr';
	$headers[] = 'Status 2 - Charging Under Tempr';
	$headers[] = 'Status 2 - Disch Over Tempr';
	$headers[] = 'Status 2 - Charging Over Tempr';
	
	$headers[] = 'Status 3 - State of Heater';
	$headers[] = 'Status 3 - AC - In';
	$headers[] = 'Status 3 - Power Supply';
	$headers[] = 'Status 3 - Disch MOSFET';
	$headers[] = 'Status 3 - Charging MOSFET';
	$headers[] = 'Status 3 - Current Limiting Circuit';
	
	$headers[] = 'Status 4 - LED-Warning Fn';
	$headers[] = 'Status 4 - Current Limits Fn';
	$headers[] = 'Status 4 - Current Limits Control';
	$headers[] = 'Status 4 - Buzzer Warning Fn';
	
	$headers[] = 'Status 5 - Sampling';
	$headers[] = 'Status 5 - Battery Voltage';
	$headers[] = 'Status 5 - Tempr NTC';
	$headers[] = 'Status 5 - Charging MOSFET';
	$headers[] = 'Status 5 - Disch MOSFET';
	
	$headers[] = 'Status 6 - Cell 8 Balancing';
	$headers[] = 'Status 6 - Cell 7 Balancing';
	$headers[] = 'Status 6 - Cell 6 Balancing';
	$headers[] = 'Status 6 - Cell 5 Balancing';
	$headers[] = 'Status 6 - Cell 4 Balancing';
	$headers[] = 'Status 6 - Cell 3 Balancing';
	$headers[] = 'Status 6 - Cell 2 Balancing';
	$headers[] = 'Status 6 - Cell 1 Balancing';
	
	$headers[] = 'Status 7 - Cell 16 Balancing';
	$headers[] = 'Status 7 - Cell 15 Balancing';
	$headers[] = 'Status 7 - Cell 14 Balancing';
	$headers[] = 'Status 7 - Cell 13 Balancing';
	$headers[] = 'Status 7 - Cell 12 Balancing';
	$headers[] = 'Status 7 - Cell 11 Balancing';
	$headers[] = 'Status 7 - Cell 10 Balancing';
	$headers[] = 'Status 7 - Cell 9 Balancing';
	
	$headers[] = 'Status 8 - Disch Over Current';
	$headers[] = 'Status 8 - Charging Over Current';
	$headers[] = 'Status 8 - Cell Under Voltage';
	$headers[] = 'Status 8 - Cell Over Voltage';
	$headers[] = 'Status 8 - Pack Under Voltage';
	$headers[] = 'Status 8 - Pack Over Voltage';
	
	$headers[] = 'Status 9 - SOC Low';
	$headers[] = 'Status 9 - MOS Over Tempr';
	$headers[] = 'Status 9 - Env Under Tempr';
	$headers[] = 'Status 9 - Env Over Tempr';
	$headers[] = 'Status 9 - Disch Under Tempr';
	$headers[] = 'Status 9 - Charging Under Tempr';
	$headers[] = 'Status 9 - Disch Over Tempr';
	$headers[] = 'Status 9 - Charging Over Tempr';

	function get_alarm($val,$status){
	$val= trim($val);
	if($status == "0"){
		if($val == "0"){
			$alarm='Normal';
		}elseif($val == "1"){
			$alarm='Below Lower Limit';
		}elseif($val == "2"){
			$alarm='Above Higher Limit';
		}else{
			$alarm='Other Error';
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
	
	
	$fp = fopen('php://output', 'w');
	$fn = "LOG ALARM_UNIT_".$site."_".date('Y_m_d_H_M');
	if ($fp && $result) {
		header('Content-Type: text/csv');
		header('Content-Disposition: attachment; filename="'.$fn.'.csv"');
		header('Pragma: no-cache');
		header('Expires: 0');
		fputcsv($fp, $headers);
				
		while($row=myFetchDb($result)){
						
			$array = array($row['waktu'],$row['pack_id'],get_alarm($row['cell_1'],0),get_alarm($row['cell_2'],0),get_alarm($row['cell_3'],0),get_alarm($row['cell_4'],0),get_alarm($row['cell_5'],0),get_alarm($row['cell_6'],0),get_alarm($row['cell_7'],0),get_alarm($row['cell_8'],0),get_alarm($row['cell_9'],0),get_alarm($row['cell_10'],0),get_alarm($row['cell_11'],0),get_alarm($row['cell_12'],0),get_alarm($row['cell_13'],0),get_alarm($row['cell_14'],0),get_alarm($row['cell_15'],0),get_alarm($row['cell_16'],0),get_alarm($row['temp_1'],0),get_alarm($row['temp_2'],0),get_alarm($row['temp_3'],0),get_alarm($row['temp_4'],0),get_alarm($row['temp_5'],0),get_alarm($row['temp_6'],0),get_alarm($row['temp_7'],0),get_alarm($row['temp_8'],0),get_alarm($row['temp_9'],0),get_alarm($row['temp_10'],0),get_alarm($row['temp_11'],0),get_alarm($row['temp_12'],0),get_alarm($row['temp_13'],0),get_alarm($row['temp_14'],0),get_alarm($row['temp_15'],0),get_alarm($row['temp_16'],0),get_alarm($row['temp_mossfet'],0),get_alarm($row['temp_env'],0),get_alarm($row['bat_cur'],0),get_alarm($row['bat_volt'],0),get_alarm($row['dis_cur'],0));
			
			for($i=1;$i<10;$i++){
				$arr_tmp=array();
				$arr_tmp=explode(",",get_alarm($row['status_'.$i],$i));
				foreach($arr_tmp as $val){
					array_push($array,$val);
				}
			}
			fputcsv($fp, $array);
		}
	}
}
?>
