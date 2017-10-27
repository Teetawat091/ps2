<? include("header.php"); ?>
<link href="css_gallery/lightgallery.css" rel="stylesheet">
<table border='0' style='width:100%; margin-top:15px; font-size:40px;' cellspacing='0' cellpadding='0' align='center' class='bordered'>
<tr>
  <td align='left' style='padding-left:30px; font-size:40px; padding-right:30px;' valign='bottom'><strong>2559 / สาขาสุราษฎร์ธานี</strong>
    <hr></td>
</tr>
<tr>
  <td style='padding-left:30px; padding-right:30px;'><table width="100%" border="0" cellspacing="0" cellpadding="0" style=" font-size:34px;">
      <td style='padding-left:30px; padding-right:30px;'><table width="100%" border="0" cellspacing="0" cellpadding="0" style=" font-size:34px;">
            <tr>
              <td width="30%"><ul id="lightgallery">
                  <li  data-src="company_profile/2559/surat/Lotus_20_02_59/1.jpg" style=" list-style-type: none;" data-sub-html="<h1>บูธโลตัส สุราษฎร์ฯ</h1>"> <a href=""> <img class="img-responsive"  src="company_profile/2559/surat/Lotus_20_02_59/1.jpg" style="width:80%;"> </a> </li>
                  <?
		$directory = "company_profile/2559/surat/Lotus_20_02_59/";
		$filecount = 0;
		$files = glob($directory . "*");
		if ($files){
		 $filecount = count($files);
		}
		for($i=1;$i<= $filecount; $i++){
		if($i != 1){
	?>
                  <li style="display:none;"  data-src="company_profile/2559/surat/Lotus_20_02_59/<? echo $i;  ?>.jpg" data-sub-html="<h1>บูธโลตัส สุราษฎร์ฯ</h1>"> <a href=""> <img class="img-responsive" src="company_profile/2559/surat/Lotus_20_02_59/<? echo $i;  ?>.jpg"> </a> </li>
                  <? }
	}	
	 ?>
                </ul></td>
              <td valign="top"><strong>บูธโลตัส สุราษฎร์ฯ </strong><br>
                ระหว่างวันที่  20 ก.พ.59 <br>
              <a href="company_profile/2559/surat/Lotus_20_02_59.rar" target="_blank">Download</a></td>
            </tr>
          </table></td>
      </tr>

    </table>
   
    <script type="text/javascript">
        $(document).ready(function(){
            $('#lightgallery').lightGallery();

        });
        </script>
    <script src="https://cdn.jsdelivr.net/picturefill/2.3.1/picturefill.min.js"></script>
    <script src="js_gallery/lightgallery.js"></script>
    <script src="js_gallery/lg-fullscreen.js"></script>
    <script src="js_gallery/lg-thumbnail.js"></script>
    <script src="js_gallery/lg-video.js"></script>
    <script src="js_gallery/lg-autoplay.js"></script>
    <script src="js_gallery/lg-zoom.js"></script>
    <script src="js_gallery/lg-hash.js"></script>
    <script src="js_gallery/lg-pager.js"></script>
    <script src="js_gallery/jquery.mousewheel.min.js"></script>
    <? include("footer.php"); ?>
