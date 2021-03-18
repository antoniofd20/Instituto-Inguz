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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- FONTAWESOME LOCAL -->
    <link rel="stylesheet" href="../../FontAwesome/css/font-awesome.css">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@400;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@1,900&display=swap" rel="stylesheet">

    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="../../css/bootstrap/bootstrap.css">
    
    <!-- MIS ESTILOS -->
    <link rel="stylesheet" href="../../css/reportes.css">
    <link rel="stylesheet" href="../../css/modal.css">
    <link rel="stylesheet" href="../../css/nav_side_2.css">
    
    <!-- JavaScript local -->
    <script src="../../jquery/jquery_bootstrap.js"></script>
    <script src="../../js/bootstrap.min.js"></script>

    <title>Reportes</title>
</head>
<body>
<header class="header_2">
        <nav class="nav_2">
            <ul class="ul_2">
                <li class="li_2">
                    <a href="inicio.php" class="link_img_2">
                        <i class="icono_2 fa fa-home fa-2x"></i>
                        <img src="../img/logo.png" alt="" class="img_nav_2">
                    </a>
                </li>
                <li class="li_2">
                    <a href="alumnos.php" class="link_2">
                        <i class="icono_2 fa fa-graduation-cap fa-2x"></i>
                    </a>
                </li>
                <li class="li_2">
                    <a href="#" class="link_2">
                        <i class="icono_2 fa fa-file-text fa-2x"></i>
                    </a>
                </li>
                <li class="li_2">
                    <a href="#" class="link_2">
                        <i class="icono_2 fa fa-archive fa-2x"></i>
                    </a>    
                </li>
            </ul>
        </nav>

        <!-- ICONOS PARA USUARIO Y SING OUT -->
        <ul class="sesion">
            <li class="btn-sesion">
                <a href="#">
                    <i class="icono-user fa fa-user-circle fa-3x" aria-hidden="true"></i>
                </a>
            </li>
            <li class="btn-sesion">
                <a href="../../php/desconecta_usuario.php">
                    <i class="icono-exit fa fa-sign-out fa-3x" aria-hidden="true"></i>
                </a>
            </li>
        </ul>
    </header>

    <aside>
        <a href="inicio.php">
            <div class="img" title="Ir a inicio"></div>
        </a>

        <div class="container_2">
            <div class="row_2">
                <div class="col-2_2 alu">
                    <a href="../../modulos/alumnos/list.php"><i class="fa fa-graduation-cap fa-2x" title="Ir a alumnos"></i></a>
                </div>

                <div class="col-2_2 profesores">
                    <a href="../../modulos/profesores/list.php"><i class="fa fa-address-book fa-2x" title="Ir a profesores"></i></a>
                </div>
                
            </div>
            
            <div class="row_2">
                <div class="col-2_2 grupos">
                    <a href="../../modulos/grupos/list.php"><i class="fa fa-users fa-2x" title="Ir a grupos"></i></a>
                </div>

                <div class="col-2_2 colab">
                    <a href="../../modulos/colaboradores/list.php"><i class="fa fa-black-tie fa-2x" title="Ir a colaboradores"></i></a>
                </div>

            </div>

            <div class="row_2">
                <div class="col-2_2 reportes">
                    <a href="../../modulos/reportes/list.php"><i class="fa fa-list-alt fa-2x" title="Ir a reportes"></i></a>
                </div>

                <div class="col-2_2 catalogo">
                    <a href="../../modulos/catalogo/list.php"><i class="fa fa-file-text fa-2x" title="Ir a catalogo"></i></a>
                </div>

            </div>

            <div class="row_2">
                <div class="col-2_2 caja">
                    <a href="../../modulos/caja/recibo.php"><i class="fa fa-archive fa-2x" title="Ir a caja"></i></a>
                </div>

                <div class="col-2_2 admin">
                    <a href="../../modulos/administracion/menu.php"><i class="fa fa-unlock-alt  fa-2x" title="Ir a administración"></i></a>
                </div>

            </div>
        </div>
    </aside>


    <div class="cont">
        <ul class = "renglon">
            <li class = "columna ingresos">
                <a href="javascript:void(0)" onclick="consultaIngresos()" class="ingresos">
                    <h4><i class="icono_3 fa fa-usd fa-2x"></i>
                    INGRESOS</h4>
                </a>
            </li>
            <li class = "columna adeudos">
                <a href="adeudos.php" class="adeudos">
                    <h4><i class="icono_3 fa fa-times fa-2x"></i>
                    ADEUDOS</h4>
                </a>
            </li>
            <li class = "columna meta">
                <a href="meta.php" class="meta">
                    <h4><i class="icono_3 fa fa-flag-checkered fa-2x"></i>
                    META</h4>
                </a>
            </li>
            <li class = "columna pagos">
                <a href="#" class="pagos">
                    <h4><i class="icono_3 fa fa-money fa-2x"></i>
                    PAGOS</h4>
                </a>
            </li>
        </ul>
    </div>

    <div id="divModal"></div>
    <script>
        function consultaIngresos() {
            var ruta = 'modal_conuslta_ingresos.php';
            console.log(ruta);
            $.get(ruta, function(data){
                $('#divModal').html(data);
                $('#miModal').modal('show');
            });
        }

        function back(){
            history.back();
        }
    </script>
</body>
</html>