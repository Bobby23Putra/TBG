<?php
require_once("/home/pi/code/db_con.php");
myOpenDb();
$sth = "select * from log where synced = '0' order by id desc limit 0,100";
$res = myQueryDb($sth);
$rows = array();
$keypbasic="";
$data="";
while($r = myFetchDb($res)) {
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
//mysql_free_result($res);
unset($sth);
unset($res);
unset($rows);
unset($raw);
unset($raw2);
unset($key);
unset($key2);
//mysql_close();
echo $keypbasic."|".$data;


//$header="------WebKitFormBoundaryvZ0ZHShNAcBABWFy\nContent-Disposition: form-data; name='fileToUpload'; filename='data.txt'\nContent-Type: text/plain\n";
//$data=$header.$data."\n------WebKitFormBoundaryvZ0ZHShNAcBABWFy";
//file_put_contents("/media/data/data.txt",$data);
//echo $data;
?>
