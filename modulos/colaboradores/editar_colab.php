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

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $id = $_POST['id'];
        ## // DATOS PERSONALES
        $nombre = mb_strtoupper(trim(filter_var($_POST['nombre'], FILTER_SANITIZE_STRING)));
        $ap_paterno = mb_strtoupper(trim(filter_var($_POST['ap_paterno'], FILTER_SANITIZE_STRING)));
        $ap_materno = mb_strtoupper(trim(filter_var($_POST['ap_materno'], FILTER_SANITIZE_STRING)));
        $curp = mb_strtoupper(trim(filter_var($_POST['curp'], FILTER_SANITIZE_STRING)));
        $fecha_nac = $_POST['fecha_nac'];
        $edad = $_POST['edad'];
        $sexo = $_POST['sexo'];

        ## // CONTACTO
        $telefono = $_POST['telefono'];
        $celular = $_POST['celular'];
        $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));

        ## // DOMICILIO 
        $calle_num = mb_strtoupper(trim(filter_var($_POST['calle_num'], FILTER_SANITIZE_STRING)));
        $colonia = mb_strtoupper(trim(filter_var($_POST['colonia'], FILTER_SANITIZE_STRING)));
        $alc_mun = mb_strtoupper(trim(filter_var($_POST['alc_mun'], FILTER_SANITIZE_STRING)));
        $estado_r = mb_strtoupper(trim(filter_var($_POST['estado_r'], FILTER_SANITIZE_STRING)));
        $cp = $_POST['cp'];

        ## // INFORMACION ACADEMICA
        $area = mb_strtoupper(trim(filter_var($_POST['area'], FILTER_SANITIZE_STRING)));
        $profesion = mb_strtoupper(trim(filter_var($_POST['profesion'], FILTER_SANITIZE_STRING)));
        $fecha_alta = $_POST['fecha_alta'];
        $fecha_baja = $_POST['fecha_baja'];

        ## // OBTENER EL ULTIMO ID DE PERSONA 
        $query1 = $conexion->query(
            "SELECT idpersona FROM $db.tbpersona
            ORDER BY idpersona DESC"
        ) or die("Error al obtener a la ultima persona regsitrada " . mysqli_error($conexion));

        ## // OBTENER LA EDAD DE LA PERSONA
        $nacimiento = new DateTime($fecha_nac);
        $ahora = new DateTime(date("Y-m-d"));
        $diferencia = $ahora->diff($nacimiento);

        $edad = $diferencia->format("%y");


        ## // AGREGAR A LAS BASES DE DATOS
        try {
            $conexion->begin_transaction();

            ## // AGREGAMOS LOS DATOS EN LA TABLA PERSONA
            $statment1 = $conexion->prepare(
                "UPDATE $db.tbpersona SET
                nombre = ?, apaterno = ?, amaterno = ?, fechanac = ?, curp = ?,
                sexo = ?, edad = ?, telefono = ?, celular = ?, correoe = ?, 
                calleynum = ?, colonia = ?, municipio = ?, estado = ?, cpostal = ?
                WHERE idpersona = $id"
            )or die("Error al insertar persona " . mysqli_error($conexion));

            $statment1->bind_param("ssssssissssssss", $nombre, $ap_paterno, $ap_materno, $fecha_nac, $curp, $sexo, $edad, $telefono, $celular, $email, $calle_num, $colonia, $alc_mun, $estado_r, $cp);
            $statment1->execute();

            ## // AGREGAMOS LOS DATOS EN LA TABLA COLABORADOR
            $statment2 = $conexion->prepare(
                "UPDATE $db.tbcolaborador SET
                area = ?, profesion = ?, fechalta = ?, fechabaja = ?
                WHERE clavecolaborador = $id"
            )or die("Error al insertar colaborador " . mysqli_error($conexion));

            $statment2->bind_param("ssss", $area, $profesion, $fecha_alta, $fecha_baja);
            $statment2->execute();

            $conexion->commit();

            echo "<script language = javascript>
            alert('Datos del colaborador editados con exito.');
            window.location='list.php';
            </script>";

        } catch (Exception $e) {
            $conexion->rollback();

            #$errores .= 'No se pudo registrar el usuario, intente nuevamente';
            echo "<script language = javascript>
            alert('Ocurrio un error, intentar mas tarde.');
            window.location='list.php';
            </script>";
            die ("Error al realizar los registros correspondientes " . $e->getMessage());
        }
        $conexion->close();
    }

    $id = $_GET['id'];

    $query = $conexion->query(
        "SELECT * FROM tbpersona p
        JOIN tbcolaborador c ON (p.idpersona = c.persona)
        WHERE clavecolaborador = $id AND persona = $id"
    ) or die("Error al obtener los datos del colaborador " . mysqli_error($conexion));

    $colab = $query->fetch_assoc();

    $titulo = 'Editar colaborador';
    require '../../plantillas/nav_side.view.php';

?>

