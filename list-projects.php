<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">

<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>

<body>

  <div class="container">
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">Projects</a>
        </div>
        <ul class="nav navbar-nav">
          <li><a href="index.html">Home</a></li>
          <li class="active"><a href="new_project.php">Insertar Proyectos</a></li>
          <li><a href="new_user.html">Insertar Nuevo Usuario</a></li>
          <li><a href="list-projects.php">Detalles de Todos los proyectos</a></li> 
          <li><a href="finished.html">Proyectos terminados</a></li> 
        </ul>
      </div>
    </nav>
    <div class="jumbotron">
      <h2>Proyectos</h2>

      <?php
        include "connection.php";

        $result = $my_sql_conn->query("select * from project");

      ?>
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
            <th>Accion</th>
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
                ?>
                
                <?php
                echo "<a href='edit.php?id=".$rs['id']."'>";
                echo "<i class='material-icons'>mode_edit</i></a>";
                ?>
                <a href='delete.php?id=<? echo $rs["id"];?>'>
                <?php
                echo "<i class='material-icons'>delete</i></a>";
                echo "</td>";
                echo "</tr>";
              }
            ?>
          </tbody>
      </table>
    </div>
  </div>
<?php



?>

</body>