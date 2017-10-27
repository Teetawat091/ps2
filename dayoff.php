<? include("header.php"); ?>

<table border='0' style='width:100%; margin-top:15px; font-size:40px;' cellspacing='0' cellpadding='0' align='center' class='bordered'>
  <tr>
    <td align='left' style='padding-left:30px; font-size:40px;' valign='bottom'><strong>ข้อมูลชุดวันหยุด</strong></td>
    <td align='right' style='padding-right:30px;'><!-- <a class='orange large button' href=dayoff_add.php style='text-align:center; height:30px; font-size:30px;'><strong>เพิ่มข้อมูลชุดวันหยุด</strong></a>--></td>
  </tr>
  <?  
$sql_query = "SELECT * FROM `user` , `dayoff` WHERE `user`.`user_id` = `dayoff`.`dayoff_id` AND `user`.`user_status` != 'retire' AND `user`.`branch_id` = '$_SESSION[ss_branch_id]'"; 
$result = mysql_query($sql_query); 
?>
  <tr>
    <td align='center' colspan='2'><table id='hor-minimalist-b' >
        <thead>
          <tr>
            <th>ที่.</th>
            <th>ข้อมูลชุดวันหยุด</th>
           <!-- <th>&nbsp;</th>-->
            <th>&nbsp;</th>
          </tr>
        </thead>
        <tbody>
          <?
$i = 1;
while($arr = mysql_fetch_array($result)){
?>
          <tr>
            <td width="3%"><? echo $i; ?></td>
            <td><? echo $arr['dayoff_name']; ?></td>
           <!-- <td width="10%"><div align=center><a href=dayoff_edit.php?dayoff_id=<? echo $arr[0] ?>><img src='Editing-Edit-icon.png' width='20'   /></a></div></td> -->
            <td width="10%"><div align=center><a href=dayoff_detail.php?dayoff_id=<? echo $arr[0] ?>&dayoff_name=<? echo urlencode($arr['dayoff_name']); ?>><img src='calen.png' width='20'   /></a></div></td>
          </tr>
          <? $i++; 
 } ?>
        </tbody>
      </table>
      <br />
    </td>
  </tr>
</table>
<? include("footer.php"); ?>
