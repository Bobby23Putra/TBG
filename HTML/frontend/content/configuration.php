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
    
    $data_cal=mySingleData('setting','setting_value','setting_name','cal');
    
    $do1_atas=mySingleData('setting','setting_value','setting_name','do1_atas');
    $do1_bawah=mySingleData('setting','setting_value','setting_name','do1_bawah');
    $do2_atas=mySingleData('setting','setting_value','setting_name','do2_atas');
    $do2_bawah=mySingleData('setting','setting_value','setting_name','do2_bawah');
    
    $lvd_relay=mySingleData('setting','setting_value','setting_name','lvd_relay_type');
    
    $current_load=trim(shell_exec("sudo python /home/pi/ads.py"));
    $load1=explode(",",$current_load)[0];
    $load2=explode(",",$current_load)[1];
    $load3=explode(",",$current_load)[2];
    $load4=explode(",",$current_load)[3];
    $current_ip = shell_exec("ifconfig eth0 | grep 'inet addr:' | cut -d: -f2 | awk '{ print $1}'");
	$current_gateway=shell_exec("route -n|grep 'UG'|grep -v 'UGH'|cut -f 10 -d ' '");
	$current_gateway=explode("\n",$current_gateway)[0];
	
	$controller_type=mySingleData('setting','setting_value','setting_name','controller_type');
	$datetime_source=mySingleData('setting','setting_value','setting_name','date_source');
    
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
    <div class="col-lg-6">
        <table class="table">
            <thead>
                <tr>
                    <td>
                        <h3>SNMP DATA</h3>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="input-group">
							<span class="input-group-addon">SNMP Port</span>
                        	<input type="text" name="snmp_port" class="form-control" value="<?=$data_snmp_port['setting_value'];?>"/>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="input-group">
							<span class="input-group-addon">Community</span>
                        	<input type="text" name="community" class="form-control" value="<?=$data_community['setting_value'];?>"/>
                        </div>
                    </td>
                </tr>
            </thead>
        </table>  
    </div>
    
    
    <div class="col-lg-6" style="border-left:1px solid #bdbdbd;">
        <table class="table">
            <thead>
                <tr>
                    <td>
                        <h3>SNMP TRAP</h3>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="input-group">
							<span class="input-group-addon">SNMP Trap IP&nbsp;&nbsp;&nbsp;</span>
                        	<input type="text" name="trap_ip" class="form-control" value="<?=$data_trap_ip['setting_value'];?>"/>
                        </div>
                    </td>
                     <tr>
                    <td>
                        <div class="input-group">
							<span class="input-group-addon">SNMP Trap Port</span>
                        	<input type="text" name="trap_port" class="form-control" value="<?=$data_trap_port['setting_value'];?>"/>
                        </div>
                    </td>
                </tr>
                </tr>
            </thead>
        </table>
    </div>
</div>

