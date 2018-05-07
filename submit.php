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
		$sql = "SELECT DISTINCT Name, Email FROM `Alumni`";
		$result = $conn->query($sql);
		
	}
	
	$email = $_GET['email'];
	$name = $_GET['name'];
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
	
	$isupdate = false;
	while($row = $result->fetch_assoc()){
		if($name == $row['Name'] || $email == $row['Email']){
			$isupdate = true;
		}
	}
	if($fake == $empty){
		if($name != $empty && $email !=$empty && $city !=$empty && $state !=$empty && $year !=$empty && $currentJob !=$empty && $salary !=$empty && $isRelated !=$empty){
			if($isupdate == true){
				echo "<script>alert('An alumni with similar information is already registered. This will be counted as an update</script>";
				$msg2 = "" . $name . " Would like to update their information! Their email is " . $email . "\r\n City: " . $city . "\r\n" . " State: " . $state . "\r\n" . " Graduation Year: " . $year . "\r\n" . " Current Job: " . $currentJob . "\r\n" . " Current salary " . $salary . "\r\n" . " And is it related to the pathway?: " . $isRelated;
				mail("joshua.sparks@mtchs.org","Alumni Submission",$msg2);
				echo "<script>  location.replace(\"alumni.php\") </script>";
			}
			else{
				echo "<script>alert('New Alumni Entry Submited')</script>";
				$msg2 = "" . $name . " Has submitted a form! Their email is " . $email . "\r\n City: " . $city . "\r\n" . " State: " . $state . "\r\n" . " Graduation Year: " . $year . "\r\n" . " Current Job: " . $currentJob . "\r\n" . " Current salary: " . $salary . "\r\n" . " And is it related to the pathway?: " . $isRelated;
				mail("joshua.sparks@mtchs.org","Alumni Submission",$msg2);
				echo "<script>  location.replace(\"alumni.php\") </script>";
			}
		}
		else{
			echo "<script>alert('$msg all feilds must be entered in order to submit a new alumni form');</script>";
		}
	}
	else{
		echo "no please.";
	}
?>
</body>
</html>