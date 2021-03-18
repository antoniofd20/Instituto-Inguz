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

    ## // OBTENER LAS ESPECIALIDADES
    $catesp = $conexion->query(
        "SELECT * FROM catespecialidad"
    ) or die ("Error al obtener las especialidades " . mysqli_error($conexion));

    $titulo = 'Profesores';
    require '../../plantillas/nav_side.view.php';

?>

<div class="cont">
        <h1 class="title" >Consulta profesores</h1>

            <!-- CONTENEDOR PARA LOS ICONOS -->
            <div class="flex">
                <!-- AGREGAR UN NUEVO REGISTRO -->
                <div class="agregar">
                    <a href="form_prof.php">
                        <i class="icono-flex agregar-icono fa fa-plus-circle fa-3x"></i>
                    </a>
                </div>

                <!-- EXPORTAR A ALGUN TIPO DE DOCUMENTO -->
                <div class="exportar">
                    <a href="../../archivo/pdf/profesoresPDF.php" target="blank">
                        <i class="icono-flex pdf fa fa-file-pdf-o" aria-hidden="true"></i>
                    </a>
                    <a href="../../archivo/excel/profesoresEXCEL.php">
                        <i class="icono-flex excel fa fa-file-excel-o" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
<!--TABLA PARA CONSULTA-->
<table class="tabla-consulta-modal">
    <caption>Buscar profesores</caption>
    <colgroup>
        <col style="width:20%">
        <col style="width:30%">
        <col style="width:20%">
        <col style="width:30%">
    </colgroup>
    <form action="#" method="post">
      <tr>
          <th><label for="nombre">Buscar:</label></th>
          <td>
              <input type="text" name="nombre" id="nombre" class="form-control" title="Ingrese un nombre para buscar" placeholder="Puedes buscar por nombre, apellidos, celular o clave">
          </td>
          <th><label for="especialidad">Especialidad:</label></th>
          <td>
            <select name="especialidad" id="especialidad">
                <option value="">-- Seleccionar --</option>
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
    </form>
</table>        
        <div class="main-container">
            <div class="tabla-scroll-container" id="tabla-documentos">

            </div>
        </div>
    </div>

    <script>
        // Ajax para buscar colaboradoreres
        $(BuscaProfesor()); // Ejecutar automaticamente la funcion

        function BuscaProfesor(nombre, esp){
            $.ajax({
                url: 'buscaProfesor.php',
                type: 'POST',
                dataType: 'html',
                data: {
                    nombre: nombre,
                    esp: esp
                },
            })
            .done(function(respuesta){
                $("#tabla-documentos").html(respuesta);
            })
            .fail(function(){
                console.log(error);
            })
        }

        // Se ejecuta hasta que el usuario escribe
        $("#nombre").keyup(function(){
            var nombre = $("#nombre").val();
            var esp = $("#especialidad").val();

            console.log ('Nombre: ' + nombre);
            console.log ('Esp: ' + esp);

            BuscaProfesor(nombre, esp);
        })
        // Se ejecuta hasta que el usuario escribe
        $("#especialidad").change(function(){
            var nombre = $("#nombre").val();
            var esp = $("#especialidad").val();

            console.log ('Nombre: ' + nombre);
            console.log ('Esp: ' + esp);

            BuscaProfesor(nombre, esp);
        })


    </script>
