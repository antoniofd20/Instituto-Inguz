<?php 
header("Pragma: public");
header("Expires: 0");
$filename = "CatalogoExcel" . date('d-m-Y') . ".xls";
header("Content-type: application/x-msdownload");
header("Content-Disposition: attachment; filename=$filename");
header("Pragma: no-cache");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

# REALIZAR CONSULTA PARA LLENAR LA TABLA 

?>

<table>
    <tbody>
        <tr>
            <th><h1>Catalogo</h1></th>
        </tr>
        <tr>
            <th>
                <h2>Clave</h2>
            </th>
            <th>
                <h2>Descripcion</h2>
            </th>
            <th>
                <h2>Costo</h2>
            </th>
        </tr>

        <tr>
            <td>5001</td>
            <td>Inscripcion Bachillerato</td>
            <td>$1,350.00</td>
        </tr>

    </tbody>
</table>