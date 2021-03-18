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

    ## // Obtener todas las especialidades
    $esp = $conexion->query(
        "SELECT * FROM catespecialidad"
    ) or die("Error al obtener las especialidades " . mysqli_error($conexion));
    
    $titulo = 'Especialidades';
    #require 'views/colaboradores.view.php';
    require '../../plantillas/nav_side.view.php';

?>


<div class="cont">
    <h1 class="title">Especialidades</h1>

    <!-- AGREGA UN NUEVO USUARIO -->
    <form action="usuarios1.php" method="post">
        <input type="number" name="tipo" value="1" hidden>
        <table class="tabla-consulta-modal">
            <caption>Agrega una nueva especialidad</caption>
            <colgroup>
                <col style="width: 40%">
                <col style="width: 60%">
            </colgroup>

            <tr>
                <th><label for="esp">Especialidad:</label></th>
                <td>
                    <input type="text"
                            class="form-control"
                            name="esp"
                            id="esp"
                            title="Agrege el nombre de una nueva especialidad"
                            placeholder="Agrege el nombre de una nueva especialidad">
                </td>
            </tr>

            <tr>
                <th><label for="desc">Descripcion</label></th>
                <td>
                    <input type="text"
                            class="form-control"
                            name="desc"
                            id="desc"
                            title="Agregue una descripcion para la especialidad"
                            placeholder="Agregue una descripcion para la especialidad">  
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
                while($e = $esp->fetch_assoc()){
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