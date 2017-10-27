<? include("header.php"); ?>
<script>
function doSubmit(){
	
	document.getElementById("form1").submit();
}
function doConfirm(){
	if(document.getElementById("job_title").value == '' || document.getElementById("job_description").value == ''){
	
		alert("กรุณากรอกข้อมูลให้ครบถ้วน");
	
	}else{
	 
		document.getElementById("job_title_span").innerHTML  =  document.getElementById("job_title").value ;
		document.getElementById("job_description_span").innerHTML  =  document.getElementById("job_description").value.replace(/\r?\n/g, '<br />') ;
		document.getElementById("job_piority_span").innerHTML  =  document.getElementById("job_piority").options[document.getElementById("job_piority").selectedIndex].text ;
		document.getElementById("job_type_span").innerHTML  =  document.getElementById("job_type").options[document.getElementById("job_type").selectedIndex].text ;
		 
		document.getElementById("form_detail").style.visibility = 'hidden';  
		document.getElementById("form_detail").style.display = 'none';
		
		document.getElementById("confirm").style.visibility = 'visible';  
		document.getElementById("confirm").style.display = '';
	}
}
function doEdit(){
	document.getElementById("confirm").style.visibility = 'hidden';  
	document.getElementById("confirm").style.display = 'none';
	
	document.getElementById("form_detail").style.visibility = 'visible';  
	document.getElementById("form_detail").style.display = '';
}
</script>

<form action="it_job_doadd.php" method="post" id="form1" >
  <div id="form_detail">
    <table border='0' style='width:100%; margin-top:15px; font-size:40px;' cellspacing='0' cellpadding='0' align='center' class='bordered'>
      <tr>
        <td align='right' colspan='2' style='padding-right:30px; font-size:40px;'><strong>แจ้งซ่อมงานไอที</strong></td>
      </tr>
      <tr>
        <td width='30%'  align="right">เรื่อง</td>
        <td  align="left"><input type="text" name="job_title" id="job_title" style="width:450px; font-size:30px;"></td>
      </tr>
      <tr>
        <td width='30%'  align="right" valign="top">รายละเอียด</td>
        <td  align="left"><textarea name="job_description" id="job_description" style="width:450px; font-size:30px; " rows="10"></textarea></td>
      </tr>
      <tr>
        <td width='30%'  align="right">ความสำคัญ</td>
        <td  align="left"><select name="job_piority" id="job_piority" style="width:450px; font-size:30px;">
            <option value="low">ต่ำ</option>
            <option value="medium">ปานกลาง</option>
            <option value="high">สูง</option>
          </select></td>
      </tr>
      <tr>
        <td width='30%'  align="right">ประเภทงาน</td>
        <td  align="left"><select name="job_type" id="job_type" style="width:450px; font-size:30px;">
            <option value="hardware">Hardware</option>
            <option value="software">Software</option>
            <option value="network">ระบบเนตเวิร์ค</option>
            <option value="telephone">ระบบโทรศัพท์ภายใน ตู้สาขา</option>
            <option value="mobile">iPad / Tablet / Mobile</option>
          </select></td>
      </tr>
      <tr>
        <td align='center' colspan='2'><a class='orange large button' href='#' onclick='doConfirm()' style='font-size:40px;'><strong>Submit</strong></a></td>
      </tr>
      <tr>
        <td align='right' colspan='2' style='padding-right:30px;'>&nbsp;</td>
      </tr>
    </table>
  </div>
  <div id="confirm" style="visibility:hidden; display:none;">
    <table border='0' style='width:100%; margin-top:15px; font-size:40px;' cellspacing='0' cellpadding='0' align='center' class='bordered'>
      <tr>
        <td align='right' colspan='2' style='padding-right:30px; font-size:40px;'><strong>ยืนยันส่งงานแจ้งซ่อมงานไอที</strong></td>
      </tr>
      <tr>
        <td width='30%'  align="right"><strong>เรื่อง</strong></td>
        <td  align="left"><span name="job_title_span" id="job_title_span" ></span></td>
      </tr>
      <tr>
        <td width='30%'  align="right" valign="top"><strong>รายละเอียด</strong></td>
        <td  align="left"><span name="job_description_span" id="job_description_span" ></span></td>
      </tr>
      <tr>
        <td width='30%'  align="right"><strong>ความสำคัญ</strong></td>
        <td  align="left"><span name="job_piority_span" id="job_piority_span" ></span></td>
      </tr>
      <tr>
        <td width='30%'  align="right"><strong>ประเภทงาน</strong></td>
        <td  align="left"><span name="job_type_span" id="job_type_span" ></span>
		  </td>
      </tr>
      <tr>
        <td align='center' colspan='2'><a class='orange large button' href='#' onclick='doSubmit()' style='font-size:40px;'><strong>Submit</strong></a>&nbsp;<a class='green large button' href='#' onclick='doEdit()' style='font-size:40px;'><strong>แก้ไข</strong></a></td>
      </tr>
      <tr>
        <td align='right' colspan='2' style='padding-right:30px;'>&nbsp;</td>
      </tr>
    </table>
  </div>
</form>
<? include("footer.php"); ?>
