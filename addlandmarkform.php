﻿<? include('header.php'); ?>

    <style type="text/css">
    html,body{
    	height: 100%;
    }

    #map{
    	height: 500px;
    	width: 100%;
    	
    }

    input[type = text],select,textarea{
        border-radius: 4px;
        border: 1px solid #ccc;
        font-size: 28px;
    }

    button,input[type = submit]{
        border-radius: 4px;
        font-weight: bold;   
        border:0; 
        background-color: #DDDDDD;   
        font-size: 20px;
    }

    button:hover{
        box-shadow: 2px 5px 5px #888888;
        background-color: #9900cc;
        color: white;
    }

    #panel{
    	height: 100%;  
        background-color: #DDDDDD;	
        font-size: 26px;	
    }

    </style>
    </head>

    <body>
    <div class="bg" id="map"></div>
    <div id="panel">
    	<form name="addlandmarkform" id="addlandmarkform" action="" method="post">
    	<table align="" name = "addlandmark" id="addlandmark"  border="0" cellpadding="7" cellspacing="5">
    		<tr>
    		<td border = "0"><strong><b>Add Landmark Form</b></strong>
    		
    		</td>
    		</tr>
    		<tr>
    		<td >
    			<select name="branchid" id="branchid" onchange="seeid()">
    			<option value="">เลือกสำนักงาน</option>
    				<?php
    				$sql = "SELECT branch_id,branch_name FROM `branch` ORDER BY branch_id";
    				$res = mysql_query($sql);
    					if($res){
      						while ($rec= mysql_fetch_array($res)) {
                                $i = $i+1;
    					?>
   					<option value="<?php echo $rec['branch_name'] ?>"><?php  echo $i." - ".$rec['branch_name'] ?></option>
    				<?php
    				}
    				}
    				?>
    			</select>
    		</td>
    		<td>
    			<input type="text" name="name of branch" id="branchname" value="" readonly="readonly" style="text-align: center;">
    		</td>
    		</tr>
    		<tr>
    		<td>
    			ชื่อสถานที่
    		</td>
    		<td>
    			<input type="text" name="locationname" id="locationname" value="">
    		</td>
    		</tr>
    		<tr>
    		<td>
    			เกี่ยวกับสถานที่ 	    			
    		</td>
    		<td>
    			<textarea rows="4" cols="22"></textarea>
    		</td>    			
    		</tr>
    		<tr>
    			
    			<td>
    				<input type="hidden" name="lat_location" value="" id="lat_location" readonly="readonly">
    				<input type="hidden" name="lng_location" value="" id="lng_location" readonly="readonly">
    			</td>
    		</tr>
    		
    		<tr>
    		<td>
    			
    		</td>
    		<td>
    			<input type="submit" name="add" value="Add" disabled="disabled" id="add">
    			&nbsp;&nbsp;
    			<button name="clear" type="reset" value="reset">Clear</button>
    		</td>
    			
    		</tr>
    	</table>
    	</form>
    </div>
    
    <script type="text/javascript">
    var lat;
    var lng;
    var location_lat;
    var location_lng;
    var markers = [];
    var infowindow;
    var geocoder;

    lat = 7.90608272245317;
    lng = 98.36664140224457;

    function myMap() {
  	var mapCanvas = document.getElementById("map");
  	var myCenter=new google.maps.LatLng(lat,lng);
  	var mapOptions = {center: myCenter, zoom: 13};
  	var map = new google.maps.Map(mapCanvas, mapOptions);
  	geocoder = new google.maps.Geocoder;
  	infowindow = new google.maps.InfoWindow;

  	google.maps.event.addListener(map, 'click', function(event) {
    	placeMarker(geocoder,map, event.latLng,infowindow);
  		});
	}

 	function geocodeLatLng(geocoder, map, infowindow) {
        var input = document.getElementById('latlng').value;
        var latlngStr = input.split(',', 2);
        var latlng = {lat: parseFloat(latlngStr[0]), lng: parseFloat(latlngStr[1])};
        geocoder.geocode({'location': latlng}, function(results, status) {
          if (status === 'OK') {
            if (results[0]) {
              map.setZoom(11);
              var marker = new google.maps.Marker({
                position: latlng,
                map: map
              });
              infowindow.setContent(results[0].formatted_address);
              infowindow.open(map, marker);
            } else {
              window.alert('No results found');
            }
          } else {
            window.alert('Geocoder failed due to: ' + status);
          }
        });
      }

	function placeMarker(geocoder,map, location,infowindow) {
  	var marker = new google.maps.Marker({
    position: location,
    map: map
  		});
  	var infowindow = new google.maps.InfoWindow({
    content: 'กดปุ่ม add เพื่อเพิ่มสถานที่นี้ลงไปในฐานข้อมูล'
    
	});
	markers.push(marker);
	infowindow.open(map,marker);

	location_lat = marker.getPosition().lat();
	location_lng = marker.getPosition().lng();

	document.getElementById('lat_location').value = location_lat;
	document.getElementById('lng_location').value = location_lng;

	//console.log(markers.length);
	  if(markers.length>1){
        clearMarkers();
       	markers = [];
       	document.getElementById('lat_location').value ="" ;
		document.getElementById('lng_location').value = "";
        }
        if(markers.length == 0){
        	document.getElementById('add').disabled = 'disabled';
        }
        else{
        	document.getElementById('add').disabled= '';
        }

}

