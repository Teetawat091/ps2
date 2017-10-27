<? include("header.php"); 
?>
<script>function doSubmit(){document.getElementById("form1").submit();}</script>

<form action=position_doedit.php method=post id=form1 >
  <table border='0' style='width:100%; margin-top:15px; font-size:40px;' cellspacing='0' cellpadding='0' align='center' class='bordered'>
    <tr>
      <td align='right' colspan='2' style='padding-right:30px; font-size:40px;'><strong>แก้ไขตำแหน่งงาน</strong></td>
    </tr>
    <?
$sql_query = " select * from position where position_id = $_REQUEST[position_id]";
$result = mysql_query($sql_query);
$detail = mysql_fetch_array($result);
 ?>
    <tr>
      <td width='30%'  align="right">แผนก</td>
      <td align=left><select name="department_id" id="department_id" style="width:450px; font-size:30px;">
          <?php 
				$sql = "select * from `department`";
				$result = mysql_query($sql);
				while($row = mysql_fetch_array($result)){
					if($row[department_id] == $detail[department_id]){
						echo "<option value='".$row[department_id]."' selected='selected' >".$row['department_name']."</option>";
					}else{
						echo "<option value='".$row[department_id]."'>".$row['department_name']."</option>";
					}
				} 
			?>
        </select></td>
    </tr>
    <tr>
      <td width='30%'  align="right">ระดับ</td>
      <td align=left><select name="position_level_id" id="position_level_id" style="width:450px; font-size:30px;">
          <?php 
				$sql = "select * from `position_level`";
				$result = mysql_query($sql);
				while($row = mysql_fetch_array($result)){
					if($row[position_level_id] == $detail[position_level_id]){
						echo "<option value='".$row[position_level_id]."' selected='selected' >".$row['position_level_name']."</option>";
					}else{
						echo "<option value='".$row[position_level_id]."'>".$row['position_level_name']."</option>";
					}
				} 
			?>
        </select></td>
    </tr>
    <tr>
      <td width='30%'  align="right">ตำแหน่ง</td>
      <td align=left><input type="text" name="position_name" id="position_name" value="<? echo $detail[position_name]; ?>"  style="width:450px; font-size:30px;"/></td>
    </tr>
    <tr>
      <td width='30%'  align="right">สถานะ</td>
      <td align=left><select name="position_active"  style="width:450px; font-size:30px;">
          <option value=yes <? if($detail[position_active] == "yes"){?> selected="selected" <? } ?>>ปกติ</option>
          <option value=no <? if($detail[position_active] == "no"){?> selected="selected" <? } ?>>ยกเลิก</option>
        </select></td>
    </tr>
    <tr>
      <td align='center' colspan='2'><a class='orange large button' href='#' onclick='doSubmit()' style='font-size:40px;'><strong>แก้ไขตำแหน่งงาน</strong></a></td>
    </tr>
    <tr>
      <td align='right' colspan='2' style='padding-right:30px;'>&nbsp;</td>
    </tr>
  </table>
  <input type="hidden" name="position_id" value="<? echo $detail[position_id]; ?>"   >
</form>
<? include("footer.php"); ?>
