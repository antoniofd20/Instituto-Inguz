<?php
    include('../../php/conexion.php');

    //Iniciar Sesión
    session_start();
    mysqli_set_charset($conexion,'UTF-8');

    //Validar si se está ingresando con sesión un usuario con permisos
    $permiso = intval($_SESSION['permiso']);
    if (!isset($_SESSION) || !$_SESSION ){
        header("Location: /institutoInguz");
        die;
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
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

        ## // OBTENER EL ULTIMO ID DE PERSONA 
        $query1 = $conexion->query(
            "SELECT idpersona FROM $db.tbpersona
            ORDER BY idpersona DESC"
        ) or die("Error al obtener a la ultima persona regsitrada " . mysqli_error($conexion));

        if($query1->num_rows > 0){
            $fquery = $query1->fetch_assoc();
            $ultima = $fquery['idpersona'];
            $siguiente = intval($ultima) + 1;
            
            #header("Location: form_colab.php?id=$siguiente");
        } else {
            $siguiente = 1;
        }

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
                "INSERT INTO $db.tbpersona
                (idpersona, nombre, apaterno, amaterno, fechanac, curp, sexo, edad, telefono, celular, correoe, calleynum, colonia, municipio, estado, cpostal)
                VALUES
                (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? )"
            )or die("Error al insertar persona " . mysqli_error($conexion));

            $statment1->bind_param("issssssissssssss", $siguiente, $nombre, $ap_paterno, $ap_materno, $fecha_nac, $curp, $sexo, $edad, $telefono, $celular, $email, $calle_num, $colonia, $alc_mun, $estado_r, $cp);
            $statment1->execute();

            ## // AGREGAMOS LOS DATOS EN LA TABLA COLABORADOR
            $statment2 = $conexion->prepare(
                "INSERT INTO $db.tbprofesor
                (claveprofesor, persona, profesion, especialidad, fechalta)
                VALUES (?, ?, ?, ?, ?)"
            )or die("Error al insertar profesor " . mysqli_error($conexion));

            $statment2->bind_param("iisss", $siguiente, $siguiente, $profesion, $especialidad, $fecha_alta);
            $statment2->execute();
                
            #echo 'Profesor registrado';

            $conexion->commit();

            
            echo "<script language = javascript>
            alert('Profesor registrado con exito.');
            window.location='list.php';
            </script>";

        } catch (Exception $e) {
            $conexion->rollback();

            #$errores .= 'No se pudo registrar el usuario, intente nuevamente';
            echo "<script language = javascript>
            alert('Error al intentar registrar nuevo profesor.');
            window.location='list.php';
            </script>";
            die ("Error al realizar los registros correspondientes " . $e->getMessage());
        }
        $conexion->close();
    }


    ## // OBTENER LAS ESPECIALIDADES
    $catesp = $conexion->query(
        "SELECT * FROM catespecialidad"
    ) or die ("Error al obtener las especialidades " . mysqli_error($conexion));


    $titulo = 'Registro Profesor';
    require '../../plantillas/nav_side.view.php';

?>

<div class="cont">
    <h1 class="title">Registrar nuevo profesor</h1>

    <!-- INICIAMOS CONTENEDOR PARA LA TABLA DEL FORMULARIO -->
    <div class="main-container">
        <form action="form_prof.php" method="post">
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
                        <input required type="text" class="input" name="nombre" id="nombre" title="Ingrese el nombre del profesor">
                    </td>
                    <th>
                        <label for="ap_paterno" class="label">Apellido paterno:</label>
                    </th>
                    <td>
                        <input required type="text" class="input" name="ap_paterno" id="ap_paterno" title="Ingrese el apellido paterno">
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="ap_materno" class="label">Apellido materno:</label>
                    </th>
                    <td>
                        <input required type="text" class="input" name="ap_materno" id="ap_materno" title="Ingrese el apellido materno">
                    </td>
                    <th>
                        <label for="curp" class="label">Curp:</label>
                    </th>
                    <td>
                        <input required type="text" class="input" name="curp" id="curp" title="Ingrese el curp del profesor">
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="fecha_nac" class="label">Fecha de nacimiento:</label>
                    </th>
                    <td>
                        <input required type="date" class="input" name="fecha_nac" id="fecha_nac" title="Ingrese la fecha de nacimiento">
                    </td>
                    <th>
                        <label for="sexo" class="label">Sexo:</label>
                    </th>
                    <td>
                        <select name="sexo" id="sexo" class="select" title="Ingrese el sexo del profesor" required>
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
                        <input type="number" class="input" id="telefono" title="Ingrese el telefono" name="telefono">
                    </td>
                    <th>
                        <label for="celular" class="label">Celular:</label>
                    </th>
                    <td>
                        <input required type="number" class="input" id="celular" title="Ingrese el celular" name="celular">
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="email" class="label">Correo eléctronico:</label>
                    </th>
                    <td>
                        <input required type="email" class="input" id="email" title="Ingrese correo electronico" name="email">
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
                        <input required type="text" class="input" id="calle_num" title="Ingrese la calle y numero" name="calle_num">
                    </td>
                    <th>
                        <label for="colonia" class="label">Colonia:</label>
                    </th>
                    <td>
                        <input required type="text" class="input" id="colonia" title="Ingrese la colonia" name="colonia">
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="alc_mun" class="label">Municipio, Alcaldia:</label>
                    </th>
                    <td>
                        <input required type="text" class="input" id="alc_mun" title="Ingrese su alcaldia o municipio" name="alc_mun">
                    </td>
                    <th>
                        <label for="estado_r" class="label">Estado:</label>
                    </th>
                    <td>
                        <input required type="text" class="input" id="estado_r" title="Ingrese el estado al que pertenece"  name="estado_r">
                   </td>
                </tr>
                <tr>
                    <th>
                        <label for="cp" class="label">Código Postal:</label>
                    </th>
                    <td>
                        <input required type="number" class="input" id="cp" title="Ingrese su codigo postal"  name="cp">
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
                        <input required type="text" class="input" name="profesion" id="profesion" title="Ingrese la profesion del profesor">
                    </td>
                    <th colspan="1">
                        <label for="especialidad" class="label">Especialidad:</label>
                    </th>
                    <td colspan="1">
                        <select name="especialidad" id="especialidad" class="select" title="Seleccione la especialidad del profesor">
                            <!-- MUESTRO LAS ESPECIALIDADES QUE ESTAN REGISTRADAS -->
                            <?php 
                                while($e = $catesp->fetch_assoc()){
                            ?>
                                <option value="<?php echo $e['idespecialidad']; ?>"><?php echo $e['nombre']; ?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="fecha_alta" class="label">Fecha de Alta:</label>
                    </th>
                    <td>
                        <input required type="date" name="fecha_alta" class="input">
                    </td>
                    <th>
                        <label for="fecha_baja" class="label">Fecha de Baja:</label>
                    </th>
                    <td>
                    <input type="date" name="fecha_baja" class="input">
                    </td>
                </tr>
            </table>
          </div>
          <input required type="submit" value="Registrar profesor" class="submit">
        </form>
    </div>
</div>
