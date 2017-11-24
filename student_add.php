<!DOCTYPE HTML>
<html>
<head>
<title>Add Student</title>
<link rel="stylesheet" type="text/css" href="php_style.css">
<script>
function getPlace(zip) {
	
	if(zip != '') {
	    var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function () {
		    if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			    var result = xmlhttp.responseText;
				var place = result.split(', ');
				if(document.getElementById("city").value == "") {
				    document.getElementById("city").value = place[0];
				}
				if(document.getElementById("state").value == "") {
				    document.getElementById("state").value = place[1];
				}
			}; 
		}
		xmlhttp.open("GET", "getCityState3.php?zip=" + zip, true);
		xmlhttp.send(null);
	}
}
</script>
</head>
<body>
<h1>Add a Student</h1>
<?php
$servername = "localhost";
$username = "webappuser";
$password = "webappuser";
$dbname = "iad_school";

// define variables and set to empty values
$idErr = $firstnameErr = $lastnameErr = $emailErr = $genderErr = $classificationErr = $zipErr = $cityErr = $stateErr = "";
$id = $first_name = $last_name = $email = $gender = $classification = $zip = $city = $state = "";

//Copy above this line in the PHP tag and move to the area below
if ($_SERVER["REQUEST_METHOD"] == "POST") {

	if (empty($_POST["id"])) {
		$idErr = "ID is required";
	} else {
		$id = test_input($_POST["id"]);
		if (!preg_match("/^[0-9]*$/", $id)) {
			$idErr = "ID can be only numbers.";
		}
	}

	if (empty($_POST["first_name"])) {
		$firstnameErr = "First name is required";
	} else {
		$first_name = test_input($_POST["first_name"]);
		// check if name only contains letters and whitespace
		if (!preg_match("/^[a-zA-Z ]*$/",$first_name)) {
			$firstnameErr = "Only letters and white space allowed";
		}
	}

	if (empty($_POST["last_name"])) {
		$lastnameErr = "Last name is required";
	} else {
		$last_name = test_input($_POST["last_name"]);
		// check if name only contains letters and whitespace
		if (!preg_match("/^[a-zA-Z ]*$/",$last_name)) {
			$lastnameErr = "Only letters and white space allowed";
		}
	}

	if (empty($_POST["zip"])) {
		$zipErr = "Zip is required";
	} else {
		$zip = test_input($_POST["zip"]);
		// check if e-mail address is well-formed
		if (!preg_match("/^[0-9]*$/", $id)) {
			$zipErr = "Zip can be only numbers.";
		}
	}
	
	if (empty($_POST["city"])) {
		$cityErr = "City is required";
	} else {
		$city = test_input($_POST["city"]);
		// check if name only contains letters and whitespace
		if (!preg_match("/^[a-zA-Z ]*$/",$last_name)) {
			$lastnameErr = "Only letters and white space allowed";
		}
	}
	
	if (empty($_POST["state"])) {
		$stateErr = "State is required";
	} else {
		$state = test_input($_POST["state"]);
		// check if name only contains letters and whitespace
		if (!preg_match("/^[a-zA-Z ]*$/",$last_name)) {
			$lastnameErr = "Only letters and white space allowed";
		}
	}
	
	if (empty($_POST["email"])) {
		$emailErr = "Email is required";
	} else {
		$email = test_input($_POST["email"]);
		// check if e-mail address is well-formed
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$emailErr = "Invalid email format";
		}
	}

	$classification = test_input($_POST["classification"]);

	$gender = test_input($_POST["gender"]);


	if($idErr=='' && $firstnameErr=='' && $lastnameErr =='' && $emailErr =='') {

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		$sql = "INSERT INTO student (id, first_name, last_name, gender, email, classification, zip, city, state)
		VALUES ('$id', '$first_name', '$last_name', '$gender', '$email', '$classification', '$zip', '$city', '$state')";

		if ($conn->query($sql) === TRUE) {
			// echo "New record created successfully";
			header('Location: student_list.php');
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		$conn->close();
	}
}

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}


?>

<p><span class="error">* required field.</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
   Id: <input type="text" name="id" value="<?php echo $id;?>">
   <span class="error">* <?php echo $idErr;?></span>
   <br><br>
   First Name: <input type="text" name="first_name" value="<?php echo $first_name;?>">
   <span class="error">* <?php echo $firstnameErr;?></span>
   <br><br>
   Last Name: <input type="text" name="last_name" value="<?php echo $last_name;?>">
   <span class="error">* <?php echo $lastnameErr;?></span>
   <br><br>
   Zip: <input id="zip" type="text" name="zip" onblur="getPlace(this.value)" value="<?php echo $zip;?>">
   <span class="error">* <?php echo $zipErr;?></span>
   <br><br>
   City: <input id="city" type="text" name="city" value="<?php echo $city;?>">
   <span class="error">* <?php echo $cityErr;?></span>
   <br><br>
   State: <input id="state" type="text" name="state" value="<?php echo $state;?>">
   <span class="error">* <?php echo $stateErr;?></span>
   <br><br>
   E-mail: <input type="text" name="email" value="<?php echo $email;?>">
   <span class="error">* <?php echo $emailErr;?></span>
   <br><br>
   Classification: <input type="radio" name="classification" <?php if (isset($classification) && $classification=="Freshman") echo "checked";?>  value="Freshman">Freshman
   <input type="radio" name="classification" <?php if (isset($classification) && $classification=="Sophomore") echo "checked";?>  value="Sophomore">Sophomore
   <input type="radio" name="classification" <?php if (isset($classification) && $classification=="Junior") echo "checked";?>  value="Junior">Junior
   <input type="radio" name="classification" <?php if (isset($classification) && $classification=="Senior") echo "checked";?>  value="Senior">Senior
   
   <br><br>
   Gender:
   <input type="radio" name="gender" <?php if (isset($gender) && $gender=="Female") echo "checked";?>  value="Female">Female
   <input type="radio" name="gender" <?php if (isset($gender) && $gender=="Male") echo "checked";?>  value="Male">Male
   
   <br><br>
   <input class="button_input" type="submit" name="submit" value="Submit">
</form>
<form class="inline" action="student_list.php" method="get">
    <button class="button_input" type="submit">Cancel</button>
</form>

</body>
</html>