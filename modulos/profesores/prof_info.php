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


    # |-----------------------------------------------------|
    # |     OBTENER LOS DATOS DEL PROFESOR SELECCIONADO     |
    # |-----------------------------------------------------|

    $id = $_GET['id'];

    $qprofs = $conexion->query(
        "SELECT * FROM tbpersona pe
        JOIN tbprofesor pr ON (pe.idpersona = pr.persona)
        WHERE claveprofesor = '$id'"
    ) or die("Error al obtener los colaboradores " . mysqli_error($conexion));

    $prof = $qprofs->fetch_assoc();

    $qprofs->free();
    


    $titulo ='Consulta profesor';
    require '../../plantillas/nav_side.view.php';
?>


<div class="cont">
    <h1 class="title">Informacion del profesor: <?php echo $prof['nombre']; ?></h1>

    <!-- CONTENEDOR PARA LOS ICONOS -->
    <div class="flex">
        <!-- EXPORTAR A PDF -->
        <div class="exportar">
            <a href="#">
                <i class="icono-flex pdf fa fa-file-pdf-o" aria-hidden="true"></i>
            </a>
        </div>
    </div>

    <div class="main-container">
        <div class="tabla-scroll-container-ver">
            <table class="tabla-consulta-modal">
                <tr>
                    <th colspan="3">Datos personales</th>
                </tr>
                <tr>
                    <td><span>Nombre:</span> <?php echo $prof['nombre']; ?></td>
                    <td><span>Apellido Paterno:</span> <?php echo $prof['apaterno']; ?></td>
                    <td><span>Apellido Materno:</span> <?php echo $prof['amaterno']; ?></td>
                </tr>
                <tr>
                    <td><span>Curp:</span> <?php echo $prof['curp']; ?></td>
                    <td><span>Fecha Nacimiento:</span> <?php echo $prof['fechanac']; ?></td>
                    <td><span>Edad:</span> <?php echo $prof['edad']; ?></td>
                </tr>
                <tr>
                    <td><span>Sexo:</span> <?php echo $prof['sexo']; ?></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <th colspan="3">Contacto</th>
                </tr>
                <tr>
                    <td><span>Telefono:</span> <?php echo $prof['telefono']; ?></td>
                    <td><span>Celular:</span> <?php echo $prof['celular']; ?></td>
                    <td><span>Email:</span> <?php echo $prof['correoe']; ?></td>
                </tr>
                <tr>
                    <th colspan="3">Domicilio</th>
                </tr>
                <tr>
                    <td><span>Calle y Numero:</span> <?php echo $prof['calleynum']; ?></td>
                    <td><span>Colonia:</span> <?php echo $prof['colonia']; ?></td>
                    <td><span>Municipio/Alcaldia:</span> <?php echo $prof['municipio']; ?></td>
                </tr>
                <tr>
                    <td><span>Estado:</span> <?php echo $prof['estado']; ?></td>
                    <td><span>Codigo Postal:</span> <?php echo $prof['cpostal']; ?></td>
                    <td></td>
                </tr>
                <tr>
                    <th colspan="3">Informacion Academica</th>
                </tr>
                <tr>
                    <td><span>Profesion:</span> <?php echo $prof['profesion']; ?></td>
                    <?php 
                        if($prof['especialidad'] == 1){
                            $esp = 'CIENCIAS';
                        } else if($prof['especialidad'] == 2){
                            $esp = 'SOCIALES';
                        } else if($prof['especialidad'] == 3){
                            $esp = 'INGLES';
                        }
                    ?>

                    <td><span>Especialidad:</span> <?php echo $esp; ?></td>
                    <td></td>
                </tr>
                <tr>
                    <td><span>Fecha Alta:</span> <?php echo $prof['fechalta']; ?></td>
                    <td><span>Fecha baja:</span> <?php echo $prof['fechabaja']; ?></td>
                    <td></td>
                </tr>
            </table>
        </div>
    </div>
</div>