<?php
    ini_set('session.save_path','/media/data/log');
    session_start();
    require_once('../config/db_con.php');
    myOpenDb();
    $sql = "select * from user where username='".$_SESSION['uname']."'";
    $res =myQueryDb($sql);
   
    $data = array();
    while($row=myFetchDb($res))
    {
       $data []= array
       (
            "id"        => $row['id'],
            "username"  => $row['username']
        );
    $no++;
    }
    $array_json = json_encode(array('data' => $data));
    echo $array_json;
?>