<?php 
header("Pragma: public");
header("Expires: 0");
$filename = "gruposExcel" . date('d-m-Y') . ".xls";
header("Content-type: application/x-msdownload");
header("Content-Disposition: attachment; filename=$filename");
header("Pragma: no-cache");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

# REALIZAR CONSULTA PARA LLENAR LA TABLA 

?>

<table>
    <tbody>
        <tr>
            <th><h1>Grupos</h1></th>
        </tr>
        <tr>
            <th>
                <h2>Grupo</h2>
            </th>
            <th>
                <h2>Especialidad</h2>
            </th>
            <th>
                <h2>Fecha inicio</h2>
            </th>
            <th>
                <h2>Fecha fin</h2>
            </th>
            <th>
                <h2>Alumnos inscritos</h2>
            </th>
        </tr>

        <tr>
            <td>0000</td>
            <td>CIENCIAS</td>
            <td>01/01/2020</td>
            <td>01/06/2020</td>
            <td>15</td>
        </tr>
        <tr>
            <td>0001</td>
            <td>CIENCIAS</td>
            <td>01/01/2020</td>
            <td>01/06/2020</td>
            <td>15</td>
        </tr>
        <tr>
            <td>0002</td>
            <td>CIENCIAS</td>
            <td>01/01/2020</td>
            <td>01/06/2020</td>
            <td>15</td>
        </tr>
        <tr>
            <td>0003</td>
            <td>CIENCIAS</td>
            <td>01/01/2020</td>
            <td>01/06/2020</td>
            <td>15</td>
        </tr>
        <tr>
            <td>0004</td>
            <td>CIENCIAS</td>
            <td>01/01/2020</td>
            <td>01/06/2020</td>
            <td>15</td>
        </tr>
    </tbody>
</table>