<div class="row"> 
    <div class="col-lg-6">
        <table class="table">
            <thead>
                <tr>
                    <td>
                        <h3>CURRENT CALIBRATION</h3>
                    </td>
                </tr>
                <tr>
					<td colspan="2">
						<div class="row">
							<div class="col-lg-6">
								Load #1 : <?php echo $load1." / ".$data_cal. "= ".round(($load1/$data_cal),2); ?>A
							</div>
							<div class="col-lg-6">
								Load #2 : <?php echo $load2." / ".$data_cal." = ".round(($load2/$data_cal),2); ?>A
							</div>
							<div class="col-lg-6">
								Load #3 : <?php echo $load3." / ".$data_cal." = ".round(($load3/$data_cal),2); ?>A
							</div>
							<div class="col-lg-6">
								Load #4 : <?php echo $load4." / ".$data_cal." = ".round(($load4/$data_cal),2); ?>A
							</div>
						</div>
					</td>
				</tr>
				<tr>
                    <td>
                        <div class="input-group">
							<span class="input-group-addon">Current Calibration</span>
                        	<input type="text" name="cal" class="form-control" value="<?=$data_cal;?>"/>
                        </div>
                    </td>
                </tr>
            </thead>
        </table>
    </div>
    
    <div class="col-lg-6" style="border-left:1px solid #bdbdbd;">
        <table class="table">
            <thead>
                <tr>
                    <td>
                        <h3>LVD RELAY</h3>
                    </td>
                </tr>
                <tr>
                    
                    <td>
                    	<div class="row">
                    		 <div class="col-lg-8 text-center">
                    		 	<div class="input-group">
									<span class="input-group-addon">LVD Relay Type</span>
		                		 	<select name="lvd_relay" class="form-control">
						            	<option value="latching" <?php if($lvd_relay == 'latching') echo "selected";?>>LATCHING</option>
						            	<option value="nonlatching" <?php if($lvd_relay == 'nonlatching') echo "selected";?>>NON LATCHING</option>
						            </select>
						        </div>
								
							</div>
							<div class="col-lg-4 text-center">
								<div class="col-lg-12 text-center"><a href="#"><h4><span id="reset_latch" class="label label-success">Reset Latch</span></h4></a></div>
				                <!--<button class="btn btn-success" id="reset_latch">Reset Latch</button>-->
				            </div>
				        </div>
				    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="row">
                        	<div class="col-lg-6">
                        		<div class="row">
                        			<div class="col-lg-3 text-center">DO-1</div>
                        			<div class="col-lg-3 text-center">DO-2</div>
                        			<div class="col-lg-3 text-center">DO-3</div>
                        			<div class="col-lg-3 text-center">DO-4</div>
                        		</div>
                        	</div>
                        	<div class="col-lg-6">
                        		<div class="row">
		                    		<div class="col-lg-3 text-center">DO-5</div>
		                    		<div class="col-lg-3 text-center">DO-6</div>
		                    		<div class="col-lg-3 text-center">DO-7</div>
		                    		<div class="col-lg-3 text-center">DO-8</div>
		                    	</div>
                        	</div>
                        </div>
                        <div class="row">
                        	<div class="col-lg-6">
                        		<div class="row">
                        			<div class="col-lg-3 text-center"><a href="#"><span id="1" class="label label-info do-on">On</span></a></div>
                        			<div class="col-lg-3 text-center"><a href="#"><span id="2" class="label label-info do-on">On</span></a></div>
                        			<div class="col-lg-3 text-center"><a href="#"><span id="3" class="label label-info do-on">On</span></a></div>
                        			<div class="col-lg-3 text-center"><a href="#"><span id="4" class="label label-info do-on">On</span></a></div>
                        			
                        		</div>
                        	</div>
                        	<div class="col-lg-6">
                        		<div class="row">
		                    		<div class="col-lg-3 text-center"><a href="#"><span id="5" class="label label-info do-on">On</span></a></div>
		                    		<div class="col-lg-3 text-center"><a href="#"><span id="6" class="label label-info do-on">On</span></a></div>
		                    		<div class="col-lg-3 text-center"><a href="#"><span id="7" class="label label-info do-on">On</span></a></div>
		                    		<div class="col-lg-3 text-center"><a href="#"><span id="8" class="label label-info do-on">On</span></a></div>
		                    	</div>
                        	</div>
                        </div>
                        <div class="row">
                        	<div class="col-lg-6">
                        		<div class="row">
                        			<div class="col-lg-3 text-center"><a href="#"><span id="1" class="label label-info do-off">Off</span></a></div>
                        			<div class="col-lg-3 text-center"><a href="#"><span id="2" class="label label-info do-off">Off</span></a></div>
                        			<div class="col-lg-3 text-center"><a href="#"><span id="3" class="label label-info do-off">Off</span></a></div>
                        			<div class="col-lg-3 text-center"><a href="#"><span id="4" class="label label-info do-off">Off</span></a></div>
                        		</div>
                        	</div>
                        	<div class="col-lg-6">
                        		<div class="row">
		                    		<div class="col-lg-3 text-center"><a href="#"><span id="5" class="label label-info do-off">Off</span></a></div>
		                    		<div class="col-lg-3 text-center"><a href="#"><span id="6" class="label label-info do-off">Off</span></a></div>
		                    		<div class="col-lg-3 text-center"><a href="#"><span id="7" class="label label-info do-off">Off</span></a></div>
		                    		<div class="col-lg-3 text-center"><a href="#"><span id="8" class="label label-info do-off">Off</span></a></div>
		                    	</div>
                        	</div>
                        </div>
                    </td>
                </tr>
            </thead>
        </table>
    </div>
