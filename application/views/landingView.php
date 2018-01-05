<!DOCTYPE html>
<html lang="es">
<head>
  <title>Pago Fácil</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="public/js/controller.js"></script>
</head>
<body>

<div class="container">
  <div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
      <br><p>Seleccione una acción a ejecutar</p>
      <input type="button" class="pfBtn btn btn-sm btn-primary btn-block" id="POST" value="Dar de alta una calificación">

      <input type="button" class="pfBtn btn btn-sm btn-primary btn-block" id="GET" value="Obtener calificaciones">

      <input type="button" class="pfBtn btn btn-sm btn-primary btn-block" id="put" value="Actualizar una calificación">

      <input type="button" class="pfBtn btn btn-sm btn-primary btn-block" id="delete" value="Eliminar una calificación">
    </div>

    <div id="showAlumnos" style="max-width:30%;display:none;">
      <label>Seleccione un alumno</label>
      <select class="form-control" id="alumno">
        <?php
          foreach ($data['users'] as $user) 
          {
            $name = $user['nombre'].' '.$user['ap_paterno'].' '.$user['ap_materno'];
            echo '<option value="'.$user['id_t_usuarios'].'">'.$name.'</option>';
          }
        ?>
      </select>
    </div>

    <div id="showMaterias" style="max-width:30%;display:none;">
      <br><label>Seleccione una materia</label>
      <select class="form-control" id="materias">
        <?php
          foreach ($data['courses'] as $course) 
          {
            echo '<option value="'.$course['id_t_materias'].'">'.$course['nombre'].'</option>';
          }
        ?>
      </select>
    </div>
    <div id="helper" style="display:none;max-width:30%"></div><br>
    <div id="showButton" style="max-width:30%;display:none;">
      <input type="button" class="btn btn-block btn-warning" id="actionBtn">
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="data_response">
      
    </div>
  </div>
</div>

<div class="jumbotron text-center" id="json_response">
   
</div>
  


</body>
</html>