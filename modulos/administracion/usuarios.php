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

    ## // OBTENER TODOS LOS COLABORADORES QUE NO TENGAN UN USUARIO
    $colabs = $conexion->query(
        "SELECT * FROM tbcolaborador c
        JOIN tbpersona p ON(c.clavecolaborador = p.idpersona)"
    ) or die ("Error al obtener los colaboradores " . mysqli_error($conexion));

    ## // OBTENER LOS PERMISOS DISPONIBLES
    $permisos = $conexion->query(
        "SELECT * FROM tbpermisos
        WHERE idpermiso != 1"
    ) or die('Error al obtener los permisos ' . mysqli_error($conexion));

    ## // OBTENER TODOS LOS USUARIOS
    $usuarios = $conexion->query(
        "SELECT * FROM tbusuarios A

        JOIN tbcolaborador B ON (A.colaborador = B.clavecolaborador)
        JOIN tbpersona C ON (B.persona = C.idpersona)
        JOIN tbpermisos D ON (A.permiso = D.idpermiso)
        
        WHERE A.permiso != 1
        
        ORDER BY A.colaborador DESC"
    ) or die ("Error al obtener los usuarios" . mysqli_error($conexion));
    
    $titulo = 'Usuarios';
    #require 'views/colaboradores.view.php';
    require '../../plantillas/nav_side.view.php';

?>


<div class="cont">
    <h1 class="title">Usuarios</h1>

    <!-- AGREGA UN NUEVO USUARIO -->
    <form action="usuarios1.php" method="post">
        <input type="number" name="tipo" value="1" hidden>
        <table class="tabla-consulta-modal">
            <caption>Agrega un nuevo usuario</caption>
            <colgroup>
                <col style="width: 40%">
                <col style="width: 60%">
            </colgroup>
            <tr>
                <th><label for="colab">Colaborador:</label></th>
                <td>
                    <select name="colab" 
                            id="colab" 
                            class="form-control"
                            title="Seleccione un colaborador">
                        <?php
                            while($c = $colabs->fetch_assoc()){

                                ## // OBTENER COLABORADORES QUE NO SEAN USUARIOS AUN
                                $esusuario = $conexion->query(
                                    "SELECT * FROM tbusuarios
                                    WHERE colaborador =" . $c['clavecolaborador'] .""
                                ) or die ("Error al obtener los colaboradores que son usuarios " . mysqli_error($conexion));

                                if($esusuario->num_rows == 0){
                                    $nombre = $c['nombre'] . ' ' . $c['apaterno'] . ' ' . $c['amaterno'];
                        ?>
                                    <option value="<?php echo $c['clavecolaborador'] ?>"><?php echo $nombre . ' / ' . $c['area'] ?></option>
                        <?php
                                }
                            }
                        ?>
                    </select>
                </td>
            </tr>

            <tr>
                <th><label for="permiso">Permiso:</label></th>
                <td>
                    <select name="permiso" 
                            id="permiso"
                            class="form-control"
                            title="Seleccione tipo de permiso para el colaborador">
                        <?php
                            while($per = $permisos->fetch_assoc()){
                        ?>
                            <option value="<?php echo $per['idpermiso'] ?>"><?php echo $per['tipopermiso'] ?></option>
                        <?php
                            }
                        ?>
                    </select>
                </td>
            </tr>

        </table>
        <div class="botonera">
            <input type="submit" class="btn primary" value="Registrar nuevo usuario">
        </div>
    </form>

    <!-- MOSTRAR LOS USUARIOS QUE YA EXISTEN -->
    <h1 class="title"></h1>
    <div class="main-container">
        <table class="tabla-scroll">
            <colgroup>
                <col style="width: 8%; min-width: 8%">
                <col style="width: 40%; min-width: 40%">
                <col style="width: 15%; min-width: 15%">
                <col style="width: 15%; min-width: 15%">
                <col style="width: 30%; min-width: 15%">
            </colgroup>

            <thead>
                <th>Clave</th>
                <th>Nombre</th>
                <th>Area</th>
                <th>Nombre de usuario</th>
                <th>Tipo de permiso</th>
            </thead>

            <?php
                while($u = $usuarios->fetch_assoc()){
                    $nombre = $u['nombre'] . ' ' . $u['apaterno'] . ' ' . $u['amaterno'];
                    $clave = '0000' . $u['clavecolaborador'];
                    $clave = substr($clave, -4);
            ?>
                <tr>
                    <td style="text-align: center"><?php echo $clave ?></td>
                    <td><?php echo $nombre ?></td>
                    <td style="text-align: center"><?php echo $u['area'] ?></td>
                    <td style="text-align: center"><?php echo $u['usuario'] ?></td>
                    <td style="text-align: center"><?php echo $u['tipopermiso'] ?></td>

                </tr>
            <?php
                }
            ?>
        </table>
    </div>
</div>