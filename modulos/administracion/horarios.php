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

    ## // Obtener todos los horarios
    $horarios = $conexion->query(
        "SELECT * FROM cathorario A
        
        JOIN catespecialidad B ON (A.especialidad = B.idespecialidad)"
    ) or die("Error al obtener los horarios " . mysqli_error($conexion));

    ## // Obtener las especialidades
    $esp = $conexion->query(
        "SELECT * FROM catespecialidad"
    ) or die ("Error al obtener las especialidades " . mysqli_error($conexion));
    
    $titulo = 'Horarios';
    #require 'views/colaboradores.view.php';
    require '../../plantillas/nav_side.view.php';

?>


<div class="cont">
    <h1 class="title">Horarios</h1>

    <!-- AGREGA UN NUEVO USUARIO -->
    <form action="usuarios1.php" method="post">
        <input type="number" name="tipo" value="1" hidden>
        <table class="tabla-consulta-modal">
            <caption>Agrega un nuevo horario</caption>
            <colgroup>
                <col style="width: 40%">
                <col style="width: 60%">
            </colgroup>

            <tr>
                <th><label for="esp">Especialidad</label></th>
                <td>
                    <select name="esp" 
                            id="esp"
                            class="form-control"
                            title="Seleccione una especialidad para el horario">

                        <?php
                            while($e = $esp->fetch_assoc()){
                        ?>
                            <option value="<?php echo $e['idespecialidad'] ?>"><?php echo $e['nombre'] ?></option>
                        <?php
                            }
                        ?>
                    </select>
                </td>
            </tr>

            <tr>
                <th><label for="dias">Dias:</label></th>
                <td>
                    <input type="text"
                            name="dias"
                            id="dias"
                            class="form-control"
                            title="Ingrese los dias de clase de este horario"
                            placeholder="Ingrese los dias de clase de este horario">
                </td>
            </tr>

            <tr>
                <th><label for="horainicio">Hora de inicio:</label></th>
                <td>
                    <input type="time"
                            name="horainicio"
                            id="horainicio"
                            class="form-control"
                            title="Ingrese la hora en la que comienzan las clases"
                            placeholder="Ingrese la hora en la que comienzan las clases">
                </td>
            </tr>

            <tr>
                <th><label for="horafin">Hora en que termina:</label></th>
                <td>
                    <input type="time"
                            name="horafin"
                            id="horafin"
                            class="form-control"
                            title="Ingrese la hora en la que terminan las clases"
                            placeholder="Ingrese la hora en la que terminan las clases">
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
                <col style="width: 25%; min-width: 25%">
                <col style="width: 25%; min-width: 25%">
                <col style="width: 25%; min-width: 25%">
                <col style="width: 25%; min-width: 25%">
            </colgroup>

            <thead>
                <th>Especialidad</th>
                <th>Dias</th>
                <th>Hora de inicio</th>
                <th>Hora de termino</th>
            </thead>

            <?php
                while($h = $horarios->fetch_assoc()){
            ?>
                <tr>
                    <td style="text-align: center"><?php echo $h['nombre'] ?></td>
                    <td style="text-align: center"><?php echo $h['dias'] ?></td>
                    <td style="text-align: center"><?php echo $h['horainicio'] ?></td>
                    <td style="text-align: center"><?php echo $h['horafin'] ?></td>
                </tr>
            <?php
                }
            ?>
        </table>
    </div>
</div>