<div class="cont">
    <h1 class="title">Editar datos de colaborador</h1>

    <!-- INICIAMOS CONTENEDOR PARA LA TABLA DEL FORMULARIO -->
    <div class="main-container">
        <form action="editar_colab.php" method="post">
            <input type="number" value="<?php echo $colab['clavecolaborador'] ?>" name="id" hidden>
          <div class="tabla-scroll-container-ver">
            <table class="tabla-consulta-modal-form">

                <!-- IMPORTANTE
                     INGRESAR A LA BASE DE DATOS AUTOMATICO VARIAS FECHAS
                -->
                <!-- INFORMACION PERSONAL -->
                <tr>
                    <th colspan="4" style="border-bottom: 1px solid grey; border-top: 1px solid grey; background: rgb(179, 200, 228);">Datos Personales</th>
                </tr>
                <tr>
                    <th>
                        <label for="nombre" class="label">Nombre(s):</label>
                    </th>
                    <td>
                        <input value="<?php echo $colab['nombre'] ?>" type="text" class="input" name="nombre" id="nombre" title="Ingrese el nombre del profesor">
                    </td>
                    <th>
                        <label for="ap_paterno" class="label">Apellido paterno:</label>
                    </th>
                    <td>
                        <input value="<?php echo $colab['apaterno'] ?>" type="text" class="input" name="ap_paterno" id="ap_paterno" title="Ingrese el apellido paterno">
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="ap_materno" class="label">Apellido materno:</label>
                    </th>
                    <td>
                        <input value="<?php echo $colab['amaterno'] ?>" type="text" class="input" name="ap_materno" id="ap_materno" title="Ingrese el apellido materno">
                    </td>
                    <th>
                        <label for="curp" class="label">Curp:</label>
                    </th>
                    <td>
                        <input value="<?php echo $colab['curp'] ?>" type="text" class="input" name="curp" id="curp" title="Ingrese el curp del profesor">
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="fecha_nac" class="label">Fecha de nacimiento:</label>
                    </th>
                    <td>
                        <input type="date" class="input" name="fecha_nac" id="fecha_nac" title="Ingrese la fecha de nacimiento" value="<?php echo $colab['fechanac'] ?>">
                    </td>
                    <th>
                        <label for="sexo" class="label">Sexo:</label>
                    </th>
                    <td>
                        <select name="sexo" id="sexo" class="select" title="Ingrese el sexo del profesor">
                            <option value="<?php echo $colab['sexo'] ?>" selected><?php echo $colab['sexo'] ?></option>
                            <option value="FEMENINO">FEMENINO</option>
                            <option value="MASCULINO">MASCULINO</option>
                        </select>
                    </td>
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
                        <input value="<?php echo $colab['telefono'] ?>" type="number" class="input" id="telefono" title="Ingrese el telefono" name="telefono">
                    </td>
                    <th>
                        <label for="celular" class="label">Celular:</label>
                    </th>
                    <td>
                        <input value="<?php echo $colab['celular'] ?>" type="number" class="input" id="celular" title="Ingrese el celular" name="celular">
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="<?php echo $colab['correoe'] ?>" class="label">Correo eléctronico:</label>
                    </th>
                    <td>
                        <input value="antonioflodiaz@gmail.com" type="email" class="input" id="email" title="Ingrese correo electronico" name="email">
                    </td>
                    <td></td>
                    <td></td>
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
                        <input value="<?php echo $colab['calleynum'] ?>" type="text" class="input" id="calle_num" title="Ingrese la calle y numero" name="calle_num">
                    </td>
                    <th>
                        <label for="colonia" class="label">Colonia:</label>
                    </th>
                    <td>
                        <input value="<?php echo $colab['colonia'] ?>" type="text" class="input" id="colonia" title="Ingrese la colonia" name="colonia">
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="alc_mun" class="label">Municipio, Alcaldia:</label>
                    </th>
                    <td>
                        <input value="<?php echo $colab['municipio'] ?>" type="text" class="input" id="alc_mun" title="Ingrese su alcaldia o municipio" name="alc_mun">
                    </td>
                    <th>
                        <label for="estado_r" class="label">Estado:</label>
                    </th>
                    <td>
                        <input value="<?php echo $colab['estado'] ?>" type="text" class="input" id="estado_r" title="Ingrese el estado al que pertenece"  name="estado_r">
                   </td>
                </tr>
                <tr>
                    <th>
                        <label for="cp" class="label">Código Postal:</label>
                    </th>
                    <td>
                        <input value="<?php echo $colab['cpostal'] ?>" type="number" class="input" id="cp" title="Ingrese su codigo postal"  name="cp">
                   </td>
                    <td></td>
                    <td></td>
                </tr>



                <!-- INFORMACION DEL PUESTO -->
                <tr>
                    <th colspan="4" style="border-bottom: 1px solid grey; border-top: 1px solid grey; background: rgb(179, 200, 228);">Informacion Academica</th>
                </tr>
                <tr>
                    <th colspan="1">
                        <label for="area" class="label">Área:</label>
                    </th>
                    <td colspan="1">
                        <select name="area" id="area" title="Seleccione el area" class="select">
                            <option value="<?php echo $colab['area'] ?>"><?php echo $colab['area'] ?></option>
                            <option value="VENTAS">VENTAS</option>
                            <option value="RECEPCION">RECEPCION</option>
                        </select>
                    </td>
                    <th colspan="1">
                        <label for="profesion" class="label">Profesion:</label>
                    </th>
                    <td colspan="1">
                        <input value="<?php echo $colab['profesion'] ?>" type="text" class="input" name="profesion" id="profesion" title="Ingrese profesion del colaborador">
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="fecha_alta" class="label">Fecha de Alta:</label>
                    </th>
                    <td>
                        <input value="<?php echo $colab['fechalta'] ?>" type="date" name="fecha_alta" class="input">
                    </td>
                    <th>
                        <label for="fecha_baja" class="label">Fecha de Baja:</label>
                    </th>
                    <td>
                    <input value="<?php echo $colab['fechabaja'] ?>" type="date" name="fecha_baja" class="input">
                    </td>
                </tr>
            </table>
          </div>
          <input type="submit" value="Registrar colaborador" class="submit">
        </form>
    </div>
</div>