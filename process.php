<?php
	include 'connection.php';

	$id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }

    $leaderdate = $my_sql_conn->query("select * from the_projects where id='$id'");

    if ($leaderdate->num_rows == 0) {
      $leaderdate = $my_sql_conn->query("SELECT project.id, project.name as name_project,concat(leader.name,' ',leader.lastname) as name,days,end_date,cost from project,leader where project.end_date <=curdate() and project.id='$id'");
      while($rs = $leaderdate->fetch_array(MYSQLI_ASSOC)){
        $projectname = $rs['name_project'];
        $leadername = $rs['name'];
        $cost = $rs['cost'];
      }

      $fechas = array();
      $result = $my_sql_conn->query("select Sum(Presupuesto) as Presupuestos,Fecha from activities where IDProject='$id' group by Fecha");

      while($rs = $result->fetch_array(MYSQLI_ASSOC)){
        $fechas[$rs['Fecha']] = $rs['Presupuestos']; 
      }
    }
    else{
      while($rs = $leaderdate->fetch_array(MYSQLI_ASSOC)){
        $projectname = $rs['name_project'];
        $leadername = $rs['name'];
        $cost = $rs['cost'];
      }

      $fechas = array();
      $result = $my_sql_conn->query("select Sum(Presupuesto) as Presupuestos,Fecha from activities where IDProject='$id' group by Fecha");

      while($rs = $result->fetch_array(MYSQLI_ASSOC)){
        $fechas[$rs['Fecha']] = $rs['Presupuestos']; 
      }

    }


?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Proyectos</title>
<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/main.css">
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
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
        <h2>Proceso del Proyecto</h2>
    	<div class="panel panel-default">
        	<div class="panel-body">
        		<h4 class="panelProject">Proyecto: <small><?php echo $projectname;?></small></h4>
        		<h4 class="panelProject">Lider Proyecto: <small><?php echo $leadername;?></small></h4>
        		<h4 class="panelProject">Presupuesto Inicial: <small>$<?php echo $cost;?></small></h4>
        	</div>
        </div>
        <div id="chart_div"></div>
    </div>
</div>

<script type="text/javascript">
google.charts.load('current', {packages: ['corechart', 'line']});
google.charts.setOnLoadCallback(drawBackgroundColor);

function drawBackgroundColor() {
      var data = new google.visualization.DataTable();
      data.addColumn('date', 'Dia');
      data.addColumn('number', 'Presupuesto');

      data.addRows([
        <?php
          foreach ($fechas as $key => $value) {
            $annio = substr($key, 0,4);
            $mes = substr($key, 5,2);
            $dia = substr($key, 8,2);
        ?>
          [new Date(<?php echo $annio;?>,<?php echo $mes-1;?>,<?php echo $dia;?>),<?php echo $value;?>],
        <?php    
          } 

        ?>
      ]);

      var options = {
        title: 'Prespuesto de actividades por dia',
        height: 400,
        hAxis: {
          title: 'Dia'
        },
        vAxis: {
          title: 'Presupuesto'
        },
        backgroundColor: '#f1f8e9'
      };

      var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
      chart.draw(data, options);
    }
</script>

  <footer class="container-fluid text-center">
    <p>Veotek<i class="material-icons">copyright</i> <span id="theYear"></span></p>
  </footer>
  <script type="text/javascript">
      var d = new Date();
      var n = d.getFullYear();
      document.getElementById("theYear").innerHTML = n;
  </script>
