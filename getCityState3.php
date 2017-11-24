<?php
header("Content-Type: text/plain");

$servername = "localhost";
$username = "webappuser";
$password = "webappuser";
$dbname = "iad_school";


if($_SERVER["REQUEST_METHOD"] == "GET") {
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	$sql = "SELECT * FROM location WHERE postal_code =" .$_GET["zip"];
	$result = $conn->query($sql);
	
	if($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		$city = $row["city"];
		$state = $row["state_code"];
		
		echo $city .", ".$state;
	}
}
?>