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
    $materias = $conexion->query(
        "SELECT * FROM catmaterias m
        JOIN catespecialidad e ON (m.especialidad = e.idespecialidad)
        WHERE especialidad = '$esp'"
    ) or die("Error al obtener las materias " . mysqli_error($conexion));

    ## // EN CASO DE RECIBIR NOMBRE DE BUSQUEDA SE EJECUTA 
    if(isset($_POST['esp'])){
        $esp = $_POST['esp'];

        $materias = $conexion->query(
            "SELECT * FROM catmaterias m
            JOIN catespecialidad e ON (m.especialidad = e.idespecialidad)
            WHERE especialidad = '$esp'"
        )or die("Error al obtener las materias " . mysqli_error($conexion));
    }

    #var_dump($horarios->num_rows);
    
    #var_dump($qcolabs->num_rows)

    if($materias->num_rows > 0){
        
        $salida .= '
            <select name="nivel" id="nivel" class="select" title="Seleccionar el nivel del grupo">
        ';
        
        while($mat = $materias->fetch_assoc()){
            #var_dump($mat);
            $salida .= '
                    <option value="' . $mat['idmaterias'] .'">' . $mat['nombremat'] .'</option>
            ';
        }
        $salida .= '
            </select>
        ';
    } else {
        $salida .= '
            <p style="color:red">No hay modalidades para la especialidad</p>
        ';
    }

    echo $salida;
    $conexion->close();

