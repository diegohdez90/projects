<?php
	include "connection.php";
	$id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( null==$id ) {
        header("Location: index.html");
    }
     
    if ( !empty($_POST)) {

    	$name = $_POST['name'];
        $start = $_POST['start'];
        $end = $_POST['end'];
    	$responsable = $_POST['responsable'];
        $cost = $_POST['cost'];
        $status = $_POST['status'];
         
        // validate input
        $valid = true;
        if (empty($name)) {
            $valid = false;
        }
         
        if (empty($start)) {
            $valid = false;
        }
         
        if (empty($end)) {
            $valid = false;
        }

        if (empty($responsable)) {
            $valid = false;
        }

	    if (empty($cost)) {
            $valid = false;
        }

        if (empty($status)) {
            $valid = false;
        }

        $startProject = new DateTime($start);
		$endProject = new DateTime($end);
        $diff = $endProject->diff($startProject)->format("%a");



            $result = $my_sql_conn->query("UPDATE project  set name = '$name', start_date = '$start', end_date ='$end', leader_id1='$responsable',cost='$cost',status='$status',days='$diff' WHERE id ='$id'");
            if($result){
	            $my_sql_conn->close();
    	        header("Location: list-projects.php");
    	    }
    	    else{
    	    	echo $my_sql_conn->error;
    	    }

     }else {
        $result = $my_sql_conn->query("SELECT * FROM project where id = '$id'");
    	while ($rs = $result->fetch_array(MYSQLI_ASSOC) ){
    		$projectname = $rs['name'];
    		$status = $rs['status'];
    		$cost = $rs['cost'];
    		$start = $rs['start_date'];
    		$end = $rs['end_date'];
    		$leaderid = $rs['leader_id1'];
    	}
    }
?>

<!DOCTYPE html>
<html>
<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<body>
	<div class="container">
     
        <div class="span10 offset1">
            <div class="row">
                <h3>Actualizar Proyecto</h3>
            </div>
            <form class="form-horizontal" action="edit.php?id=<?php echo $id?>" method="post">
              <div class="control-group">
                <label class="control-label">Nombre del Proyecto</label>
                <div class="controls">
                    <input name="name" type="text" class="form-control" placeholder="Nombre del Proyecto" value="<?php echo !empty($projectname)?$projectname:'';?>">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Fecha de inicio</label>
                <div class="controls">
                    <input name="start" type="date"class="form-control" placeholder="Fecha de inicio" value="<?php echo !empty($start)?$start:'';?>">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Fecha de fin</label>
                <div class="controls">
                    <input name="end" type="date"class="form-control" placeholder="Fecha de fin" value="<?php echo strtotime($end)>strtotime($start)?$end:'';?>">
                </div>
              </div>
              <div class="control-group"><label>Responsable</label>
	            <?php
	              include "connection.php";

	              $result= $my_sql_conn->query("Select id,concat(name,' ',lastname) as fullname from leader");
	            ?>
	            <div class="control">
		            <select class="form-control" name="responsable">
		            <?php
		              while($row = $result->fetch_assoc()) {
		                ?>
		                  <option value="<?php echo $row['id']; ?>"><?php echo $row['fullname']; ?></option>
		                  
		                <?php
		                    }
		                  $my_sql_conn->close();
		          ?></select>
		        </div>
		     </div>
              <div class="control-group">
                <label class="control-label">Presupuesto</label>
                <div class="controls">
                    <input name="cost" type="text" class="form-control" placeholder="Presupuesto" value="<?php echo !empty($cost)?$cost:'';?>">
                </div>
              </div>
              <div class="control-group">
              	<label class="control-label">Status</label>
	              <?php
					$table_name = "project";
					$column_name = "status";
					include 'connection.php';
					echo "<select class='form-control' name=\"$column_name\">";
					$result = $my_sql_conn->query("SELECT COLUMN_TYPE FROM INFORMATION_SCHEMA.COLUMNS
					    WHERE TABLE_NAME = '$table_name' AND COLUMN_NAME = '$column_name'");

					$row = $result->fetch_array(MYSQLI_ASSOC);
					$enumList = explode(",", str_replace("'", "", substr($row['COLUMN_TYPE'], 5, (strlen($row['COLUMN_TYPE'])-6))));

					foreach($enumList as $value)
					    echo "<option value=\"$value\">".$value."</option>";

					echo "</select>";
	              ?>
	          </div>
              <div class="form-actions">
                  <button type="submit" class="btn btn-success">Update</button>
                  <a class="btn" href="list-projects.php">Back</a>
                </div>
            </form>
        </div>
                 
    </div> <!-- /container -->
</body>