function setMapOnAll(map) {
            for (var i = 0; i < markers.length; i++) {
              markers[i].setMap(map);
            }
          }

        function clearMarkers() {
          setMapOnAll(null);
        }

    function seeid(){
    	var branchlatlng;
    	branchlatlng =document.getElementById('branchname').value = document.getElementById('branchid').value;
    	//console.log(branchlatlng);
    	if(branchlatlng=="ภูเก็ต"){
    		lat = 7.90608272245317;
    		lng = 98.36664140224457;
    		myMap();
    		document.getElementById('lat_location').value ="" ;
			document.getElementById('lng_location').value = "";
    	}
    	else if(branchlatlng =="หาดใหญ่"){
    		lat = 7.006341665683104;
    		lng = 100.4985523223877;
    		myMap();
    		document.getElementById('lat_location').value ="" ;
			document.getElementById('lng_location').value = "";
    	}
    	else if(branchlatlng == "อยุธยา"){
    		lat = 14.343238520299131;
    		lng = 100.60918271541595;
    		myMap();
    		document.getElementById('lat_location').value ="" ;
			document.getElementById('lng_location').value = "";

    	}
    	else if(branchlatlng == "สุราษฎร์ธานี"){
    		lat = 9.11065637716888;
    		lng = 99.30181503295898;
            console.log(lat+","+lng);
    		myMap();
    		document.getElementById('lat_location').value ="" ;
			document.getElementById('lng_location').value = "";

    	}
    	else if(branchlatlng == "ศรีราชา"){
    		lat = 13.168317602040103;
    		lng = 100.93120604753494;
    		myMap();
    		document.getElementById('lat_location').value ="" ;
			document.getElementById('lng_location').value = "";

    	}
    	//myMap();
    }

    if(document.getElementById('lat_location').value ==''){
    	document.getElementByName('add').disabled = false;

    }

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBHlC_bwi0D_b86YE0ZN1hnymItuDb_5N0&callback=myMap"></script>
    <?php

    	//$sqlinsert = "INSERT INTO `branch_destination`(branch_destination_id,branch_destination_name,branch_id,lat_destination,lng_destination) VALUES (NULL,)"
    	//echo "i sis".$_GET['locationname'];
    	if(isset($_POST['branchid'])==false){

    	}
    	else {
    		$id;
    		if($_POST['branchid']== "ภูเก็ต"){
    			$id = 1;
    		}
    		else if($_POST['branchid']== "หาดใหญ่"){
    			$id = 3;

    		}
    		elseif ($_POST['branchid']== "อยุธยา") {
    			$id = 11;
    			# code...
    		}
    		elseif ($_POST['branchid']== "สุราษฯ") {
    			$id = 2;
    			# code...
    		}
    		else if($_POST['branchid']== "ศรีราชา"){
    			$id = 10;

    		}

    		$sqlinsert = "INSERT INTO `branch_destination`(branch_destination_id,branch_destination_name,branch_id,lat_destination,lng_destination) VALUES (NULL,'".$_POST['locationname']."',".$id.",'".$_POST['lat_location']."','".$_POST['lng_location']."')";
    		$insertres = mysql_query($sqlinsert);
    		if($insertres){
    			

    		}
    		else{
    			echo "add fail";
    		}

    	}
        mysql_close($conn);
    ?>
    </body>
    </html>
