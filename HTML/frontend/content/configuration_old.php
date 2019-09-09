<script type="text/javascript">
	function updateClock(){
		var currentTime = new Date();
		//var x1=x.getMonth() + "/" + x.getDate() + "/" + x.getYear();
		var currentDays = currentTime.getDate();
		var currentMonths = currentTime.getMonth();
		var currentYears = currentTime.getFullYear();
		var currentHours = currentTime.getHours();
		var currentMinutes = currentTime.getMinutes();
		var currentSeconds = currentTime.getSeconds();
	 
		// Pad the minutes and seconds with leading zeros, if required
		currentDays = ( currentDays < 10 ? "0" : "" ) + currentDays;
		currentMonths = ( currentMonths < 10 ? "0" : "" ) + currentMonths;
		if(currentMonths == "00"){
			currentMonths = "01";
		}else if(currentMonths == "01"){
			currentMonths = "02";
		}else if(currentMonths == "02"){
			currentMonths = "03";
		}else if(currentMonths == "03"){
			currentMonths = "04";
		}else if(currentMonths == "04"){
			currentMonths = "05";
		}else if(currentMonths == "05"){
			currentMonths = "06";
		}else if(currentMonths == "06"){
			currentMonths = "07";
		}else if(currentMonths == "07"){
			currentMonths = "08";
		}else if(currentMonths == "08"){
			currentMonths = "09";
		}else if(currentMonths == "09"){
			currentMonths = "10";
		}else if(currentMonths == "10"){
			currentMonths = "11";
		}else if(currentMonths == "11"){
			currentMonths = "12";
		}
		currentHours = ( currentHours < 10 ? "0" : "" ) + currentHours;
		currentMinutes = ( currentMinutes < 10 ? "0" : "" ) + currentMinutes;
		currentSeconds = ( currentSeconds < 10 ? "0" : "" ) + currentSeconds;
	 
		// Compose the string for display
		var currentDateString = currentYears  + "-" + currentMonths + "-" + currentDays;
		var currentTimeString = currentHours + ":" + currentMinutes + ":" + currentSeconds
		$("#date").val(currentDateString);
		$("#clock").val(currentTimeString);
		     
	}
	$(function()
    {
        setInterval('updateClock()', 1000);
        
        $( "#reboot" ).click(function() {
        	//jQuery.ajaxSetup({async:false});
        	$.get( "../../ajax/update_configuration.php", { reboot: "yes" , ip:$("#ip").val() , gateway:$("#gateway").val() } ).done(function( data ) {
        	});
        	var url = "http://<?php echo $_SERVER['SERVER_NAME'];?>:8080/reboot.php?dest="+$("#ip").val();
        	//console.log(url);
        	location.href=url;
        	return false;
        });
    });
</script>
<?php
    $sql_snmp_port = "select setting_value from setting where setting_name='snmp_port'";
    $res_snmp_port=myQueryDb($sql_snmp_port);
    $data_snmp_port=myFetchDb($res_snmp_port);

    $sql_trap_ip = "select setting_value from setting where setting_name='trap_ip'";
    $res_trap_ip =myQueryDb($sql_trap_ip);
    $data_trap_ip=myFetchDb($res_trap_ip);

    $sql_trap_port = "select setting_value from setting where setting_name='trap_port'";
    $res_trap_port =myQueryDb($sql_trap_port);
    $data_trap_port=myFetchDb($res_trap_port);

    $sql_community = "select setting_value from setting where setting_name='community'";
    $res_community =myQueryDb($sql_community);
    $data_community=myFetchDb($res_community);
    
    $current_ip = shell_exec("ifconfig eth0 | grep 'inet addr:' | cut -d: -f2 | awk '{ print $1}'");
	$current_gateway=shell_exec("route -n|grep 'UG'|grep -v 'UGH'|cut -f 10 -d ' '");
    
?>
<style>
    #push{
        padding-bottom:220px;
    }
</style>
<form method="POST" action="../../ajax/update_configuration.php">
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Dashboard <small>Configuration</small>
        </h1>
        <ol class="breadcrumb">
            <li>
               <a href="main.php?page_id=dashboard&pack_id=all">
                    <i class="fa fa-dashboard"></i> Dashboard
               </a>
            </li>
            <li class="active">Configuration</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-lg-4">
        <table class="table">
            <thead>
                <tr>
                    <td>
                        <h3>DATE&nbsp;&&nbsp;TIME</h3>
                    </td>
                </tr>
                <tr>
                    <td>
                        DATE
                    </td>
                    <td>
                        <div class="input-group">
                            <span class="input-group-addon">
                               <i class="fa fa-calendar" aria-hidden="true"></i>
                            </span>
                            <input type="text" name="date" class="form-control" id="date" readonly />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        TIME
                    </td>
                    <td>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-clock-o" aria-hidden="true"></i>
                            </span>
                            <input type="text" name="clock" class="form-control" id="clock" readonly />
                        </div>
                    </td>
                </tr>
            </thead>
        </table>
       
    </div>
    
    
    <div class="col-lg-4" style="border-left:1px solid #bdbdbd;">
        <table class="table">
            <thead>
                <tr>
                    <td>
                        <h3>SNMP</h3>
                    </td>
                </tr>
                <tr>
                    <td>
                        PORT
                    </td>
                    <td>
                        <input type="text" name="snmp_port" class="form-control" value="<?=$data_snmp_port['setting_value'];?>"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        COMMUNITY
                    </td>
                    <td>
                        <input type="text" name="community" class="form-control" value="<?=$data_community['setting_value'];?>"/>
                    </td>
                </tr>
            </thead>
        </table>
    </div>
    
    <div class="col-lg-4" style="border-left:1px solid #bdbdbd;">
        <table class="table">
            <thead>
                <tr>
                    <td>
                        <h3>SNMP&nbsp;TRAP</h3>
                    </td>
                </tr>
                <tr>
                    <td>
                        TRAP IP
                    </td>
                    <td>
                        <input type="text" name="trap_ip" class="form-control" value="<?=$data_trap_ip['setting_value'];?>"/>
                    </td>
                     <tr>
                    <td>
                        TRAP PORT
                    </td>
                    <td>
                        <input type="text" name="trap_port" class="form-control" value="<?=$data_trap_port['setting_value'];?>"/>
                    </td>
                </tr>
                </tr>
            </thead>
        </table>
    </div>
    
    

    
</div>

<div class="row">
    <div class="col-lg-12 text-center">
        <input type="submit" class="btn btn-primary" value="Save Configuration" name="update">
    </div>
    </form>
    <br><br>
    <hr></hr>
</div>

<div class="row">
	<div class="col-lg-4" style="border-left:1px solid #bdbdbd;"></div>
	<div class="col-lg-4" >
            <table class="table">
                <thead>
                    <tr>
                        <td>
                            <h3>NETWORK&nbsp;INFO</h3>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            IP ADDRESS
                        </td>
                        <td>
                            <input type="text" id="ip" name="ip" value="<?=$current_ip?>" class="form-control"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            GATEWAY
                        </td>
                        <td>
                            <input type="text" id="gateway" name="gateway" value="<?=$current_gateway?>" class="form-control"/>
                        </td>
                    </tr>
                </thead>
            </table>
       
    </div>
    <div class="col-lg-4" style="border-left:1px solid #bdbdbd;"></div>

</div>

<div class="row">

	<div class="col-lg-12 text-center">
    	<button class="btn btn-success" id="reboot">Save New IP and Reboot</button>
    </div>
<br>

</div>

<div id="push"></div>

