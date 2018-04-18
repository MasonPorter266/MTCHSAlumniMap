<!doctype html>
<html>
<link rel="stylesheet" type="text/css" href="stylesheets/AlumniMap.css">
<head>
<meta charset="utf-8">
<title>Alumni Map</title>
  <?php
  	//include java as well as make a sql connection
  	include'JQuery/animations.html';
	$servername = "clone2.smtchs.org";
	$username = "clone2";
	
	$conn = new mysqli($servername, $username, '*SsEkS=3k]1T', 'clone2_alumnimap');
	
	//test connection if it works run sql
	if(!$conn){
		die("Connection failed:");
	}else{
		$sql = "SELECT DISTINCT Longitude, Latitude FROM `MapLocation`";
		$result = $conn->query($sql);
		
	}
  ?>
	<script>
    // JavaScript Document
    var map;
    //set map
    function initMap(){
        var mapCanvas = document.getElementById("map");
        var mapOptions = {
            center: new google.maps.LatLng(43.6121,-116.3915), 
            zoom: 5,
            zoomControl: true,
            gestureHandling: 'none',
            mapTypeControl: false,
            streetViewControl:false,
            fullscreenControl:false,
            disableDefaultUI:true
        }
    	var searchkey = "<?php $search = $_GET['search']; echo $search; ?>";
		if(searchkey != ""){
			<?php 
			$sql2 = "SELECT DISTINCT Alumni.Name, MapLocation.City, MapLocation.State, FROM `Alumni` JOIN `MapLocation` ON Alumni.Location = MapLocation.ID WHERE Alumni.Name like '%".$_GET['search']."%' OR MapLocation.CITY like '%".$_GET['search']."%' OR MapLocation.State like '%". $_GET['search'] . "%'";
			$result2 = $conn->query($sql2);
			?>
			Open(3);
			document.getElementById("results").innerHTML = "<?php while($row2 = $result2->fetch_assoc()){echo "<button class=\\\"item\\\"><p class=\\\"item\\\" onClick=\\\"resultItem()\\\">" . $row2["Name"]; echo "<br>"; echo $row2["City"] . ", " . $row2["State"] . "</p></button>";} ?>";
		}
        //Create map
        map = new google.maps.Map(mapCanvas, mapOptions);
    
        //create markers
        var geocoder = new google.maps.Geocoder();
        
        //meridian
		<?php 
		$i=0;
		$x=0;
		while($row = $result->fetch_assoc()) {
			$x++;
			$y = $x+1;
			echo "\r\n";
			echo "    var marker" . $x ."= new google.maps.Marker({";
			echo "\r\n";
			echo "        position: new google.maps.LatLng(" . $row["Latitude"] . ", " . $row["Longitude"]."),";
			echo "\r\n";
			echo "        map: map";
			echo "\r\n";
			echo "    });";
			echo "\r\n";
		}
		
			
		?>
	}
        
        
        //change the position on the map.
    function change(name){
        var geocoder = new google.maps.Geocoder();
        geocoder.geocode({address: name },function(results, status){
            if(status === google.maps.GeocoderStatus.OK){
                var latlng = results[0].geometry.location;
                map.panTo(latlng);
             }else{
                alert("Geocode unsuccessful");
            }
        });
    }
	
	function resultItem(){
	}
        //AIzaSyBeVccoArT3M9-jEI9G-QtpNH6Di0kY9ok
    </script>
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDZ0xnpDVoO-WtnBN37DEWJx-0Z-gzC27s&callback=initMap"
  type="text/javascript"></script>
</head>

<body>
	<main>
        <section>
        	<!--Make the starting GUI as well extension which comes out when a buttone is slected-->
        	<div id="gui">
            	<p>hello</p>
                <button onClick="Open(1)">home</button>
                <button onClick="Open(2)">about</button>
                <button onClick="Open(3)">search</button>
                <button onClick="Open(4)">alumni</button>
            </div>
            <div id="extension" class="closed">
				<p id="Content"></p>
            </div>
            <div id="map" class="Map"></div>
    	</section>
    </main>
</body>
<?php $conn->close(); ?>
</html>