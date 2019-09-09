<script>
    $(function(){
       $("li#<?=$_GET['page_id']?>").addClass('active');
       
    });
</script>
<?php
    require("../../config/db_con.php");
    myOpenDb();
    $sql = "select * from log order by id desc limit 0,1";
    $res=myQueryDb($sql);
    $data=myFetchDb($res);
    $exp_date_time= explode(" ",$data['waktu']);
    if ($_SESSION['uname']!='admin')
    {
        echo '<script>';
            echo '
                $(function()
                {
                    $("li#management_user").hide();
                });
                ';
        echo '</script>';
    }
?>

 <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="main.php?page_id=dashboard">RTU Monitoring System</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color:#FFFFFF;"><i class="fa fa-user"></i> <?=$_SESSION['uname']?><b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li id="dashboard">
                        <a href="main.php?page_id=dashboard"><i class="fa fa-fw fa-dashboard" style="margin-right: 10px;"></i> Dashboard</a>
                    </li>
                    <!--
                     <li id="alarm">
                        <a href="main.php?page_id=alarm&pack_id=all"><i class="fa fa-fw fa-bell" style="margin-right: 10px;"></i> Alarm</a>
                    </li>
                   
                    <li id="configuration">
                        <a href="main.php?page_id=configuration"><i class="fa fa-fw fa-wrench" style="margin-right: 10px;"></i> Configuration</a>
                    </li>
                     -->

                    <li id="management_user">
                        <a href="main.php?page_id=management_user"><i class="fa fa-users" aria-hidden="true" style="margin-right: 12px;"></i> Management User</a>
                    </li>
                    <li id="change_password">
                        <a href="main.php?page_id=change_password"><i class="fa fa-lock" aria-hidden="true" style="margin-right: 17px;"></i> Change Password</a>
                    </li>
                    <li>
                       <p style="margin: 10px 10px 10px 10px;font-size: larger;">INFORMATION</p>
                    </li>
                    
                     <li>
                        <p style="margin: 10px 10px 10px 10px;color:#ffffff;" href="#"><i class="fa fa-fw fa-calendar" style="margin-right: 12px;"></i> <?php if(isset($exp_date_time[0])) echo $exp_date_time[0]; else echo "No data"; ?> <i class="fa fa-clock-o" aria-hidden="true"></i> <?php if(isset($exp_date_time[1])) echo $exp_date_time[1]; else echo "-"; ?></p>
                            <div class="progress" style="margin: 10px 10px 10px 10px;">
                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                            
                                </div>
                            </div>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>
