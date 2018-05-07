<!DOCTYPE html>
<html lang="en-us">

<head>
  <meta charset="utf-8">
  <title>MTCHS Graduate Map</title>
  <link rel="stylesheet" type="text/css" href="stylesheets/styles.css" media="screen">
  <link rel="icon" href="images/MTCHSLogo.png">
</head>

<header>

</header>

<body> 
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
			$sql2 = "SELECT DISTINCT Alumni.Name, MapLocation.City, MapLocation.State FROM `Alumni` JOIN `MapLocation` ON Alumni.Location = MapLocation.ID WHERE Alumni.Name like '%".$_GET['search']."%' OR MapLocation.CITY like '%".$_GET['search']."%' OR MapLocation.State like '%". $_GET['search'] . "%'";
			$result2 = $conn->query($sql2);
			?>
			Open(3);
			document.getElementById("results").innerHTML = "<?php while($row2 = $result2->fetch_assoc()){echo "<button class=\\\"item\\\"><p class=\\\"item\\\">" . $row2["Name"]; echo "<br>"; echo $row2["City"] . ", " . $row2["State"] . "</p></button>";} ?>";
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
        //AIzaSyBeVccoArT3M9-jEI9G-QtpNH6Di0kY9ok
    </script>
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDZ0xnpDVoO-WtnBN37DEWJx-0Z-gzC27s&callback=initMap"
  type="text/javascript"></script>
  <div class="MapFrame">
    <div class="MapNav">
      <img src="images/MTCHSLogo.png" alt="MTCHS Logo">
      <nav>
        <ul>
          <li><a href="#">HOME</a></li>
          <li><a href="#">ABOUT</a></li>
          <li><a href="#">SEARCH</a></li>
          <li><a href="#">ALUMNI FORM</a></li>
        </ul>
      </nav>
      <p>©MTCHS 2018</p>
    </div>

    <div class="MapTabExtension">
      <div id="ABOUT">
        <h2>What is MTCHS?</h2>
        <h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Feugiat in fermentum posuere urna nec tincidunt praesent semper feugiat. Id leo in vitae turpis massa sed elementum. Amet justo donec enim diam vulputate ut pharetra. Aliquam eleifend mi in nulla posuere sollicitudin. Volutpat diam ut venenatis tellus in. Sem nulla pharetra diam sit amet nisl. Enim blandit volutpat maecenas volutpat blandit aliquam etiam. Pharetra sit amet aliquam id diam. Ornare lectus sit amet est placerat.</h4>

        <h2>What is the Alumni Map?</h2>
        <h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Feugiat in fermentum posuere urna nec tincidunt praesent semper feugiat. Id leo in vitae turpis massa sed elementum. Amet justo donec enim diam vulputate ut pharetra. Aliquam eleifend mi in nulla posuere sollicitudin. Volutpat diam ut venenatis tellus in. Sem nulla pharetra diam sit amet nisl. Enim blandit volutpat maecenas volutpat blandit aliquam etiam. Pharetra sit amet aliquam id diam. Ornare lectus sit amet est placerat.</h4>

        <h2>How does it work?</h2>
        <h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Feugiat in fermentum posuere urna nec tincidunt praesent semper feugiat. Id leo in vitae turpis massa sed elementum. Amet justo donec enim diam vulputate ut pharetra. Aliquam eleifend mi in nulla posuere sollicitudin. Volutpat diam ut venenatis tellus in. Sem nulla pharetra diam sit amet nisl. Enim blandit volutpat maecenas volutpat blandit aliquam etiam. Pharetra sit amet aliquam id diam. Ornare lectus sit amet est placerat.</h4>

        <h2>I am a past student. How can I join?</h2>
        <h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Feugiat in fermentum posuere urna nec tincidunt praesent semper feugiat. Id leo in vitae turpis massa sed elementum. Amet justo donec enim diam vulputate ut pharetra. Aliquam eleifend mi in nulla posuere sollicitudin. Volutpat diam ut venenatis tellus in. Sem nulla pharetra diam sit amet nisl. Enim blandit volutpat maecenas volutpat blandit aliquam etiam. Pharetra sit amet aliquam id diam. Ornare lectus sit amet est placerat.</h4>
      </div>
      <div id="SEARCH">
        <form method = 'none' id='search'>
          <input type=\"text\" name=\"search\" id=\"searchbar\">
          <input type='submit' value = 'button' onClick'search()'>
        </form>
        <p id='results'></p>
      </div>
      <div id="ALUMNIFORM">
        <form Method = 'get' action = 'submit.php'>
          <label>Email<input type='text' name='email'></label>
          <label>Name<input type='text' name='name'></label>
          <label>City<input type='text' name='city'></label>
          <label>State<input type='text' name='state'></label>
          <label>Graduation Year<input type='number' name='year'></label>
          <label>Current Job<input type='text' name='currentJob'></label>
          <label>Current Salary<input type='text' name='salary'></label>
          <p>Is your job Pathway related?</p>
          <br>
          <label>no<input value='no' type='radio' name='isRelated'></label>
          <label> yes<input value='yes' type = 'radio' name = 'isRelated'></label>
          <input name =\"fake\" type = \"text\" style = \"display:none\"><input type='submit'>
        </form>
      </div>

      <!--
      <Log Begin: Huston we have a problem:>
      There is a need for the TabExtension to feature different content depending on the user selection.
      To do this there is two possiblities with varying difficulty...
      The first option is to add extra grid-columns located at the same place that appear and hide depending on selections.
      The second option is to use JQuery to make content fill MapTabExtension when needed.

      I am not sure which is easier and cleaner so research is needed.
      <Log ended>
     -->
    </div>

    <div class="Map" id="map">
      <!--Map API Key Code goes here-->
    </div>
  </div>

</body>

</html>
