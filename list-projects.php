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
        <h2>Proyectos</h2>

        <?php
          include "connection.php";

          $result = $my_sql_conn->query("select * from project order by start_date");

        ?>
        <div class="table-responsive">
          <table class="table table-stripped">
              <thead>
                <th>ID</th>
                <th>Nombre del Proyecto</th>
                <th>Responsable</th>
                <th>Dia de inicio</th>
                <th>Dia de fin</th>
                <th>Dias</th>
                <th>Presupuesto</th>
                <th>Status</th>
                <th>Acciones</th>
              </thead>
              <tbody>
                <?php
                  while ($rs = $result->fetch_array(MYSQLI_ASSOC)) {
                    echo "<tr>";
                    echo "<td>";
                    echo $rs['id'];
                    echo "</td>";
                    echo "<td>";
                    echo $rs['name'];
                    echo "</td>";
                    $leaderid = $rs['leader_id1'];
                    $leadername = $my_sql_conn->query("select concat(name,' ',lastname) as fullname from leader where id='$leaderid'");
                    while ($rsleader = $leadername->fetch_array(MYSQLI_ASSOC)) {
                      echo "<td>";
                      echo $rsleader['fullname'];
                      echo "</td>";                  
                    }
                    echo "<td>";
                    echo $rs['start_date'];
                    echo "</td>";
                    echo "<td>";
                    echo $rs['end_date'];
                    echo "</td>";
                    echo "<td>";
                    echo $rs['days'];
                    echo "</td>";
                    echo "<td>";
                    echo "$".$rs['cost'];
                    echo "</td>";
                    echo "<td>";
                    echo $rs['status'];
                    echo "</td>";
                    echo "<td>";
                    echo "<a style=\"color:white\" href='edit.php?id=".$rs['id']."'>";
                    echo "<i class='material-icons'>mode_edit</i></a>";
                    echo "<a style=\"color:white\" href='activities.php?id=".$rs['id']."'>";
                    echo "<i class='material-icons'>description</i></a>";
                    echo "<a style=\"color:white\" href='addactivity.php?id=".$rs['id']."'>";
                    echo "<i class='material-icons'>add</i></a>";
                    echo "<a style=\"color:white\" href='process.php?id=".$rs['id']."'>";
                    echo "<i class='material-icons'>assessment</i></a>";
                    echo "</td>";
                    echo "</tr>";
                  }
                ?>
              </tbody>
          </table>
        </div>
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