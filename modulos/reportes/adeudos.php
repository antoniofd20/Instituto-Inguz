<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="../../FontAwesome/css/font-awesome.css">
    
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@400;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@1,900&display=swap" rel="stylesheet">
    
    <!-- ESTILOS CSS -->
    <link rel="stylesheet" href="../../css/tablas.css">
    <link rel="stylesheet" href="../../css/ingresos.css">


    <title>Adeudos</title>
</head>
<body>
<div class="cont-centrado">
    <a href="inicio.php">
        <img src="../../img/logo.png" alt="" class="logo logo-deudas" title="Regresar al inicio">
    </a>
    <header>
        <h1 class="title">Reporte de adeudos de alumnos</h1>
        <h3 class="subtitulo">Adeudos del 6 de FEBRERO del 2021</h3>
    </header>
</div>

<div class="cont-centrado">
    <div class="main-container">
            <div class="tabla-scroll-container">

                <table class="tabla-scroll">
                    <colgroup>
                        <!-- CLAVE -->
                        <col style="width: 5%; min-width: 5%">
                        <!-- NOMBRE -->
                        <col style="width: 30%; min-width: 30%">
                        <!-- ESPECIALIDAD -->
                        <col style="width: 10%; min-width: 10%">
                        <!-- CONCEPTO -->
                        <col style="width: 10%; min-width: 10%">
                        <!-- IMPORTE -->
                        <col style="width: 10%; min-width: 10%">
                    </colgroup>
                    <thead>
                        <th>CLAVE</th>
                        <th>NOMBRE</th>
                        <th>ESPECIALIDAD</th>
                        <th>CONCEPTO</th>
                        <th>IMPORTE</th>
                    </thead>

                    <tr>
                        <td>0000</td>

                        <td class="izquierda">RAYMUNDO ANTONIO FLORES DIAZ</td>

                        <td>SOCIALES</td>

                        <td class="izquierda">MENSUALIDAD</td>

                        <td class="derecha">1,000.00</td>
                    </tr>

                    <tr>
                        <td>0001</td>
                        <td class="izquierda">CESAR ALEJANDRO BONILLA JARAMILLO</td>
                        <td>SOCIALES</td>
                        <td class="izquierda">RECARGO</td>
                        <td class="derecha">110.00</td>
                    </tr>

                    <tr>
                        <td>0002</td>
                        <td class="izquierda">BEATRIZ DIAZ RODRIGUEZ</td>
                        <td>CIENCIAS</td>
                        <td class="izquierda">CRUCE MES</td>
                        <td class="derecha">122.00</td>
                        </td>
                    </tr>

                    <tr>
                        <td>0003</td>
                        <td class="izquierda">ALDO GALLEGOS GALLEGOS</td>
                        <td>CIENCIAS</td>
                        <td class="izquierda">GUÍA</td>
                        <td class="derecha">100.00</td>
                    </tr>

                    <tr>
                        <td>0004</td>
                        <td class="izquierda">JONATAN ROMERO OJEDA</td>
                        <td>SOCIALES</td>
                        <td class="izquierda">CRUCE MES</td>
                        <td class="derecha">122.00</td>
                    </tr>
                </table>
            </div>
            <h3 class="total">Total: $1,454.00</h3>
        </div>
        </div>
    

    <div id="divModal"></div>

    <footer>
        <a href="list.php" class="btn primary">Regresar</a>
    </footer>

</body>
</html>