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

    $id = $_GET['id'];

    $query = $conexion->query(
        "SELECT * FROM tbpersona p
        JOIN tbcolaborador c ON (p.idpersona = c.persona)
        WHERE clavecolaborador = $id AND persona = $id"
    ) or die("Error al obtener los datos del colaborador " . mysqli_error($conexion));

    $colab = $query->fetch_assoc();


    $titulo = 'Consulta colaborador';
    #require 'views/colab_info.view.php';
    require '../../plantillas/nav_side.view.php';

?>

<div class="cont">
    <h1 class="title">Informacion del colaborador: <?php echo $colab['nombre'] ?></h1>

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
                    <td><span>Nombre:</span> <?php echo $colab['nombre']; ?></td>
                    <td><span>Apellido Paterno:</span> <?php echo $colab['apaterno']; ?></td>
                    <td><span>Apellido Materno:</span> <?php echo $colab['amaterno']; ?></td>
                </tr>
                <tr>
                    <td><span>Curp:</span> <?php echo $colab['curp']; ?></td>
                    <td><span>Fecha Nacimiento:</span> <?php echo $colab['fechanac']; ?></td>
                    <td><span>Fecha Edad:</span> <?php echo $colab['edad']; ?></td>
                </tr>
                <tr>
                    <td><span>Sexo:</span> <?php echo $colab['sexo']; ?></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <th colspan="3">Contacto</th>
                </tr>
                <tr>
                    <td><span>Telefono:</span> <?php echo $colab['telefono']; ?></td>
                    <td><span>Celular:</span> <?php echo $colab['celular']; ?></td>
                    <td><span>Email:</span> <?php echo $colab['correoe']; ?></td>
                </tr>
                <tr>
                    <th colspan="3">Domicilio</th>
                </tr>
                <tr>
                    <td><span>Calle y Numero:</span> <?php echo $colab['calleynum']; ?></td>
                    <td><span>Colonia:</span> <?php echo $colab['colonia']; ?></td>
                    <td><span>Municipio/Alcaldia:</span> <?php echo $colab['municipio']; ?></td>
                </tr>
                <tr>
                    <td><span>Estado:</span> <?php echo $colab['estado']; ?></td>
                    <td><span>Codigo Postal:</span> <?php echo $colab['cpostal']; ?></td>
                    <td></td>
                </tr>
                <tr>
                    <th colspan="3">Informacion del Puesto</th>
                </tr>
                <tr>
                    <td><span>Area:</span> <?php echo $colab['area']; ?></td>
                    <td><span>Profesion:</span> <?php echo $colab['profesion']; ?></td>
                    <td></td>
                </tr>
                <tr>
                    <td><span>Fecha Alta:</span> <?php echo $colab['fechalta']; ?></td>
                    <?php 
                        if($colab['fechabaja'] == ''){
                    ?>
                        <td><span>Fecha baja:</span> Sin fecha de baja</td>
                    <?php 
                        } else {
                    ?>
                        <td><span>Fecha baja:</span> <?php echo $colab['fechabaja']; ?></td>
                    <?php 
                        }
                    ?>
                    <td></td>
                </tr>
            </table>
        </div>
    </div>
</div>