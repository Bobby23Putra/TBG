<?php
if($_GET['type'] == 'getdate'){
	echo date("Y-m-d H:i:s");
}elseif($_GET['type'] == 'changedate'){
	shell_exec("sudo mount -o remount,rw /");
	$str_exec = 'sudo date -s "'.trim($_GET['date_new']).' '.trim($_GET['clock_new']).'"';
	$exec=exec($str_exec);
	shell_exec("sudo mount -o remount,ro /");
	
}
?>
