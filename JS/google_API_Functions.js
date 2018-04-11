<script>
// JavaScript Document
var map;
// extra gui
var ControlUI = document.createElement("div");
ControlUI.innerHTML = "<button id=\"Open\"onClick=\"Open1()\"></button>"+
				   "<button id=\"Open2\"onClick=\"Open2()\"></button>"+
				   "<div id=\"gui\" class = \"closed\">"+
						"<p>hello</p> <div id=\"gui\" class=\"Button\">"+
						"<button onClick=\"change('Meridian, ID')\">Meridian</button>"+
						"<br>"+
						"<button onClick=\"change('win Falls, Idaho, USA')\">Twin Falls</button>"+
						"<br>"+
						"<button onClick=\"change('Sasebo,Japan')\">Japan</button>"+
						"<br>"+
						"<button onClick=\"change('Moscow,ID')\">Moscow</button></div>"+ 
						"<p id=\"Content\"></p>"+
					"</div>";

//set map
function initMap(){
	var mapCanvas = document.getElementById("map");
	var mapOptions = {
		center: new google.maps.LatLng(43.6121,-116.3915), 
		zoom: 7,
		zoomControl: false,
		gestureHandling: 'none',
		mapTypeControl: false,
		streetViewControl:false,
		fullscreenControl:false,
		disableDefaultUI:true
	}

	//Create map
	map = new google.maps.Map(mapCanvas, mapOptions);

	//add custom gui
	map.controls[google.maps.ControlPosition.LEFT_TOP].push(ControlUI);

	//create markers
	var geocoder2 = new google.maps.Geocoder();
	
	//meridian
	geocoder2.geocode({address:'Meridian, ID' },function(results, status){
	  if(status === google.maps.GeocoderStatus.OK){
		  var marker3 = new google.maps.Marker({ 
			map: map,
			position:results[0].geometry.location
		  });
		marker3.addListener('click', function(){
			updateTextBox("You clicked on Meridian");
		});
	  }else{
		  alert("Geocode unsuccessful");
	  }
	});
	
	//twin
	var marker2 = new google.maps.Marker({
		position: new google.maps.LatLng(42.5630,-114.4609),
		map: map,
		title: 'Trashville'
	});
		marker2.addListener('click', function(){
			updateTextBox("You clicked on Twin Falls");
		});
	
	//Moscow Idaho
	var geocoder = new google.maps.Geocoder();
	geocoder.geocode({address:'moscow ID' },function(results, status){
	  if(status === google.maps.GeocoderStatus.OK){
		  var marker4 = new google.maps.Marker({ 
			map: map,
			position:results[0].geometry.location
		  });
	  }else{
		  alert("Geocode unsuccessful");
	  }
		
		marker4.addListener('click', function(){
			updateTextBox("You clicked on Moscow");
		});
	});
	
	//Sasebo Japan
	var geocoder = new google.maps.Geocoder();
	geocoder.geocode({address:'Sasebo,Japan' },function(results, status){
	  if(status === google.maps.GeocoderStatus.OK){
		  var marker = new google.maps.Marker({ 
			map: map,
			position:results[0].geometry.location
		  });
	  }else{
		  alert("Geocode unsuccessful");
	  }
		
		marker.addListener('click', function(){
			updateTextBox("You clicked on Sasebo");
		});
	});
	
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
function updateTextBox(x){
	document.getElementById("Content").innerHTML = x
}
	//AIzaSyBeVccoArT3M9-jEI9G-QtpNH6Di0kY9ok
</script>