<? include("header.php"); ?>
  <table border='0' style='width:100%; margin-top:15px; font-size:40px;' cellspacing='0' cellpadding='0' align='center' class='bordered'><tr><td align='center' colspan='2' style=' font-size:60px; letter-spacing:2px;' height='300' valign='middle'><strong>ขอบคุณสำหรับการแจ้งซ่อม :)</strong></td></tr></table> 
<?  $sql_query = "Insert Into `it_job` (`job_id`,`job_title`,`job_description`,`job_piority`,`job_type`,`job_sender_id`,`job_status`,`job_datetime_entered`,`job_datetime_receive`,`job_datetime_close`,`job_repaire_description`)VALUES( 
NULL,'$_REQUEST[job_title]','$_REQUEST[job_description]','$_REQUEST[job_piority]','$_REQUEST[job_type]','$_SESSION[ss_user_id]','send',NOW(),'$_REQUEST[job_datetime_receive]','$_REQUEST[job_datetime_close]','$_REQUEST[job_repaire_description]')"; 
$result = mysql_query($sql_query); 

 ?><meta http-equiv="refresh" content="3; url=it_job.php"  /><? include("footer.php"); ?>
