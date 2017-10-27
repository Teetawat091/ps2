<?php
ob_start(); include('header.php');?>

  <script type="text/javascript" src="js/jquery-3.2.1.js"></script>
  <script type="text/javascript" src="js/html2canvas.js"></script>
  <script type="text/javascript" src="js/canvas2image.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Prompt" rel="stylesheet">
  <!--<meta name="viewport" content="initial-scale=1.0, user-scalable=no">-->
  <!--<meta charset="utf-8">-->
    <style>

      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
        font-family: 'Prompt', sans-serif;
        text-align: justify;
      }

      #map {      	
        height: 500px;
        left: 0;
        width: 100%;

      }
      #floating-panel {
        position: absolute;    
        
        z-index: 5;
        background-color: #fff;
        padding: 7.6px;
        border: 0px solid #999;
        line-height: 30px;
        padding-left: 10px; 
      }
      
      #right-panel {
        
        width: 100%;
        height: 100%;
        overflow-y: scroll;
        scrollbar-arrow-color:blue;
        scrollbar-face-color: #e7e7e7;
        scrollbar-3dlight-color: #a0a0a0;
        scrollbar-darkshadow-color:#888888;
      }
      #right-panel {
        
        line-height: 20px;
        padding-left: 5px;
        background-color: #DDDDDD;
      }

      #right-panel select, #right-panel input {
        
      }

      #right-panel select {
        width: 100%;
      }

      #right-panel i {
        
      }

      input[type = text],select{
        border-radius: 4px;
        border: 1px solid:#ccc;
        font-size: 26px;
      }

      button{
        border-radius: 4px;
        font-weight: bold;  
        border:1;
      }

      button:hover{
        box-shadow: 2px 5px 5px #888888;
        background-color: #9900cc;
        color: white;
      }
      
      .panel {
        height: 100%;
        overflow: auto;
      }

    </style>
    <?php

    $branchnamesql = "select branch.branch_lat,branch.branch_lng,branch.branch_id
    from branch, user
    where branch.branch_id = user.branch_id
    and user.branch_id =".$_SESSION['ss_branch_id']." LIMIT 1";
    //echo $branchnamesql;
    
    $branchres = mysql_query($branchnamesql);
    
    $ress = mysql_fetch_array($branchres);
    $userbranchlatlng[0] = $ress['branch_lat'];
    $userbranchlatlng[1] = $ress['branch_lng'];
    $userbranchlatlng[2] = $ress['branch_id'];
    $userbranchlatlng[3] = $ress['branch_name'];

    //echo $userbranchlatlng[0].",".$userbranchlatlng[1];
    ?>
    
        <script id = "sc" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBHlC_bwi0D_b86YE0ZN1hnymItuDb_5N0&callback=initMap" async defer></script>
        <script>
        var markers = [];
        var directionsDisplay;
        var directionsService;
        var lat_lng;
        var lat;
        var lng;
        var dynamicroute = [] ;

        console.log(screen.width+"x"+screen.height);
                 
        //lat_lng = '<?php echo $userbranchlatlng[0] ?>';
        //console.log(lat_lng);

        function initMap() {
          var mappop ={
              center:new google.maps.LatLng(<?php echo $userbranchlatlng[0]?>,<?php echo $userbranchlatlng[1] ?>),
              zoom:15
          }
          var map = new google.maps.Map(document.getElementById('map'),mappop);
          google.maps.event.addListener(map, 'click', function(event) {
            placeMarker(map, event.latLng);
          });
          directionsService = new google.maps.DirectionsService;
          directionsDisplay = new google.maps.DirectionsRenderer({
            draggable: true,
            map: map,
            panel: document.getElementById('right-panel')

          });
          directionsDisplay.addListener('directions_changed', function() {
            computeTotalDistance(directionsDisplay.getDirections());
          });
          var currentdate = new Date();

        var month = currentdate.getMonth()+1;
          if(month<10){
            month = "0"+month;
          }
          var day = currentdate.getDate();
          if(day<10){
            day = "0"+day;
          }
          datetime = currentdate.getFullYear() + "-"+month
          + "-" + day + " "
          + currentdate.getHours() + ":"
          + currentdate.getMinutes() + ":" + currentdate.getSeconds();
          document.getElementById('datetime').value = datetime; 

          document.getElementById('or').value = mappop.center;
          var og = document.getElementById('or').value.substr(1);
          og = og.substr(0,og.length-1);

          document.getElementById('or').value = og;

          //console.log(document.getElementById('or').value);

          //ใส่marker+routing เข้าที่เดิมที่จุดที่สำนักงานอยู่ ได้100เปอ
          placeMarker(map,mappop.center);

          // marker แสดงที่ตั้งสำนักงานแต่ละที่แบบไม่routing+infowindow ให้รู้ว่าสำนักงานจังหวัดไหน -------*******-------- ใส่แล้วบัค
          /*var mark = new google.maps.Marker({
            position:mappop.center,
            map: map,
          });
          markers.push(mark);*/
          //infowindow
          /*var infowindow = new google.maps.InfoWindow({
          content: 'สำนักงานจังหวัด : ' + '<?php echo $_GET['branch'] ?>'
          });
          infowindow.open(map,mark);*/
   
        }
           
        function displayRoute(origin, destination, service, display) {
          service.route({
            origin: origin,
            destination: destination,
            waypoints: [],
            travelMode: google.maps.TravelMode.DRIVING,
            avoidTolls: true
          }, function(response, status) {
            if (status === google.maps.DirectionsStatus.OK) {
              display.setDirections(response);
            } else {
              //alert('Could not display directions due to: ' + status);
            }
          });
        }
        function placeMarker(map, location) {
          var marker = new google.maps.Marker({
            position: location,
            map: map,
          });
          markers.push(marker);
           lat = marker.getPosition().lat();
           lng = marker.getPosition().lng();
           seten(lat,lng);
        }

        function starting(id){
          document.getElementById('or').value = document.getElementById(id).value;
          document.getElementById('index').value = document.getElementById(id).selectedIndex;
          displayRoute(''+document.getElementById('or').value+'',''+document.getElementById('en').value+'',directionsService,
            directionsDisplay);
           
        }

        function ending(id){
          var end= document.getElementById('en').value = document.getElementById(id).value;
          //alert($('#or').val());
          if(document.getElementById('or').value!=""){
             displayRoute(''+document.getElementById('or').value+'',''+end+'',directionsService,
            directionsDisplay);
          //document.getElementById('takeshot').disabled = '';
          clearMarkers();
          markers = [];

          }
          //document.getElementById('en').value = "";
        }

        function seten(lat,lng){
           document.getElementById('en').value = lat+","+lng;
          
          //alert(document.getElementById('en').value);
          displayRoute(''+document.getElementById('or').value+'',''+document.getElementById('en').value+'',directionsService,
            directionsDisplay);

          //document.getElementById('takeshot').disabled = '';     
          clearMarkers();
          markers = [];
          //document.getElementById('en').value = "";
        }

        function setMapOnAll(map) {
            for (var i = 0; i < markers.length; i++) {
              markers[i].setMap(map);
            }
          }

        function clearMarkers() {
          setMapOnAll(null);
        }

        function savepic(){

          //document.getElementById('vihicle').value =  document.getElementById('vihicle').value;
        document.getElementById('en').value ;
        html2canvas(document.getElementById('map'), {
          useCORS: true,
          allowTaint:false,
          taintTest: false,
          onrendered: function(canvas) {
            var dataUrl= canvas.toDataURL("image/png");
            //document.getElementById('pic').appendChild( canvas );
            canvas.id = "c";
            var img =  document.createElement("img");
            img.setAttribute('src', dataUrl);
            img.setAttribute('id', 'image');
            img.setAttribute('download','pic/route.png');
            document.getElementById('pic').appendChild(img);
           // var url = img.src.replace(/^data:image\/[^;]/, 'data:application/octet-stream');
           // window.open(url);
           var imm = document.getElementById('image').src;
           var xml = new XMLHttpRequest();
           xml.open('post','snap_pic.php',true);
           xml.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
           xml.onreadystatechange = function(){
            if(this.readyState == 4 && this.status ==200){
              //alert(datetime);
              //document.getElementById('pic').innerHTML = this.responseText;
              //alert(this.responseText);
              //alert(document.getElementById('pic').innerHTML);
            }
           
           }
           xml.send('imgsrc='+dataUrl+'&datetime='+datetime);
            //document.write('<img src="' + dataUrl + '"/>');
            }
          });
        }
        
          function computeTotalDistance(result) {
          var total = 0;
          var test;
          var slat;
          var myroute = result.routes[0];

          for (var i = 0; i < myroute.legs.length; i++) {
            total += myroute.legs[i].distance.value;
            //console.log(myroute.legs[0].start_location);
            }
          total = total / 1000;
          document.getElementById('total').value = total;
          console.log(dynamicroute.length);
          slat = JSON.stringify(myroute.legs[0].start_location);
          document.getElementById('realstart').value = slat;
                    //console.log(document.getElementById('realstart').value);
          //alert(JSON.stringify(dynamicroute));   
         
          }
           
        </script>

      <div id="floating-panel">
    
   <form action="user_outgoing_add.php" method="post" id="form555">
    <strong>ยานภาหนะ </strong>
    <select name="select" id="vihicle">
      <option value="car">รถยนต์</option>
      <option value="motercycle" selected="selected">มอเตอไซค์</option>
    </select>
    <strong>สาขา</strong>

    <select name="campus" id="campus">
    <!--<option value="" selected="selected"><?php echo $_GET['branch'] ?></option>-->
    <?php // ดึงสาขาทั้งหมดมาจาก DB
    $sql = "SELECT branch_name FROM `branch` WHERE branch_id =".$userbranchlatlng[2];
    $res = mysql_query($sql);
    while ($rec= mysql_fetch_array($res)) {  
    ?>
   <option value="<?php echo $rec['branch_lat'].",".$rec['branch_lng'] ?>"><?php  echo $rec['branch_name'] ?></option><
    <?php
    }
    
    ?>
    </select>
  
    <button id="submitbtn" style="display: none;">บันทึก</button>
    <div id="subcats" align="left" style="display:block">
    <strong>จาก</strong>
    <select id="Phuket" name="subcategory" onchange="starting(this.id)">
    <option value="<?php echo $userbranchlatlng[0].','.$userbranchlatlng[1] ?>" selected="selected">สำนักงาน</option>
     </script>
    <?php
    $sqldes = "select branch_destination.branch_destination_name,branch_destination.lat_destination,branch_destination.lng_destination from branch_destination,branch where branch_destination.branch_id = branch.branch_id and branch.branch_id =".$userbranchlatlng[2];
    $startres = mysql_query($sqldes);
    if($startres){
      while ($startrec= mysql_fetch_array($startres)) {
          
    ?>
   <option value="<?php echo $startrec['lat_destination'].",".$startrec['lng_destination'] ?>"><?php  echo $startrec['branch_destination_name'] ?></option>
    <?php
    }
    }
    ?>
    </select>

    </select>
    <select  id="Hatyai" name="subcategory"  onchange="ending(this.id)">
      <option value="">ไปยัง</option>
      <?php
 
      $startres = mysql_query($sqldes);
    if($startres){
      while ($hrec= mysql_fetch_array($startres)) {
    ?>
   <option value="<?php echo $hrec['lat_destination'].",".$hrec['lng_destination'] ?>"><?php  echo $hrec['branch_destination_name'] ?></option>
    <?php
    }
    }
    ?>
    </select>

    </div>
      <input type="hidden" name="or" value="" id="or">
      <input type="hidden" name="en" value="" id="en">
      <input type="hidden" name="cam" value="" id="cam">
      <input type="hidden" name="total" value="" id="total">
      <input type="hidden" name="datetime" value="" id="datetime">
      <input type="hidden" name="realstart" value="" id="realstart">
      <input type="hidden" name="index" id="index" value="">
      <input type="hidden" name="uid" id="uid" value="<?php echo $_SESSION[ss_user_id]; ?>">
      <input type="hidden" name="userlat" id="userlat" value="<?php echo $userbranchlatlng[0] ?>">
      <input type="hidden" name="userlng" id="userlng" value="<?php echo $userbranchlatlng[1] ?>">
      <input type="hidden" name="descriptions" id="descriptions" value="">
    
    </form>
  
    </div>
      <body >
        <div id="map" class="col-xs-12 col-md-10 col-lg-12 "></div>
        <div id="right-panel" class="col-lg-12 col-md-10 " align="left" style="font-size: 16px"></div> 
        <div id="btn" style="display: inline-flex;"> 
        <a class="green large button" href="#" onclick="kkk()" style="font-size:40px;"><strong>บันทึก</strong></a> &nbsp;&nbsp;
        <a class="green large button" onclick="showdialog()" id="setdes" style="font-size:40px;"><strong>หมายเหตุ</strong></a>
        <a class="green large button" onclick="hidedialog()" id="diag" style="font-size:40px;display: none;"><strong>หมายเหตุ</strong></a> &nbsp;&nbsp;
        <textarea  " cols="35" id="desc" style="border-radius: 4px ;display:none;"></textarea>
        </div> <br><br>
   
        <div id="pic" style="display: none;"></div>

      </body>
    <script>
     document.getElementById('or').value = <?php echo $userbranchlatlng[0]?>;
     document.getElementById('or').value = document.getElementById('or').value+","+<?php echo $userbranchlatlng[1] ?>;
     document.getElementById('cam').value = <?php echo $userbranchlatlng[2] ?>;  

     function showdialog(){
      $("#desc").show(1000);
      //document.getElementById('desc').style.display = 'block';
      document.getElementById('diag').style.display = 'block'; 
      document.getElementById('setdes').style.display = 'none';
     }
     function hidedialog(){

      //console.log(document.getElementById('desc').value);
      $("#desc").hide(1000);
      document.getElementById('diag').style.display = 'none';
      document.getElementById('setdes').style.display = 'block';
      document.getElementById('descriptions').value = document.getElementById('desc').value;
      console.log(document.getElementById('descriptions').value);
     }
     
     function kkk() {
     	var timeout =  setTimeout(function(){ document.getElementById('form555').submit(); },800);
    	if (timeout) {
    		savepic();
    	}
     	//savepic();
     	//document.getElementById('form555').submit();
     }
     
    </script>
</html>

<?include('footer.php');?>