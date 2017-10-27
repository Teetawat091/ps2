<? include("header.php");
 ?>
<script>function doSubmit(){document.getElementById("form1").submit();}</script>

<form action=position_doadd.php method=post id=form1 >
  <table border='0' style='width:100%; margin-top:15px; font-size:40px;' cellspacing='0' cellpadding='0' align='center' class='bordered'>
    <tr>
      <td align='right' colspan='2' style='padding-right:30px; font-size:40px;'><strong>เพิ่มตำแหน่งงาน</strong></td>
    </tr>
    <tr>
      <td width='30%'  align=right>แผนก</td>
      <td  align=left><select name="department_id"  style="width:450px; font-size:30px;">
          <?php 
				$sql = "select * from `department` where department_active = 'yes' Order By  department_name";
				$result = mysql_query($sql);
				while($row = mysql_fetch_array($result)){
					echo "<option value='".$row[department_id]."'>".$row['department_name']."</option>";
				} 
			?>
        </select></td>
    </tr>
    <tr>
      <td width='30%'  align=right>ระดับ</td>
      <td  align=left><select name="position_level_id"  style="width:450px; font-size:30px;">
          <?php 
				$sql = "select * from `position_level` ";
				$result = mysql_query($sql);
				while($row = mysql_fetch_array($result)){
					echo "<option value='".$row[position_level_id]."'>".$row['position_level_name']."</option>";
				} 
			?>
        </select></td>
    </tr>
    <tr>
      <td width='30%'  align=right>ตำแหน่ง</td>
      <td  align=left><input type="text" name="position_name" id="position_name" style="width:450px; font-size:30px;"  /></td>
    </tr>
    <tr>
      <td width='30%'  align=right>สถานะ</td>
      <td  align=left><select name="position_active" style="width:450px; font-size:30px;">
          <option value=yes>ปกติ</option>
          <option value=no>ยกเลิก</option>
        </select></td>
    </tr>
    <tr>
      <td align='center' colspan='2'><a class='orange large button' href='#' onclick='doSubmit()' style='font-size:40px;'><strong>เพิ่มตำแหน่งงาน</strong></a></td>
    </tr>
    <tr>
      <td align='right' colspan='2' style='padding-right:30px;'>&nbsp;</td>
    </tr>
  </table>
</form>
<? include("footer.php"); ?>
