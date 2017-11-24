<!DOCTYPE HTML>
<html>
<head>
<title>Delete</title>
<link rel="stylesheet" type="text/css" href="php_style.css">
</head>
<body>
<h1>Delete</h1>
<?php

$servername = "localhost";
$username = "webappuser";
$password = "webappuser";
$dbname = "iad_school";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

//CHECK GET
if($_SERVER["REQUEST_METHOD"] == "GET") {
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	$sql = "SELECT * from student where id = ".$_GET['id'];
	
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$current_id = $row["id"];
	$id = $row["id"];
	$first_name = $row["first_name"];
	$last_name = $row["last_name"];
	$email = $row["email"];
	$classification = $row["classification"];
	$gender = $row["gender"];
}

//CHECK POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
echo $_POST["id"];
	
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	//CHANGE TO DELETE BY ID
		// sql to delete a record should be tied to the delete button...
	$sql = "DELETE FROM student WHERE id='". $_POST["id"]."'";
	
	if ($conn->query($sql) === TRUE) {
		//echo "Record deleted successfully";
		header("Location: student_list.php");
	} else {
		echo "Error deleting record: " . $conn->error;
	}
	$conn->close();
}

echo "<p>Delete " . $first_name . " ". $last_name. "?</p>";
?>
<div id="divbutton">
<form class="inline" action="student_delete.php" method="post">
	<input type="hidden" name="id" value="<?php echo $id; ?>">
	<button class="button_input" type="submit">Delete</button>
</form>
<form class="inline" action="student_list.php" method="get">
    <button class="button_input" type="submit">Cancel</button>
</form>
</div>
</body>
</html>
