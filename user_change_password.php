<?php include("header.php"); ?>
<script>
	function doSubmit(){
		if(document.getElementById("new_password").value == "" || document.getElementById("new_password2").value == "" ){
			Apprise("<br /><center><strong>กรุณากรอกข้อมูลให้ครบ</strong></center><br />");
		}else if(document.getElementById("new_password").value != document.getElementById("new_password2").value){
			Apprise("<br /><center><strong>กรุณากรอกรหัสผ่านใหม่ให้ตรงกัน</strong></center><br />");
		}else{
			document.getElementById("form1").submit();
		}
	}
</script>

<form action="user_dochange_password.php" method="post"  id=form1>
  <table border="0" style="width:100%; margin-top:15px; font-size:40px;" cellspacing="0" cellpadding="0" align="center" class="bordered">
    <tr>
      <td align="right" colspan="2" style="padding-right:30px; font-size:40px;"><strong>เปลี่ยนรหัสผ่าน</strong></td>
    </tr>
    <tr>
      <td width="30%" align="right">รหัสผ่านเดิม</td>
      <td align="left"><input type="password" name="old_password" id="old_password" style="width:450px; font-size:30px;"></td>
    </tr>
    <tr>
      <td align="right">รหัสผ่านใหม่</td>
      <td align="left"><input type="password" name="new_password" id="new_password"  style="width:450px; font-size:30px;"></td>
    </tr>
    <tr>
      <td align="right">รหัสผ่านใหม่ (2)</td>
      <td align="left"><input type="password" name="new_password2" id="new_password2"  style="width:450px; font-size:30px;"></td>
    </tr>
    <tr>
      <td align="center" colspan="2"><a class="orange large button" href="#" onclick="doSubmit()" style="font-size:40px;"><strong>เปลี่ยนรหัสผ่าน</strong></a></td>
    </tr>
    <tr>
      <td align="right" colspan="2" style="padding-right:30px;">&nbsp;</td>
    </tr>
  </table>
</form>
<?php include("footer.php"); ?>
