<?php
error_reporting(0);
function myOpenDb(){
	global $handle;
	$handle = new SQLite3("/media/data/cdc.db");
	$handle->busyTimeout(15000);
	$handle->exec('PRAGMA journal_mode = wal;');
	//sqlite_busy_timeout($handle, 10000);
	//$handle->setAttribute(PDO_ATTR_TIMEOUT, 10);
	if(!$handle){
		$handle = new SQLite3("/media/data/cdc.db");
		$handle->busyTimeout(15000);
		$handle->exec('PRAGMA journal_mode = wal;');
	}
	return $handle;
}

function myQueryDb($query){
	global $handle;
	
	$handle->exec('PRAGMA busy_timeout = 15000;');
	//sqlite_busy_timeout($handle, 10000);
	$array['dbhandle'] = $handle;
	$array['query'] = $query;
	$result = $handle->query($query);
	if($result){
		return $result;
	}else{
		//myQueryDb($query);
		echo "<script>alert('Please Refresh Page')</script>";
	}
	$handle->close();
	unset($handle);
}

function myFetchDb(&$result){
	//#Get Columns
	$i = 0;
	while ($result->columnName($i)){
		$columns[] = $result->columnName($i);
		$i++;
	}
	$resx = $result->fetchArray(SQLITE3_ASSOC);
	return $resx;
}

function MyNumDb(&$result){
	//$resx = $result->numColumns();
	//return $resx;
	$nrows = 0;
	$result->reset();
	while ($result->fetchArray())
	    $nrows++;
	$result->reset();
	return $nrows;
}

function mySingleData($table,$field,$where,$key){
	$str="SELECT ". $field . " FROM ". $table . " WHERE " . $where . "='".$key."'";
	$res=myQueryDb($str);
	$row=myFetchDb($res);
	return $row[$field];
}
@myOpenDb();
?>
