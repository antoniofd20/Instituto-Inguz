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

    header("Pragma: public");
    header("Expires: 0");
    $filename = "colaboradoresExcel" . date('d-m-Y') . ".xls";
    header("Content-type: application/x-msdownload");
    header("Content-Disposition: attachment; filename=$filename");
    header("Pragma: no-cache");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

    ## // LISTAR A TODOS LOS COLABORADORES 
    $qcolabs = $conexion->query(
        "SELECT * FROM tbpersona p
        JOIN tbcolaborador c ON (p.idpersona = c.persona)
        ORDER BY clavecolaborador DESC"
    ) or die("Error al obtener los colaboradores " . mysqli_error($conexion));

?>
<table>
    <tbody>    
        <tr>
            <th><h1>Colaboradores</h1></th>
        </tr> 
        <tr>
            <th><h2>Clave</h2></th>
            <th><h2>Nombre</h2></th>
            <th><h2>Area</h2></th>
            <th><h2>Telefono</h2></th>
            <th><h2>Celular</h2></th>
        </tr>
        <?php 
            while($colab = $qcolabs->fetch_assoc()){
                ## // VISUALMENTE SE VERA 0001, 0002, 0003...
                $clave = '0000' . $colab['clavecolaborador'];
                $clave = substr($clave, -4);
        ?>
                <tr>
                    <td style="text-align: center;"><?php echo $clave; ?></td>
                    <td><?php echo $colab['nombre'] . ' ' . $colab['apaterno'] . ' ' .  $colab['amaterno']?></td>
                    <td><?php echo $colab['area'] ?></td>
                    <td><?php echo $colab['telefono'] ?></td>
                    <td><?php echo $colab['celular'] ?></td>
                </tr>
        <?php
            }
        ?>
        
    </tbody>
</table>