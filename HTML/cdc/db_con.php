<?php 
$myDBuserName="root";
$myDBpassword="root";
$myDBhostname="localhost";
$myDBname="cdc";

$err = false;
//MYSQL FUNCTION======================
function myOpenDb() {
 	global $myDBhostname,$myDBuserName,$myDBpassword,$myDBname,$msg_err,$mysql_conn,$err;
 	
	$mysql_conn = @mysql_connect($myDBhostname,$myDBuserName,$myDBpassword);
	if(!$mysql_conn) {
		$msg_err .= "Error connecting to server: " . mysql_error(). "<br>";
		$err = true;
	}else {
		$mysql_db = @mysql_select_db($myDBname,$mysql_conn);
		if(!$mysql_db) {
			$msg_err .= "Error selecting MySQL database: " . mysql_error(). "<br>";	
			$err = true;		
		}else {
			return $mysql_db;
		}
	}
}

function myCloseDb() {
	global $mysql_conn;
    @mysql_close($mysql_conn);
}

function myQueryDb($query) {
 	global $msg_err,$err;
 	//if ((strpos($query,'update') !== false) || (strpos($query,'UPDATE') !== false) || (strpos($query,'insert') !== false) || (strpos($query,'INSERT') !== false) || (strpos($query,'delete') !== false) || (strpos($query,'DELETE') !== false)){
 		//$query2 = mysql_real_escape_string($query);
 		//$ins="insert into pk_querytable (date_invoke,user_invoke,list_query,synced) values (NOW(),'".$_SESSION['uid']."','".$query2."','0')";
 		//$res=@mysql_query($ins);
 	//}
	$result = @mysql_query($query);
	if(!$result) {
		$msg_err .= "MySQL Query Error: " . mysql_error(). "<br>";
		$err = true;
	}else {
		return $result;	
	}
}

function myFetchDb($result) {
	$row = @mysql_fetch_array($result);
    return $row;
}

function myAssocDb($result) {
	$row = @mysql_fetch_assoc($result);
    return $row;
}


function myNumDb($result) {
	$num = @mysql_num_rows($result);
    return $num;
}

function mySingleData($table,$field,$where,$key){
	$str="SELECT ". $field . " FROM ". $table . " WHERE " . $where . "='".$key."'";
	$res=myQueryDb($str);
	$row=myFetchDb($res);
	return $row[$field];
}

/*
function send_mail($from,$subject,$body,$to){
	$mail = new PHPMailer();  
	$mail->IsSMTP();  // telling the class to use SMTP
	$mail->Mailer = "smtp";
	$mail->SMTPSecure="ssl";
	$mail->Host = "smtp.gmail.com";
	$mail->Port = 465;
	$mail->SMTPDebug=2;
	$mail->SMTPAuth = true; // turn on SMTP authentication
	$mail->Username = "aloha.report@gmail.com"; // SMTP username
	$mail->Password = "aloha555"; // SMTP password 
	 
	$mail->FromName = $from;
	$mail->From     = "aloha.report@gmail.com";
	foreach($to as $val){
		echo $val."\n";
		$mail->AddAddress($val);
	}
	//$mail->AddCC("indra_jazz12@yahoo.com");
	
	$mail->IsHTML	= true; 
	$mail->Subject  = $subject;
	$mail->Body     = $body;
	$mail->WordWrap = 200;  
	
	if(!$mail->Send()){
		echo "send fail\n";		
		return false; 
	}else{ 
		echo "send true\n";
		return true;
	}

}
*/
function send_mail($body){
	
	//Create a new PHPMailer instance
	$mail = new PHPMailer();
	//Tell PHPMailer to use SMTP
	$mail->isSMTP();
	//Enable SMTP debugging
	// 0 = off (for production use)
	// 1 = client messages
	// 2 = client and server messages
	$mail->SMTPDebug = 0;
	//Ask for HTML-friendly debug output
	$mail->Debugoutput = 'html';
	//Set the hostname of the mail server
	$mail->Host = 'smtp.gmail.com';
	//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
	$mail->Port = 587;
	//Set the encryption system to use - ssl (deprecated) or tls
	$mail->SMTPSecure = 'tls';
	//Whether to use SMTP authentication
	$mail->SMTPAuth = true;
	//Username to use for SMTP authentication - use full email address for gmail
	$mail->Username = "dimas.eko.iandityo@gmail.com";
	//Password to use for SMTP authentication
	$mail->Password = "anjinganjing";
	//Set who the message is to be sent from
	$mail->setFrom('indosat@trial.com', 'Indosat Trial');
	//Set an alternative reply-to address
	//$mail->addReplyTo('replyto@example.com', 'First Last');
	//Set who the message is to be sent to
	$mail->addAddress('dimas.eko.iandityo@gmail.com', '');
	$mail->addAddress('dmsymbfreak@gmail.com', '');
	$mail->addAddress('wawan_wiratno@yahoo.com', '');
	//Set the subject line
	$mail->Subject = "[Indosat trial] Alarm Message!!";
	//Read an HTML message body from an external file, convert referenced images to embedded,
	//convert HTML into a basic plain-text alternative body
	//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
	$mail->msgHTML($body);
	//Replace the plain text body with one created manually
	$mail->AltBody = 'This is a plain-text message body';
	//Attach an image file
	//$mail->addAttachment('images/phpmailer_mini.gif');

	//send the message, check for errors
	if (!$mail->send()) {
		 return "error";
	} else {
		 return "sent";
	}


}

?>
