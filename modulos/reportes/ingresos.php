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

    # FUNCION PARA OBTENER EL NOMBRE DE LOS MESES
    function nombreMes($mes){
        switch($mes){
            case 1: return 'ENERO'; break;
            case 2: return 'FEBRERO'; break;
            case 3: return 'MARZO'; break;
            case 4: return 'ABRIL'; break;
            case 5: return 'MAYO'; break;
            case 6: return 'JUNIO'; break;
            case 7: return 'JULIO'; break;
            case 8: return 'AGOSTO'; break;
            case 9: return 'SEPTIEMBRE'; break;
            case 10: return 'OCTUBRE'; break;
            case 11: return 'NOVIEMBRE'; break;
            case 12: return 'DICIEMBRE'; break;
        }
    }

    # RECIBIR DATOS POST PARA DESPUES MOSTRARLOS EN PANTALLA
    if(isset($_POST['tipo'])){

        # SI LA CONSULTA ES POR EL DIA ACTUAL (tipo == 1)
        if($_POST['tipo'] == 1){
            $hoy = $_POST['hoy'];
            
            $dia = substr($hoy, 0, -7);
            $mes = substr($hoy, 2, -5);
            $year = substr($hoy, 4);
            
            $mesNombre = nombreMes($mes);
            $title = 'Ingresos del ' . $dia . ' de ' . $mesNombre . ' del ' . $year;

            #echo $title;

            # HACER TODAS LAS CONSULTAS PARA LLENAR LAS PESTAÑAS DE LA PAGINA


        # SI LA CONSULTA ES POR MES (tipo == 2)
        } else if($_POST['tipo'] == 2){ 
            $mes = $_POST['mes'];
            $year = $_POST['anio_mes'];

            $mesNombre = nombreMes($mes);
            $title = 'Ingresos de ' . $mesNombre . ' del ' . $year;

            #echo $title;

            # HACER TODAS LAS CONSULTAS PARA LLENAR LAS PESTAÑAS DE LA PAGINA
   
            
        # SI LA CONSULTA ES POR AÑO (tipo == 3)
        } else if($_POST['tipo'] == 3){
            $year = $_POST['anio'];

            $title = 'Ingresos del año ' . $year;
            
            #echo $title;

            # HACER TODAS LAS CONSULTAS PARA LLENAR LAS PESTAÑAS DE LA PAGINA


        # SI LA CONSULTA ES POR UN PERIODO (tipo == 4)
        } else if($_POST['tipo'] == 4){
            $fecha1 = $_POST['fecha1'];
            $fecha2 = $_POST['fecha2'];

            # DATOS DE LA FECHA 1
            $dia1 = substr($fecha1, 8);
            $mes1 = substr($fecha1, 5, -3);
            $mes1 = nombreMes($mes1);
            $year1 = substr($fecha1, 0, -6);

            # DATOS DE LA FECHA 2
            $dia2 = substr($fecha2, 8);
            $mes2 = substr($fecha2, 5, -3);
            $mes2 = nombreMes($mes2);
            $year2 = substr($fecha2, 0, -6);

            $title = 'Ingresos del ' . $dia1 . ' de ' . $mes1 . ' del ' . $year1 . ' al ' . $dia2 . ' de ' . $mes2 . ' del ' . $year2;

            #echo $title;
        }
    }

?>

<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- FONTAWESOME LOCAL -->
    <link rel="stylesheet" href="../../FontAwesome/css/font-awesome.css">
    
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@400;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@1,900&display=swap" rel="stylesheet">
    
    <!-- BOOTSTRAP LOCAL-->
    <link rel="stylesheet" href="../../css/bootstrap/bootstrap.css">
    
    <!-- ESTILOS CSS -->
    <link rel="stylesheet" href="../../css/ingresos.css">
    <link rel="stylesheet" href="../../css/modal.css">
    <link rel="stylesheet" href="../../css/tablas.css">

    <!-- JQUERY  LOCAL -->
    <!--<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>-->
    <script src="../../jquery/jquery-3.5.1.js"></script>
    
    <!-- JavaScript local -->
    <script src="../../jquery/jquery_bootstrap.js"></script>
    <script src="../../js/bootstrap.min.js"></script>

    <title>Ingresos</title>

    <style type="text/css">
        .highcharts-figure, .highcharts-data-table table {
            min-width: 320px; 
            max-width: 800px;
            margin: 1em auto;
        }

        .highcharts-data-table table {
            font-family: Verdana, sans-serif;
            border-collapse: collapse;
            border: 1px solid #EBEBEB;
            margin: 10px auto;
            text-align: center;
            width: 100%;
            max-width: 500px;
        }
        .highcharts-data-table caption {
            padding: 1em 0;
            font-size: 1.2em;
            color: #555;
        }
        .highcharts-data-table th {
            font-weight: 600;
            padding: 0.5em;
        }
        .highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
            padding: 0.5em;
        }
        .highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
            background: #f8f8f8;
        }
        .highcharts-data-table tr:hover {
            background: #f1f7ff;
        }


        input[type="number"] {
            min-width: 50px;
        }
	</style>
