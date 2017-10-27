<? include("header.php"); ?>

<table border='0' style='width:100%; margin-top:15px; font-size:40px;' cellspacing='0' cellpadding='0' align='center' class='bordered'>
  <tr>
    <td align='center' colspan='2' style=' font-size:60px; letter-spacing:2px;' height='300' valign='middle'><strong>เพิ่มข้อมูลเรียบร้อยแล้ว</strong></td>
  </tr>
</table>
<?  
if($_FILES['picture']['name']){
	$ext = explode('.',$_FILES['picture']['name']);
	$extension = $ext[1];
	$newname = rand(1000,9999)."_".time();
	$full_local_path = 'upload/'.$newname.".".$extension ;
	$sql_path = 'upload/'.$newname.".".$extension ;
	move_uploaded_file($_FILES['picture']['tmp_name'], $full_local_path);
}else{
	$full_local_path = "";
}
$leave_apporve_id = implode(',',$_POST['apporver']);

$sql_query = "Insert Into `user` (`user_id`,`user_code`,`username`,`password`,`email`,`title`,`name`,`sname`,`dob`,`company_id`, `branch_id`,`position_id`,`user_level`,`dayoff_id`,`picture`,`user_status`,`leave_apporve_id`,`date_start`,`date_apporve`,`datetime_entered`)VALUES( 
NULL,'$_REQUEST[user_code]','$_REQUEST[username]',PASSWORD($_REQUEST[password]),'$_REQUEST[email]','$_REQUEST[title]','$_REQUEST[name]','$_REQUEST[sname]','$_REQUEST[dob]','$_REQUEST[company_id]','$_REQUEST[branch_id]','$_REQUEST[position_id]','$_REQUEST[user_level]','$_REQUEST[dayoff_id]','$full_local_path','$_REQUEST[user_status]','$leave_apporve_id','$_REQUEST[date_start]','$_REQUEST[date_apporve]',NOW())"; 
$result = mysql_query($sql_query); 

$m_id = mysql_insert_id();
$sql_query = "UPDATE `user` SET `dayoff_id` = '$m_id' Where `user_id` = $m_id"; 
$result = mysql_query($sql_query); 
$all_name = $_REQUEST[name]." ".$_REQUEST[sname];
$sql_query = "Insert Into `dayoff` (`dayoff_id`,`dayoff_name`)VALUES( 
$m_id,'$all_name')"; 
$result = mysql_query($sql_query); 

//
 ?>
<meta http-equiv="refresh" content="3; url=user.php"  />
<? include("footer.php"); ?>