</div>
<div class="row"> 

    
    <div class="col-lg-6" >
        <table class="table">
            <thead>
                <tr>
                    <td>
                        <h3>LVD #1</h3>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="input-group">
							<span class="input-group-addon">Reconnect (V)</span>
                        	<input type="text" name="do1_atas" class="form-control" value="<?=$do1_atas?>"/>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="input-group">
							<span class="input-group-addon">Disconnect (V)</span>
                        	<input type="text" name="do1_bawah" class="form-control" value="<?=$do1_bawah?>"/>
                        </div>
                    </td>
                </tr>
            </thead>
        </table>
       
    </div>
    
    
    <div class="col-lg-6" >
        <table class="table">
            <thead>
                <tr>
                    <td>
                        <h3>LVD #2</h3>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="input-group">
							<span class="input-group-addon">Reconnect (V)</span>
                        	<input type="text" name="do2_atas" class="form-control" value="<?=$do2_atas?>"/>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="input-group">
							<span class="input-group-addon">Disconnect (V)</span>
                        	<input type="text" name="do2_bawah" class="form-control" value="<?=$do2_bawah?>"/>
                        </div>
                    </td>
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
    <div class="col-lg-4">
        <table class="table">
            <thead>
                <tr>
                    <td colspan="2">
                        <h3>DATE&nbsp;&&nbsp;TIME&nbsp;(UTC)</h3>
                    </td>
                </tr>
                <tr>
                    <td width="50%">
                        <div class="input-group">
                            <span class="input-group-addon">
                               <i class="fa fa-calendar" aria-hidden="true"></i>
                            </span>
                            <input type="text" name="date" class="form-control" id="date" readonly />
                        </div>
                    </td>
                    <td>
                        <div class="input-group">
                            <span class="input-group-addon">
                               <i class="fa fa-calendar" aria-hidden="true"></i>
                            </span>
                            <input type="text" name="date" class="form-control" id="date_new" placeholder="2017-09-30"   />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-clock-o" aria-hidden="true"></i>
                            </span>
                            <input type="text" name="clock" class="form-control" id="clock" readonly />
                        </div>
                    </td>
                    <td>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-clock-o" aria-hidden="true"></i>
                            </span>
                            <input type="text" name="clock" class="form-control" id="clock_new" placeholder="22:10:00" />
                        </div>
                    </td>
                </tr>
            </thead>
        </table>
        <div class="col-lg-12 text-center">
			<button class="btn btn-success" id="update_date_time">Update Date Time</button>
		</div>
       
    </div>
    
    
    <div class="col-lg-4" style="border-left:1px solid #bdbdbd;">
        <table class="table">
                <thead>
                    <tr>
                        <td >
                            <h3>NETWORK&nbsp;INFO</h3>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="input-group">
								<span class="input-group-addon">IP Address</span>
                           	 	<input type="text" id="ip" name="ip" value="<?=$current_ip?>" class="form-control"/>	
                           	 </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="input-group">
								<span class="input-group-addon">Gateway&nbsp;&nbsp;&nbsp;</span>
                            	<input type="text" id="gateway" name="gateway" value="<?=$current_gateway?>" class="form-control"/>
                            </div>
                        </td>
                    </tr>
                </thead>
            </table>
            <div class="col-lg-12 text-center">
				<button class="btn btn-success" id="reboot">Save New IP and Reboot</button>
			</div>
    </div>
    
    <div class="col-lg-4" style="border-left:1px solid #bdbdbd;">
        <table class="table">
                <thead>
                    <tr>
                        <td>
                            <h3>CONTROLLER</h3>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        	<div class="input-group">
								<span class="input-group-addon">Controller Type&nbsp;&nbsp;</span>
		                        <select id="controller_type" class="form-control">
						            	<option value="mate2" <?php if($controller_type == 'mate2') echo "selected";?>>MATE 2</option>
						            	<option value="mate3" <?php if($controller_type == 'mate3') echo "selected";?>>MATE 3</option>
						        </select>
						     </div>
                        </td>
                    </tr>
                    <tr>
                       <td>				            
							<div class="input-group">
								<span class="input-group-addon">Datetime Source</span>
								<select id="datetime_source" class="form-control">
				                	<option value="rtc" <?php if($datetime_source == 'rtc') echo "selected";?>>RTC</option>
				                	<option value="mate3" <?php if($datetime_source == 'mate3') echo "selected";?>>MATE 3</option>
				            </select>
							</div>
							
                        </td>
                    </tr>
                </thead>
            </table>
            <div class="col-lg-12 text-center">
				<button class="btn btn-success" id="save_controller">Save Setting</button>
			</div>
    </div>
