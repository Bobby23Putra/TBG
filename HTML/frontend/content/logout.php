<?php
	ini_set('session.save_path','/media/data/log');
	session_start();
	session_destroy();
	header("location:../../");
	//exit();
?>
