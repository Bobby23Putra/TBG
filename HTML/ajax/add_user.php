<?php
    //shell_exec("sudo mount -o remount,rw /");
    //require_once('../config/db_con.php');
    //myOpenDb();
    $username = $_GET[username];
    $password = md5($_GET[password]);
   // $sql ="INSERT INTO user ('username','password') VALUES ('{$username}','{$password}')";
    $res = shell_exec("sudo bash /var/www/html/ajax/action_user.sh 'add' '$username' '$password'");
    echo "1";
?>
