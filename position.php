<? include("header.php"); ?>

<table border='0' style='width:100%; margin-top:15px; font-size:40px;' cellspacing='0' cellpadding='0' align='center' class='bordered'>
<tr>
  <td align='left' style='padding-left:30px; font-size:40px;' valign='bottom'><strong>ตำแหน่งงาน</strong></td>
  <td align='right' style='padding-right:30px;'><a class='orange large button' href=position_add.php style='text-align:center; height:30px; font-size:30px;'><strong>ข้อมูลตำแหน่งงาน</strong></a></td>
</tr>
<?  
$sql = "select * from department";
$res = mysql_query($sql);
while($row = mysql_fetch_array($res)){
	$all_department[$row[department_id]] = $row[department_name];
}

$sql = "select * from position_level";
$res = mysql_query($sql);
while($row = mysql_fetch_array($res)){
	$all_position_level[$row[position_level_id]] = $row[position_level_name];
}

$sql_query = "select * from `position` Order By `department_id` ASC , `position_level_id` DESC ,`position_name` ASC  "; 
$result = mysql_query($sql_query); 
?>
<tr>
  <td align='center' colspan='2'><table id='hor-minimalist-b' >
      <thead>
        <tr>
          <th width="3%">ที่.</th>
          <th>ตำแหน่ง</th>
          <th width="20%">แผนก</th>
          <th width="10%">ระดับ</th>
            <th width="5%" align="center">สถานะ</th>
          <th width="5%">&nbsp;</th>
        </tr>
      </thead>
      <tbody>
        <?
$i = 1;
while($arr = mysql_fetch_array($result)){
?>
        <tr>
          <td><? echo $i; ?></td>
          <td><? echo $arr['position_name']; ?></td>
          <td><? echo $all_department[$arr['department_id']]; ?></td>
          <td><? echo $all_position_level[$arr['position_level_id']]; ?></td>
            <td  align="center"><? if($arr['position_active'] == "yes"){ ?>
              <img src="trafficlight green.png" height="20" />
              <? }else{ ?>
              <img src="trafficlight red.png"  height="20"  />
              <? } ?></td>
          <td><div align=center><a href=position_edit.php?position_id=<? echo $arr[0] ?>><img src='Editing-Edit-icon.png' width='20'   /></a></div></td>
        </tr>
        <? $i++; 
 } ?>
      </tbody>
    </table>
  <br />

    <? include("footer.php"); ?>
