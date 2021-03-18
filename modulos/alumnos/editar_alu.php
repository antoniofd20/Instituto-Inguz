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

    $titulo = 'Editar alumno';
    require '../../plantillas/nav_side.view.php';
    # require 'plantillas/nav_forms.php';

?>

<div class="cont">
    <h1 class="title">Editar datos del alumno</h1>

    <!-- INICIAMOS CONTENEDOR PARA LA TABLA DEL FORMULARIO -->
    <div class="main-container">
        <form action="#" method="post">
          <div class="tabla-scroll-container-ver">
            <table class="tabla-consulta-modal-form">

                <!-- IMPORTANTE
                     INGRESAR A LA BASE DE DATOS AUTOMATICO VARIAS FECHAS
                -->

                <tr>
                    <th colspan="4" style="border-bottom: 1px solid grey; border-top: 1px solid grey; background: rgb(179, 200, 228);">Informacion Academica</th>
                </tr>
                <tr>
                    <th colspan="1">
                        <label for="clave" class="label">Matricula:</label>
                    </th>
                    <td colspan="1">
                        <input type="number" value='0001' name="clave" id="clave" class="input matricula" title="Matricula del nuevo alumno" readonly>
                    </td>
                    <th colspan="1">
                        <label for="estado" class="label" class="input">Estado:</label>
                    </th>
                    <td colspan="1">
                        <select name="estado" id="estado" class="select" title="Seleccione el estado del nuevo alumno">
                            <option value="ACTIVO">ACTIVO</option>
                            <option value="INACTIVO">INACTIVO</option>
                            <option value="">ACTIVO</option>
                        </select>
                    </td>
                </tr>

                <!-- INFORMACION ACADEMICA -->
                <tr>
                    <th>
                        <label for="especialidad" class="label">Especialidad:</label>
                    </th>
                    <td>
                        <select name="especialidad" id="especialidad" class="select" title="Seleccione la especialidad del alumno">
                            <option value="ACTIVO">CIENCIAS</option>
                            <option value="INACTIVO">SOCIALES</option>
                            <option value="">INGLES</option>
                        </select>
                    </td>
                    <th>
                        <label for="grupo" class="label">Grupo:</label>
                    </th>
                    <td>
                        <input value="1001" type="number" class="input matricula" name="grupo" placeholder="6453..." id="grupo">
                    </td>
                </tr>

                <tr>
                    <th>
                        <label for="asesor" class="label">Asesor:</label>
                    </th>
                    <td>
                        <input value="Juan Manuel Carreon" type="text" class="input" name="asesor">
                    </td>
                    <td colspan="2"></td>
                </tr>
                <!-- INFORMACION PERSONAL -->
                <tr>
                    <th colspan="4" style="border-bottom: 1px solid grey; border-top: 1px solid grey; background: rgb(179, 200, 228);">Datos Personales</th>
                </tr>
                <tr>
                    <th>
                        <label for="nombre" class="label">Nombre(s):</label>
                    </th>
                    <td>
                        <input value="Raymundo Antonio" type="text" class="input" name="nombre" id="nombre" title="Ingrese el nombre del alumno">
                    </td>
                    <th>
                        <label for="ap_paterno" class="label">Apellido paterno:</label>
                    </th>
                    <td>
                        <input value="Flores" type="text" class="input" name="ap_paterno" id="ap_paterno" title="Ingrese el apellido paterno">
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="ap_materno" class="label">Apellido materno:</label>
                    </th>
                    <td>
                        <input value="Diaz" type="text" class="input" name="ap_materno" id="ap_materno" title="Ingrese el apellido materno">
                    </td>
                    <th>
                        <label for="curp" class="label">Curp:</label>
                    </th>
                    <td>
                        <input value="FODR990920HDFLZY04" type="text" class="input" name="curp" id="curp" title="Ingrese el curp del alumno">
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="fecha_nac" class="label">Fecha de nacimiento:</label>
                    </th>
                    <td>
                        <input type="date" class="input" name="fecha_nac" id="fecha_nac" title="Ingrese la fecha de nacimiento">
                    </td>
                    <th>
                        <label for="edad" class="label">Edad:</label>
                    </th>
                    <td>
                        <input value="21" type="number" class="input matricula" name="edad" id="edad" title="Ingrese la edad del alumno">
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="sexo" class="label">Sexo:</label>
                    </th>
                    <td>
                        <select name="sexo" id="sexo" class="select" title="Ingrese el sexo del alumno">
                            <option value="FEMENINO">FEMENINO</option>
                            <option value="MASCULINO" selected>MASCULINO</option>
                        </select>
                    </td>
                    <td></td>
                    <td></td>
                </tr>
                <!-- CONTACTO -->
                <tr>
                    <th colspan="4" style="border-bottom: 1px solid grey; border-top: 1px solid grey; background: rgb(179, 200, 228);">Contacto</th>
                </tr>
                <tr>
                    <th>
                        <label for="telefono" class="label">Teléfono:</label>
                    </th>
                    <td>
                        <input value="5540713097" type="number" class="input" id="telefono" title="Ingrese el telefono" name="telefono">
                    </td>
                    <th>
                        <label for="celular" class="label">Celular:</label>
                    </th>
                    <td>
                        <input value="5540713097" type="number" class="input" id="celular" title="Ingrese el celular" name="celular">
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="recados" class="label">Recados:</label>
                    </th>
                    <td>
                        <input value="5540713097" type="number" class="input" id="recados" title="Ingrese un numero para recados" name="recados">
                    </td>
                    <th>
                        <label for="email" class="label">Correo eléctronico:</label>
                    </th>
                    <td>
                        <input value="antonioflodiaz@gmail.com" type="email" class="input" id="email" title="Ingrese correo electronico" name="email">
                    </td>
                </tr>
                <!-- DOMICILIO -->
                <tr>
                    <th colspan="4" style="border-bottom: 1px solid grey; border-top: 1px solid grey; background: rgb(179, 200, 228);">Domicilio</th>
                </tr>
                <tr>
                    <th>
                        <label for="calle_num" class="label">Calle y número:</label>
                    </th>
                    <td>
                        <input value="Calle 15 #123" type="text" class="input" id="calle_num" title="Ingrese la calle y numero" name="calle_num">
                    </td>
                    <th>
                        <label for="colonia" class="label">Colonia:</label>
                    </th>
                    <td>
                        <input value="Campestre Guadalupana" type="text" class="input" id="colonia" title="Ingrese la colonia" name="colonia">
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="alc_mun" class="label">Municipio, Alcaldia:</label>
                    </th>
                    <td>
                        <input value="Nezahualcoyotl" type="text" class="input" id="alc_mun" title="Ingrese su alcaldia o municipio" name="alc_mun">
                    </td>
                    <th>
                        <label for="estado_r" class="label">Estado:</label>
                    </th>
                    <td>
                        <input value="Mexico" type="text" class="input" id="estado_r" title="Ingrese el estado al que pertenece"  name="estado_r">
                   </td>
                </tr>
                <tr>
                    <th>
                        <label for="cp" class="label">Código Postal:</label>
                    </th>
                    <td>
                        <input value="57120" type="number" class="input" id="cp" title="Ingrese su codigo postal"  name="cp">
                   </td>
                    <td></td>
                    <td></td>
                </tr>
                <!-- DOCUMENTOS ENTREGADOS -->
                <tr>
                    <th colspan="4" style="border-bottom: 1px solid grey; border-top: 1px solid grey; background: rgb(179, 200, 228);">Documentos Entregados</th>
                </tr>
                <tr>
                    <th>
                        <label for="acta">Acta de nacimiento:</label>
                    </th>
                    <td>
                        <input type="checkbox" name="acta" id="acta" title="Acta de nacimiento" checked>
                    </td>
                    <th>
                        <label for="curp_checkbox">Curp:</label>
                    </th>
                    <td>
                        <input type="checkbox" name="curp_checkbox" id="curp_checkbox" title="Curp" checked>
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="certificado" class="checkbox">Certificado de Secundaria:</label>
                    </th>
                    <td>
                        <input type="checkbox" name="certificado" id="certificado" title="Certificado">
                    </td>
                    <th>
                        <label for="ine" class="checkbox">INE:</label>
                    </th>
                    <td>
                        <input type="checkbox" name="ine" id="ine" title="INE" checked>
                    </td>
                </tr>
            </table>
          </div>
          <input type="submit" value="Registrar alumno" class="submit">
        </form>
    </div>
