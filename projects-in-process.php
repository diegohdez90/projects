<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include "connection.php";

$result = $my_sql_conn->query("SELECT * FROM project where status='En proceso'");

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"name_project":"'  . $rs["name"] . '",';
    $id_leader = $rs["leader_id1"];
    $outp .= '"startdate":"'. $rs["start_date"] . '",';
    $outp .= '"enddate":"'. $rs["end_date"] . '",';
    $outp .= '"days":"'. $rs["days"] . '",';
    $outp .= '"cost":"'. $rs["cost"] . '",';
	$fullnameleader = $my_sql_conn->query("SELECT concat(name,' ',lastname) as fullname from leader where id='$id_leader'");
    while($rsleader = $fullnameleader->fetch_array(MYSQLI_ASSOC)) {
		    $outp .= '"leader":"'   . $rsleader["fullname"]        . '"}';	    	
    }
}
$outp ='{"results":['.$outp.']}';
$my_sql_conn->close();

echo($outp);
?>