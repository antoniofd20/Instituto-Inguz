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
    
    require '../../plantillas/nav_side.view.php';

?>

<div class="cont">
        <h1 class="title" >Consulta alumnos</h1>

            <!-- CONTENEDOR PARA LOS ICONOS -->
            <div class="flex">
                <!-- AGREGAR UN NUEVO REGISTRO -->
                <div class="agregar">
                    <a href="form_alu.php">
                        <i class="icono-flex agregar-icono fa fa-plus-circle fa-3x"></i>
                    </a>
                </div>

                <!-- EXPORTAR A ALGUN TIPO DE DOCUMENTO -->
                <div class="exportar">
                    <a href="archivo/pdf/alumnosPDF.php"  target="blank">
                        <i class="icono-flex pdf fa fa-file-pdf-o" aria-hidden="true"></i>
                    </a>
                    <a href="archivo/excel/alumnosEXCEL.php">
                        <i class="icono-flex excel fa fa-file-excel-o" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
<!--TABLA PARA CONSULTA-->
<table class="tabla-consulta-modal">
    <caption>Buscar alumnos</caption>
    <form action="#" method="post">
      <tr>
          <th colspan="1"><label for="nombre">Nombre:</label></th>
          <td colspan="3">
              <input type="text" name="nombre" id="nombre" class="form-control" title="Ingrese un nombre para buscar" placeholder="Nombre o apellidos">
          </td>
      </tr>
      <tr>
          <th><label for="especialidad">Especialidad:</label></th>
          <td>
            <select name="especialidad" id="especialidad">
                <option value="CIENCIAS">CIENCIAS</option>
                <option value="SOCIALES">SOCIALES</option>
                <option value="INGLES">INGLES</option>
            </select>
          </td>
          <th><label for="estado">Estado:</label></th>
          <td>
            <select name="estado" id="estado">
                <option value="ACTIVO">ACTIVO</option>
                <option value="BAJA">BAJA</option>
            </select>
          </td>
      </tr>
    </form>
