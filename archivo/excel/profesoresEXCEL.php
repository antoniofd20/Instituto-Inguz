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


## // LISTAR A TODOS LOS COLABORADORES SI NO SE HA INGRESADO BUSQUEDA
$qprofs = $conexion->query(
    "SELECT * FROM tbpersona pe
    JOIN tbprofesor pr ON (pe.idpersona = pr.persona)
    ORDER BY claveprofesor DESC"
) or die("Error al obtener los colaboradores " . mysqli_error($conexion));

header("Pragma: public");
header("Expires: 0");
$filename = "profesoresExcel" . date('d-m-Y') . ".xls";
header("Content-type: application/x-msdownload");
header("Content-Disposition: attachment; filename=$filename");
header("Pragma: no-cache");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

# REALIZAR CONSULTA PARA LLENAR LA TABLA 

?>
<table>
    <tbody>     
        <tr>
            <th><h1>Profesores</h1></th>
        </tr> 
        <tr>
            <th><h2>Clave</h2></th>
            <th><h2>Nombre</h2></th>
            <th><h2>Profesion</h2></th>
            <th><h2>Especialidad</h2></th>
            <th><h2>Celular</h2></th>
        </tr>
        <?php 
            while($prof = $qprofs->fetch_assoc()){
                ## // VISUALMENTE SE VERA 0001, 0002, 0003...
                $clave = '0000' . $prof['claveprofesor'];
                $clave = substr($clave, -4);

                if($prof['especialidad'] == 1){
                    $esp = 'CIENCIAS';
                } else if($prof['especialidad'] == 2){
                    $esp = 'SOCIALES';
                } else if($prof['especialidad'] == 3){
                    $esp = 'INGLES';
                }
        ?>
                <tr>
                    <td style="text-align: center;"><?php echo $clave; ?></td>
                    <td><?php echo $prof['nombre'] . ' ' . $prof['apaterno'] . ' ' .  $prof['amaterno']; ?></td>
                    <td><?php echo $prof['profesion'] ?></td>
                    <td><?php echo $esp; ?></td>
                    <td><?php echo $prof['celular'] ?></td>
                </tr>

        <?php
            }
        ?>
    </tbody>
</table>