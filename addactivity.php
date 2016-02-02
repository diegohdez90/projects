<?php

	include 'connection.php';

	$id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }

    $result = $my_sql_conn->query("select leader.id as leaderid,project.name,concat(leader.name,' ',leader.lastname) as 'fullname' from project,leader where project.id='$id' and project.leader_id1=leader.id");

    while($rs = $result->fetch_array(MYSQLI_ASSOC)){
    	$leaderid = $rs['leaderid'];
	    $projectname = $rs['name'];
	    $leaderproject = $rs['fullname'];
    }
    echo $projectname. " ".$leaderproject;

?>

<!DOCTYPE html>
<html>
<head>
<title>Editar Proyecto</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" type="text/css" href="css/main.css">
<style type="text/css">
	.panelProject{
		color: rgb(0,172,200);
	}
</style>
<script type="text/javascript">
	$(document).ready(function () {
		$('.panelProject').children().css("color","rgb(253,130,4)");
	});
</script>
</head>
<body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myMenu">
          </button>
          <a class="navbar-brand" href="index.html">Proyectos</a>
        </div>
        <div class="collapse navbar-collapse" id="myMenu">
          <ul class="nav navbar-nav">
            <li><a href="index.html"><p class="text-center"><i class="material-icons">home</i></p><p class="text-center">Inicio</p></a></li>
            <li><a href="new_project.php"><p class="text-center"><i class="material-icons">note_add</i></p><p class="text-center">Nuevo<br>Proyecto</p></a></li>
            <li><a href="new_user.html"><p class="text-center"><i class="material-icons">person_add</i></p><p class="text-center">Nuevo<br>Usuario</p></a></li>
            <li class="active"><a href="list-projects.php"><p class="text-center"><i class="material-icons">assignment</i></p><p class="text-center">Proyectos</p> </a></li> 
            <li><a href="finished.html"><p class="text-center"><i class="material-icons">assignment_turned_in</i></p><p class="text-center">Proyectos<br>Terminados</p></a></li>
            <li><a href="in-process.html"><p class="text-center"><i class="material-icons">assignment_ind</i></p><p class="text-center">Proyectos<br>En Proceso</p></a></li>
            <li><a href="abandoned.html"><p class="text-center"><i class="material-icons">close</i></p><p class="text-center">Proyectos<br>Abandonados</p></a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right veoteimg">
            <li><a href="index.html"><span><img src="img/veotek.png" width="140"></span></a></li>
          </ul>
        </div>
      </div>
    </nav>
        <div class="jumbotron">
          <div class="container">
            <div class="row">
                <h2>Anexar actividad</h2>	
            	<div class="panel panel-default">
                	<div class="panel-body">
                		<h4 class="panelProject">Proyecto: <small><?php echo $projectname;?></small></h4>
                		<h4 class="panelProject">Lider Proyecto: <small><?php echo $leaderproject;?></small></h4>
                	</div>
                </div>
            </div>



        <form role="form" action="register-activity.php" method="post" enctype="multipart/form-data">
          	<div class="form-group"><label>Actividad</label><input class="form-control" type="text" name="activity" placeholder="Actividad"></div>
          	<div class="form-group"><input class="form-control" type="hidden" name="id" value="<?php echo $id; ?>"></div>
            <div class="form-group"><input class="form-control" type="hidden" name="leaderid" value="<?php echo $leaderid; ?>"></div>
            <div class="form-group"><label>Presupuesto</label><input class="form-control" type="text" placeholder="Presupuesto" name="cost"></div>
            <div class="form-group"><label>Fecha</label><input class="form-control" type="date" name="date"></div>
          <input class="btn btn-default" type="submit" value="Enviar">
        </form>



        </div>
      </div>
                 
    <footer class="container-fluid text-center">
      <p>Veotek<i class="material-icons">copyright</i> <span id="theYear"></span></p>
    </footer>
    <script type="text/javascript">
        var d = new Date();
        var n = d.getFullYear();
        document.getElementById("theYear").innerHTML = n;
    </script>

</body>