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

    $query = $conexion->query(
        "SELECT * FROM tbgrupo g
        JOIN catespecialidad e ON (g.especialidad = e.idespecialidad)"
    ) or die("Error al obtener los grupos " . mysqli_error($conexion));


    $titulo = 'Grupos';
    require '../../plantillas/nav_side.view.php'

?>

<div class="cont">

        <h1 class="title" >Consulta grupos</h1>

                <!-- CONTENEDOR PARA LOS ICONOS -->
                <div class="flex">
                    <!-- AGREGAR UN NUEVO REGISTRO -->
                    <div class="agregar">
                        <a href="form_grupo.php">
                            <i class="icono-flex agregar-icono fa fa-plus-circle fa-3x"></i>
                        </a>
                    </div>

                    <!-- EXPORTAR A ALGUN TIPO DE DOCUMENTO -->
                    <div class="exportar">
                        <a href="archivo/pdf/gruposPDF.php" target="blank">
                            <i class="icono-flex pdf fa fa-file-pdf-o" aria-hidden="true"></i>
                        </a>
                        <a href="archivo/excel/gruposEXCEL.php">
                            <i class="icono-flex excel fa fa-file-excel-o" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>

        <!--TABLA PARA CONSULTA-->
        <table class="tabla-consulta-modal">
            <caption>Buscar grupo</caption>
            <colgroup>
                <col style="width:40%">
                <col style="width:60%">
            </colgroup>
            <form action="#" method="post">
            <tr>
                <th><label for="especialidad">Especialidad:</label></th>
                <td>
                    <select name="especialidad" id="especialidad"
                    title="Seleccione una especialidad a buscar">
                        <option value="CIENCIAS">CIENCIAS</option>
                        <option value="SOCIALES">SOCIALES</option>
                        <option value="INGLES">INGLES</option>
                    </select>
                </td>
            </tr>
            </form>
        </table>    

        <div class="main-container">
            <div class="tabla-scroll-container">

                <table class="tabla-scroll">
                    <colgroup>
                        <col style="width: 15%; min-width: 10%">
                        <col style="width: 40%; min-width: 40%">
                        <col style="width: 25%; min-width: 15%">
                        <col style="width: 15%; min-width: 15%">
                        <col style="width: 40%; min-width: 15%">
                    </colgroup>

                    
                    <thead>
                        <th>Grupo</th>
                        <th>Especialidad</th>
                        <th>Fecha inicio</th>
                        <th>Inscritos</th>
                        <th>Acciones</th>
                    </thead>

                    <?php 
                        while($q = $query->fetch_assoc()){
                            $clave = '0000' . $q['idgrupo'];
                            $clave = substr($clave, -4);
                    ?>
                    <tr>
                        <td style="text-align: center"><?php echo $clave ?></td>
                        <td style="text-align: center"><?php echo $q['nombre'] ?></td>
                        <td style="text-align: center"><?php echo $q['fechainicio'] ?></td>
                        <td style="text-align: center"><?php echo $q['inscritos'] ?></td>
                        <td class="ico-group">
                            <a style="color: black" class="ico-accion" title="Lista de alumnos" href="#">
                                <i class="fa fa-eye ico-consulta" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>

                    <?php 
                        }
                    ?>
                </table>
            </div>
        </div>
    </div>