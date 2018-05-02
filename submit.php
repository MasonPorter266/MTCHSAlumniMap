<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>
<body>
<?php
	//make a sql connection
	$servername = "clone2.smtchs.org";
	$username = "clone2";
	
	$conn = new mysqli($servername, $username, '*SsEkS=3k]1T', 'clone2_alumnimap');
	
	//test connection if it works run sql
	if(!$conn){
		die("Connection failed:");
	}else{
		$sql = "SELECT DISTINCT Name, Email `MapLocation`";
		$result = $conn->query($sql);
		
	}
	
	$Name = $_GET['Name'];
	$email = $_GET['email'];
	$city = $_GET['city'];
	$state = $_GET['state'];
	$year = $_GET['year'];
	$currentJob = $_GET['currentJob'];
	$salary = $_GET['salary'];
	$isRelated = $_GET['isRelated'];
	$fake = $_GET['fake'];
	
 	//validate form
	$msg = "An error has occured,";
	$empty ="";
	
	while($row = $result ->fetch_assoc()){
		if($Name = $row['Name']){
			$update = true;
		}
	}
	if($fake == $empty){
		if($Name != $empty && $email !=$empty && $city !=$empty && $state !=$empty && $year !=$empty && $currentJob !=$empty && $salary !=$empty && $isRelated !=$empty){
			if($update){
				echo "<script>alert('An alumni with similar information is already registered. This will be counted as an update</script>";
				echo "<script> location.href = 'alumni.php'; </script>";
			}
			else{
				echo "<script>alert('New Alumni Entry Submited')</script>" . "<p>" . $Name . $email . $city . $state . $year . $currentJob . $salary . $isRelated . "</p>";
				echo "<script> location.href = 'alumni.php'; </script>";
			}
		}
		else{
			echo "<script>alert('$msg all feilds must be entered in order to submit a new alumni form')</script>" . "<p>" . $Name . $email . $city . $state . $year . $currentJob . $salary . $isRelated . "</p>";
			echo "<script> location.href = 'alumni.php'; </script>";
		}
	}
	else{
		echo "no please.";
	}
?>
</body>
</html>