</div>



<div id="push"></div>


<script type="text/javascript">
	function updateClock(){
		$.get( "../../ajax/getdate.php", { type: "getdate"  } ).done(function( data ) {
        	var curr_date=data.trim().split(" ");
        	// Compose the string for display
			//var currentDateString = currentYears  + "-" + currentMonths + "-" + currentDays;
			//var currentTimeString = currentHours + ":" + currentMinutes + ":" + currentSeconds
			$("#date").val(curr_date[0]);
			$("#clock").val(curr_date[1]);
        });		
		     
	}
	$(function()
    {
        setInterval('updateClock()', 1000);
        
        $( "#reboot" ).click(function() {
        	//jQuery.ajaxSetup({async:false});
        	$.get( "../../ajax/update_configuration.php", { reboot: "yes" , ip:$("#ip").val() , gateway:$("#gateway").val() } ).done(function( data ) {
        	});
        	var url = "http://<?php echo $_SERVER['SERVER_NAME'];?>/reboot.php?dest="+$("#ip").val();
        	//console.log(url);
        	location.href=url;
        	return false;
        });
        
        $( "#save_controller" ).click(function() {
        	//jQuery.ajaxSetup({async:false});
        	$.get( "../../ajax/update_controller.php", { controller_type:$("#controller_type").val() , date_source:$("#datetime_source").val() } ).done(function( data ) {
        	});
        	var url = "http://<?php echo $_SERVER['SERVER_NAME'];?>/reboot.php?dest="+$("#ip").val();
        	location.href=url;
        	return false;
        });
        
        $( "#update_date_time" ).click(function() {
        	//jQuery.ajaxSetup({async:false});
        	$.get( "../../ajax/getdate.php", { type: "changedate" , date_new: $("#date_new").val() , clock_new: $("#clock_new").val()  } ).done(function( data ) {
        		alert("Date Updated");        	
        	});
        	return false;
        });
        
        $( ".do-on" ).click(function() {
        	$.get( "../../ajax/testdo.php", { type: "on" , id: this.id } ).done(function( data ){      	
        	});
        	return false;
        });
        
        $( ".do-off" ).click(function() {
        	$.get( "../../ajax/testdo.php", { type: "off" , id: this.id } ).done(function( data ){      	
        	});
        	return false;
        });
        
         $( "#reset_latch" ).click(function() {
        	$.get( "../../ajax/latch_reset.php" ).done(function( data ){ 
        		alert("Latch Reset Success");
        	});
        	return false;
        });
		
		
		if($( "#controller_type" ).val() == "mate2"){
			$( "#datetime_source" ).prop('disabled', true);
		}
		
		$( "#controller_type" ).change(function() {
			if($( "#controller_type" ).val() == "mate2"){
				$( "#datetime_source" ).val("rtc");
				$( "#datetime_source" ).prop('disabled', true);
			}else{
				$( "#datetime_source" ).prop('disabled', false);
			}
			return false;
		});
    });
</script>

