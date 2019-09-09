<?php
$temp=`python /home/pi/code/query_modbus.py 1 0 1`;
$hum=`python /home/pi/code/query_modbus.py 1 1 1`;
//echo $temp."\n".$hum;
$temp=trim($temp);
$hum=trim($hum);
if($temp == "Error"){
	$temp = "0";
}else{
	$temp = $temp / 100;
}
if($hum == "Error"){
	$hum = "0";
}else{
	$hum = $hum / 100;
}
echo $temp.";".$hum;
?>
