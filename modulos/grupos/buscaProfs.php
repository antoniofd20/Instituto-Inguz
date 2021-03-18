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
    $esp = 0;
    $profesores = $conexion->query(
        "SELECT * FROM tbprofesor p
        JOIN catespecialidad e ON (p.especialidad = e.idespecialidad)
        WHERE especialidad = '$esp'"
    ) or die("Error al obtener los horarios " . mysqli_error($conexion));

    ## // EN CASO DE RECIBIR NOMBRE DE BUSQUEDA SE EJECUTA 
    if(isset($_POST['esp'])){
        $esp = $_POST['esp'];

        $profesores = $conexion->query(
            "SELECT * FROM tbprofesor p
            JOIN catespecialidad e ON (p.especialidad = e.idespecialidad)
            JOIN tbpersona pe ON (pe.idpersona = p.persona)
            WHERE especialidad = '$esp'"
        )or die("Error al obtener los horarios " . mysqli_error($conexion));
    }

    #var_dump($horarios->num_rows);
    
    #var_dump($qcolabs->num_rows)

    if($profesores->num_rows > 0){
        $salida .= '
            <select name="profesor" id="profesor" class="select" title="Seleccionar el profesor">
        ';

        while($prof = $profesores->fetch_assoc()){
            $salida .= '
                    <option value="' . $prof['claveprofesor'] . '">'. $prof['nombre'] . ' ' . $prof['apaterno'] . ' ' . $prof['amaterno'] .'</option>
            ';
        }
        $salida .= '
            </select>
        ';
    } else {
        $salida .= '
        <p style="color:red">No hay profesores para la especialidad</p>
        ';
    }

    echo $salida;
    $conexion->close();

