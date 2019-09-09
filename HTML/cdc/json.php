<?php
require_once("db_con.php");
myOpenDb();
$sth = "select * from log where synced = '0' order by id desc limit 0,300";
$res = myQueryDb($sth);
$rows = array();
$keypbasic="";
$data="";
while($r = mysql_fetch_assoc($res)) {
	//echo $r['poll']."\n";
	//$raw=explode(",",$r['poll']);
	//foreach($raw as $key){
	//	$key2=explode("=",$key);
	//	$raw2[$key2[0]]=$key2[1];
	//}
	unset($r['synced']);
	$rows[] = $r;
	$keypbasic .= $r['id'].",";
}
//print_r($rows);

$keypbasic = substr($keypbasic, 0, -1); 
$data = json_encode($rows);
mysql_free_result($res);
unset($sth);
unset($res);
unset($rows);
unset($raw);
unset($raw2);
unset($key);
unset($key2);
mysql_close();
echo $keypbasic."|".$data;
?>
