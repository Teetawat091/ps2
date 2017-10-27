<? include("header.php"); ?>
<script>function doSubmit(){document.getElementById("form1").submit();}</script><form action=it_job_doedit.php method=post id=form1 >
<table border='0' style='width:100%; margin-top:15px; font-size:40px;' cellspacing='0' cellpadding='0' align='center' class='bordered'>
<tr><td align='right' colspan='2' style='padding-right:30px; font-size:40px;'><strong>it_job</strong></td></tr><?
$sql_query = " select * from it_job where job_id = $_REQUEST[job_id]";
$result = mysql_query($sql_query);
$detail = mysql_fetch_array($result);
 ?> 
<tr><td width='30%'  align=right>job_title</td>
<td align=left><input type="text" name="job_title" id="job_title" value="<? echo $detail[job_title]; ?>"  style="width:450px; font-size:30px;" /></td></tr> 
<tr><td width='30%'  align=right>job_description</td>
<td align=left><input type="text" name="job_description" id="job_description" value="<? echo $detail[job_description]; ?>"  style="width:450px; font-size:30px;" /></td></tr> 
<tr><td width='30%'  align=right>job_piority</td>
<td align=left><select name="job_piority"  style="width:450px; font-size:30px;"><option value=high>high</option><option value=medium>medium</option><option value=low>low</option></select></td></tr> 
<tr><td width='30%'  align=right>job_type</td>
<td align=left><select name="job_type"  style="width:450px; font-size:30px;"><option value=hardware>hardware</option><option value=software>software</option><option value=network>network</option><option value=telephone>telephone</option></select></td></tr> 
<tr><td width='30%'  align=right>job_sender_id</td>
<td align=left><input type="text" name="job_sender_id" id="job_sender_id" value="<? echo $detail[job_sender_id]; ?>"  style="width:450px; font-size:30px;" /></td></tr> 
<tr><td width='30%'  align=right>job_status</td>
<td align=left><select name="job_status"  style="width:450px; font-size:30px;"><option value=send>send</option><option value=receive>receive</option><option value=close>close</option></select></td></tr> 
<tr><td width='30%'  align=right>job_datetime_entered</td>
<td align=left><input type="text" name="job_datetime_entered" id="job_datetime_entered" value="<? echo $detail[job_datetime_entered]; ?>"  style="width:450px; font-size:30px;" /></td></tr> 
<tr><td width='30%'  align=right>job_datetime_receive</td>
<td align=left><input type="text" name="job_datetime_receive" id="job_datetime_receive" value="<? echo $detail[job_datetime_receive]; ?>"  style="width:450px; font-size:30px;" /></td></tr> 
<tr><td width='30%'  align=right>job_datetime_close</td>
<td align=left><input type="text" name="job_datetime_close" id="job_datetime_close" value="<? echo $detail[job_datetime_close]; ?>"  style="width:450px; font-size:30px;" /></td></tr> 
<tr><td width='30%'  align=right>job_repaire_description</td>
<td align=left><input type="text" name="job_repaire_description" id="job_repaire_description" value="<? echo $detail[job_repaire_description]; ?>"  style="width:450px; font-size:30px;" /></td></tr><tr>      <td align='center' colspan='2'><a class='orange large button' href='#' onclick='doSubmit()' style='font-size:40px;'><strong>Submit</strong></a></td></tr> <tr><td align='right' colspan='2' style='padding-right:30px;'>&nbsp;</td></tr>
</table><input type="hidden" name="job_id" value="<? echo $detail[job_id]; ?>"   >
</form><? include("footer.php"); ?>
