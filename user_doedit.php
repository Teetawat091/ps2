<? include("header.php"); ?>

<table border='0' style='width:100%; margin-top:15px; font-size:40px;' cellspacing='0' cellpadding='0' align='center' class='bordered'>
  <tr>
    <td align='center' colspan='2' style=' font-size:60px; letter-spacing:2px;' height='300' valign='middle'><strong>แก้ไขปรับปรุงข้อมูลเรียบร้อยแล้ว</strong></td>
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

$sql_query = "UPDATE `user` SET `username` = '$_REQUEST[username]'  , `email` = '$_REQUEST[email]'  , `title` = '$_REQUEST[title]'  , `name` = '$_REQUEST[name]'  , `sname` = '$_REQUEST[sname]'  , `dob` = '$_REQUEST[dob]' ,`company_id`= '$_REQUEST[company_id]', `branch_id`= '$_REQUEST[branch_id]' , `position_id` = '$_REQUEST[position_id]' , `user_level` = '$_REQUEST[user_level]'  , `picture` = '$full_local_path'  , `user_status` = '$_REQUEST[user_status]'  , `leave_apporve_id` = '$leave_apporve_id'  , `date_start` = '$_REQUEST[date_start]'  , `date_apporve` = '$_REQUEST[date_apporve]'  , `date_retire` = '$_REQUEST[date_retire]'  Where `user_id` = $_REQUEST[user_id]"; 
$result = mysql_query($sql_query); 

 ?>
<meta http-equiv="refresh" content="1; url=user.php"  />
<? include("footer.php"); ?>
