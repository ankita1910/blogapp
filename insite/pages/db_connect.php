<?php
	$serverName = "localhost";
	$userName = "root";
	$password = "ankita";
	$databaseName = "webblog";

	$conn = new mysqli($serverName, $userName, $password, $databaseName);
	if($conn->connect_error) 
	{
		die("Error: could not connect " . $conn->connect_error);
	}
?>
