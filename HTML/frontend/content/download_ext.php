<?php

require_once("../../db_con.php");
myOpenDb();
	
$query="SELECT * FROM log_external_dl order by id asc";
$result = myQueryDb($query);
//$num=myNumDb($result);
if (!$result){
	echo "<script>location.href='index.php';alert('Database Error.')</script>";
	//}elseif($num == '0'){
	//	echo "<script>location.href='index.php';alert('No Data For Selected Date.')</script>";
}else{
	//$num_fields = mysql_num_fields($result);

	$headers = array();
	//$headers[] = 'ID';
	$headers[] = 'Waktu';
	$headers[] = 'Load 1';
	$headers[] = 'Load 2';
	$headers[] = 'Load 3';
	$headers[] = 'Load 4';
	$headers[] = 'DI 1';
	$headers[] = 'DI 2';
	$headers[] = 'DI 3';
	$headers[] = 'DI 4';
	$headers[] = 'DI 5';
	$headers[] = 'DI 6';
	$headers[] = 'DI 7';
	$headers[] = 'DI 8';

	$fp = fopen('php://output', 'w');
	$fn = "Log_site";
	if ($fp && $result) {
		header('Content-Type: text/csv');
		header('Content-Disposition: attachment; filename="'.$fn.'.csv"');
		header('Pragma: no-cache');
		header('Expires: 0');
		fputcsv($fp, "\xEF\xBB\xBF");
		fputcsv($fp, $headers);
				
		while($row=myFetchDb($result)){	
			unset($row['id']);
			//unset($row['site_id']);
			//fputcsv($fp, array_values($values));
			fputcsv($fp, array_values($row));
		}
		die;
	}
}
	

?>
