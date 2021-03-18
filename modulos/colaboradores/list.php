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

    
    $titulo = 'Colaboradores';
    #require 'views/colaboradores.view.php';
    require '../../plantillas/nav_side.view.php';

?>

<div class="cont">

    <h1 class="title" >Consulta colaboradores</h1>

    <!-- CONTENEDOR PARA LOS ICONOS -->
    <div class="flex">
        <!-- AGREGAR UN NUEVO REGISTRO -->
        <div class="agregar">
            <a href="form_colab.php">
                <i class="icono-flex agregar-icono fa fa-plus-circle fa-3x"></i>
            </a>
        </div>

        <!-- EXPORTAR A ALGUN TIPO DE DOCUMENTO -->
        <div class="exportar">
            <a href="../../archivo/pdf/colaboradoresPDF.php" target="blank">
                <i class="icono-flex pdf fa fa-file-pdf-o" aria-hidden="true"></i>
            </a>
            <a href="../../archivo/excel/colaboradoresEXCEL.php">
                <i class="icono-flex excel fa fa-file-excel-o" aria-hidden="true"></i>
            </a>
        </div>
    </div>

        <!--TABLA PARA CONSULTA-->
        <table class="tabla-consulta-modal">
            <caption>Buscar colaborador</caption>
            <colgroup>
                <col style="width:40%">
                <col style="width:60%">
            </colgroup>
            <form action="#" method="post">
            <tr>
                <th><label for="nombre">Buscar:</label></th>
                <td>
                    <input type="text" name="nombre" id="nombre" class="form-control" title="Ingrese un nombre para buscar" placeholder="Puedes buscar por nombre, apellidos, celular o clave">
                </td>
            </tr>
            </form>
        </table>        
        <div class="main-container">
            <div class="tabla-scroll-container" id="tabla-documentos">

                <!-- Aqui van a aparecer los resultados -->
                
            </div>
        </div>
</div>

<script>
    // Ajax para buscar colaboradoreres
    $(BuscaColab()); // Ejecutar automaticamente la funcion

    function BuscaColab(nombre){
        $.ajax({
            url: 'buscaColab.php',
            type: 'POST',
            dataType: 'html',
            data: {
                nombre: nombre
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

        console.log ('Nombre: ' + nombre);

        BuscaColab(nombre);
    })


</script>