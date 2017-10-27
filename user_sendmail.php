<?php include('header.php'); ?>

<html>
<head>
	<meta charset="utf-8">
</head>
<body>

<?php
$sql = "SELECT * FROM user WHERE user_id=$_SESSION[ss_user_id]";
$bossid;
//echo $sql;

$result = mysql_query($sql);

if($result){
	while($row = mysql_fetch_array($result)){
		//print_r($row);
		$bossid = $row['leave_apporve_id'];
	}
}
if(strpos($bossid, ",")!==false){
    $bossid = explode(",", $_GET['boss']);
    for($i=0;$i<count($bossid);$i++){
    	
       // echo '<br>'.'Boss mail : '.$bossid[$i].'<br>';
    }
}
else{
    $bossid =  $_GET['boss'];
   // echo  'Boss mail : '.$bossid.'<br>';
}
$boss = count($bossid);
if ($bossid=='') {
  echo '<script type="text/javascript">
  alert("You do not have any boss");
  window.location = "main.php";
  </script>';
}

$detailsql = "SELECT * FROM user_outgoing WHERE user_id =".$_SESSION[ss_user_id]." AND user_outgoing_id = ".$_GET['dt'];
//echo $detailsql;
$detailresult = mysql_query($detailsql);
$detail = mysql_fetch_array($detailresult);

// Mail To boss

//error_reporting(E_ALL);
error_reporting(E_STRICT);

date_default_timezone_set("Asia/Bangkok");

require_once('PHPMailer/class.phpmailer.php');
//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

$mail             = new PHPMailer();
$mail->CharSet = "utf-8";

$body             = file_get_contents('user_sendmail_content.php');
$body             = eregi_replace("[\]",'',$body);

$message = '<html><body style="background:#eee;" align="center">';
$message .= '';
$message .= '<img src="logo-serene.png">';
$message .= '<p>'.$_SESSION[ss_title].$_SESSION[ss_name].'    '.$_SESSION[ss_sname].' &nbsp;&nbsp;&nbsp; ตำแหน่ง &nbsp; '.$_SESSION[ss_position].'</p>';
$message .= '<p>ขออนุมัติ การเดินทางออกนอกสถานที่</p>';
$message .= 'โดยมีรายละเอียดการเดินทางตามที่ระบุไว้ด้านล่าง'.'<br>';
$message .= '<p>ค่าเดินทาง : '.$detail['cost'].'</p>';
$message .= '<p>ระยะทางในการเดินทาง : '.$detail['distance'].' กิโลเมตร</p>';
$message .= '<p>ยานพาหนะ : ' .$detail['vihecle_type'].'</p>';
$message .= '<small>หมายเหตุ : '.$_GET['description'].'</small>';
$message .= '<table border = "0" cellspacing = "5" cellpadding = "5"><tr><td><form method = "get" action = "http://localhost/ps2/approve_outgoing.php">';//urlที่ทำงาน=http://localhost:81/testgoogle/approve.php
$message .= '<input type = "hidden" name = "goingid" value ='.$_GET['dt'].'>';
$message .= '<input type = "submit" name = "approve" value = "อนุมัติ" style = "background-color: orange;border-radius: 4px;font-size: 16px;color: white;box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);width:100px;height:30px;">'; 
$message .= '</form></td><td><form method="get" action="http://localhost/ps2/non_approve_outgoing.php">';//urlที่ทำงาน=http://localhost:81/testgoogle/cancle.php //http://127.0.0.1/30M/googleamp/testgoogle/cancle.php urlที่บ้าน
$message .= '&nbsp;&nbsp;&nbsp;';
$message .= '<input type = "hidden" name = "goid" value='.$_GET['dt'].'>';
$message .= '<input type = "submit" name = "cancle" value = "ไม่อนุมัติ" style = "background-color: orange;border-radius: 4px;font-size: 16px;color: white;box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);width:100px;height:30px;">';
$message .= '</form></td></tr></table>';
$message .= '<br>'.'<br>';
$message .= '<img src="pic/route.png">';
$message .= "</body>";
$message .= '</html>';

$mail->IsSMTP(); // telling the class to use SMTP
$mail->Host       = "mail.yourdomain.com"; // SMTP server
$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
                                           // 1 = errors and messages
                                           // 2 = messages only
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
$mail->Username   = "sandna03@gmail.com";  // GMAIL username
$mail->Password   = "kakz8654[]";            // GMAIL password

$mail->SetFrom('sandna03@gmail.com');

//$mail->AddReplyTo("name@yourdomain.com","First Last");

$mail->Subject    = "ขออนุมัติการออกนอกสถานที่";

//$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

$mail->MsgHTML($message);


if($boss>1){
	for ($i=0; $i <$boss ; $i++) { 
		$address = $bossid[$i];
		$mail->AddAddress($address);
	}
}
else{

		$address = $bossid;
		$mail->AddAddress($address);
}

//$address = "chitpitak.t@gmail.com";

$mail->AddAttachment("pic/route.png");      // attachment
//$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment

if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  echo "Message sent!";
  ?>

  <script type="text/javascript">

  		var timeout =  setTimeout(function(){ window.location = "main.php"; },1500);
    	if (timeout) {
    		
    	}

  </script>
  <?php
}

?>

</body>

</html>
