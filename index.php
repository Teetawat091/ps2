<?

	if($_POST['username'] && $_POST['password']){
		include("db.php");
		$username = $_POST['username'];
		$password  = $_POST['password'];
		$sql = "Select * FROM  `user` where `username`= '$username'  AND `password` = PASSWORD(  '$password' )  ";
		$result = mysql_query($sql);
		$num = mysql_num_rows($result);
		if($num == 0){
			$error = "Username , Password ไม่ถูกต้อง";
		}else{
			$row = mysql_fetch_array($result);
			$_SESSION[ss_user_id] =  $row['user_id'];
			$_SESSION[ss_username] =  $row['username'];
			$_SESSION[ss_user_code] =  $row['user_code'];
			$_SESSION[ss_user_level] =  $row['user_level'];
			$_SESSION[ss_title] =  $row['title'];
			$_SESSION[ss_name] =  $row['name'];
			$_SESSION[ss_sname] =  $row['sname'];
			$_SESSION[ss_position_id] =  $row['position_id'];
			$_SESSION[ss_branch_id] =  $row['branch_id'];
			
			$sql = "INSERT INTO `user_login_log` (`id` ,`user_id` ,`ip` ,`datetime_entered`)VALUES (NULL ,  '$_SESSION[ss_user_id]',  '$_SERVER[REMOTE_ADDR]', NOW());";
			mysql_query($sql);
			
			$sql = "SELECT * FROM `user_login_log` Where user_id = '$_SESSION[ss_user_id]' Order By id DESC Limit 1,1 ";
			$res = mysql_query($sql);
			$row = mysql_fetch_array($res);
			$_SESSION[last_login] = $row['datetime_entered'];
			
			$sql = "SELECT * FROM `position` Where position_id = '$_SESSION[ss_position_id]' ";
			$res = mysql_query($sql);
			$row = mysql_fetch_array($res);
			$_SESSION[ss_position] = $row['position_name'];
			echo $_SESSION[ss_position];
			
			echo '<meta http-equiv="refresh" content="0; url=main.php">';
			exit;
				
		}
	}elseif($_POST['logincheck']){
		$error = "กรุุณาตรวจสอบ Username Password";
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Serene Management System 1.0</title>
<!-- Loading Bootstrap -->
<link href="css/bootstrap.css" rel="stylesheet">
<!-- Loading Flat UI -->
<link href="css/flat-ui.css" rel="stylesheet">
<style>
	@font-face {
    font-family: 'psl_kittithadaspregular';
    src: url('psl094sp-webfont.eot');
    src: url('psl094sp-webfont.eot?#iefix') format('embedded-opentype'),
         url('psl094sp-webfont.woff') format('woff'),
         url('psl094sp-webfont.ttf') format('truetype');
    font-weight: normal;
    font-style: normal;

}
	body {
		font-family:'psl_kittithadaspregular',Sans-Serif;
		margin:auto;
		width:450px;
 	}
	</style>
<script language="javascript" type="text/javascript">
	  document.oncontextmenu=RightMouseDown;
	  document.onmousedown = mouseDown; 
	
	  function mouseDown(e) {
		  if (e.which==3 ||e.which==2) {//righClick
		  //alert("Disabled - do whatever you like here..");
			}
	}
	function RightMouseDown() { return false;}
	</script>
	<script type="text/javascript">
<!--
function checklogin(f){
	if(document.all.item("username").value!="" && document.all.item("password").value!="")
		{f.submit();
	}
	else alert(" : : กรุณาใส่ชื่อผู้ใช้และรหัสผ่านค่ะ : : ");
	
}
-->
</SCRIPT>
</head>
<body >
<form action="index.php" method="post" id="admin" name="admin">
<table width="450" border="0" cellspacing="0" cellpadding="0" align="center" style="margin-top:50px;">
  <tr >
    <td colspan="3" align="center"><h1 style="font-size:50px;">Serene Management System</h1>
      <br />
    </td>
  </tr>
  <tr>
    <td ><div class="login-icon"> <img src="SereneLogo-TH-W.jpg" /> </div></td>
    <td >&nbsp;</td>
    <td ><div class="login-form" >
        <div class="control-group">
          <input type="text" class="login-field" value="" placeholder="ชื่อผู้ใช้งาน" name="username" />
          <label class="login-field-icon fui-man-16" for="login-name"></label>
        </div>
        <div class="control-group">
          <input type="password" class="login-field" value="" placeholder="รหัสผ่าน" name="password" />
          <label class="login-field-icon fui-lock-16" for="login-pass"></label>
        </div>
        <a class="btn btn-info btn-large btn-block" href="#" onclick="checklogin(admin)" style="font-size:40px;"><strong>ลงชื่อเข้าใช้งาน</strong></a> </div>
		<input type="submit" style=" display:none;" />
		</td>
  </tr>
  <tr >
    <td colspan="3" align="center"><br /><strong><span style="font-size:40px; color:#FF0000;"><? echo $error; ?></span></strong>
      
    </td>
  </tr></table>
</form>
</body>
</html>
