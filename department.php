<? include("header.php"); ?>

<table border='0' style='width:100%; margin-top:15px; font-size:40px;' cellspacing='0' cellpadding='0' align='center' class='bordered'>
  <tr>
    <td align='left' style='padding-left:30px; font-size:40px;' valign='bottom'><strong>ข้อมูลแผนก</strong></td>
    <td align='right' style='padding-right:30px;'><a class='orange large button' href=department_add.php style='text-align:center; height:30px; font-size:30px;'><strong>เพิ่มข้อมูลแผนก</strong></a></td>
  </tr>
  <?  
$sql_query = "select * from `department`"; 
$result = mysql_query($sql_query); 
?>
  <tr>
    <td align='center' colspan='2'><table id='hor-minimalist-b' >
        <thead>
          <tr>
            <th width="3%">ที่</th>
            <th>แผนก</th>
            <th width="10%" align="center">สถานะ</th>
            <th width="10%">&nbsp;</th>
          </tr>
        </thead>
        <tbody>
          <?
$i = 1;
while($arr = mysql_fetch_array($result)){
?>
          <tr>
            <td><? echo $i; ?></td>
            <td><? echo $arr['department_name']; ?></td>
            <td  align="center"><? if($arr['department_active'] == "yes"){ ?>
              <img src="trafficlight green.png" height="20" />
              <? }else{ ?>
              <img src="trafficlight red.png"  height="20"  />
              <? } ?></td>
            <td><div align=center><a href=department_edit.php?department_id=<? echo $arr[0] ?>><img src='Editing-Edit-icon.png' width='20'   /></a></div></td>
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
