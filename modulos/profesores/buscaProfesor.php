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

    $salida = '';

    ## // LISTAR A TODOS LOS COLABORADORES SI NO SE HA INGRESADO BUSQUEDA
    $qprofs = $conexion->query(
        "SELECT * FROM tbpersona pe
        JOIN tbprofesor pr ON (pe.idpersona = pr.persona)
        ORDER BY claveprofesor DESC"
    ) or die("Error al obtener los colaboradores " . mysqli_error($conexion));
    
    ## // EN CASO DE RECIBIR NOMBRE DE BUSQUEDA SE EJECUTA 
    $nombre = $_POST['nombre'];
    $esp = intval($_POST['esp']);

    if(isset($nombre) || isset($esp)){
        #echo $esp;

        ## // IMPORTANTE ##############################3
        ## // ME SIRVE PARA QUE NO ARROJE NI UN RESULTADO DE NOMBRE Y HAGA CASO SOLO A LA ESPECIALIDAD
        if($esp != 0){
            $nombre = '########';
        }
        #echo $nombre;

        $qprofs = $conexion->query(
            "SELECT * FROM tbpersona pe
            JOIN tbprofesor pr ON (pe.idpersona = pr.persona)
            WHERE (nombre LIKE '%".$nombre."%'
            OR apaterno LIKE '%".$nombre."%'
            OR amaterno LIKE '%".$nombre."%'
            OR claveprofesor LIKE '%".$nombre."%'
            OR celular LIKE '%".$nombre."%') OR 
            (especialidad = '$esp')
            ORDER BY claveprofesor DESC"
        )or die("Error al obtener los colaboradores " . mysqli_error($conexion));
    } 

        ## // EN CASO DE RECIBIR NOMBRE DE BUSQUEDA SE EJECUTA 




    #var_dump($_POST);
    
    #var_dump($qcolabs->num_rows);

    $salida .= '
        <table class="tabla-scroll">
        <colgroup>
            <col style="width: 20%; min-width: 15%">
            <col style="width: 40%; min-width: 40%">
            <col style="width: 25%; min-width: 15%">
            <col style="width: 15%; min-width: 15%">
            <col style="width: 30%; min-width: 15%">
        </colgroup>
    ';

    if($qprofs->num_rows > 0){
        $salida.= '
            <thead>
                <th>Clave</th>
                <th>Nombre</th>
                <th>Especialidad</th>
                <th>Celular</th>
                <th>Acciones</th>
            </thead>
        ';

        while($prof = $qprofs->fetch_assoc()){
            ## // VISUALMENTE SE VERA 0001, 0002, 0003...
            $clave = '0000' . $prof['claveprofesor'];
            $clave = substr($clave, -4);

            /*if($prof['especialidad'] == 1){
                $e = 'BACHILLERATO';
            } else if($prof['especialidad'] == 2){
                $e ='INGLES';
            }*/

            $numero = intval($prof['especialidad']);

            $especialidad = $conexion->query(
                "SELECT * FROM catespecialidad
                WHERE idespecialidad = '$numero'"
            ) or die ("Error al obtener la especialidad del profesor " . mysqli_error($conexion));

            $e = $especialidad->fetch_assoc();

        $salida .= '
            <tr>
                <td style="text-align: center;">' . $clave .'</td>
                <td class="nombre">' . $prof['nombre'].' '. $prof['apaterno'].' '.$prof['amaterno'] . '</td>
                <td style="text-align: center;">' . $e['nombre'] .'</td>
                <td style="text-align: center;">' . $prof['celular'] .'</td>
                <td class="ico-group">
                <a style="color: black" class="ico-accion" title="Ver profesor" href="prof_info.php?id='.$prof['claveprofesor'].'">
                        <i class="fa fa-eye ico-consulta" aria-hidden="true"></i>
                    </a>
                    <a style="color: black" class="ico-accion" title="Edita profesor" href="editar_prof.php?id='.$prof['claveprofesor'].'">
                        <i class="fa fa-pencil ico-editar" aria-hidden="true"></i>
                    </a>
                </td>
            </tr>
        ';
        }

        $salida .= '
            </table>
        ';
    } else {
        $salida .= '
            <tr>
                <td style="text-align: center;">
                    No se encontró ningún resultado con el criterio de búsqueda solicitado
                </td>
            </tr>
        ';
    }

    $salida .= '</table>';

    echo $salida;
    $conexion->close();

