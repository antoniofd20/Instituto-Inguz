<?php 

    $errores = '';

    if($_GET['e'] == 'true'){
        $errores .= 'Usuario y/o contrasena incorrectos';
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- ESTILOS -->
    <link rel="stylesheet" href="css/login.css">

    <!-- FUENTES -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Comfortaa&display=swap" rel="stylesheet">

    <title>Iniciar sesion</title>
</head>
<body>


    <div class="contain">
        <div class="img"></div>
        <!-- ME DEBE LLEVAR AL LOGIN.PHP PARA COMPROBAR QUE SEA UN USUARIO -->
        <form action="php/login.php" method="POST" class="formulario">
            
            <input class="input up" type="text" placeholder="Usuario..." name="usuario" id="usuario" required>
            <input class="input down" type="password" placeholder="Contraseña..." name="contrasena" id="contrasena" required>
            <?php
                if(!empty($errores)){
            ?>
                <ul>
                    <li><?php echo $errores ?></li>
                </ul>
            <?php
                }
            ?>
            <input type="submit" class="btn" value="Ingresar">

        </form>
    </div>
</body>
</html>