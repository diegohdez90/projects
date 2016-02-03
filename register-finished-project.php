<?php

	include 'connection.php';

	$id = $_POST['id'];
	$conclusion = $_POST['conclusion'];
	$leaderid = $_POST['leaderid'];
	$enddate = $_POST['date'];

	$get_start_date = $my_sql_conn->query("select start_date from project where id='$id'");

    while ($the_start_date = $get_start_date->fetch_array(MYSQLI_ASSOC)) {
    	$startdate = $the_start_date['start_date'];
    }

    $start = new DateTime($startdate);
	$end = new DateTime($enddate);
	$diff = $end->diff($start)->format("%a");

    $result = $my_sql_conn->query("UPDATE project  set end_date ='$enddate', status='Terminado',days='$diff' WHERE id ='$id'");
    $result = $my_sql_conn->query("INSERT INTO conclusion(detalles,fecha,project_leader_id1,project_id) VALUES ('$conclusion','$enddate','$leaderid',$id)");
    if($result){
        $my_sql_conn->close();
        header("Location: list-projects.php");
    }
    else{
    	echo $my_sql_conn->error;
    }



?>