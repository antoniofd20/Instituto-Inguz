<?php

    include('php/conexion.php');

    //Iniciar Sesión
    session_start();
    mysqli_set_charset($conexion,'UTF-8');

    //Validar si se está ingresando con sesión un usuario con permisos
    $permiso = intval($_SESSION['permiso']);
    if (!isset($_SESSION) || !$_SESSION){
        header("Location: /institutoInguz");
        die;
    }

    # REQUERIMOS EL ARCHIVO DE LA VISTA
    #require 'views/inicio.view.php';

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inicio</title>
    <link rel="stylesheet" href="css/inicio.css">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">


    <!-- FONTAWESOME -->
    <link rel="stylesheet" href="FontAwesome/css/font-awesome.css">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@400;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@1,900&display=swap" rel="stylesheet">

    <!-- css de grafica -->
    <style type="text/css">
        .div{
            width: 85%;
            margin-left: 7.5%;
            position: static;
        }

        .highcharts-figure, .highcharts-data-table table {
            min-width: 310px; 
            max-width: 100%;
            margin: 1em auto;
        }

        #container {
            height: 150px;
        }

        .highcharts-data-table table {
            font-family: Verdana, sans-serif;
            border-collapse: collapse;
            border: 1px solid #EBEBEB;
            margin: 10px auto;
            text-align: center;
            width: 100%;
            max-width: 500px;
        }
        .highcharts-data-table caption {
            padding: 1em 0;
            font-size: 1.2em;
            color: #555;
        }
        .highcharts-data-table th {
            font-weight: 600;
            padding: 0.5em;
        }
        .highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
            padding: 0.5em;
        }
        .highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
            background: #f8f8f8;
        }
        .highcharts-data-table tr:hover {
            background: #f1f7ff;
        }

	</style>
</head>
<body>

    <script src="librerias/Highcharts-9.0.0/code/highcharts.js"></script>
    <script src="librerias/Highcharts-9.0.0/code/modules/exporting.js"></script>
    <script src="librerias/Highcharts-9.0.0/code/modules/export-data.js"></script>
    <script src="librerias/Highcharts-9.0.0/code/modules/accessibility.js"></script>
    
    <!-- ICONOS PARA USUARIO Y SING OUT -->
    <ul class="sesion">
        <li class="btn-sesion">
            <a href="#">
                <i class="icono-user fa fa-user-circle" aria-hidden="true"></i>
            </a>
        </li>
        <li class="btn-sesion">
            <a href="php/desconecta_usuario.php">
                <i class="icono-exit fa fa-sign-out" aria-hidden="true"></i>
            </a>
        </li>
    </ul>
    <img src="img/logo.png" alt="" class="logo">
    <h1 class="title">
        INSTITUTO INGUZ
    </h1>
    <div class="subtitulo">
        <pre>Hola de nuevo <?php echo $_SESSION['nombre'] ?>.
Tipo: <?php echo $_SESSION['tipo'] ?>.
Usuario: <?php echo $_SESSION['usuario'] ?>.</pre>
    </div>

    <!-- AQUI ESTABA LA GRAFICA -->

    
    <div class="container">
       
        <div class="card">
            <a href="modulos/alumnos/list.php">
            <h4><i class="icono fa fa-graduation-cap fa-2x"></i>
            ALUMNOS</h4>
            </a>
        </div>

        <div class="card">
            <a href="modulos/reportes/list.php">
                <h4><i class="iconoA fa fa-list-alt fa-2x"></i>
                REPORTES</h4>
            </a>
        </div>
        
        <div class="card">
            <a href="modulos/catalogo/list.php">
                <h4><i class="icono fa fa-file-text fa-2x"></i>
                CATALOGOS</h4>
            </a>
        </div> 

        <div class="card">
            <a href="modulos/profesores/list.php">
                <h4><i class="icono fa fa-address-book fa-2x"></i>
                PROFESORES</h4>
            </a>
        </div>
        
        <div class="card">
            <a href="modulos/colaboradores/list.php">
                <h4><i class="iconoE fa fa-black-tie fa-2x"></i>
                COLABORADORES</h4>
            </a>
        </div>

        <div class="card">
            <a href="modulos/grupos/list.php">
            <h4><i class="icono fa fa-users fa-2x"></i>
                GRUPOS</h4>
            </a>
        </div>
        
        <div class="card">
            <a href="modulos/caja/recibo.php">
                <h4><i class="icono fa fa-archive fa-2x"></i>
                    CAJA</h4>
            </a>
        </div>
        
        
        <?php
            if($permiso == 1 || $permiso == 2){
        ?>
            <div class="card">
                <a href="modulos/administracion/menu.php">
                    <h4><i class="icono fa fa-unlock-alt fa-2x"></i>
                    ADMINISTRACIÓN</h4>
                </a>
            </div>
        <?php
            }
        ?>
        
        <!--<div class="card">
            <a href="#">
                <h4><i class="icono fa fa-cogs fa-2x"></i>
                CONFIGURACIÓN</h4>
            </a>
        </div>-->
        
    </div>


    <!-- GRAFICA NUEVA -->
    <div class="div">
        <figure class="highcharts-figure">
            <div id="container"></div>
            <p class="highcharts-description">
                
            </p>
        </figure>
    </div>


    <script type="text/javascript">
        Highcharts.chart('container', {
            chart: {
                type: 'bar'
            },
            title: {
                text: 'Meta de ingresos de mes'
            },
            yAxis: {
                min: 10,
                title: {
                    text: 'Porcentaje de ingresos respecto a la meta mensual'
                }
            },
            legend: {
                reversed: false
            },
            plotOptions: {
                series: {
                    stacking: 'normal'
                }
            },
            series: [{
                name: 'Ingresos al momento',
                data: [80]
            }, {
                name: 'Por cobrar',
                data: [20]
            }]
        });
	</script>
    
</body>
</html>