<?php

include 'connection.php';

$project = $_POST['project'];
$responsable = $_POST['responsable'];
$startdate = $_POST['startdate'];
$enddate = $_POST['enddate'];
$start = new DateTime($startdate);
$end = new DateTime($enddate);
$diff = $end->diff($start)->format("%a");
$cost = $_POST['cost'];

$insert = $my_sql_conn->query("INSERT INTO project(name,leader_id1,start_date,end_date,days,cost,status) VALUES('$project','$responsable','$startdate','$enddate','$diff','$cost','En Proceso')");

if($insert){
	$my_sql_conn->close();
	header("Location:index.html");
}
else{
	die("Error: ". $my_sql_conn->error);
}

?>