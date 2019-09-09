<?php
//--- mount rw
$mount=shell_exec("sudo mount -o remount,rw /");
$str_exec_cal = "sudo bash /home/pi/conf/changecontroller.sh ".trim($_GET['controller_type'])." ".trim($_GET['date_source']);
$res_cal = exec($str_exec_cal);
echo "1";
//--- mount ro
$mount=shell_exec("sudo mount -o remount,ro /");
?>