</table>   
        <div class="main-container">
            <div class="tabla-scroll-container">

                <table class="tabla-scroll">
                    <colgroup>
                        <!-- CLAVE -->
                        <col style="width: 5%; min-width: 5%">
                        <!-- NOMBRE -->
                        <col style="width: 30%; min-width: 30%">
                        <!-- ESPECIALIDAD -->
                        <col style="width: 10%; min-width: 10%">
                        <!-- ESTADO -->
                        <col style="width: 10%; min-width: 10%">
                        <!-- TELEFONO -->
                        <col style="width: 10%; min-width: 10%">
                        <!-- ASESOR -->
                        <col style="width: 30%; min-width: 30%">
                        <!-- ACCIONES -->
                        <col style="width: 10%; min-width: 10%">
                    </colgroup>
                    <thead>
                        <th>CLAVE</th>
                        <th>NOMBRE</th>
                        <th>ESPECIALIDAD</th>
                        <th>ESTADO</th>
                        <th>TELEFONO</th>
                        <th>ASESOR</th>
                        <th>ACCIONES</th>
                    </thead>

                    <tr>
                        <td>0000</td>
                        <td class="izquierda">RAYMUNDO ANTONIO FLORES DIAZ</td>
                        <td>SOCIALES</td>
                        <td>ACTIVO</td>
                        <td>5540713797</td>
                        <td class="izquierda">ITZEL TOLEDO ALVAREZ</td>
                        <td class="ico-group">
                            <a style="color: black" class="ico-accion" title="Ver alumno" href="alu_info.php">
                                <i class="fa fa-eye ico-consulta" aria-hidden="true"></i>
                            </a>
                            <a style="color: black" class="ico-accion" title="Edita alumno" href="editar_alu.php">
                                <i class="fa fa-pencil ico-editar" aria-hidden="true"></i>
                            </a>
                            <a style="color: black" class="ico-accion" title="Elimina usuario" href="#">
                                <i class="fa fa-history ico-eliminar" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>

                    <tr>
                        <td>0001</td>
                        <td class="izquierda">CESAR ALEJANDRO BONILLA JARAMILLO</td>
                        <td>SOCIALES</td>
                        <td>ACTIVO</td>
                        <td>5540713797</td>
                        <td class="izquierda">MOISES CRUZ ESPINOZA</td>
                        <td class="ico-group">
                        <a style="color: black" class="ico-accion" title="Ver alumno" href="alu_info.php">
                                <i class="fa fa-eye ico-consulta" aria-hidden="true"></i>
                            </a>
                            <a style="color: black" class="ico-accion" title="Edita alumno" href="editar_alu.php">
                                <i class="fa fa-pencil ico-editar" aria-hidden="true"></i>
                            </a>
                            <a style="color: black" class="ico-accion" title="Elimina usuario" href="#">
                                <i class="fa fa-history ico-eliminar" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>

                    <tr>
                        <td>0002</td>
                        <td class="izquierda">BEATRIZ DIAZ RODRIGUEZ</td>
                        <td>CIENCIAS</td>
                        <td>ACTIVO</td>
                        <td>5540713797</td>
                        <td class="izquierda">JESUS EDUARDO SALDIVAR</td>
                        <td class="ico-group">
                        <a style="color: black" class="ico-accion" title="Ver alumno" href="alu_info.php">
                                <i class="fa fa-eye ico-consulta" aria-hidden="true"></i>
                            </a>
                            <a style="color: black" class="ico-accion" title="Edita alumno" href="editar_alu.php">
                                <i class="fa fa-pencil ico-editar" aria-hidden="true"></i>
                            </a>
                            <a style="color: black" class="ico-accion" title="Elimina usuario" href="#">
                                <i class="fa fa-history ico-eliminar" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>

                    <tr>
                        <td>0003</td>
                        <td class="izquierda">ALDO GALLEGOS GALLEGOS</td>
                        <td>CIENCIAS</td>
                        <td>ACTIVO</td>
                        <td>5540713797</td>
                        <td class="izquierda">OMAR MENDOZA</td>
                        <td class="ico-group">
                        <a style="color: black" class="ico-accion" title="Ver alumno" href="alu_info.php">
                                <i class="fa fa-eye ico-consulta" aria-hidden="true"></i>
                            </a>
                            <a style="color: black" class="ico-accion" title="Edita alumno" href="editar_alu.php">
                                <i class="fa fa-pencil ico-editar" aria-hidden="true"></i>
                            </a>
                            <a style="color: black" class="ico-accion" title="Elimina usuario" href="#">
                                <i class="fa fa-history ico-eliminar" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>

                    <tr>
                        <td>0004</td>
                        <td class="izquierda">JONATAN ROMERO OJEDA</td>
                        <td>SOCIALES</td>
                        <td>ACTIVO</td>
                        <td>5540713797</td>
                        <td class="izquierda">RICARDO IVAN LOMBARDINI</td>
                        <td class="ico-group">
                        <a style="color: black" class="ico-accion" title="Ver alumno" href="alu_info.php">
                                <i class="fa fa-eye ico-consulta" aria-hidden="true"></i>
                            </a>
                            <a style="color: black" class="ico-accion" title="Edita alumno" href="editar_alu.php">
                                <i class="fa fa-pencil ico-editar" aria-hidden="true"></i>
                            </a>
                            <a style="color: black" class="ico-accion" title="Elimina usuario" href="#">
                                <i class="fa fa-history ico-eliminar" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>

                    <tr>
                        <td>0005</td>
                        <td class="izquierda">SALVADOR ALEJANDRO PEREDO MENDEZ</td>
                        <td>INGLES</td>
                        <td>ACTIVO</td>
                        <td>5540713797</td>
                        <td class="izquierda">FRANCO JOSUE</td>
                        <td class="ico-group">
                        <a style="color: black" class="ico-accion" title="Ver alumno" href="alu_info.php">
                                <i class="fa fa-eye ico-consulta" aria-hidden="true"></i>
                            </a>
                            <a style="color: black" class="ico-accion" title="Edita alumno" href="editar_alu.php">
                                <i class="fa fa-pencil ico-editar" aria-hidden="true"></i>
                            </a>
                            <a style="color: black" class="ico-accion" title="Elimina usuario" href="#">
                                <i class="fa fa-history ico-eliminar" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>0005</td>
                        <td class="izquierda">SALVADOR ALEJANDRO PEREDO MENDEZ</td>
                        <td>INGLES</td>
                        <td>ACTIVO</td>
                        <td>5540713797</td>
                        <td class="izquierda">FRANCO JOSUE</td>
                        <td class="ico-group">
                        <a style="color: black" class="ico-accion" title="Ver alumno" href="alu_info.php">
                                <i class="fa fa-eye ico-consulta" aria-hidden="true"></i>
                            </a>
                            <a style="color: black" class="ico-accion" title="Edita alumno" href="editar_alu.php">
                                <i class="fa fa-pencil ico-editar" aria-hidden="true"></i>
                            </a>
                            <a style="color: black" class="ico-accion" title="Elimina usuario" href="#">
                                <i class="fa fa-history ico-eliminar" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>0005</td>
                        <td class="izquierda">SALVADOR ALEJANDRO PEREDO MENDEZ</td>
                        <td>INGLES</td>
                        <td>ACTIVO</td>
                        <td>5540713797</td>
                        <td class="izquierda">FRANCO JOSUE</td>
                        <td class="ico-group">
                        <a style="color: black" class="ico-accion" title="Ver alumno" href="alu_info.php">
                                <i class="fa fa-eye ico-consulta" aria-hidden="true"></i>
                            </a>
                            <a style="color: black" class="ico-accion" title="Edita alumno" href="editar_alu.php">
                                <i class="fa fa-pencil ico-editar" aria-hidden="true"></i>
                            </a>
                            <a style="color: black" class="ico-accion" title="Elimina usuario" href="#">
                                <i class="fa fa-history ico-eliminar" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>0005</td>
                        <td class="izquierda">SALVADOR ALEJANDRO PEREDO MENDEZ</td>
                        <td>INGLES</td>
                        <td>ACTIVO</td>
                        <td>5540713797</td>
                        <td class="izquierda">FRANCO JOSUE</td>
                        <td class="ico-group">
                        <a style="color: black" class="ico-accion" title="Ver alumno" href="alu_info.php">
                                <i class="fa fa-eye ico-consulta" aria-hidden="true"></i>
                            </a>
                            <a style="color: black" class="ico-accion" title="Edita alumno" href="editar_alu.php">
                                <i class="fa fa-pencil ico-editar" aria-hidden="true"></i>
                            </a>
                            <a style="color: black" class="ico-accion" title="Elimina usuario" href="#">
                                <i class="fa fa-history ico-eliminar" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>