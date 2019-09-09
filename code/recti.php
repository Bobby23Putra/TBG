<?php
$all=array();
$json=file_get_contents("eaton.json");
$json=json_decode($json,TRUE);
foreach($json as $key => $val){
	$snmp="snmpget -v2c -c public -r 0 -t 1.3 10.42.0.3 ".$val;
	$exec=shell_exec($snmp);
	if($exec == ""){
		$value = "-";
	}else{
		$value=explode(":",$exec)[1];
		$value=trim($value);
	}
	$all[] = $value;
}
echo implode(";",$all);
?>
