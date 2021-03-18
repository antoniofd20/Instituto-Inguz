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

    # |-------------------------------------------------------|
    # |     REGISTRAR LOS DATOS DEL PROFESOR SELECCIONADO     |
    # |-------------------------------------------------------|
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $id = $_POST['id'];
        ## // DATOS PERSONALES
        $nombre = mb_strtoupper(trim(filter_var($_POST['nombre'], FILTER_SANITIZE_STRING)));
        $ap_paterno = mb_strtoupper(trim(filter_var($_POST['ap_paterno'], FILTER_SANITIZE_STRING)));
        $ap_materno = mb_strtoupper(trim(filter_var($_POST['ap_materno'], FILTER_SANITIZE_STRING)));
        $curp = mb_strtoupper(trim(filter_var($_POST['curp'], FILTER_SANITIZE_STRING)));
        $fecha_nac = $_POST['fecha_nac'];
        $edad;
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
        $profesion = mb_strtoupper(trim(filter_var($_POST['profesion'], FILTER_SANITIZE_STRING)));
        $especialidad = mb_strtoupper(trim(filter_var($_POST['especialidad'], FILTER_SANITIZE_STRING)));
        $fecha_alta = $_POST['fecha_alta'];
        $fecha_baja = $_POST['fecha_baja'];

        #var_dump($_POST);

        ## // OBTENER LA EDAD DE LA PERSONA
        $nacimiento = new DateTime($fecha_nac);
        $ahora = new DateTime(date("Y-m-d"));
        $diferencia = $ahora->diff($nacimiento);

        $edad = $diferencia->format("%y");

        #echo $edad . $siguiente;


        ## // AGREGAR A LAS BASES DE DATOS
        try {
            $conexion->begin_transaction();

            ## // AGREGAMOS LOS DATOS EN LA TABLA PERSONA
            $statment1 = $conexion->prepare(
                "UPDATE $db.tbpersona SET
                nombre = ?, apaterno = ?, amaterno = ?, fechanac = ?, curp = ?, 
                sexo = ?, edad = ?, telefono = ?, celular = ?, correoe = ?, calleynum = ?, 
                colonia = ?, municipio = ?, estado = ?, cpostal = ?
                WHERE idpersona = '$id'"
            )or die("Error al editar los datos de la persona " . mysqli_error($conexion));

            $statment1->bind_param("ssssssissssssss", $nombre, $ap_paterno, $ap_materno, $fecha_nac, $curp, $sexo, $edad, $telefono, $celular, $email, $calle_num, $colonia, $alc_mun, $estado_r, $cp);
            $statment1->execute();

            ## // AGREGAMOS LOS DATOS EN LA TABLA COLABORADOR
            $statment2 = $conexion->prepare(
                "UPDATE $db.tbprofesor SET
                profesion = ?, especialidad = ?, fechalta = ?, fechabaja = ?
                WHERE claveprofesor = '$id'"
            )or die("Error al insertar profesor " . mysqli_error($conexion));

            $statment2->bind_param("ssss", $profesion, $especialidad, $fecha_alta, $fecha_baja);
            $statment2->execute();
                
            #echo 'Profesor registrado';
            echo "<script language = javascript>
            alert('Datos del profesor editados con exito.');
            window.location='list.php';
            </script>";

            $conexion->commit();

            
            #header('Location: list.php');

        } catch (Exception $e) {
            $conexion->rollback();

            #$errores .= 'No se pudo registrar el usuario, intente nuevamente';
            echo "<script language = javascript>
            alert('Ocurrio un error al intentar editar los datos del profesor, favor de intentarlo mas tarde.');
            window.location='list.php';
            </script>";
            die ("Error al realizar los registros correspondientes " . $e->getMessage());
        }
        $conexion->close();
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

    $titulo = 'Editar profesor';
    require '../../plantillas/nav_side.view.php';
?>


