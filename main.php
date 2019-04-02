<?php include("header.php"); ?>
<table border="0" width="65%" cellspacing="0" cellpadding="0" align="center" class="bordered" style="margin-top:100px;">
  <tr>
    <td rowspan="3" width="150" align="center"><img src="man-24-512.png" width="100" /></td>
    <td colspan="2"><? echo $_SESSION[ss_title]."".$_SESSION[ss_name]." ".$_SESSION[ss_sname]; ?></td>
  </tr>
  <tr>
    <td align="left" width="120" ><strong>รหัส</strong> <? echo $_SESSION['ss_user_code']; ?> </td>
    <td align="left" ><strong>ตำแหน่ง</strong> <? echo $_SESSION['ss_position']; ?></td>
  </tr>
  <tr>
    <td colspan="2">เข้าใช้งานล่าสุด :
      <? if($_SESSION['last_login'] != ""){ echo date("d/m/", strtotime($_SESSION['last_login'])).(date("y", strtotime($_SESSION['last_login']))+43).date(" H:i", strtotime($_SESSION['last_login']));}else{ echo "-";} ?>
      น.</td>
  </tr>
</table>
<?php include("footer.php"); ?>
