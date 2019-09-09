<?php
    require_once('../config/db_con.php');
    myOpenDb();
    $sql = "select * from user order by username asc";
    $res =myQueryDb($sql);
   
    $data = array();
    $no=1;
    while($row=myFetchDb($res))
    {
       $data []= array
       (
            "no"        => $no,
            "id"        => $row['id'],
            "username"  => $row['username']
        );
    $no++;
    }
    $array_json = json_encode($data);
    echo $array_json;
?>