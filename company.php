<? include("header.php"); ?>

<table border='0' style='width:100%; margin-top:15px; font-size:40px;' cellspacing='0' cellpadding='0' align='center' class='bordered'>
  <tr>
    <td align='left' style='padding-left:30px; font-size:40px;' valign='bottom'><strong>ข้อมูลบริษัท</strong></td>
    <td align='right' style='padding-right:30px;'><a class='orange large button' href=company_add.php style='text-align:center; height:30px; font-size:30px;'><strong>เพิ่มข้อมูลบริษัท</strong></a></td>
  </tr>
  <?  
$sql_query = "select * from `company`"; 
$result = mysql_query($sql_query); 
?>
  <tr>
    <td align='center' colspan='2'><table id='hor-minimalist-b' >
        <thead>
          <tr>
            <th width="3%">ที่.</th>
            <th width="40%">ชื่อบริษัท</th>
            <th>ที่อยู่</th>
            <th width="15%">เบอร์โทรศัพท์</th>
            <th>สถานะ</th>
            <th>&nbsp;</th>
          </tr>
        </thead>
        <tbody>
          <?
$i = 1;
while($arr = mysql_fetch_array($result)){
?>
          <tr>
            <td><? echo $i; ?></td>
            <td><? echo $arr['company_name']; ?></td>
            <td><? echo $arr['company_address']; ?></td>
            <td><? echo $arr['company_tel']; ?></td>
            <td align="center"><? if($arr['company_active'] == "yes"){ ?><img src="trafficlight green.png" height="20" /><? }else{ ?><img src="trafficlight red.png"  height="20"  /><? } ?></td>
            <td><div align=center><a href=company_edit.php?company_id=<? echo $arr[0] ?>><img src='Editing-Edit-icon.png' width='20'   /></a></div></td>
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
