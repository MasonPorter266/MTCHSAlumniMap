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
		$sql = "SELECT DISTINCT Longitude, City, State, Latitude FROM `MapLocation`";
		$result = $conn->query($sql);
		
	}
  ?>
	<script>
    // JavaScript Document
    var map;
    //set map and map options are the availble java ui
    function initMap(){
        var mapCanvas = document.getElementById("map");
        var mapOptions = {
            center: new google.maps.LatLng(43.6121,-116.3915), 
            zoom: 5,
            streetViewControl:false,
            fullscreenControl:false,
            disableDefaultUI:true
        }
		//enter a name in search, it gets stored in searchkey on refresh
    	var searchkey = "<?php $search = $_GET['search']; echo $search; ?>";
		//if searchkey has been used find all alumni that have something with the search key in it then make a button for us to press and see their info
		if(searchkey != ""){
			<?php 
			$sql2 = "SELECT DISTINCT Alumni.Name, Alumni.GradYear, Alumni.Education, Alumni.Job,Alumni.Salary, Alumni.IsPathwayRelated, MapLocation.City, MapLocation.State, MapLocation.Latitude, MapLocation.Longitude FROM `Alumni` JOIN `MapLocation` ON Alumni.Location = MapLocation.ID WHERE Alumni.Name like '%".$_GET['search']."%' OR MapLocation.CITY like '%".$_GET['search']."%' OR MapLocation.State like '%". $_GET['search'] . "%'";
			$result2 = $conn->query($sql2);
			?>
			Open(3);
			//make each button with correct information
			var fun = "<?php while($row2 = $result2->fetch_assoc()){echo $button = str_replace( "'s","","<button class=\\\"item\\\" onClick='resultItem(\\\"" . $row2["City"] . ", " . $row2["State"]."\\\",\\\"". $row2["Name"] ."\\\",\\\"". $row2["GradYear"] ."\\\",\\\"". $row2["Education"] ."\\\",\\\"". $row2["Job"] ."\\\",\\\"". $row2["Salary"] ."\\\",\\\"". $row2["IsPathwayRelated"] ."\\\")'><p class=\\\"item\\\">" . $row2["Name"]); echo "<br>"; echo $row2["City"] . ", " . $row2["State"] . "</p></button>";} ?>"
			document.getElementById("results").innerHTML = fun
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
			echo "	marker" . $x .".addListener('click', function(event){;change(\"". $row["City"] . "," . $row["State"] ."\");Open(3);";
			$sql3 = "SELECT DISTINCT Alumni.Name, Alumni.GradYear, Alumni.Education, Alumni.Job,Alumni.Salary, Alumni.IsPathwayRelated, MapLocation.City, MapLocation.State, MapLocation.Latitude, MapLocation.Longitude FROM `Alumni` JOIN `MapLocation` ON Alumni.Location = MapLocation.ID WHERE MapLocation.Longitude =". $row["Longitude"] ." OR MapLocation.Latitude =". $row["Latitude"];
			$result3 = $conn->query($sql3);
			echo "var fun = \""; while($row3 = $result3->fetch_assoc()){echo $button = str_replace( "'s","","<button class=\\\"item\\\" onClick='resultItem(\\\"" . $row3["City"] . ", " . $row3["State"]."\\\",\\\"". $row3["Name"] ."\\\",\\\"". $row3["GradYear"] ."\\\",\\\"". $row3["Education"] ."\\\",\\\"". $row2["Job"] ."\\\",\\\"". $row3["Salary"] ."\\\",\\\"". $row3["IsPathwayRelated"] ."\\\")'><p class=\\\"item\\\">" . $row3["Name"]); echo "<br>"; echo $row3["City"] . ", " . $row3["State"] . "</p></button>";};
			echo "\";document.getElementById('results').innerHTML = fun; ;});";
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
				map.setZoom(10);
             }else{
                alert("Geocode unsuccessful");
            }
        });
    }
	//organize the information of the button
	function resultItem(location,name,year,education,job,salary,isPathwayRelated){
		change(location);
		if(isPathwayRelated){
			var related = "Yes";
		}else{
			var related = "No";
		}
		document.getElementById("extension").innerHTML = "<button onClick=\"Open(0)\">X</button><h4>" + name + "</h4><p>" + "Graduation year: " + year + "</p><p>" + "Total College Education: " + education + "</p><p>" +  "Current Job: " + job + "</p><p>" + "Current Salary: " + salary + "</p><p>" + "Is Their job Pathway related?" + related + "</p>";
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