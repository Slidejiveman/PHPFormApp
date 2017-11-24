<?php
$servername = "localhost";
$username = "webappuser";
$password = "webappuser";
$dbname = "iad_school";

$start = $_GET['start'];
$page = 5;

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$sql = "SELECT * FROM student LIMIT" .$page. "OFFSET" .$start;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	// output data of each row
	echo "<table>" . "<tr>" . "<th></th>". "<th>ID</th>"."<th>First</th>"."<th>Last</th>"."</tr>";
	$rnum = 1;
	while($row = $result->fetch_assoc()) {		
		echo "<tr><td><input type='radio' name='selectedRow' onchange='selectChange()' id='selectedRow".$rnum."' value=".$row["id"]."></td>" . "<td>" . $row["id"]. "</td><td>" . $row["first_name"]. "</td>" . "<td>" . $row["last_name"]. "</td></tr>";
		$rnum++;
	}
	echo "</table>";
} else {
	echo "0 results";
}
$conn->close();
?>