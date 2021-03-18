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

    $titulo = 'Consultar alumno';

    require '../../plantillas/nav_side.view.php';

?>

<div class="cont">
    <h1 class="title">Informacion del alumno: Raymundo</h1>

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
                <!-- DATOS ACADEMICOS DEL ALUMNO -->
                <tr>
                    <th colspan="3">Datos academicos</th>
                </tr>
                <tr>
                    <td><span>Matricula:</span> 0001</td>
                    <td><span>Estado:</span> ACTIVO</td>
                    <td></td>
                </tr>
                <tr>
                    <td><span>Especialidad:</span> CIENCIAS</td>
                    <td><span>Grupo:</span> 1001</td>
                    <td><span>Fecha Registro:</span> 10/02/2020</td>
                </tr>
                <tr>
                    <td><span>Asesor:</span> Juan Manuel Carreon</td>
                    <td><span>Fecha Inicio:</span> 01/01/2020</td>
                    <td><span>Fecha Termino:</span> 01/04/2020</td>
                </tr>
                <tr>
                    <th colspan="3">Datos personales</th>
                </tr>
                <tr>
                    <td><span>Nombre:</span> Raymundo Antonio</td>
                    <td><span>Apellido Paterno:</span> Flores</td>
                    <td><span>Apellido Materno:</span> Diaz</td>
                </tr>
                <tr>
                    <td><span>Curp:</span> FODR990920HDFLZY04</td>
                    <td><span>Fecha Nacimiento:</span> 20/09/1999</td>
                    <td><span>Fecha Edad:</span> 21</td>
                </tr>
                <tr>
                    <td><span>Sexo:</span> MASCULINO</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <th colspan="3">Contacto</th>
                </tr>
                <tr>
                    <td><span>Telefono:</span> 5540713097</td>
                    <td><span>Celular:</span> 5540713097</td>
                    <td><span>Recados:</span> 5540713097</td>
                </tr>
                <tr>
                    <td><span>Email:</span> antonioflodiaz@gmail.com</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <th colspan="3">Domicilio</th>
                </tr>
                <tr>
                    <td><span>Calle y Numero:</span> Calle 15 #123</td>
                    <td><span>Colonia:</span> Campestre Guadalupana</td>
                    <td><span>Municipio/Alcaldia:</span> Nezahualcoyotl</td>
                </tr>
                <tr>
                    <td><span>Estado:</span> Mexico</td>
                    <td><span>Codigo Postal:</span> 57120</td>
                    <td></td>
                </tr>
                <tr>
                    <th colspan="3">Documentos Entregados</th>
                </tr>
                <tr>
                    <td><span>Acta de Nacimiento:</span></td>
                    <td>Si</td>
                    <td></td>
                </tr>
                <tr>
                    <td><span>Curp:</span></td>
                    <td>No</td>
                    <td></td>
                </tr>
                <tr>
                    <td><span>Certificado de Secundaria: </span></td>
                    <td>Si</td>
                    <td></td>
                </tr>
                <tr>
                    <td><span>INE:</span></td>
                    <td>Si</td>
                    <td></td>
                </tr>
            </table>
        </div>
    </div>
</div>