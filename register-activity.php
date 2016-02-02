<?php

	include 'connection.php';

	$id_project = $_POST['id'];
	$activity = $_POST['activity'];
	$cost = $_POST['cost'];
	$date = $_POST['date'];
	$leaderid = $_POST['leaderid'];

	$result = $my_sql_conn->query("INSERT INTO ACTIVIDAD(descripcion,fecha,presupuesto,project_id,project_leader_id1) VALUES ('$activity','$date','$cost','$id_project','$leaderid')");

	if($result){
		$my_sql_conn->close();
		header("Location:list-projects.php");
	}
	else{
		die("Error: ". $my_sql_conn->error);
	}
?>