<?php
$all=array();
$json=file_get_contents("eaton.json");
$json=json_decode($json,TRUE);
foreach($json as $key => $val){
        $snmp="snmpget -v2c -c public 10.42.0.3 ".$val;
        $exec=shell_exec($snmp);
        $value=explode(":",$exec)[1];
        $value=trim($value);
        //echo $key." = ".$value."\n";
        $all[$key] = $value;
}
//echo implode(";",$all);
print_r($all);
?>
