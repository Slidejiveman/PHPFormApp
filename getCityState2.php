<?php
header("Content-Type: text/plain");
$zip = $_GET["zip"];

$xml = simplexml_load_file("locations.xml") or die("Error: cannot load XML file."); //name needs to be correct

foreach ($xml->children() as $location) {
	if($location->zipcode == $zip) {
		echo $location->city . ", " .$location->statecode;
		break;
	}
}
?>