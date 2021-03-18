<?php

    include('../../php/conexion.php');

    //Iniciar Sesión
    session_start();
    mysqli_set_charset($conexion,'UTF-8');

    //Validar si se está ingresando con sesión un usuario con permisos
    $permiso = intval($_SESSION['permiso']);
    if (!isset($_SESSION) || !$_SESSION ){
        header("Location: /institutoInguz");
        die;
    }

?>



<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <title>Administracion</title>
    <link rel="stylesheet" href="../../css/inicio.css">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">


    <!-- FONTAWESOME -->
    <link rel="stylesheet" href="../../FontAwesome/css/font-awesome.css">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@400;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@1,900&display=swap" rel="stylesheet">
</head>
<body>
    
    <!-- ICONOS PARA USUARIO Y SING OUT -->
    <ul class="sesion">
        <li class="btn-sesion">
            <a href="#">
                <i class="icono-user fa fa-user-circle" aria-hidden="true"></i>
            </a>
        </li>
        <li class="btn-sesion">
            <a href="../../php/desconecta_usuario.php">
                <i class="icono-exit fa fa-sign-out" aria-hidden="true"></i>
            </a>
        </li>
    </ul>
    <img src="../../img/logo.png" alt="" class="logo">
    <h1 class="title">
        INSTITUTO INGUZ
    </h1>
    <div class="subtitulo">
        <pre>Hola de nuevo <?php echo $_SESSION['nombre'] ?>.
Tipo: <?php echo $_SESSION['tipo'] ?>.
Usuario: <?php echo $_SESSION['usuario'] ?>.</pre>
    </div>
    
    <div class="container">
       
        <div class="card">
            <a href="usuarios.php">
            <h4><i class="icono fa fa-user-plus fa-2x"></i>
            USUARIOS</h4>
            </a>
        </div>

        <div class="card">
            <a href="especialidades.php">
            <h4><i class="icono fa fa-sitemap fa-2x"></i>
            ESPECIALIDADES</h4>
            </a>
        </div>

        <div class="card">
            <a href="horarios.php">
            <h4><i class="icono fa fa-clock-o fa-2x"></i>
            HORARIOS</h4>
            </a>
        </div>

        <div class="card">
            <a href="ingles.php">
            <h4><i class="icono fa fa-language fa-2x"></i>
            NIVELES DE INGLES</h4>
            </a>
        </div>

        <div class="card">
            <a href="bachillerato.php">
            <h4><i class="icono fa fa-desktop fa-2x"></i>
            MODALIDADES DE BACHILLERATO</h4>
            </a>
        </div>

        <div class="card">
            <a href="estatus.php">
            <h4><i class="icono fa fa-star fa-2x"></i>
            ESTATUS</h4>
            </a>
        </div>

        <div class="card" onclick="back()">
            <a href="#">
            <h4><i class="icono fa fa-undo fa-2x"></i>
            REGRESAR</h4>
            </a>
        </div>

        
    </div>
    
</body>

<script>
      function back(){
        history.back();
      }
</script>
</html>