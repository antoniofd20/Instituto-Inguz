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

    $qcata = $conexion->query(
        "SELECT * FROM catprodserv"
    ) or die ("Error al obtener los productos del catalogo " . mysqli_error($conexion));

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $clave = $_POST['clave'];
        $desc = mb_strtoupper(trim(filter_var($_POST['desc'], FILTER_SANITIZE_STRING)));
        $costo = mb_strtoupper(trim(filter_var($_POST['costo'], FILTER_VALIDATE_FLOAT)));

        #var_dump($_POST);

        if($desc == '' || $costo == ''){

            ## // MODIFICAR CADA UNO DE LOS PRECIOS
            while($serv = $qcata->fetch_assoc()){
                $descExistente = mb_strtoupper(trim(filter_var($_POST['desc'. $serv['idprodserv']], FILTER_SANITIZE_STRING)));
                $costoExistente = trim(filter_var($_POST['costo' . $serv['idprodserv']], FILTER_VALIDATE_FLOAT));
                $clave = $serv['idprodserv'];

                #echo $descExistente . '<br>';
                #echo $costoExistente . '<br>';
                
                $insertar = $conexion->prepare(
                    "UPDATE $db.catprodserv SET
                    nombre = ?, costo = ?
                    WHERE idprodserv = '$clave'"
                ) or die (" Error al actualizar servicios existentes " . mysqli_error($conexion));

                $insertar->bind_param("sd", $descExistente, $costoExistente);

                $insertar->execute();
            }

            echo "<script language = javascript>
            alert('Se actualizaron con exito los servicios existentes.');
            window.location='editar-catalogo.php';
            </script>";


        } else if($desc != '' && $costo != ''){

            ## // AGREGAMOS EN LA BASE EL NUEVO SERVICIO INGRESADO
            $query = $conexion->prepare(
                "INSERT INTO $db.catprodserv (idprodserv, nombre, costo) VALUES (?, ?, ?)"
            ) or die ("Error al insertar en la base de datos " . mysqli_error($conexion));

            $query->bind_param("isd", $clave, $desc, $costo);

            if($query->execute()){
                echo "<script language = javascript>
                alert('Nuevo servicio agregado.');
                window.location='editar-catalogo.php';
                </script>";
            } else {
                echo "<script language = javascript>
                alert('Error al agregar nuevo servicio.');
                window.location='editar-catalogo.php';
                </script>";
            }

        }
    }

    $qcata = $conexion->query(
        "SELECT * FROM catprodserv"
    ) or die ("Error al obtener los productos del catalogo " . mysqli_error($conexion));

    require '../../plantillas/catalogo_nav.php';

