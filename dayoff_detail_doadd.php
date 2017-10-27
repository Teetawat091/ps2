<? include("header.php"); ?>
  <table border='0' style='width:100%; margin-top:15px; font-size:40px;' cellspacing='0' cellpadding='0' align='center' class='bordered'><tr><td align='center' colspan='2' style=' font-size:60px; letter-spacing:2px;' height='300' valign='middle'><strong>dayoff_detail</strong></td></tr></table> 
<?  $sql_query = "Insert Into `dayoff_detail` (`dayoff_detail_id`,`dayoff_detail_year`,`dayoff_detail_month`,`dayoff_detail_day`,`datetime_entered`)VALUES( 
NULL,'$_REQUEST[dayoff_detail_year]','$_REQUEST[dayoff_detail_month]','$_REQUEST[dayoff_detail_day]','$_REQUEST[datetime_entered]')"; 
$result = mysql_query($sql_query); 

 ?><meta http-equiv="refresh" content="3; url=dayoff_detail.php"  /><? include("footer.php"); ?>
