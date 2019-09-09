<?php
    //shell_exec("sudo mount -o remount,rw /");
    //require_once('../config/db_con.php');
    //myOpenDb();
    $id = $_GET['id'];
    //$sql="DELETE FROM user
     //     WHERE id='{$id}'";
    //echo $sql;
    //$res = myQueryDb($sql);
    $res = shell_exec("sudo bash /var/www/html/ajax/action_user.sh 'delete' '$id'");
    if($id == '1'){
    	echo "0";
    }else{
   		echo "1";
   	}
?>
