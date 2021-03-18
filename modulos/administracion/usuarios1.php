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

    if($_POST['tipo'] == 1){
        #var_dump($_POST);
        $colab = $_POST['colab'];
        $permiso_nuevo = $_POST['permiso'];

        ## // OBTENER LA ABREVIATURA DEL PERMISO
        $per = $conexion->query(
            "SELECT * FROM tbpermisos
            WHERE idpermiso = $permiso_nuevo"
        ) or die ("Error al obtener la abreviatura");

        $abr = $per->fetch_assoc();
        $abr = $abr['abr'];

        #echo $abr;

        ## // OBTENER EL ULTIMO USUARIO DEL PERMISO SELECCIONADO
        $ultimo = $conexion->query(
            "SELECT * FROM tbusuarios
            WHERE usuario LIKE '$abr%'
            ORDER BY usuario DESC"
        ) or die("Error al obtener el ultimo usuario");

        if($ultimo->num_rows > 0){
            $ultimo_usuario  = $ultimo->fetch_assoc();

            ## // OBTENFO EL ULTIMO USUARIO DEL DEPARTAMENTO
            $user = $ultimo_usuario['usuario'];

            $num_usuario = substr($user, -3) + 1;

            $ultimo->free();
        } else {
            $num_usuario = 1;
        }

        ## // SE CREA EL USUARIO
        $usuario = "000" . $num_usuario;
        $usuario = substr($usuario, -3);
        $usuario = $abr . '_' . $usuario;


        ## // AGREGAMOS A LA TABLA USUSARIOS
        $statment = $conexion->prepare(
            "INSERT INTO tbusuarios
            (colaborador, usuario, pwd, permiso)
            VALUES
            (?, ?, ?, ?)"
        ) or die("Error al insertar usuario " . mysqli_error($conexion));

        $statment->bind_param("issi", $colab, $usuario, $usuario, $permiso_nuevo);

        if($statment->execute()){
            echo "<script language = javascript>
            alert('Usuario dado de alta exitosamente.');
            window.location='usuarios.php';
            </script>";
        } else {
            echo "<script language = javascript>
            alert('Error al registrar nuevo usuario.');
            window.location='usuarios.php';
            </script>";
        }
    }