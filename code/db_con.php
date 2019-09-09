<?php
function myOpenDb(){
	global $handle;
	$handle = new SQLite3("/media/data/cdc.db");
	//sqlite_busy_timeout($handle, 10000);
	//$handle->setAttribute(PDO_ATTR_TIMEOUT, 10);
	return $handle;
}

function myQueryDb($query){
	global $handle;
	$timeout = $handle->query('PRAGMA busy_timeout = 10000');
	$array['dbhandle'] = $handle;
	$array['query'] = $query;
	$result = $handle->query($query);
	return $result;
}

function myFetchDb(&$result){
	//#Get Columns
	$i = 0;
	while ($result->columnName($i)){
		$columns[ ] = $result->columnName($i);
		$i++;
	}
	$resx = $result->fetchArray(SQLITE3_ASSOC);
	return $resx;
}
function mySingleData($table,$field,$where,$key){
	$str="SELECT ". $field . " FROM ". $table . " WHERE " . $where . "='".$key."'";
	$res=myQueryDb($str);
	$row=myFetchDb($res);
	return $row[$field];
}
myOpenDb();
?>
