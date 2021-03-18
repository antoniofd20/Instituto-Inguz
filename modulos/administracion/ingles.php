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

    ## // Obtener todos los niveles de ingles
    $niveles = $conexion->query(
        "SELECT * FROM catmaterias
        
        WHERE nombremat LIKE 'NIVEL%'"
    ) or die("Error al obtener los niveles " . mysqli_error($conexion));
    
    $titulo = 'Niveles de ingles';
    #require 'views/colaboradores.view.php';
    require '../../plantillas/nav_side.view.php';

?>


<div class="cont">
    <h1 class="title">Niveles de ingles</h1>

    <!-- AGREGA UN NUEVO USUARIO -->
    <form action="#" method="post">
        <input type="number" name="tipo" value="1" hidden>
        <table class="tabla-consulta-modal">
            <caption>Agrega un nuevo nivel</caption>
            <colgroup>
                <col style="width: 40%">
                <col style="width: 60%">
            </colgroup>

            <tr>
                <th><label for="nivel">Nivel</label></th>
                <td>
                    <input type="number"
                            name="nivel"
                            id="nivel"
                            class="form-control"
                            title="Ingrese un numero para el nivel"
                            placeholder="Ingrese un numero para el nivel">
                </td>
            </tr>

        </table>
        <div class="botonera">
            <input type="submit" class="btn primary" value="Registrar">
        </div>
    </form>

    <!-- MOSTRAR LOS USUARIOS QUE YA EXISTEN -->
    <h1 class="title">Niveles existentes</h1>
    <div class="main-container">
        <table class="tabla-scroll">

            <thead>
                <th>Nivel</th>
            </thead>

            <?php
                while($n = $niveles->fetch_assoc()){
            ?>
                <tr>
                    <td style="text-align: center"><?php echo $n['nombremat'] ?></td>
                </tr>
            <?php
                }
            ?>
        </table>
    </div>
</div>