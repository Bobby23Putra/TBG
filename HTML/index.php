<?php
	ini_set('session.save_path','/media/data/log');
    $base_url=$_SERVER['SERVER_NAME'].":8080";
     session_start();
     require_once("config/db_con.php");
    myOpenDb();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?=$base_url.'/'?>favicon.ico" />
    <meta name="viewport" content="width=device-width, user-scalable=no" />

    <title>Login</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

     <!-- jQuery -->
    <script src="jquery.min.js"></script>

</head>

<body>
<!-- include navbar -->
    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <?php
                    include("frontend/content/login.php");
                ?>
            </div>
        </div>
    </div>
    <!-- /.container -->

    <!-- Bootstrap Core JavaScript -->
    <script src="bootstrap.js>
        
    </script>

</body>

</html>