<div class="cont">
    <h1 class="title">Editar datos de profesor</h1>

    <!-- INICIAMOS CONTENEDOR PARA LA TABLA DEL FORMULARIO -->
    <div class="main-container">
        <form action="editar_prof.php" method="post">
        <input type="number" value="<?php echo $prof['claveprofesor'] ?>" name="id" hidden>
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
                        <input value="<?php echo $prof['nombre']; ?>" type="text" class="input" name="nombre" id="nombre" title="Ingrese el nombre del profesor">
                    </td>
                    <th>
                        <label for="ap_paterno" class="label">Apellido paterno:</label>
                    </th>
                    <td>
                        <input value="<?php echo $prof['apaterno']; ?>" type="text" class="input" name="ap_paterno" id="ap_paterno" title="Ingrese el apellido paterno">
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="ap_materno" class="label">Apellido materno:</label>
                    </th>
                    <td>
                        <input value="<?php echo $prof['amaterno']; ?>" type="text" class="input" name="ap_materno" id="ap_materno" title="Ingrese el apellido materno">
                    </td>
                    <th>
                        <label for="curp" class="label">Curp:</label>
                    </th>
                    <td>
                        <input value="<?php echo $prof['curp']; ?>" type="text" class="input" name="curp" id="curp" title="Ingrese el curp del profesor">
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="fecha_nac" class="label">Fecha de nacimiento:</label>
                    </th>
                    <td>
                        <input value="<?php echo $prof['fechanac']; ?>" type="date" class="input" name="fecha_nac" id="fecha_nac" title="Ingrese la fecha de nacimiento">
                    </td>
                    <th>
                        <label for="sexo" class="label">Sexo:</label>
                    </th>
                    <td>
                        <select name="sexo" id="sexo" class="select" title="Ingrese el sexo del profesor">
                            <option value="<?php echo $prof['sexo']; ?>" selected><?php echo $prof['sexo']; ?></option>
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
                        <input value="<?php echo $prof['telefono']; ?>" type="number" class="input" id="telefono" title="Ingrese el telefono" name="telefono">
                    </td>
                    <th>
                        <label for="celular" class="label">Celular:</label>
                    </th>
                    <td>
                        <input value="<?php echo $prof['celular']; ?>" type="number" class="input" id="celular" title="Ingrese el celular" name="celular">
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="email" class="label">Correo eléctronico:</label>
                    </th>
                    <td>
                        <input value="<?php echo $prof['correoe']; ?>" type="email" class="input" id="email" title="Ingrese correo electronico" name="email">
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
                        <input value="<?php echo $prof['calleynum']; ?>" type="text" class="input" id="calle_num" title="Ingrese la calle y numero" name="calle_num">
                    </td>
                    <th>
                        <label for="colonia" class="label">Colonia:</label>
                    </th>
                    <td>
                        <input value="<?php echo $prof['colonia']; ?>" type="text" class="input" id="colonia" title="Ingrese la colonia" name="colonia">
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="alc_mun" class="label">Municipio, Alcaldia:</label>
                    </th>
                    <td>
                        <input value="<?php echo $prof['municipio']; ?>" type="text" class="input" id="alc_mun" title="Ingrese su alcaldia o municipio" name="alc_mun">
                    </td>
                    <th>
                        <label for="estado_r" class="label">Estado:</label>
                    </th>
                    <td>
                        <input value="<?php echo $prof['estado']; ?>" type="text" class="input" id="estado_r" title="Ingrese el estado al que pertenece"  name="estado_r">
                   </td>
                </tr>
                <tr>
                    <th>
                        <label for="cp" class="label">Código Postal:</label>
                    </th>
                    <td>
                        <input value="<?php echo $prof['cpostal']; ?>" type="number" class="input" id="cp" title="Ingrese su codigo postal"  name="cp">
                   </td>
                    <td></td>
                    <td></td>
                </tr>



                <!-- INFORMACION ACADEMICA -->
                <tr>
                    <th colspan="4" style="border-bottom: 1px solid grey; border-top: 1px solid grey; background: rgb(179, 200, 228);">Informacion Academica</th>
                </tr>
                <tr>
                    <th colspan="1">
                        <label for="profesion" class="label">Profesión:</label>
                    </th>
                    <td colspan="1">
                        <input value="<?php echo $prof['profesion']; ?>" type="text" class="input" name="profesion" id="profesion" title="Ingrese la profesion del profesor">
                    </td>
                    <th colspan="1">
                        <label for="especialidad" class="label">Especialidad:</label>
                    </th>

                    <?php 
                        if($prof['especialidad'] == 1){
                            $esp = 'CIENCIAS';
                        } else if($prof['especialidad'] == 2){
                            $esp = 'SOCIALES';
                        } else if($prof['especialidad'] == 3){
                            $esp = 'INGLES';
                        }
                    ?>


                    <td colspan="1">
                        <select name="especialidad" id="especialidad" class="select" title="Seleccione la especialidad del profesor">
                            <option value="<?php echo $prof['especialidad']; ?>" selected><?php echo $esp; ?></option>
                            <option value="1">CIENCIAS</option>
                            <option value="2">SOCIALES</option>
                            <option value="3">INGLES</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="fecha_alta" class="label">Fecha de Alta:</label>
                    </th>
                    <td>
                        <input value="<?php echo $prof['fechalta']; ?>" type="date" name="fecha_alta" class="input">
                    </td>
                    <th>
                        <label for="fecha_baja" class="label">Fecha de Baja:</label>
                    </th>
                    <td>
                    <input value="<?php echo $prof['fechabaja']; ?>" type="date" name="fecha_baja" class="input">
                    </td>
                </tr>
            </table>
          </div>
          <input type="submit" value="Registrar profesor" class="submit">
        </form>
    </div>
</div>