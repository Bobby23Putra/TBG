<?php
 ini_set('session.save_path','/media/data/log');
    session_start();
    //echo 'session : '.$_SESSION['uname'];
    if(empty($_SESSION['uname']))
    {
        echo '<script>';
            echo '
                window.location.href ="/";
            ';
            echo '</script>';
        exit();
    }
?>
