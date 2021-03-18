<?php

  /*Archivo para conexión a base de datos*/
  include_once("conexion.php");

  ## // SI NO HAY UNA SESION ACTIVA, INICIAMOS UNA
  if (!isset($_SESSION)) {
    session_start(); 
  }

  ## // OBTENER LOS DATOS INGRESADOS EN EL LOGIN
  $User = mysqli_real_escape_string($conexion, $_POST['usuario']);
  $Password = mysqli_real_escape_string($conexion, $_POST['contrasena']);

  ## // COMPROBAR QUE EL USUARIO EXISTA EN LA BD
  $query = $conexion->query(
    "SELECT * FROM $db.tbusuarios
    WHERE usuario = '$User' AND pwd = '$Password'"
  ) or die("Error al obtener los usuarios " . mysqli_error($conexion));

  if(!$query->num_rows){
    echo "<script type=\"text/javascript\"> window.location = '../index.php?e=true';</script>";
  } else {
    $usuario = $query->fetch_assoc();

    ## // OBTENEMOS TODOS LOS DATOS DE USUARIO, COLABORADOR Y PERSONA
    $qdatos = $conexion->query(
      "SELECT * FROM tbusuarios u
      JOIN tbcolaborador c  on(c.clavecolaborador = u.colaborador)
      JOIN tbpersona p ON(c.persona = p.idpersona)
      WHERE usuario = '" . $usuario['usuario'] . "'"
    ) or die ("Error al obtener los datos de persona " . mysqli_error($conexion));
    
    $fdatos = $qdatos->fetch_assoc();

    $_SESSION['usuario'] = $fdatos['usuario'];
    $_SESSION['permiso'] = $fdatos['permiso'];
    $_SESSION['nombre'] = $fdatos['nombre'] . ' ' .$fdatos['apaterno'] . ' ' . $fdatos['amaterno'];
    $_SESSION['area'] = $fdatos['area'];
    $_SESSION['fechalta'] = $fdatos['fechalta'];
    $_SESSION['fechabaja '] = $fdatos['fechabaja'];
    $_SESSION['fechanac'] = $fdatos['fechanac'];
    $_SESSION['curp'] = $fdatos['curp'];
    $_SESSION['sexo'] = $fdatos['sexo'];
    $_SESSION['edad'] = $fdatos['edad'];
    $_SESSION['telefono'] = $fdatos['telefono'];
    $_SESSION['celular'] = $fdatos['celular'];
    $_SESSION['correoe'] = $fdatos['correoe'];
    $_SESSION['calleynum'] = $fdatos['calleynum'];
    $_SESSION['colonia'] = $fdatos['colonia'];
    $_SESSION['municipio'] = $fdatos['municipio'];
    $_SESSION['estado'] = $fdatos['estado'];
    $_SESSION['cpostal'] = $fdatos['cpostal'];

    if($usuario['permiso'] == 1){ // PROGRAMADOR
      isset($_SESSION);

      $_SESSION['tipo'] = 'PROGRAMADOR';

      header('Location: ../inicio.php');

    } else if($usuario['permiso'] == 2){ // ADMINISTRADOR
      isset($_SESSION);

      $_SESSION['tipo'] = 'ADMINISTRADOR';

      header('Location: ../inicio.php');
    } else if($usuario['permiso'] == 3){ // GERENTE
      isset($_SESSION);

      $_SESSION['tipo'] = 'GERENTE';
      
      header('Location: ../inicio.php');
    } else if($usuario['permiso'] == 4){ // VENTAS
      isset($_SESSION);

      $_SESSION['tipo'] = 'VENTAS';
      
      header('Location: ../inicio.php');
    }

    #var_dump($_SESSION);
    #echo "<script type=\"text/javascript\"> window.location = '../index.php?e=true';</script>";
  }

// mysqli_free_result($res_sql_sesion);
mysqli_close($conexion);





