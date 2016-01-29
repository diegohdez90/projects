<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include "connection.php";

$result = $my_sql_conn->query("SELECT * FROM the_projects");

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"name_project":"'  . $rs["name_project"] . '",';
    $outp .= '"name":"'   . $rs["name"]        . '",';
    $outp .= '"enddate":"'. $rs["end_date"] . '",';
    $outp .= '"days":"'. $rs["days"] . '",';
    $outp .= '"cost":"'. $rs["cost"] . '"}';
}
$outp ='{"results":['.$outp.']}';
$my_sql_conn->close();

echo($outp);
?>