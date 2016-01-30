<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Nuevo Proyecto</title>
<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>

<body>

  <div class="container">
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">Proyectos</a>
        </div>
        <ul class="nav navbar-nav">
          <li><a href="index.html">Inicio</a></li>
          <li class="active"><a href="new_project.php">Nuevo Proyecto</a></li>
          <li><a href="new_user.html">Nuevo Usuario</a></li>
          <li><a href="list-projects.php">Proyectos</a></li> 
          <li><a href="finished.html">Proyectos Terminados</a></li> 
          <li><a href="in-process.html">Proyectos En Proceso</a></li>
          <li><a href="abandoned.html">Proyectos Abandonados</a></li>
        </ul>
      </div>
    </nav>
    <div class="jumbotron">
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
        <input class="btn btn-primary" type="submit" value="Enviar">
      </form>
    </div>
  </div>
<?php



?>

</body>