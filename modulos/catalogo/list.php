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

    $qcata = $conexion->query(
        "SELECT * FROM catprodserv"
    ) or die ("Error al obtener los productos del catalogo " . mysqli_error($conexion));



    $titulo = 'Catalogo';
    require '../../plantillas/catalogo_nav.php';

?>

<div class="cont mt-50">
    <h1 class="title" >Catálogo</h1>

            <!-- CONTENEDOR PARA LOS ICONOS -->
            <div class="flex">
                <!-- AGREGAR UN NUEVO REGISTRO -->
                <div class="agregar">
                    <a href="editar-catalogo.php">
                        <i class="icono-flex editar-icono fa fa-pencil fa-3x"></i>
                    </a>
                </div>

                <!-- EXPORTAR A ALGUN TIPO DE DOCUMENTO -->
                <div class="exportar">
                    <a href="archivo/pdf/catalogoPDF.php" target="blank">
                        <i class="icono-flex pdf fa fa-file-pdf-o" aria-hidden="true"></i>
                    </a>
                    <a href="archivo/excel/catalogoEXCEL.php">
                        <i class="icono-flex excel fa fa-file-excel-o" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        <div class="main-container mas-abajo">
            <div class="tabla-scroll-container">

                <table class="tabla-scroll">
                    <colgroup>
                        <col style="width: 20%">
                        <col style="width: 60%">
                        <col style="width: 20%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>Clave</th>
                            <th>Descripción</th>
                            <th>Costo</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        while($serv = $qcata->fetch_assoc()){
                    ?>
                        <tr>
                            <td class="center"><?php echo $serv['idprodserv'] ?></td>
                            <td class="center"><?php echo $serv['nombre'] ?></td>
                            <td class="center">$ <?php echo $serv['costo'] ?></td>
                        </tr>
                    <?php
                        }
                    ?>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>