<?php

require_once("../../db_con.php");
myOpenDb();
	
$query="SELECT * FROM log_download order by id asc";
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
	$headers[] = 'CC ID';
	$headers[] = 'Output Current';
	$headers[] = 'Input Current';
	$headers[] = 'Battery Voltage';
	$headers[] = 'Input Voltage';
	$headers[] = 'Output kWh';
	$headers[] = 'Output Ah';
	$headers[] = 'CC Mode';
	$headers[] = 'Alarm';
	$headers[] = 'Aux Mode';
	$headers[] = 'Aux Value';	

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