?>


    <div class="cont mt-50">
    <h1 class="title" >Edita precios del catálogo</h1>
        <div class="main-container mas-abajo">
          <!-- INICIA EL FORMULARIO PARA CAMBIAR LOS PRECIOS DE LOS SERVICIOS/PRODUCTOS -->
          <form action="editar-catalogo.php" method="post">
            <div class="tabla-scroll-container">

                <table class="tabla-scroll">
                    <colgroup>
                        <col style="width: 20%">
                        <col style="width: 60%">
                        <col style="width: 20%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>Clave</th>
                            <th>Descripción</th>
                            <th>Costo</th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php 
                        while($cata = $qcata->fetch_assoc()){
                    ?>
                        <tr>
                            <td class="center"><?php echo $cata['idprodserv']; ?></td>
                            <td class="center">
                                <input type="text" name="desc<?php echo $cata['idprodserv'] ?>" value="<?php echo $cata['nombre']; ?>">
                            </td>
                            <td>
                                <input type="number" step=0.01 value="<?php echo $cata['costo'] ?>" name="costo<?php echo $cata['idprodserv'] ?>"
                                    title="Edita el valor del costo de este servicio">
                            </td>
                        </tr>
                    <?php 
                        }

                        ## // OBTENER LA CLAVE PARA EL NUEVO SERVICIO
                        $ultimo = $qcata->num_rows;

                        $siguiente = $ultimo + 1;
                        $siguiente = '000' . $siguiente; 
                        $siguiente = substr($siguiente, -3);
                        $siguiente = '5' . $siguiente;
                        $siguiente = intval($siguiente);
                    ?>

                    <tr>
                        <td>
                            <input type="number" name="clave" id="clave" value="<?php echo $siguiente; ?>" readonly>
                        </td>
                        <td>
                            <input type="text" name="desc" id="desc" placeholder="Agregar una nueva descripcion para el nuevo servicio o producto"
                            title="Agregar una nueva descripcion para el nuevo servicio o producto">
                        </td>
                        <td style="display: inline-flex; padding-right: 20px;padding-left: 20px;">
                            $ <input type="number" step=0.01 name="costo" id="costo" placeholder="Ej: 1999.99"
                            title="No agregar comas ni espacios">
                        </td>
                    </tr>



                    <!--
                        <tr>
                            <td class="center">5001</td>
                            <td class="izquierda">Inscripcion Bachillerato</td>
                            <td>
                                <input type="number" value='1350'>
                            </td>
                        </tr>
                        <tr>
                            <td class="center">5002</td>
                            <td class="izquierda">Tramite Alta SEP</td>
                            <td>
                                <input type="number" value='1350'>
                            </td>
                        </tr>
                        <tr>
                            <td class="center">5003</td>
                            <td class="izquierda">Mensualidad</td>
                            <td>
                                <input type="number" value='1350'>
                            </td>
                        </tr>
                        <tr>
                            <td class="center">5004</td>
                            <td class="izquierda">Guía Bachillerato Ciencias Experimentales</td>
                            <td>
                                <input type="number" value='1350'>
                            </td>
                        </tr>
                        <tr>
                            <td class="center">5005</td>
                            <td class="izquierda">Guía Bachillerato Ciencias Sociales</td>
                            <td>
                                <input type="number" value='1350'>
                            </td>
                        </tr>
                        <tr>
                            <td class="center">5006</td>
                            <td class="izquierda">Libro Inglés Nivel 1</td>
                            <td>
                                <input type="number" value='1350'>
                            </td>
                        </tr>
                        <tr>
                            <td class="center">5007</td>
                            <td class="izquierda">Libro Inglés Nivel 2</td>
                            <td>
                                <input type="number" value='1350'>
                            </td>
                        </tr>
                        <tr>
                            <td class="center">5008</td>
                            <td class="izquierda">Libro Inglés Nivel 3</td>
                            <td>
                                <input type="number" value='1350'>
                            </td>
                        </tr>
                        <tr>
                            <td class="center">5009</td>
                            <td class="izquierda">Libro Inglés Nivel 4</td>
                            <td>
                                <input type="number" value='1350'>
                            </td>
                        </tr>
                        <tr>
                            <td class="center">5010</td>
                            <td class="izquierda">Libro Inglés Nivel 5</td>
                            <td>
                                <input type="number" value='1350'>
                            </td>
                        </tr>
                        <tr>
                            <td class="center">5011</td>
                            <td class="izquierda">Libro Inglés Nivel 6</td>
                            <td>
                                <input type="number" value='1350'>
                            </td>
                        </tr>
                        <tr>
                            <td class="center">5012</td>
                            <td class="izquierda">Libro Inglés Nivel 7</td>
                            <td>
                                <input type="number" value='1350'>
                            </td>
                        </tr>
                        <tr>
                            <td class="center">5013</td>
                            <td class="izquierda">Tramite Liberación</td>
                            <td>
                                <input type="number" value='1350'>
                            </td>
                        </tr>
                        <tr>
                            <td class="center">5014</td>
                            <td class="izquierda">Reposición Acta de Nacimiento</td>
                            <td>
                                <input type="number" value='1350'>
                            </td>
                        </tr>
                        <tr>
                            <td class="center">5015</td>
                            <td class="izquierda">Recuperacion de certificado de secundaria</td>
                            <td>
                                <input type="number" value='1350'>
                            </td>
                        </tr>
                        <tr>
                            <td class="center">5016</td>
                            <td class="izquierda">Constancia de estudios</td>
                            <td>
                                <input type="number" value='1350'>
                            </td>
                        </tr>
                        <tr>
                            <td class="center">5017</td>
                            <td class="izquierda">Credencial</td>
                            <td>
                                <input type="number" value='1350'>
                            </td>
                        </tr>
                        <tr>
                            <td class="center">5018</td>
                            <td class="izquierda">Acto Cívico</td>
                            <td>
                                <input type="number" value='1350'>
                            </td>
                        </tr>
                        <tr>
                            <td class="center">5019</td>
                            <td class="izquierda">Examén de Colocación</td>
                            <td>
                                <input type="number" value='1350'>
                            </td>
                        </tr>

                    -->
                    </tbody>
                </table>

            </div>
            <div class="botonera">
                <a href="list.php" class="btn primary">Regresar</a>
                <input type="submit" value="Editar lista de precios" class='submit'>
            </div>

          </form>
        </div>
    </div>
