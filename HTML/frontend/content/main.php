<?php
    //SHOW ERROR MESSAGE
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    $base_url="http://".$_SERVER['SERVER_NAME'];
    include("../../config/check_session.php");
    $title =str_replace("_"," ",$_GET['page_id']);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <title>TBG RTU Dashboard</title>


    <!-- Bootstrap Core CSS -->
    <link href="../../css/bootstrap.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../../css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../../css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!--<link rel="shortcut icon" href="../../images/comtel-logo.png">-->
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!-- [if lt IE 9]> -->
        <script src="../../html5shiv.js"></script>
        <script src="../../respond.min.js"></script>
    <!--[endif]-->

     <!-- jQuery -->
    <script src="../../js/jquery.js"></script>
    <link rel="stylesheet" href="../../sweet2.css">
    
    <!-- Latest compiled and minified JavaScript -->
    <script src="../../sweet2.js"></script>
    
    <!-- Bootstrap Core JavaScript -->
    <script src="../../js/bootstrap.min.js"></script>
    
    <!-- Table bootstrap   -->
    <link href="<?=$base_url.'/css/';?>bootstrap-table.min.css" rel="stylesheet" type="text/css">
    <script src="<?=$base_url.'/js/';?>bootstrap-table.min.js"></script>
    
    <!-- JQuery validate   -->
    <script src="<?=$base_url.'/js/';?>jquery.validate.js"></script>
    <script src="<?=$base_url.'/js/';?>jquery-validate.bootstrap-tooltip.js"></script>
    
    <script>
        $(function()
        {
        	<?php
        	if(isset($_GET['pack_id'])){ ?>
            $("li#pack<?=$_GET['pack_id']?>").addClass('active');
            $("div#pack<?=$_GET['pack_id']?>").addClass('active');
            <?php
            }
            ?>
            $('.nav-tabs').on('click', 'li', function()
             {
                var tab_pane_id = $(this).attr('id');
                var split_tab_pane_id =tab_pane_id.split("pack");
                var id = split_tab_pane_id[1];
                $('.tab-pane').removeClass('active');
                $('div#pack'+id).addClass('active');
                
                changeUrlParam('pack_id', id);
                location.reload();
             });
        });
        
        function getURLParameter(name)
        {
            return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.search)||[,""])[1].replace(/\+/g, '%20'))||null;
        }

        function changeUrlParam (param, value)
        {
            var currentURL = window.location.href+'&';
            var change = new RegExp('('+param+')=(.*)&', 'g');
            var newURL = currentURL.replace(change, '$1='+value+'&');

            if (getURLParameter(param) !== null)
            {
                try
                {
                    window.history.replaceState('', '', newURL.slice(0, - 1) );
                }
                catch (e)
                {
                    console.log(e);
                }
            }
            else
            {
                var currURL = window.location.href;
                if (currURL.indexOf("?") !== -1)
                {
                    window.history.replaceState('', '', currentURL.slice(0, - 1) + '&' + param + '=' + value);
                }
                else
                {
                    window.history.replaceState('', '', currentURL.slice(0, - 1) + '?' + param + '=' + value);
                }
            }
        }
    </script>
</head>

<body>
    <div id="wrapper">
        <?php
        //include navbar
         include("../templates/navbar.php");
        ?>
        <div id="page-wrapper">

            <div class="container-fluid">
                <!--dynamic content-->
                <?php
                    $page=$_GET['page_id'];
                    include($page.'.php');
                ?>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

</body>

</html>
