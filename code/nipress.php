<?php
require_once("db_con.php");
myOpenDb();
$site_id = mySingleData('setting','setting_value','setting_name','site_id');
$data = trim($argv[1]);
$pulsa= trim($argv[2]);
$addr= trim($argv[3]);
$now= trim($argv[4]);
$qid=trim($argv[5]);
$data = explode("-",$data);

$cell_num=hexdec($data[17].$data[18]);
$x=18;
for($i=1;$i<=$cell_num;$i++){
	$x1 = $x + 1;
	$x2 = $x + 2;
	$x3 = $x + 3;
	$x4 = $x + 4;
	$x=$x4;
	${"cell" . $i} = hexdec($data[$x1].$data[$x2].$data[$x3].$data[$x4])/1000;
}

if($cell_num < 16){
	for($b=$cell_num+1;$b<=16;$b++){
                ${"cell" . $b} = "N/A";
        }
}

$hex_tmp_1 = $x+1;
$hex_tmp_2 = $x+2;
$hex_tmp=$data[$hex_tmp_1].$data[$hex_tmp_2];

$temp_number=hexdec($hex_tmp);
$x=$hex_tmp_2;
for($i=1;$i<=$temp_number;$i++){
	$x1 = $x + 1;
	$x2 = $x + 2;
	$x3 = $x + 3;
	$x4 = $x + 4;
	$x=$x4;
	${"temp" . $i} = hexdec($data[$x1].$data[$x2].$data[$x3].$data[$x4])/100;
}

if($temp_number < 18){
	for($a=$temp_number+1;$a<=18;$a++){
		${"temp" . $a} = "N/A";
	}
}

if($temp_number < 18){
	$temp_mossf=${"temp" . ($temp_number-1)};
	$temp_env=${"temp" . $temp_number};
	${"temp" . ($temp_number-1)} = "N/A";
	${"temp" . $temp_number} = "N/A";
}else{
	$temp_mossf=${"temp" . ($temp_number-1)};
	$temp_env=${"temp" . $temp_number};
}
$batcur=hexdec($data[$x+1].$data[$x+2].$data[$x+3].$data[$x+4])/100;
$batvolt=hexdec($data[$x+5].$data[$x+6].$data[$x+7].$data[$x+8])/1000;
$soc=hexdec($data[$x+9].$data[$x+10].$data[$x+11].$data[$x+12])/100;
$full_cap=hexdec($data[$x+15].$data[$x+16].$data[$x+17].$data[$x+18])/100;
$cycle_count=hexdec($data[$x+19].$data[$x+20].$data[$x+21].$data[$x+22]);
$des_cap=hexdec($data[$x+23].$data[$x+24].$data[$x+25].$data[$x+26])/100;

$check="select waktu from tmp_log where pack_id = '".$addr."'";
$rc=myQueryDb($check);
$row=myFetchDb($rc);
if(strlen($row['waktu']) > 5){
	//update
	$upd="update tmp_log set waktu = '".$now."',cell_1='".$cell1."',cell_2='".$cell2."',cell_3='".$cell3."',cell_4='".$cell4."',cell_5='".$cell5."',cell_6='".$cell6."',cell_7='".$cell7."',cell_8='".$cell8."',cell_9='".$cell9."',cell_10='".$cell10."',cell_11='".$cell11."',cell_12='".$cell12."',cell_13='".$cell13."',cell_14='".$cell14."',cell_15='".$cell15."',cell_16='".$cell16."',temp_1='".$temp1."',temp_2='".$temp2."',temp_3='".$temp3."',temp_4='".$temp4."',temp_5='".$temp5."',temp_6='".$temp6."',temp_7='".$temp7."',temp_8='".$temp8."',temp_9='".$temp9."',temp_10='".$temp10."',temp_11='".$temp11."',temp_12='".$temp12."',temp_13='".$temp13."',temp_14='".$temp14."',temp_15='".$temp15."',temp_16='".$temp16."',temp_mossfet='".$temp_mossf."',temp_env='".$temp_env."',bat_cur='".$batcur."',bat_volt='".$batvolt."',soc='".$soc."',full_cap='".$full_cap."',cycle_count='".$cycle_count."',des_cap='".$des_cap."',balance='".$pulsa."',qid='".$qid."' where pack_id = '".$addr."'";
	echo $upd;
	$res=`sudo bash /home/pi/code/mysql "$upd"`;
}else{
	//insert
	$ins="insert into tmp_log (waktu,site_id,pack_id,cell_1,cell_2,cell_3,cell_4,cell_5,cell_6,cell_7,cell_8,cell_9,cell_10,cell_11,cell_12,cell_13,cell_14,cell_15,cell_16,temp_1,temp_2,temp_3,temp_4,temp_5,temp_6,temp_7,temp_8,temp_9,temp_10,temp_11,temp_12,temp_13,temp_14,temp_15,temp_16,temp_mossfet,temp_env,bat_cur,bat_volt,soc,full_cap,cycle_count,des_cap,balance,qid) values ('".$now."','".$site_id."','".$addr."','".$cell1."','".$cell2."','".$cell3."','".$cell4."','".$cell5."','".$cell6."','".$cell7."','".$cell8."','".$cell9."','".$cell10."','".$cell11."','".$cell12."','".$cell13."','".$cell14."','".$cell15."','".$cell16."','".$temp1."','".$temp2."','".$temp3."','".$temp4."','".$temp5."','".$temp6."','".$temp7."','".$temp8."','".$temp9."','".$temp10."','".$temp11."','".$temp12."','".$temp13."','".$temp14."','".$temp15."','".$temp16."','".$temp_mossf."','".$temp_env."','".$batcur."','".$batvolt."','".$soc."','".$full_cap."','".$cycle_count."','".$des_cap."','".$pulsa."','".$qid."')";
	//$res=myQueryDb($ins);
	$res=`sudo bash /home/pi/code/mysql "$ins"`;
}
?>
