<?php
$type=trim($_GET['type']);
$id=trim($_GET['id']);
$id=$id+7;
$str_exec = 'sudo python /home/pi/do.py '.$type.' '.$id;
$exec=exec($str_exec);
?>
