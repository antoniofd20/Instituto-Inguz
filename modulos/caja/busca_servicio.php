<?php
    include('../../php/conexion.php');

    //Iniciar Sesión
    session_start();
    mysqli_set_charset($conexion,'UTF-8');

    //Validar si se está ingresando con sesión un usuario con permisos
    $permiso = intval($_SESSION['permiso']);
    if (!isset($_SESSION) || !$_SESSION){
        header("Location: /institutoInguz");
        die;
    }

    $data = array();

    $servicio = $_POST['concepto'];

    $consulta = $conexion->query(
        "SELECT * FROM catprodserv
        
        WHERE idprodserv = '$servicio'"
    ) or die("Error al obtener datos del servicio " . mysqli_error($conexion));

    $datos = $consulta->fetch_assoc();

    $clave = $datos['idprodserv'];
    $nombre = $datos['nombre'];
    $costo = $datos['costo'];

    
    
    $data['clave'] = $clave;
    #$data['nombre'] = $nombre;
    $data['monto'] = $costo;
    
    echo json_encode($data);
    $consulta->free();