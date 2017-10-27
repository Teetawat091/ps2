<? include("header.php"); ?>

<table border='0' style='width:100%; margin-top:15px; font-size:40px;' cellspacing='0' cellpadding='0' align='center' class='bordered'>
  <tr>
    <td align='left' style='padding-left:30px; font-size:40px;' valign='bottom'><strong>หมวดหมู่้ทรัพย์สิน</strong></td>
    <td align='right' style='padding-right:30px;'><a class='orange large button' href=asset_category_add.php style='text-align:center; height:30px; font-size:30px;'><strong>เพิ่มหมวดหมู</strong></a></td>
  </tr>
  <?  
$sql_query = "select * from `asset_category`"; 
$result = mysql_query($sql_query); 
?>
  <tr>
    <td align='center' colspan='2'><table id='hor-minimalist-b' >
        <thead>
          <tr>
            <th width="10">No.</th>
            <th>หมวหมู่</th>
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
            <td><? echo $arr['asset_category_name']; ?></td>
            <td><div align=center><a href=asset_category_edit.php?asset_category_id=<? echo $arr[0] ?>><img src='Editing-Edit-icon.png' width='20'   /></a></div></td>
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