</head>
<body>
    <!-- SCRIPTS NECESARIOS PARA GRAFICA -->
    <script src="../../librerias/Highcharts-9.0.0/code/highcharts.js"></script>
    <script src="../../librerias/Highcharts-9.0.0/code/exporting.js"></script>
    <script src="../../librerias/Highcharts-9.0.0/code/export-data.js"></script>
    <script src="../../librerias/Highcharts-9.0.0/code/accessibility.js"></script>

    <a href="inicio.php">
        <img src="../../img/logo.png" alt="" class="logo" title="Regresar al inicio">
    </a>
    <header>
        <h1 class="title">Reporte de ingresos</h1>
        <h3 class="subtitulo"><?php echo $title; ?></h3>

        <!-- CONTENEDOR PARA LOS ICONOS -->
        <div class="flex">
            <!-- EXPORTAR A ALGUN TIPO DE DOCUMENTO -->
            <div class="exportar">
                <a href="archivo/pdf/ingresosPDF.php" target="blank">
                    <i class="icono-flex pdf fa fa-file-pdf-o" aria-hidden="true"></i>
                </a>
                <a href="#">
                    <i class="icono-flex excel fa fa-file-excel-o" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </header>

    <div class="container">
        <ul class="tabs">
            <li><a href="#cobranza"><i class="fa fa-money"></i><span class="tab-text">Cobranza</span></a></li>
            <li><a href="#inscripcion"><i class="fa fa-address-card-o"></i><span class="tab-text">Inscripción</span></a></li>
            <li><a href="#mensualidad"><i class="fa fa-calendar"></i><span class="tab-text">Mensualidad</span></a></li>
            <li><a href="#libros"><i class="fa fa-book"></i><span class="tab-text">libros/Guías</span></a></li>
        </ul>

        <div class="secciones">
            <!-- SECCION DE COBRANZA -->
            <article id="cobranza">
                <div class="enacabezado">
                    <h2 class="titulo">Resumen de Cobranza</h2>
                    <a href="javascript:void(0)" onclick="consultaIngresos()" class="link">Consultar nueva fecha</a>
                </div>

                <!-- CONTENEDOR DE TABLA Y GRAFICA -->
                <div class="contenedor-grafica">

                    <!-- CONTENEDOR DE LA TABLA -->
                    <div class="cont-izq">
    
                        <table class="tabla">
                            <colgroup>
                                <col style="width: 70%; min-width: 70%">
                                <col style="width: 30%; min-width: 30%">
                            </colgroup>
        
                            <thead>
                                <th>CONCEPTO</th>
                                <th>IMPORTE</th>
                            </thead>
        
                            <tr>
                                <td class="concepto">Inscripción</td>
                                <td class="importe">7,000.00</td>
                            </tr>
                            <tr>
                                <td class="concepto">Mensualidad Bachillerato</td>
                                <td class="importe">10,800.00</td>
                            </tr>
                            <tr>
                                <td class="concepto">Mensualidad Inglés</td>
                                <td class="importe">6,000.00</td>
                            </tr>
                            <tr>
                                <td class="concepto">Libros</td>
                                <td class="importe">1,000.00</td>
                            </tr>
                            <tr>
                                <td class="concepto">Guías</td>
                                <td class="importe">800.00</td>
                            </tr>
                            <tr>
                                <td class="concepto">Examén de Colocación</td>
                                <td class="importe">2,000.00</td>
                            </tr>
                            <tr>
                                <td class="concepto">Otros Documentos</td>
                                <td class="importe">500.00</td>
                            </tr>
                            <tr>
                                <td class="concepto">Credencial</td>
                                <td class="importe">400.00</td>
                            </tr>
                            <tr>
                                <td class="concepto">Acto Cívico</td>
                                <td class="importe">1,000.00</td>
                            </tr>
                        </table>
                        <h3 class="total">Total: $29,500.00</h3>
                    </div>

                    <!-- CONTENEDOR DE LA GRAFICA -->
                    <div class="cont-der">
                        <figure class="highcharts-figure">
                            <div id="container"></div>
                            <p class="highcharts-description">
                            </p>
                        </figure>
                    </div>
                </div>
            </article>
            <!-- SECCION DE INSCRIPCIONES -->
            <article id="inscripcion">
                <div class="enacabezado">
                    <h2 class="titulo">Resumen de Inscripciones</h2>
                    <a href="javascript:void(0)" onclick="consultaIngresos()" class="link">Consultar nueva fecha</a>
                </div>
                <table class="tabla">
                    <colgroup>
                        <col style="width: 10%; min-width: 10%">
                        <col style="width: 35%; min-width: 40%">
                        <col style="width: 15%; min-width: 15%">
                        <col style="width: 15%; min-width: 10%">
                        <col style="width: 15%; min-width: 15%">
                        <col style="width: 10%; min-width: 10%">
                    </colgroup>

                    <thead>
                        <th>MATRICULA</th>
                        <th>NOMBRE</th>
                        <th>ESPECIALIDAD</th>
                        <th>ESTADO</th>
                        <th>TELÉFONO</th>
                        <th>IMPORTE</th>
                    </thead>

                    <tr>
                        <td class="center">0001</td>
                        <td>Flores Diaz Raymundo</td>
                        <td class="center">CIENCIAS</td>
                        <td class="center">ACTIVO</td>
                        <td class="center">5540713097</td>
                        <td  class="importe">1,000.00</td>
                    </tr>

                    <tr>
                        <td class="center">0002</td>
                        <td>Toledo Alvarez Nayeli</td>
                        <td class="center">SOCIALE</td>
                        <td class="center">ACTIVO</td>
                        <td class="center">5544556688</td>
                        <td  class="importe">1,000.00</td>
                    </tr>
                </table>
                <h3 class="total">Total: $2,000.00</h3>
            </article>
            <!-- SECCION DE MENSUALIDAD -->
            <article id="mensualidad">
                <div class="enacabezado">
                    <h2>Mensualidad Bachillerato</h2>
                    <a href="javascript:void(0)" onclick="consultaIngresos()" class="link">Consultar nueva fecha</a>
                </div>
                <table class="tabla">
                    <colgroup>
                        <col style="width: 20%; min-width: 20%">
                        <col style="width: 40%; min-width: 40%">
                        <col style="width: 20%; min-width: 20%">
                        <col style="width: 20%; min-width: 20%">
                    </colgroup>

                    <thead>
                        <th>MATRICULA</th>
                        <th>NOMBRE</th>
                        <th>MES</th>
                        <th>IMPORTE</th>
                    </thead>

                    <tr>
                        <td class="center">0001</td>
                        <td>Flores Diaz Raymundo</td>
                        <td class="center">1</td>
                        <td  class="importe">1,000.00</td>
                    </tr>

                    <tr>
                        <td class="center">0002</td>
                        <td>Toledo Alvarez Nayeli</td>
                        <td class="center">2</td>
                        <td  class="importe">1,000.00</td>
                    </tr>
                </table>
                <h3 class="subtotal">Subtotal: $2,000.00</h3>

                <h1>Mensualidad Inglés</h1>
                <table class="tabla">
                    <colgroup>
                        <col style="width: 20%; min-width: 20%">
                        <col style="width: 40%; min-width: 40%">
                        <col style="width: 20%; min-width: 20%">
                        <col style="width: 20%; min-width: 20%">
                    </colgroup>

                    <thead>
                        <th>MATRICULA</th>
                        <th>NOMBRE</th>
                        <th>MES</th>
                        <th>ESTADO</th>
                    </thead>

                    <tr>
                        <td class="center">0001</td>
                        <td>Flores Diaz Raymundo</td>
                        <td class="center">1</td>
                        <td  class="importe">1,000.00</td>
                    </tr>
                </table>
                <h3 class="subtotal">Subtotal: $1,000.00</h3>
                <h3 class="total">Total: $3,000.00</h3>
            </article>
            <!-- SECCION DE LIBROS -->
            <article id="libros">
                <div class="enacabezado">
                    <h2>Libros</h2>
                    <a href="javascript:void(0)" onclick="consultaIngresos()" class="link">Consultar nueva fecha</a>
                </div>
                <table class="tabla">
                    <colgroup>
                        <col style="width: 20%; min-width: 20%">
                        <col style="width: 40%; min-width: 40%">
                        <col style="width: 20%; min-width: 20%">
                        <col style="width: 20%; min-width: 20%">
                    </colgroup>

                    <thead>
                        <th>MATRICULA</th>
                        <th>NOMBRE</th>
                        <th>MATERIA</th>
                        <th>IMPORTE</th>
                    </thead>

                    <tr>
                        <td class="center">0001</td>
                        <td>Flores Diaz Raymundo</td>
                        <td class="center">MATEMÁTICAS</td>
                        <td  class="importe">1,000.00</td>
                    </tr>

                    <tr>
                        <td class="center">0002</td>
                        <td>Toledo Alvarez Nayeli</td>
                        <td class="center">HISTORIA</td>
                        <td  class="importe">1,000.00</td>
                    </tr>
                </table>
                <h3 class="subtotal">Subtotal: $2,000.00</h3>

                <h1>Guías</h1>
                <table class="tabla">
                    <colgroup>
                        <col style="width: 20%; min-width: 20%">
                        <col style="width: 40%; min-width: 40%">
                        <col style="width: 20%; min-width: 20%">
                        <col style="width: 20%; min-width: 20%">
                    </colgroup>

                    <thead>
                        <th>MATRICULA</th>
                        <th>NOMBRE</th>
                        <th>NIVEL</th>
                        <th>ESTADO</th>
                    </thead>

                    <tr>
                        <td class="center">0001</td>
                        <td>Flores Diaz Raymundo</td>
                        <td class="center">1</td>
                        <td  class="importe">1,000.00</td>
                    </tr>
                </table>
                <h3 class="subtotal">Subtotal: $1,000.00</h3>
                <h3 class="total">Total: $3,000.00</h3>
            </article>
        </div>
    </div>

    <div id="divModal"></div>

    <footer>
        <a href="list.php" class="btn primary">Regresar</a>
    </footer>

    <script type="text/javascript">
        // AQUI VAN TODOS LOS DATOS QUE LA GRAFICA NECESITA
        Highcharts.chart('container', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Representacion grafica del resumen de cobranza'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                    }
                }
            },
            series: [{
                name: 'Porcentaje',
                colorByPoint: true,
                data: [{
                    name: 'Inscripcion',
                    y: 23.72,
                    sliced: false,
                    selected: true
                }, {
                    name: 'Mes Bachillerato',
                    y: 36.61
                }, {
                    name: 'Mes Ingles',
                    y: 20.33
                }, {
                    name: 'Libros',
                    y: 3.38
                }, {
                    name: 'Guias',
                    y: 2.71
                }, {
                    name: 'Examen Colocacion',
                    y: 6.77
                }, {
                    name: 'Otros docs',
                    y: 1.69
                }, {
                    name: 'Credencial',
                    y: 1.35
                }, {
                    name: 'Acto Civico',
                    y: 3.38
                }]
            }]
        });
	</script>

    <script>
        // LE ASIGNO LA CLASE ACTIVE A LA PRIMERA SECCION
        $('ul.tabs li a:first').addClass('active');
        // ESCONDO LOS ARTICULOS
        $('.secciones article').hide();
        // INDICO QUE MUESTRE SOLO EL PRIMERO
        $('.secciones article:first').show();

        // AL DAR CLICK EN CUALQUIER ELEMENTO
        $('ul.tabs li a').click(function(){
            // REMUEVE LA CLASE DE CUALQUIER ELEMENTO
            $('ul.tabs li a').removeClass('active');
            // SE LA ASIGNA A LA QUE SELECCIONAMOS
            $(this).addClass('active');
            // OCULTAMOS TODOS LOS ARTICULOS
            $('.secciones article').hide();

            // TRAEMOS EL ATRIBUTO HREF DEL ELEMENTO SELECCIONADO
            var activeTab = $(this).attr('href');
            // MOSTRAMOS EL SELECCIONADO
            $(activeTab).show();
            return false;
        });


        function consultaIngresos() {
            var ruta = 'modal_conuslta_ingresos.php';
            console.log(ruta);
            $.get(ruta, function(data){
                $('#divModal').html(data);
                $('#miModal').modal('show');
            });
        }
    </script>
</body>
</html>