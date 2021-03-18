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

    ## // OBTENER LOS ESTATUS
    $status = $conexion->query(
        "SELECT * FROM catstatus"
    ) or die ("Error al obtener los estatus " . mysqli_error($conexion));
    
    $titulo = 'Estatus';
    #require 'views/colaboradores.view.php';
    require '../../plantillas/nav_side.view.php';

?>


<div class="cont">
    <h1 class="title">Estatus para alumnos</h1>

    <!-- AGREGA UN NUEVO USUARIO -->
    <form action="#" method="post">
        <input type="number" name="tipo" value="1" hidden>
        <table class="tabla-consulta-modal">
            <caption>Agrega un nuevo tipo de estatus</caption>
            <colgroup>
                <col style="width: 40%">
                <col style="width: 60%">
            </colgroup>

            <tr>
                <th><label for="estatus">Estatus:</label></th>
                <td>
                    <input type="text"
                            class="form-control"
                            name="estatus"
                            id="estatus"
                            title="Agrege de un nuevo tipo de estatus"
                            placeholder="Agrege de un nuevo tipo de estatus">
                </td>
            </tr>

            <tr>
                <th><label for="desc">Descripcion</label></th>
                <td>
                    <input type="text"
                            class="form-control"
                            name="desc"
                            id="desc"
                            title="Agregue una descripcion parael estatus"
                            placeholder="Agregue una descripcion parael estatus">  
                </td>
            </tr>

        </table>
        <div class="botonera">
            <input type="submit" class="btn primary" value="Registrar">
        </div>
    </form>

    <!-- MOSTRAR LOS USUARIOS QUE YA EXISTEN -->
    <h1 class="title"></h1>
    <div class="main-container">
        <table class="tabla-scroll">
            <colgroup>
                <col style="width: 40%; min-width: 40%">
                <col style="width: 60%; min-width: 60%">
            </colgroup>

            <thead>
                <th>Nombre</th>
                <th>Descripcion</th>
            </thead>

            <?php
                while($e = $status->fetch_assoc()){
            ?>
                <tr>
                    <td style="text-align: center"><?php echo $e['nombre'] ?></td>
                    <td style="text-align: center"><?php echo $e['descripcion'] ?></td>
                </tr>
            <?php
                }
            ?>
        </table>
    </div>
</div>