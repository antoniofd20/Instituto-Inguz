<?php

    # OBTENER EL DIA ACTUAL
    $hoy = getdate();
    $mes = $hoy['mon'];
    $year = $hoy['year'];
    $hoy = $hoy['mday'] . '-' . $hoy['mon'] . '-' . $hoy['year'];

    # ESTE ARRAY SIRVE PARA DESPUES SELECCIONAR EL MES ACTUAL EN EL SELECT AUTOMATICO
    $meses = array(
        array('ENERO', 1),
        array('FEBRERO', 2),
        array('MARZO', 3),
        array('ABRIL', 4),
        array('MAYO', 5),
        array('JUNIO', 6),
        array('JULIO', 7),
        array('AGOSTO', 8),
        array('SEPTIEMBRE', 9),
        array('OCTUBRE', 10),
        array('NOVIEMBRE', 11),
        array('DICIEMBRE', 12),
    );

    # ESTOS AÑOS SE VAN A TRAER DE LA BASE DE DATOS
    $anios = array(
        2020, 2021
    );

?>

<!-- Modal -->
<div id="miModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Contenido del modal -->
    <div class="modal-content" style="width: 130%; margin: auto;">
        <div class="modal-header">
            <h1 class="modal-tittle">Consulta ingresos</h1>
        </div>
        <!-- INICIAR FORMULARIO -->
        <div class="modal-body">
            
            <!-- AGREGUE ESTILOS AQUI PARA PROBAR -->
            <div class="contenedor"style="width: 100%; margin: 0 auto;">
                <h3 class="titulo_modal_2">Selecciona periodo de tiempo</h3>
                
                <!-- BUSCAR POR DIA -->
                <form action="ingresos.php" method="post">
                    <div class="renglon-modal">
                        <div class="col-8_2">
                            <!-- PONER EN AUTOMATICO EL DIA ACTUAL -->
                            <input type="text" value="<?php echo $hoy; ?>" class="form-control" title="Fecha de hoy" name="hoy" readonly>
                        </div>
                        <div class="col-2_2">
                            <input type="number" name="tipo" value="1" hidden>
                            <input type="submit" class="submit_2 btn btn-primary" title="Enviar fecha actual" value="Hoy">  
                        </div>
                    </div>
                </form>

                <!-- BUSCAR POR MES -->
                <form action="ingresos.php" method="post">
                    <div class="renglon-modal">
                        <div class="col-4_2">
                            <select name="mes" class="form-control" id="mes" title="Mes a consultar">
                                    <!-- PONER EN AUTOMATICO EL MES Y AÑO ACTUAL -->
                                    <?php 
                                        for($i = 1; $i <= 12; $i++){
                                            if ($mes == $i){
                                                $j = $i -1;
                                    ?>
                                            <option value="<?php echo $meses[$j][1]; ?>" selected><?php echo $meses[$j][0]; ?></option>

                                    <?php
                                            } else {
                                    ?>
                                            <option value="<?php echo $meses[$i - 1][1]; ?>"><?php echo $meses[$i - 1][0]; ?></option>
                                    <?php
                                            }
                                        } 
                                    ?>
                            </select>
                        </div>
                        <div class="col-4_2">
                            <!-- OBTENER LOS AÑOS DE ACUERDO A LOS
                                PAGOS REGISTRADOS EN LA BD -->
                            <select name="anio_mes" class="form-control" id="anio_mes" title="Año a consultar">
                                <!-- SELECCIONAR AUTOMATICO EL AÑO ACTUAL -->
                                <?php 
                                        for($i = 0; $i < count($anios); $i++){
                                            if ($anios[$i] == $year){
                                ?>
                                        <option value="<?php echo $anios[$i]; ?>" selected><?php echo $anios[$i]; ?></option>

                                <?php
                                            } else {
                                ?>
                                        <option value="<?php echo $anios[$i]; ?>"><?php echo $anios[$i]; ?></option>
                                <?php
                                            }
                                        } 
                                ?>
                            </select>
                        </div>
                        <div class="col-2_2">
                            <input type="number" name="tipo" value="2" hidden>
                            <input type="submit" class="submit_2 btn btn-primary" title="Enviar fecha actual" value="Por mes">  
                        </div>
                    </div>
                </form>

                <!-- BUSCAR POR AÑO -->
                <form action="ingresos.php" method="post">
                    <div class="renglon-modal">
                        <div class="col-8_2">
                            <!-- OBTENER LOS AÑOS DE ACUERDO A LOS
                                PAGOS REGISTRADOS EN LA BD -->
                            <select name="anio" class="form-control" id="anio" title="Año a consultar">
                                <!-- SELECCIONAR AUTOMATICO EL AÑO ACTUAL -->
                                <?php 
                                        for($i = 0; $i < count($anios); $i++){
                                            if ($anios[$i] == $year){
                                ?>
                                        <option value="<?php echo $anios[$i]; ?>" selected><?php echo $anios[$i]; ?></option>

                                <?php
                                            } else {
                                ?>
                                        <option value="<?php echo $anios[$i]; ?>"><?php echo $anios[$i]; ?></option>
                                <?php
                                            }
                                        } 
                                ?>
                            </select>
                        </div>
                        <div class="col-2_2">
                        <input type="number" name="tipo" value="3" hidden>
                            <input type="submit" class="submit_2 btn btn-primary" title="Enviar fecha actual" value="Por año"> 
                        </div>
                    </div>
                </form>

                <!-- BUSCAR POR PERIODO DE TIEMPO -->
                <form action="ingresos.php" method="post">
                    <div class="renglon-modal">
                        <div class="col-4_2">
                            <input type="date" name="fecha1" id="fecha1" class="form-control" title="Fecha de inicio de periodo a consultar">
                        </div>
                        <div class="col-4_2">
                            <input type="date" name="fecha2" id="fecha2" class="form-control" title="Fecha final de periodo a consultar">
                        </div>
                        <div class="col-2_2">
                            <input type="number" name="tipo" value="4" hidden>
                            <input type="submit" class="submit_2 btn btn-primary" title="Enviar fecha actual" value="Periodo"> 
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
  </div>
</div>
