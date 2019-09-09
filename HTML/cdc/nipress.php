<?php
require_once("db_con.php");
myOpenDb();
$site_id = mySingleData('setting','setting_value','setting_name','site_id');
$data = trim($argv[1]);
$pulsa= trim($argv[2]);
$addr= trim($argv[3]);
$now= trim($argv[4]);

$data = explode("-",$data);
$cell1=hexdec($data[19].$data[20].$data[21].$data[22])/1000;
$cell2=hexdec($data[23].$data[24].$data[25].$data[26])/1000;
$cell3=hexdec($data[27].$data[28].$data[29].$data[30])/1000;
$cell4=hexdec($data[31].$data[32].$data[33].$data[34])/1000;
$cell5=hexdec($data[35].$data[36].$data[37].$data[38])/1000;
$cell6=hexdec($data[39].$data[40].$data[41].$data[42])/1000;
$cell7=hexdec($data[43].$data[44].$data[45].$data[46])/1000;
$cell8=hexdec($data[47].$data[48].$data[49].$data[50])/1000;
$cell9=hexdec($data[51].$data[52].$data[53].$data[54])/1000;
$cell10=hexdec($data[55].$data[56].$data[57].$data[58])/1000;
$cell11=hexdec($data[59].$data[60].$data[61].$data[62])/1000;
$cell12=hexdec($data[63].$data[64].$data[65].$data[66])/1000;
$cell13=hexdec($data[67].$data[68].$data[69].$data[70])/1000;
$cell14=hexdec($data[71].$data[72].$data[73].$data[74])/1000;
$cell15=hexdec($data[75].$data[76].$data[77].$data[78])/1000;
$temp_number=hexdec($data[79].$data[80]);
$x=80;
for($i=1;$i<=$temp_number;$i++){
	$x1 = $x + 1;
	$x2 = $x + 2;
	$x3 = $x + 3;
	$x4 = $x + 4;
	$x=$x4;
	${"temp" . $i} = hexdec($data[$x1].$data[$x2].$data[$x3].$data[$x4])/100;
}
if($temp_number < 17){
	for($a=$temp_number+1;$a<=17;$a++){
		${"temp" . $a} = "0";
	}
}

$batcur=hexdec($data[$x+1].$data[$x+2].$data[$x+3].$data[$x+4])/100;
$batvolt=hexdec($data[$x+5].$data[$x+6].$data[$x+7].$data[$x+8])/1000;
$soc=hexdec($data[$x+9].$data[$x+10].$data[$x+11].$data[$x+12])/100;
$full_cap=hexdec($data[$x+15].$data[$x+16].$data[$x+17].$data[$x+18])/100;
$cycle_count=hexdec($data[$x+19].$data[$x+20].$data[$x+21].$data[$x+22]);
$des_cap=hexdec($data[$x+23].$data[$x+24].$data[$x+25].$data[$x+26])/100;


$ins="insert into log (waktu,site_id,pack_id,cell_1,cell_2,cell_3,cell_4,cell_5,cell_6,cell_7,cell_8,cell_9,cell_10,cell_11,cell_12,cell_13,cell_14,cell_15,temp_1,temp_2,temp_3,temp_4,temp_5,temp_6,temp_7,temp_8,temp_9,temp_10,temp_11,temp_12,temp_13,temp_14,temp_15,temp_mossfet,temp_env,bat_cur,bat_volt,soc,full_cap,cycle_count,des_cap,balance) values ('".$now."','".$site_id."','".$addr."','".$cell1."','".$cell2."','".$cell3."','".$cell4."','".$cell5."','".$cell6."','".$cell7."','".$cell8."','".$cell9."','".$cell10."','".$cell11."','".$cell12."','".$cell13."','".$cell14."','".$cell15."','".$temp1."','".$temp2."','".$temp3."','".$temp4."','".$temp5."','".$temp6."','".$temp7."','".$temp8."','".$temp9."','".$temp10."','".$temp11."','".$temp12."','".$temp13."','".$temp14."','".$temp15."','".$temp16."','".$temp17."','".$batcur."','".$batvolt."','".$soc."','".$full_cap."','".$cycle_count."','".$des_cap."','".$pulsa."')";
$res=myQueryDb($ins);
?>
