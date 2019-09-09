<?php
require_once("db_con_panas.php");
myOpenDb();
$sth = "select * from p60 where synced = '0' order by id desc limit 0,300";
$res = myQueryDb($sth);
$rows = array();
$keypbasic="";
$data="";
while($r = mysql_fetch_assoc($res)) {
	$keypbasic .= $r['id'].",";
	unset($r['id']);
	unset($r['synced']);
	$rows[] = $r;
}
//print_r($r);

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
