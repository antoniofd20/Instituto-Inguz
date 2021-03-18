<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- FONTAWESOME -->
    <link rel="stylesheet" href="../../FontAwesome/css/font-awesome.css">

    <link rel="stylesheet" href="../../css/nav_side.css">
    <link rel="stylesheet" href="../../css/tablas.css">
    <link rel="stylesheet" href="../../css/form-cata.css">

    <!-- FUENTES -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@400;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@1,900&display=swap" rel="stylesheet">
    <title><?php echo $titulo; ?></title>
</head>
<body>
    <header class="header">
        <nav class="nav">
            <ul class="ul">
                <li class="li">
                    <a href="../../inicio.php" class="link_img">
                        <i class="icono fa fa-home fa-2x"></i>
                        <img src="../img/logo.png" alt="" class="img_nav">
                    </a>
                </li>
                <li class="li">
                    <a href="alumnos.php" class="link">
                        <i class="icono fa fa-graduation-cap fa-2x"></i>
                    </a>
                </li>
                <li class="li">
                    <a href="#" class="link">
                        <i class="icono fa fa-file-text fa-2x"></i>
                    </a>
                </li>
                <li class="li">
                    <a href="#" class="link">
                        <i class="icono fa fa-archive fa-2x"></i>
                    </a>    
                </li>
            </ul>
        </nav>

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
    </header>

    <aside>
        <a href="../../inicio.php">
            <div class="img" title="Ir a inicio"></div>
        </a>

        <div class="container">
            <div class="row">
                <div class="col-2 alu">
                    <a href="../../modulos/alumnos/list.php"><i class="fa fa-graduation-cap fa-2x" title="Ir a alumnos"></i></a>
                </div>

                <div class="col-2 profesores">
                    <a href="../../modulos/profesores/list.php"><i class="fa fa-address-book fa-2x" title="Ir a profesores"></i></a>
                </div>
                
            </div>
            
            <div class="row">
                <div class="col-2 grupos">
                    <a href="../../modulos/grupos/list.php"><i class="fa fa-users fa-2x" title="Ir a grupos"></i></a>
                </div>

                <div class="col-2 colab">
                    <a href="../../modulos/colaboradores/list.php"><i class="fa fa-black-tie fa-2x" title="Ir a colaboradores"></i></a>
                </div>

            </div>

            <div class="row">
                <div class="col-2 reportes">
                    <a href="../../modulos/reportes/list.php"><i class="fa fa-list-alt fa-2x" title="Ir a reportes"></i></a>
                </div>

                <div class="col-2 catalogo">
                    <a href="../../modulos/catalogo/list.php"><i class="fa fa-file-text fa-2x" title="Ir a catalogo"></i></a>
                </div>

            </div>

            <div class="row">
                <div class="col-2 caja">
                    <a href="../../modulos/caja/recibo.php"><i class="fa fa-archive fa-2x" title="Ir a caja"></i></a>
                </div>

                <div class="col-2 admin">
                    <a href="../../modulos/administracion/menu.php"><i class="fa fa-unlock-alt  fa-2x" title="Ir a administración"></i></a>
                </div>

            </div>
        </div>

        <!--
        <div class="contenido_sidebar">
            <ul class="ul_sidebar">
                <li class="li_sidebar">
                    <a href="alumnos.php" class="a_sidebar"><i class="iconoE fas fa-user-graduate fa-2x"></i><p class ="etiqueta">ALUMNOS</p></a>
                </li>
                <li class="li_sidebar">
                    <a href="grupos.php" class="a_sidebar"><i class="icono fas fa-users fa-2x"></i>GRUPOS</a>
                </li>
                <li class="li_sidebar">
                    <a href="profesores.php" class="a_sidebar"><i class="icono fas fa-chalkboard-teacher fa-2x"></i>PROFESORES</a>
                </li>
                <li class="li_sidebar">
                    <a href="colaboradores.php" class="a_sidebar"><i class="iconoE fas fa-user-tie fa-2x"></i>COLABORADORES</a>
                </li>
                <li class="li_sidebar">
                    <a href="#" class="a_sidebar"><i class="icono fas fa-book-open fa-2x"></i>CATALOGO</a>
                </li>
                <li class="li_sidebar">
                    <a href="#" class="a_sidebar"><i class="icono fas fa-cash-register fa-2x"></i>CAJA</a>
                </li>
                <li class="li_sidebar">
                    <a href="#" class="a_sidebar"><i class="icono fas fa-unlock-alt fa-2x"></i>ADMINISTRACION</a>
                </li>
                <li class="li_sidebar">
                    <a href="#" class="a_sidebar"><i class="iconoA fas fa-exclamation fa-2x"></i>REPORTES</a>
                </li>
                <li class="li_sidebar">
                    <a href="#" class="a_sidebar"><i class="icono fas fa-cogs fa-2x"></i>CONFIGURACION</a>
                </li>
                <li class="li_sidebar">
                    <a href="#" class="a_sidebar"><i class="icono fas fa-question-circle fa-2x"></i>AYUDA</a>
                </li>
            </ul>
        </div>
        -->
    </aside>


    <div class="contenido_tabla">
        
    </div>
</body>
</html>