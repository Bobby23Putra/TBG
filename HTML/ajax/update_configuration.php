<?php
//--- mount rw
$mount=shell_exec("sudo mount -o remount,rw /");
    if(isset($_POST['update']))
    {      

        //update date and time
        
        // echo $str_exec;

        // update site info
        $site_id = $_POST['site_id'];
        //$sql = "UPDATE setting SET setting_value='".$site_id."' WHERE setting_name='site_id'";
        $str_exec_site_id = "sudo bash /home/pi/conf/changesite.sh ".$site_id;
        $res_site_id = exec($str_exec_site_id);
        //echo $str_exec_site_id;
        
        //update snmp port
        $snmp_port = $_POST['snmp_port'];
        $str_exec_snmp_port = "sudo bash /home/pi/conf/changesnmpport.sh ".$snmp_port;
        $res_snmp_port = exec($str_exec_snmp_port);
        //echo $str_exec_snmp_port;
        
        //update trap ip
        $trap_ip = $_POST['trap_ip'];
        $str_exec_trap_ip = "sudo bash /home/pi/conf/changetrapip.sh ".$trap_ip;
        $res_trap_ip = exec($str_exec_trap_ip);
        //echo $str_exec_trap_ip;
        
        //update trap port
        $trap_port = $_POST['trap_port'];
        $str_exec_trap_port = "sudo bash /home/pi/conf/changetrapport.sh ".$trap_port;
        $res_trap_port = exec($str_exec_trap_port);
        //echo $str_exec_trap_port;
        
        //update community
        $trap_community = $_POST['community'];
        $str_exec_community = "sudo bash /home/pi/conf/changecommunity.sh ".$trap_community;
        $res_community = exec($str_exec_community);
        //echo $str_exec_trap_community;
        
        //update log period
        $log_period = $_POST['log_period'];
        $str_exec_log = "sudo bash /home/pi/conf/changeperiod.sh ".$log_period;
        $res_log = exec($str_exec_log);
	
		//update calibr
        $cal = $_POST['cal'];
        $str_exec_cal = "sudo bash /home/pi/conf/changecal.sh ".$cal;
        $res_cal = exec($str_exec_cal);
        
        //update do1 atas
        $do1_atas = $_POST['do1_atas'];
        $str_exec_cal = "sudo bash /home/pi/conf/changedo1atas.sh ".$do1_atas;
        $res_cal = exec($str_exec_cal);
        
        //update do1 bawah
        $do1_bawah = $_POST['do1_bawah'];
        $str_exec_cal = "sudo bash /home/pi/conf/changedo1bawah.sh ".$do1_bawah;
        $res_cal = exec($str_exec_cal);
        
        //update do2 atas
        $do2_atas = $_POST['do2_atas'];
        $str_exec_cal = "sudo bash /home/pi/conf/changedo2atas.sh ".$do2_atas;
        $res_cal = exec($str_exec_cal);
        
        //update do2 bawah
        $do2_bawah = $_POST['do2_bawah'];
        $str_exec_cal = "sudo bash /home/pi/conf/changedo2bawah.sh ".$do2_bawah;
        $res_cal = exec($str_exec_cal);
        
        //update relay type
        $lvd_relay = $_POST['lvd_relay'];
        $str_exec_cal = "sudo bash /home/pi/conf/changelvdrelay.sh ".$lvd_relay;
        $res_cal = exec($str_exec_cal);

        Header("Location:http://".$_SERVER['SERVER_NAME'].":8080/frontend/content/main.php?page_id=configuration");
	}
	elseif (isset($_GET['reboot']))
	{
	
		//$head=`head -n -2 /etc/dhcpcd.conf`;
		$ip=$_GET['ip'];
		$gateway=$_GET['gateway'];
            
		if ((!filter_var($ip, FILTER_VALIDATE_IP) === false) && (!filter_var($gateway, FILTER_VALIDATE_IP) === false))
		{
			$ip_dest=$ip;
			//$content = $head."\nstatic ip_address=".$ip."\nstatic routers=".$gateway;
			//$exec=shell_exec("echo '$content' > /etc/dhcpcd.conf");
			$exec=exec("sudo bash /var/www/html/changeip.sh '$ip' '$gateway' 2>&1 &");
			//$exec=exec("sudo bash /home/pi/reboot.sh > /dev/null 2>&1 &");
			//header("location:http://".$_SERVER['SERVER_NAME']."/reboot.php?dest=".$ip);
			echo "1";
		}

	}
//--- mount ro
$mount=shell_exec("sudo mount -o remount,ro /");
?>
