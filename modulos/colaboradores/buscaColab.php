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
    $qcolabs = $conexion->query(
        "SELECT * FROM tbpersona p
        JOIN tbcolaborador c ON (p.idpersona = c.persona)
        ORDER BY clavecolaborador DESC"
    ) or die("Error al obtener los colaboradores " . mysqli_error($conexion));

    ## // EN CASO DE RECIBIR NOMBRE DE BUSQUEDA SE EJECUTA 
    if(isset($_POST['nombre'])){
        $nombre = $_POST['nombre'];

        $qcolabs = $conexion->query(
            "SELECT * FROM tbpersona p
            JOIN tbcolaborador c ON (p.idpersona = c.persona)
            WHERE nombre LIKE '%".$nombre."%'
            OR apaterno LIKE '%".$nombre."%'
            OR amaterno LIKE '%".$nombre."%'
            OR clavecolaborador LIKE '%".$nombre."%'
            OR celular LIKE '%".$nombre."%'
            ORDER BY clavecolaborador DESC"
        )or die("Error al obtener los colaboradores " . mysqli_error($conexion));
    }

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

    if($qcolabs->num_rows > 0){
        $salida.= '
            <thead>
                <th>Clave</th>
                <th>Nombre</th>
                <th>Área</th>
                <th>Celular</th>
                <th>Acciones</th>
            </thead>
        ';

        while($colab = $qcolabs->fetch_assoc()){
            ## // VISUALMENTE SE VERA 0001, 0002, 0003...
            $clave = '0000' . $colab['clavecolaborador'];
            $clave = substr($clave, -4);

        $salida .= '
            <tr>
                <td style="text-align: center;">' . $clave .'</td>
                <td class="nombre">' . $colab['nombre'].' '. $colab['apaterno'].' '.$colab['amaterno'] . '</td>
                <td style="text-align: center;">' . $colab['area'] .'</td>
                <td style="text-align: center;">' . $colab['celular'] .'</td>
                <td class="ico-group">
                <a style="color: black" class="ico-accion" title="Ver colaborador" href="colab_info.php?id='.$colab['clavecolaborador'].'">
                        <i class="fa fa-eye ico-consulta" aria-hidden="true"></i>
                    </a>
                    <a style="color: black" class="ico-accion" title="Edita colaborador" href="editar_colab.php?id='.$colab['clavecolaborador'].'">
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

