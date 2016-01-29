<?php
	$data = json_decode(file_get_contents("php://input"));

	$host = "localhost";
	$user = "root";
	$pass = "veotek";
	$db = "projects";

	$con = new mysqli($host, $user, $pass, $db);
	if($con->connection_error) {
		die("DB connection failed:" . $con->connection_error);
	}

	$sql = "INSERT INTO `leader`(`name`,`lastname`,`department`)VALUES('$data->name','$data->lastname','$data->department')";

	$qry = $con->query($sql);

?>