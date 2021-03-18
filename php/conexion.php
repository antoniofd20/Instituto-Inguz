<?php

  /*Datos para conexión a sitio de pruebas*/
  $host = "localhost";
  $user = "root";
  $pw = "";
  $db = "basescolar";
  $conexion = mysqli_connect($host, $user, $pw, $db);

  if(!$conexion){
    echo "No se pudo conectar a la base de datos." . PHP_EOL;
    echo "No. de error: " . mysqli_connect_errno() . PHP_EOL;
    echo "El error consiste en que : " . mysqli_connect_error() . PHP_EOL;
    die();
  }
  else {
    $conexion->set_charset('utf8mb4');
    date_default_timezone_set('America/Mexico_City');
    setlocale(LC_ALL, 'es_MX'); // habilitar para sitios GoDaddy
    
    $fechahoy = date('Y-m-d');
  }
  
  ?>
 