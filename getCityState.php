<?php
$cityState = array("73114" => "Oklahoma City, Oklahoma",
		"73858" => "Shattuck, Oklahoma",
		"73013" => "Edmond, Oklahoma",
		);
header("Content-Type: text/plain");
$zip = $_GET["zip"];
if (array_key_exists($zip, $cityState))
	print $cityState[$zip];
	else
		print " , ";
?>