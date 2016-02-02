<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Nuevo Proyecto</title>
<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
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
            <li class="active"><a href="new_project.php"><p class="text-center"><i class="material-icons">note_add</i></p><p class="text-center">Nuevo<br>Proyecto</p></a></li>
            <li><a href="new_user.html"><p class="text-center"><i class="material-icons">person_add</i></p><p class="text-center">Nuevo<br>Usuario</p></a></li>
            <li><a href="list-projects.php"><p class="text-center"><i class="material-icons">assignment</i></p><p class="text-center">Proyectos</p> </a></li> 
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
        <h2>Registro de Proyecto</h2>
        <form role="form" action="register-project.php" method="post" enctype="multipart/form-data">
          <div class="form-group"><label>Nombre del Proyecto</label><input class="form-control" type="text" name="project" placeholder="Nombre del Proyecto"></div>
          <div class="form-group"><label>Lider de Proyecto</label>
              <?php
                include "connection.php";

                $result= $my_sql_conn->query("Select id,concat(name,' ',lastname) as fullname from leader");
              ?>
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
            <div class="form-group"><label>Presupuesto</label><input class="form-control" type="text" placeholder="Presupuesto" name="cost"></div>
            <div class="form-group"><label>Fecha de inicio</label><input class="form-control" type="date" name="startdate"></div>
            <div class="form-group"><label>Fecha de fin</label><input class="form-control" type="date" name="enddate"></div>
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