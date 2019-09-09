<?php
$data=shell_exec("sudo /bin/bash /home/pi/code/poll.sh");
$ping=shell_exec("sudo fping monitoringku.com");
if (strpos($ping, 'alive') !== false) {
	$con="SIM Card Online";
}else{
	$con="SIM Card Offline";
}
echo $data.";".$con;
?>
