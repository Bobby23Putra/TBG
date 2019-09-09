<?php
require_once('db_con.php');
myOpenDb();
function auth_user($num) {
	$qn="select * from auth_user where phone_number = '".$num."'";
	$rq=myQueryDb($qn);
	$rowq=myFetchDb($rq);
	if($rowq){
		return $rowq['admin'];
	}else{
		return "9";
	}
}

$inbox = "select * from inbox where Processed = 'false'";
$res=myQueryDb($inbox);
while($row=myFetchDb($res)){
	//--parameter yg dibutuhkan
	$tanggal = $row['ReceivingDateTime'];
	$isi = strtolower($row['TextDecoded']);
	$sender = $row['SenderNumber'];
	$modem = mySingleData('setting','setting_value','setting_name','modem');
	$modem = explode(",",$modem);
	$modem = $modem[1];
	if($sender==mySingleData('setting','setting_value','setting_name','site_phone_number')){
		$exec=shell_exec("sudo date -s '$tanggal'");
		$del="delete from inbox where ReceivingDateTime = '".$tanggal."'";
		$resdel=myQueryDb($del);
	}
	//-----auth user biasa
	$admin=auth_user($sender);
	if($admin == '0'){
		//----query data hanya get info
		if($isi == 'get info'){
			$exec=shell_exec("sudo bash get_info.sh '$sender' '$modem'");
			$del="delete from inbox where ReceivingDateTime = '".$tanggal."'";
			$resdel=myQueryDb($del);
		}else{
			$del="delete from inbox where ReceivingDateTime = '".$tanggal."'";
			$resdel=myQueryDb($del);
		}
	//-----auth admin
	}elseif($admin == '1'){
		//----ganti tanggal manual
		if($isi == 'date'){
			$date_before = date("Y-m-d H:i:s");
			$exec=shell_exec("sudo date -s '$tanggal'");
			$del="delete from inbox where ReceivingDateTime = '".$tanggal."'";
			$resdel=myQueryDb($del);
			$date_after = date("Y-m-d H:i:s");
			$ownnumber=mySingleData('setting','setting_value','setting_name','site_phone_number');
			if($sender != $ownnumber){
				sleep(2);
				$exec=shell_exec("sudo bash content_sms.sh '$sender' 'Update tanggal berhasil. Sebelum update = $date_before. Setelah update = $date_after.' '$modem'");
			}
		//----get info
		}elseif($isi == 'get info'){
			$exec=shell_exec("sudo bash get_info.sh '$sender' '$modem'");
			$del="delete from inbox where ReceivingDateTime = '".$tanggal."'";
			$resdel=myQueryDb($del);
		//----add number
		}elseif(strpos($isi,'addnum') !== false) {
			$consall = explode(" ",$isi); 
			$nmrhp = $consall[1];
			if($nmrhp[0] != "+"){
				$nmrhp = "+62".substr($nmrhp,1,strlen($nmrhp));
			}
			if(empty($consall[2]))$consall[2] = '0';
			$chk="select admin from auth_user where phone_number = '".$nmrhp."'";
			$resck = myQueryDb($chk);
			$rowck = myFetchDb($resck);
			if($rowck){
				if($rowck['admin'] == '1'){
					$adm = 'admin';
				}else{
					$adm = 'user';
				}
				$exec=shell_exec("sudo bash content_sms.sh '$sender' 'Nomor $nmrhp sudah diregistrasi sebelumnya dengan status : $adm' '$modem'");
				$del="delete from inbox where ReceivingDateTime = '".$tanggal."'";
				$resdel=myQueryDb($del);
			}else{
				$ins_user = "insert into auth_user (phone_number,admin) values ('".$nmrhp."','".$consall[2]."')";
				$res_ins = myQueryDb($ins_user);
				$exec=shell_exec("sudo bash content_sms.sh '$sender' 'Nomor $nmrhp berhasil diregistrasi.' '$modem'");
				$del="delete from inbox where ReceivingDateTime = '".$tanggal."'";
				$resdel=myQueryDb($del);
			}
		//----edit number	
		}elseif(strpos($isi,'editnum') !== false) {
			$consall = explode(" ",$isi); 
			$nmrhp = $consall[1];
			if($nmrhp[0] != "+"){
				$nmrhp = "+62".substr($nmrhp,1,strlen($nmrhp));
			}
			if(empty($consall[2]))$consall[2] = '0';
			$chk="select admin from auth_user where phone_number = '".$nmrhp."'";
			$resck = myQueryDb($chk);
			$rowck = myFetchDb($resck);
			if($rowck){
				if($consall[2] == '1'){
					$adm = 'admin';
				}else{
					$adm = 'user';
				}
				$upd_user = "update auth_user set admin = '".$consall[2]."' where phone_number = '".$nmrhp."'";
				$res_upd = myQueryDb($upd_user);
				$exec=shell_exec("sudo bash content_sms.sh '$sender' 'Status nomor $nmrhp sudah diubah menjadi : $adm' '$modem'");
				$del="delete from inbox where ReceivingDateTime = '".$tanggal."'";
				$resdel=myQueryDb($del);
			}else{
				$exec=shell_exec("sudo bash content_sms.sh '$sender' 'Nomor $nmrhp belum terdaftar.' '$modem'");
				$del="delete from inbox where ReceivingDateTime = '".$tanggal."'";
				$resdel=myQueryDb($del);
			}
		//----delete number	
		}elseif(strpos($isi,'delnum') !== false) {
			$consall = explode(" ",$isi); 
			$nmrhp = $consall[1];
			if($nmrhp[0] != "+"){
				$nmrhp = "+62".substr($nmrhp,1,strlen($nmrhp));
			}
			$chk="select * from auth_user where phone_number = '".$nmrhp."'";
			$resck = myQueryDb($chk);
			$rowck = myFetchDb($resck);
			if($rowck){
				$del_user = "delete from auth_user where phone_number = '".$nmrhp."'";
				$res_del = myQueryDb($del_user);
				$exec=shell_exec("sudo bash content_sms.sh '$sender' 'Nomor $nmrhp berhasil dihapus.' '$modem'");
				$del="delete from inbox where ReceivingDateTime = '".$tanggal."'";
				$resdel=myQueryDb($del);
			}else{
				$exec=shell_exec("sudo bash content_sms.sh '$sender' 'Nomor $nmrhp belum terdaftar.' '$modem'");
				$del="delete from inbox where ReceivingDateTime = '".$tanggal."'";
				$resdel=myQueryDb($del);
			}
		//----change server number	
		}elseif(strpos($isi,'servernum') !== false) {
			$old_svr=mySingleData('setting','setting_value','setting_name','sms_server');
			$consall = explode(" ",$isi); 
			$nmrhp = $consall[1];
			if($nmrhp[0] != "+"){
				$nmrhp = "+62".substr($nmrhp,1,strlen($nmrhp));
			}
			$chg_svr = "update setting set setting_value = '".$nmrhp."' where setting_name = 'sms_server'";
			$res_chg = myQueryDb($chg_svr);
			$exec=shell_exec("sudo bash content_sms.sh '$sender' 'Nomor server telah diubah dari $old_svr menjadi $nmrhp .' '$modem'");
			$del="delete from inbox where ReceivingDateTime = '".$tanggal."'";
			$resdel=myQueryDb($del);
		//----start genset
		}elseif(strpos($isi,'genset start') !== false) {
			$genset_mode=mySingleData('setting','setting_value','setting_name','genset_mode');
			if($genset_mode=="manual"){
				$starter_time = mySingleData('setting','setting_value','setting_name','starter_time');
				//---cek status genset
			
				//---nyalain solenoid
				$solenoid_start=shell_exec("gpio write 22 1");
				sleep(1);
				//---start genset
				$starter_start=shell_exec("gpio write 21 1");
				sleep($starter_time);
				$starter_stop=shell_exec("gpio write 21 0");
				sleep(10);		
				$gs=`gpio read 25`;	
				if($gs != 1) {
					$exec=shell_exec("sudo bash content_sms.sh '$sender' 'Genset dinyalakan.' '$modem'");
					sleep(mySingleData('setting','setting_value','setting_name','warming_up'));
					$kontr=`gpio write 23 1`;
				}else{
					$exec=shell_exec("sudo bash content_sms.sh '$sender' 'Genset fail to start.' '$modem'");
				}
				$del="delete from inbox where ReceivingDateTime = '".$tanggal."'";
				$resdel=myQueryDb($del);
			}else{
				$exec=shell_exec("sudo bash content_sms.sh '$sender' 'Gagal. Genset mode = auto.' '$modem'");
				$del="delete from inbox where ReceivingDateTime = '".$tanggal."'";
				$resdel=myQueryDb($del);
			}
		//----stop genset
		}elseif(strpos($isi,'genset stop') !== false) {
			$genset_mode=mySingleData('setting','setting_value','setting_name','genset_mode');
			if($genset_mode=="manual"){
				$cooling_down = mySingleData('setting','setting_value','setting_name','cooling_down');
				//--genset stop script
				$kontaktor_stop=shell_exec("gpio write 23 0");
				sleep($cooling_down);
				$selenoid_stop=shell_exec("gpio write 22 0");
				$exec=shell_exec("sudo bash content_sms.sh '$sender' 'Genset dimatikan.' '$modem'");
				$del="delete from inbox where ReceivingDateTime = '".$tanggal."'";
				$resdel=myQueryDb($del);
			}else{
				$exec=shell_exec("sudo bash content_sms.sh '$sender' 'Gagal. Genset mode = auto.' '$modem'");
				$del="delete from inbox where ReceivingDateTime = '".$tanggal."'";
				$resdel=myQueryDb($del);
			}
		//----setting parameter
		}elseif(strpos($isi,'setting') !== false) {
			$consall = explode(" ",$isi);
			$param = $consall[1];
			$value = $consall[2];
			if($value == "?"){
				$nilai = mySingleData('setting','setting_value','setting_name',$param);
				$exec=shell_exec("sudo bash content_sms.sh '$sender' 'Nilai $param = $nilai.' '$modem'");
			}else{
				$upd_setting = "update setting set setting_value = '".$value."' where setting_name = '".$param."'";
				$res_upd = myQueryDb($upd_setting);
				$exec=shell_exec("sudo bash content_sms.sh '$sender' 'Setting parameter berhasil. Nilai $param = $value.' '$modem'");
			}
			$del="delete from inbox where ReceivingDateTime = '".$tanggal."'";
			$resdel=myQueryDb($del);
			
		//----setting recti
		}elseif(strpos($isi,'setting_recti') !== false) {
			$consall = explode(" ",$isi);
			$param = $consall[1];
			$value = $consall[2];
			if($value == "?"){
				$nilai = shell_exec("sudo bash get_single_recti.sh '$param'");
				$exec=shell_exec("sudo bash content_sms.sh '$sender' 'Nilai Recti $param = $nilai.' '$modem'");
			}else{
				$upd_setting = shell_exec("sudo bash set_single_recti.sh '$param' '$value'");
				if($upd_setting == '1'){
					$exec=shell_exec("sudo bash content_sms.sh '$sender' 'Setting Recti Berhasil. Nilai $param = $value.' '$modem'");
				}else{
					$exec=shell_exec("sudo bash content_sms.sh '$sender' 'Setting Recti Gagal.' '$modem'");
				}
			}
			$del="delete from inbox where ReceivingDateTime = '".$tanggal."'";
			$resdel=myQueryDb($del);
				
		//----reboot
		}elseif(strpos($isi,'reboot') !== false) {
			$del="delete from inbox where ReceivingDateTime = '".$tanggal."'";
			$resdel=myQueryDb($del);
			$exec=shell_exec("sudo bash reboot.sh");
			
		}else{
			$del="delete from inbox where ReceivingDateTime = '".$tanggal."'";
			$resdel=myQueryDb($del);
		}
	
	}else{
		$del="delete from inbox where ReceivingDateTime = '".$tanggal."'";
		$resdel=myQueryDb($del);
	}
}

?>
