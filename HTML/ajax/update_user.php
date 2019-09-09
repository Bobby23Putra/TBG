<?php
    //shell_exec("sudo mount -o remount,rw /");
    //require_once('../config/db_con.php');
    //myOpenDb();
    $password = md5($_GET['password']);
    $id = $_GET['id'];
    $res = shell_exec("sudo bash /var/www/html/ajax/action_user.sh 'update' '$id' '$password'");
    //$sql="UPDATE user
    //      SET password='{$password}'
    //      WHERE id='{$id}'";
    //echo $sql;
    //$res = myQueryDb($sql);
    echo "1";
?>
