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

    ## // OBTENER TODOS LOS SERVICIOS Y PRODUCTOS
    $servicios = $conexion->query(
        "SELECT * FROM catprodserv"
    ) or die ("Error al obtener servicios " . mysqli_error($conexion));
    
    ## // Hacer un array para recorrerlo en los select
    $arrayServicios = [

    ];
    while($s = $servicios->fetch_assoc()){
        array_push($arrayServicios, [$s['idprodserv'], $s['nombre'], $s['costo']]);
    }

    /*for ($i=1; $i < count($arrayServicios) ; $i++) { 
        var_dump($arrayServicios[$i][0]);
        var_dump($arrayServicios[$i][1]);
        var_dump($arrayServicios[$i][2]);
    }*/

    require '../../plantillas/nav_side.view.php';
?>

<div class="cont">

    <h1 class="title">Recibo de pago</h1>
    <div class="alerta-recibo">
        Ingrese la matricula del alumno para cargar sus datos
    </div>

    <table class="tabla-recibo">
        <colgroup>
            <col style="width: 15%">
            <col style="width: 50%">
            <col style="width: 15%">
            <col style="width: 30%">
        </colgroup>
        <tr>
            <th><label for="matricula">Matricula:</label></th>
            <td style="padding-left: 60px; padding-right: 60px;">
                <input type="number"
                        name="matricula"
                        id="matricula"
                        title="Ingrese la matricula del alumno"
                        placeholder="Ej. 43">
            </td>
            <th>Folio:</th>
            <td>R0999</td>
        </tr>

        <tr>
            <th>Alumno:</th>
            <td>Raymundo Antonio Flores Diaz</td>
            <th>Fecha:</th>
            <td><?php echo $fechahoy ?></td>
        </tr>

        <tr>
            <th>Especialidad:</th>
            <td>Bachillerato</td>
        </tr>
    </table>

    <table class="tabla-consulta-modal">

    </table>

    <div class="botonera">
        <a href="#" class="btn primary" onclick="UnConcepto()">1</a>
        <a href="#" class="btn primary" onclick="DosConceptos()">2</a>
        <a href="#" class="btn primary" onclick="TresConceptos()">3</a>
    </div>

    <div class="main-container">
        <table class="tabla-scroll">
            <colgroup>
                <col style="width: 15%">
                <col style="width: 35%">
                <col style="width: 15%">
                <col style="width: 15%">
            </colgroup>

            <thead>
                <th>Clave</th>
                <th>Concepto</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
            </thead>

            <tbody>

                <!-- ================================= -->
                <!-- ======= PRIMER CONCEPTO ========= -->
                <!-- ================================= -->
                <tr>
                    <td style="text-align: center;" id="clave01"></td>
                    <td>
                        <select name="servicio01" 
                                id="servicio01"
                                title="Seleccione un producto o servicio"
                                hidden>
                                <option value="-">-- Seleccione un concepto --</option>
                            <?php
                                for ($i=0; $i < count($arrayServicios) ; $i++) { 
                            ?>
                                <option value="<?php echo $arrayServicios[$i][0] ?>"><?php echo $arrayServicios[$i][1] ?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </td>
                    <td>
                        <input type="number"
                                name="cantidad01"
                                id="cantidad01"
                                title="Ingrese la cantidad de productos"
                                placeholder="Ej. 2"
                                value="0"
                                pattern=""
                                hidden>
                    </td>
                    <td style="text-align: center;" id="subtotal01">
                        <input type="text"
                                name="monto01"
                                id="monto01"
                                value="0"
                                hidden>
                        <input type="text"
                                name="monto01_2"
                                id="monto01_2"
                                value="0.00"
                                readonly
                                hidden>
                    </td>
                </tr>


                <!-- ================================== -->
                <!-- ======= SEGUNDO CONCEPTO ========= -->
                <!-- ================================== -->
                <tr>
                    <td style="text-align: center;" id="clave02"></td>
                    <td>
                        <select name="servicio02" 
                                id="servicio02"
                                title="Seleccione un producto o servicio"
                                hidden>
                                <option value="-">-- Seleccione un concepto --</option>
                            <?php
                                for ($i=0; $i < count($arrayServicios) ; $i++) { 
                            ?>
                                <option value="<?php echo $arrayServicios[$i][0] ?>"><?php echo $arrayServicios[$i][1] ?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </td>
                    <td>
                        <input type="number"
                                name="cantidad02"
                                id="cantidad02"
                                title="Ingrese la cantidad de productos"
                                placeholder="Ej. 2"
                                value="0"
                                pattern=""
                                hidden>
                    </td>
                    <td style="text-align: center;" id="subtotal02">
                        <input type="text"
                                name="monto02"
                                id="monto02"
                                value="0"
                                hidden>
                        <input type="text"
                                name="monto02_2"
                                id="monto02_2"
                                value="0.00"
                                readonly
                                hidden>
                    </td>
                </tr>

                <!-- ================================== -->
                <!-- ======= TERCER CONCEPTO ========= -->
                <!-- ================================== -->
                <tr>
                    <td style="text-align: center;" id="clave03"></td>
                    <td>
                        <select name="servicio03" 
                                id="servicio03"
                                title="Seleccione un producto o servicio"
                                hidden>
                                <option value="-">-- Seleccione un concepto --</option>
                            <?php
                                for ($i=0; $i < count($arrayServicios) ; $i++) { 
                            ?>
                                <option value="<?php echo $arrayServicios[$i][0] ?>"><?php echo $arrayServicios[$i][1] ?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </td>
                    <td>
                        <input type="number"
                                name="cantidad03"
                                id="cantidad03"
                                title="Ingrese la cantidad de productos"
                                placeholder="Ej. 2"
                                value="0"
                                pattern=""
                                hidden>
                    </td>
                    <td style="text-align: center;" id="subtotal03">
                        <input type="text"
                                name="monto03"
                                id="monto03"
                                value="0"
                                hidden>
                        <input type="text"
                                name="monto03_2"
                                id="monto03_2"
                                value="0.00"
                                readonly
                                hidden>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="total">
        <div class="signo">Total: $</div>
        <div class="valor-total">
            <input type="text"
                    class="form-control"
                    value="0.00"
                    name="total"
                    id="total"
                    readonly>
        </div>
    </div>
<footer>
    <div class="botonera">
        <p>Atendido por: <?php echo $_SESSION['nombre'] ?></p>
    </div>

    <div class="botonera">
        <input type="submit" class="submit" value="Realizar pago">
    </div>
</footer>
</div>



<script src="js/recibo.js">
    
</script>