<?php
ini_set('session.save_path','/media/data/log');
session_start();
require_once("db_con.php");
myOpenDb();

$ip_all=`tail -2 /etc/dhcpcd.conf`;
$raw=explode("\n",$ip_all);
$raw2=explode("/",$raw[0]);
$ip_t=explode("=",$raw2[0]);
$gateway_t=explode("=",$raw[1]);
$current_ip = $ip_t[1];
$current_gateway=$gateway_t[1];
//echo $ip."<br>".$gateway;


if(isset($_POST['login'])){
	if(($_POST['un'] == 'admin') && ($_POST['ps'] == 'admin123')){
		$_SESSION['uname'] = 'admin';
		header("location:/index-old.php");
	}else{
		echo "<script>alert('Wrong Username / Password');</script>";
	}
}
if(isset($_POST['set_now'])){
	//--- mount rw
	$mount=shell_exec("sudo mount -o remount,rw /");
	$now = $_POST['set_date']." ".$_POST['set_time'];
	$ganti = shell_exec("sudo date -s '$now'");
	echo "<script>alert('Date Changed to : ".$now."');</script>";
	//--- mount ro
	$mount=shell_exec("sudo mount -o remount,ro /");
}
if(isset($_POST['update'])){
	//--- mount rw
	$mount=shell_exec("sudo mount -o remount,rw /");
	$head=`head -n -2 /etc/dhcpcd.conf`;
	$ip=$_POST['ip'];
	$gateway=$_POST['gateway'];

	if ((!filter_var($ip, FILTER_VALIDATE_IP) === false) && (!filter_var($gateway, FILTER_VALIDATE_IP) === false)) {
		$ip_dest=$ip;
		$ip=$ip."/24";
		$content = $head."\nstatic ip_address=".$ip."\nstatic routers=".$gateway;
		$exec=shell_exec("echo '$content' > /etc/dhcpcd.conf");
		$exec=exec("sudo bash /home/pi/reboot.sh > /dev/null 2>&1 &");
		header("location:reboot.php?dest=".$ip_dest);
	} else {
		echo("<script>alert('IP Address Not Valid');</script>");
	}
}
?>
<html>
<head>
<style>
body {
	font-family: Arial !important;
	background: url(bgana.png) repeat;
}
.modal-m1 
{
	position: absolute;
    top: 50%;
    left: 50%;
    margin-top: -200px;
    margin-left: -350px;
    width: 700px;
    height: 400px;
}
.dialogbox
{
    margin: 0 auto;
    background-color: #F6F6F6;
    -webkit-border-radius: 20px;
    -moz-border-radius: 20px;
    border-radius: 20px;
    -webkit-box-shadow: #666 3px 3px 5px;
    -moz-box-shadow: #666 3px 3px 5px;
    box-shadow: #666 3px 3px 20px;
    padding: 20px;
    display:inline-block; /*change*/
}
.mydialogbox
{
    width: 700px;
    text-align:center;
}
fieldset {   
	-moz-border-radius:5px;  
	border-radius: 5px;  
	-webkit-border-radius: 5px; 
}
</style>
</head>
<body>
<div><center><img src="header.png"></div>
<?php
if(!isset($_SESSION['uname'])){ ?>
<div class="modal-m1">
	<div class="modal-m2">
		<div class="dialogbox ">
			<div class="mydialogbox">
				<div>
					<form method="post">
					<p><input type="text" name="un" placeholder="Username" required ></p>
					<p><input type="password" name="ps" placeholder="Password" required ></p>
					<p><input type="submit" name="login" value="Login" ></p>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
}else{
	if(isset($_GET['address'])){
		$add_query=" where pack_id = '".$_GET['address']."' ";
	}else{
		$add_query=" ";
	}
	$sql="select * from log ".$add_query." order by id desc limit 0,1";
	$res=myQueryDb($sql);
	$data=myFetchDb($res);
	
	$sql_addr="select pack_id from log where waktu = '".$data['waktu']."' order by pack_id asc";
	$radd=myQueryDb($sql_addr);
	$str='<select id="selectaddr" name="selectaddr" onchange="javascript:location.href = this.value;">';
	while($rowadd=myFetchDb($radd)){
		if(isset($_GET['address'])){
			if($_GET['address'] == $rowadd['pack_id']){
				$sel="selected";
			}else{
				$sel="";
			}
		}
		$str.= '<option value="?address='.$rowadd['pack_id'].'" '.$sel.'>Pack '.$rowadd['pack_id'].'</option>';
	}
	$str.='</select>';
?>
<div class="modal-m1">
	<div class="modal-m2">
		<div class="dialogbox ">
			<div class="mydialogbox">
				<div>
					<form method="post" action="download.php">
						<input type="submit" name="logout" value="Logout" >
					</form>
					<table>
					<tr>
					<td rowspan="2">
			
					<fieldset>
					<legend>Realtime Data <?php echo $str; ?> (<a href="#" onClick="window.location.reload();return false;">Refresh</a>)</legend>
						<div>
							<table align="center" style="font-size:12px" width="100%">
								<tr>
									<td>Cell 1 : <?php echo $data['cell_1']; ?> V</td>
									<td>Temp 1 : <?php echo $data['temp_1']; ?> &deg;C</td>
									<td>T. Mossfet : <?php echo $data['temp_mossfet']; ?> &deg;C</td>
								</tr>
								<tr>
									<td>Cell 2 : <?php echo $data['cell_2']; ?> V</td>
									<td>Temp 2 : <?php echo $data['temp_2']; ?> &deg;C</td>
									<td>T. Env : <?php echo $data['temp_env']; ?> &deg;C</td>
								</tr>
								<tr>
									<td>Cell 3 : <?php echo $data['cell_3']; ?> V</td>
									<td>Temp 3 : <?php echo $data['temp_3']; ?> &deg;C</td>
									<td>Pack Curr : <?php echo $data['bat_cur']; ?> A</td>
								</tr>
								<tr>
									<td>Cell 4 : <?php echo $data['cell_4']; ?> V</td>
									<td>Temp 4 : <?php echo $data['temp_4']; ?> &deg;C</td>
									<td>Pack Volt : <?php echo $data['bat_volt']; ?> V</td>
								</tr>
								<tr>
									<td>Cell 5 : <?php echo $data['cell_5']; ?> V</td>
									<td>Temp 5 : <?php echo $data['temp_5']; ?> &deg;C</td>
									<td>SOC : <?php echo $data['soc']; ?> Ah</td>
								</tr>
								<tr>
									<td>Cell 6 : <?php echo $data['cell_6']; ?> V</td>
									<td>Temp 6 : <?php echo $data['temp_6']; ?> &deg;C</td>
									<td>Full Capc : <?php echo $data['full_cap']; ?> Ah</td>
								</tr>
								<tr>
									<td>Cell 7 : <?php echo $data['cell_7']; ?> V</td>
									<td>Temp 7 : <?php echo $data['temp_7']; ?> &deg;C</td>
									<td>Cycle Count : <?php echo $data['cycle_count']; ?> </td>
								</tr>
								<tr>
									<td>Cell 8 : <?php echo $data['cell_8']; ?> V</td>
									<td>Temp 8 : <?php echo $data['temp_8']; ?> &deg;C</td>
									<td>Design Capc : <?php echo $data['des_cap']; ?> Ah</td>
								</tr>
								<tr>
									<td>Cell 9 : <?php echo $data['cell_9']; ?> V</td>
									<td>Temp 9 : <?php echo $data['temp_9']; ?> &deg;C</td>
									<td></td>
								</tr>
								<tr>
									<td>Cell 10 : <?php echo $data['cell_10']; ?> V</td>
									<td>Temp 10 : <?php echo $data['temp_10']; ?> &deg;C</td>
									<td></td>
								</tr>
								<tr>
									<td>Cell 11 : <?php echo $data['cell_11']; ?> V</td>
									<td>Temp 11 : <?php echo $data['temp_11']; ?> &deg;C</td>
									<td></td>
								</tr>
								<tr>
									<td>Cell 12 : <?php echo $data['cell_12']; ?> V</td>
									<td>Temp 12 : <?php echo $data['temp_12']; ?> &deg;C</td>
									<td></td>
								</tr>
								<tr>
									<td>Cell 13 : <?php echo $data['cell_13']; ?> V</td>
									<td>Temp 13 : <?php echo $data['temp_13']; ?> &deg;C</td>
									<td></td>
								</tr>
								<tr>
									<td>Cell 14 : <?php echo $data['cell_14']; ?> V</td>
									<td>Temp 14 : <?php echo $data['temp_14']; ?> &deg;C</td>
									<td></td>
								</tr>
								<tr>
									<td>Cell 15 : <?php echo $data['cell_15']; ?> V</td>
									<td>Temp 15 : <?php echo $data['temp_15']; ?> &deg;C</td>
									<td></td>
								</tr>
							</table>
						</div>
					</fieldset>
					
					</td>
					<td>
					
					<fieldset>
					<legend>Network</legend>
					<form method="post">
						<table align="center">
							<tr>
								<td>IP Address</td><td> : </td><td><input type="text" name="ip" placeholder="IP Address" value="<?php echo $current_ip; ?>" required ></td>
							</tr>
							<tr>
								<td>Gateway</td><td> : </td><td><input type="text" name="gateway" placeholder="Gateway" value="<?php echo $current_gateway; ?>" required ></td>
							</tr>
							<tr>
								<td align="center" colspan="3"><input type="submit" name="update" value="Update" ></td>
							</tr>
						</table>
					</form>
					</fieldset>
					
					</td>
					<tr>
					<td>
					
					<fieldset>
					<legend>Download Log</legend>
					<form method="post" action="download.php">
						<table align="center">
							<tr>
								<td>Date From</td><td> : </td><td><input type="date" name="fr" placeholder="Date From" value="<?php echo date('Y-m-d'); ?>" required ></td>
							</tr>
							<tr>
								<td>Date To</td><td> : </td><td><input type="date" name="to" placeholder="Date To" value="<?php echo date('Y-m-d'); ?>" required ></td>
							</tr>
							<tr>
								<td align="center" colspan="3"><input type="submit" name="download" value="Download" ></td>
						
							</tr>
						</table>
					</form>
					</fieldset>
					
					</td>
					</tr>
					</table>
					
				</div>
			</div>
		</div>
	</div>
</div>
<?php
} 
?>    
</body>
</html>
<script>

</script>