</div>


<!-- VERSION PASADA
<div class="container">
        <h1 class="titulo">Registro Nuevo Alumno</h1>

        <form action="alumnos.php" method="POST" class="formulario">

            <div class="form-group-blue">
                <div class="form-col-3">
                    <label for="clave" class="label">Matricula:</label>
                    <input type="number" value='0001' name="clave" class="input matricula" readonly>
                </div>

                <div class="form-col-3">
                    <label for="estado" class="label" class="input">Estado:</label>
                    <select name="estado" id="" class="select">
                        <option value="ACTIVO">ACTIVO</option>
                        <option value="INACTIVO">INACTIVO</option>
                        <option value="">ACTIVO</option>
                    </select>
                </div>
            </div>

            <h1 class="titulo">Información Académica</h1>

            <div class="form-group">
                <div class="form-col-3">
                    <label for="especialidad" class="label">Especialidad:</label>
                    <select name="especialidad" id="" class="select">
                        <option value="ACTIVO">CIENCIAS</option>
                        <option value="INACTIVO">SOCIALES</option>
                        <option value="">INGLES</option>
                    </select>
                </div>

                <div class="form-col-3">
                    <label for="grupo" class="label">Grupo:</label>
                    <input type="number" class="input matricula" name="grupo" placeholder="6453...">
                </div>

                <div class="form-col-3">
                    <label for="fecha" class="label">Fecha:</label>
                    <input type="date" class="input" name="fecha">
                </div>

            </div>
            
            <div class="form-group-blue">
                <div class="form-col-3">
                    <label for="asesor" class="label">Asesor:</label>
                    <input type="text" class="input" name="asesor">
                </div>

                <div class="form-col-3">
                    <label for="fecha_inicio" class="label">Fecha inicio:</label>
                    <input type="date" class="input" name="fecha_inicio">
                </div>
            </div>

            <h1 class="titulo">Datos Personales</h1>

            <div class="form-group-blue">
                <div class="form-col-3">
                    <label for="curp" class="label">Curp:</label>
                    <input type="text" class="input" name="curp">
                </div>

                <div class="form-col-3">
                    <label for="fecha_nac" class="label">Fecha de nacimiento:</label>
                    <input type="date" class="input" name="fecha_nac">
                </div>

                <div class="form-col-3">
                    <label for="edad" class="label">Edad:</label>
                    <input type="number" class="input matricula" name="edad">
                </div>
            </div>

            <div class="form-group">
                <div class="form-col-3">
                    <label for="nombre" class="label">Nombre(s):</label>
                    <input type="text" class="input" name="nombre">
                </div>

                <div class="form-col-3">
                    <label for="ap_paterno" class="label">Apellido paterno:</label>
                    <input type="text" class="input" name="ap_paterno">
                </div>

                <div class="form-col-3">
                    <label for="ap_materno" class="label">Apellido materno:</label>
                    <input type="text" class="input" name="ap_materno">
                </div>
            </div>

            <div class="form-group-blue">
                <div class="form-col-3">
                    <label for="sexo" class="label">Sexo:</label>
                    <select name="sexo" id="" class="select">
                        <option value="FEMENINO">FEMENINO</option>
                        <option value="MASCULINO">MASCULINO</option>
                    </select>
                </div>
            </div>

            <h1 class="titulo">Contacto</h1>

            <div class="form-group-blue">
                <div class="form-col-3">
                    <label for="telefono" class="label">Teléfono:</label>
                    <input type="number" class="input" name="telefono">
                </div>

                <div class="form-col-3">
                    <label for="celular" class="label">Celular:</label>
                    <input type="number" class="input " name="celular">
                </div>

                <div class="form-col-3">
                    <label for="recados" class="label">Recados:</label>
                    <input type="number" class="input " name="recados">
                </div>
            </div>

            <div class="form-group">
                <div class="form-col-3">
                    <label for="email" class="label">Correo eléctronico:</label>
                    <input type="email" class="input" name="email">
                </div>
            </div>

            <h1 class="titulo">Domicilio</h1>

            <div class="form-group-blue">
                <div class="form-col-2">
                    <label for="calle_num" class="label">Calle y número:</label>
                    <input type="text" class="input largo" name="calle_num">
                </div>

                <div class="form-col-2">
                    <label for="colonia" class="label">Colonia:</label>
                    <input type="text" class="input largo" name="colonia">
                </div>
            </div>

            <div class="form-group">
                <div class="form-col-3">
                    <label for="alc_mun" class="label">Municipio, Alcaldia:</label>
                    <input type="text" class="input" name="alc_mun">
                </div>

                <div class="form-col-3">
                    <label for="estdo" class="label">Estado:</label>
                    <input type="text" class="input" name="estado">
                </div>

                <div class="form-col-3">
                    <label for="cp" class="label">Código Postal:</label>
                    <input type="number" class="input" name="cp">
                </div>
            </div>

            <h1 class="titulo">Documentos Entregados</h1>

            <div class="form-group">
                <div class="form-col-4" class="checkbox">
                    <label for="acta">Acta de nacimiento:</label>
                    <input type="checkbox" name="acta">
                </div>
            </div>
            <div class="form-group">
                <div class="form-col-4" class="checkbox">
                    <label for="curp">Curp:</label>
                    <input type="checkbox" name="curp">
                </div>
            </div>
            <div class="form-group">
                <div class="form-col-4">
                    <label for="certificado" class="checkbox">Certificado de Secundaria:</label>
                    <input type="checkbox" name="certificado">
                </div>
            </div>
            <div class="form-group final">
                <div class="form-col-4">
                    <label for="ine" class="checkbox">INE:</label>
                    <input type="checkbox" name="ine">
                </div>

                <div class="form-col-4">
                    <input type="submit" class="submit" value="Registrar Alumno">
                </div>
            </div>

        </form>
    </div>

</body>
</html>
-->

