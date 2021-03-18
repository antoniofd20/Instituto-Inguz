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
    
    require('../../librerias/fpdf182/fpdf.php');
    
    $hoy = getdate();
    $mes = $hoy['mon'];
    
    
    switch($mes){
        case 1: $mes = 'ENERO'; break;
        case 2: $mes = 'FEBRERO'; break;
        case 3: $mes = 'MARZO'; break;
        case 4: $mes = 'ABRIL'; break;
        case 5: $mes = 'MAYO'; break;
        case 6: $mes = 'JUNIO'; break;
        case 7: $mes = 'JULIO'; break;
        case 8: $mes = 'AGOSTO'; break;
        case 9: $mes = 'SEPTIEMBRE'; break;
        case 10: $mes = 'OCTUBRE'; break;
        case 11: $mes = 'NOVIEMBRE'; break;
        case 12: $mes = 'DICIEMBRE'; break;
    }


    class PDF extends FPDF {
        // Cabecera de página
        function Header() {
            global $mes;
            // Logo
            $this->Image('../../img/logo.png',10,8,33);
    
            $this->Cell(260, 6, '', 0, 1);
    
            # COMO SI DIERA UN MARGEN A LA IZQUIERDA
            $this->Cell(170, 6, '', 0);
    
            // Título
            // Arial bold 15
            $this->SetFont('Helvetica','B',12);
            $this->SetTextColor(34, 85, 146);
            $this->Cell(90, 6, 'Todos los profesores registrados', 0, 1, 'R');
            
            # COMO SI DIERA UN MARGEN A LA IZQUIERDA
            $this->Cell(170, 6, '', 0);
    
            # PARA EL TEXTO FECHA
            $this->SetFont('Helvetica','B',12);
            $this->SetTextColor(0,0,0);
            $this->Cell(40, 6, 'Fecha', 0, 0, 'R');
    
            # PARA LA FECHA
            $this->SetFont('Helvetica','',12);
            $this->Cell(50, 6, utf8_decode(date('d') . ' de ' . strtolower($mes) . ' del ' . date('Y')), 0, 1, 'R');
    
            # COMO SI DIERA UN MARGEN A LA IZQUIERDA
            $this->Cell(170, 6, '', 0);
            # PARA EL TEXTO HORA
            $this->SetFont('Helvetica','B',12);
            $this->SetTextColor(0,0,0);
            $this->Cell(40, 6, 'Hora', 0, 0, 'R');
    
            # PARA LA HORA
            $this->SetFont('Helvetica','',12);
            $this->Cell(50, 6,date('G:i:s A'), 0, 1, 'R');
    
            $this->Cell(260, 10, '', 0, 1); 
            
            
            # AGREGAR CICLO PARA IMPRIMIR A TODOS LOS ALUMNOS
            $this->SetFont('Helvetica','',12);
            $this->SetFillColor(47, 82, 143);
            $this->SetTextColor(255, 255, 255);
    
            $this->Cell(15);
            $this->Cell(30, 6, utf8_decode('Clave'), 0, 0, 'C', true);
            $this->Cell(80, 6, utf8_decode('Nombre'), 0, 0, 'C', true);
            $this->Cell(65, 6, utf8_decode('Profesion'), 0, 0, 'C', true);
            $this->Cell(30, 6, utf8_decode('Especialidad'), 0, 0, 'C', true);
            $this->Cell(30, 6, utf8_decode('Celular'), 0, 1, 'C', true);
        }
    
        // Pie de página
        function Footer() {
            // Posición: a 1,5 cm del final
            $this->SetY(-15);
            // Arial italic 8
            $this->SetFont('Arial','I',8);
            // Número de página
            $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
        }
    }

    // Creación del objeto de la clase heredada
    $pdf = new PDF('L', 'mm', 'Letter');
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Helvetica','',10);





// Creación del objeto de la clase heredada


# AGREGAR CONSULTA PARA MOSTRAR A LOS ALUMNOS
    // CODE...

$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetDrawColor(146, 143, 142);

## // LISTAR A TODOS LOS COLABORADORES SI NO SE HA INGRESADO BUSQUEDA
$qprofs = $conexion->query(
    "SELECT * FROM tbpersona pe
    JOIN tbprofesor pr ON (pe.idpersona = pr.persona)
    ORDER BY claveprofesor"
) or die("Error al obtener los colaboradores " . mysqli_error($conexion));

while($prof = $qprofs->fetch_assoc()){
    ## // VISUALMENTE SE VERA 0001, 0002, 0003...
    $clave = '0000' . $prof['claveprofesor'];
    $clave = substr($clave, -4);


    $numero = intval($prof['especialidad']);

    $especialidad = $conexion->query(
        "SELECT * FROM catespecialidad
        WHERE idespecialidad = '$numero'"
    ) or die ("Error al obtener la especialidad del profesor " . mysqli_error($conexion));

    $e = $especialidad->fetch_assoc();

    $pdf->Cell(15);
    $pdf->Cell(30, 6, utf8_decode($clave), 1, 0, 'C', true);
    $pdf->Cell(80, 6, utf8_decode($prof['nombre'] . ' ' . $prof['apaterno'] . ' ' .  $prof['amaterno']), 1, 0, 'L', true);
    $pdf->Cell(65, 6, utf8_decode($prof['profesion']), 1, 0, 'L', true);

    $pdf->Cell(30, 6, utf8_decode($e['nombre']), 1, 0, 'C', true);
    $pdf->Cell(30, 6, utf8_decode($prof['celular']), 1, 1, 'C', true);

}

$nombre = 'profesores' . date('d') . '-' . date('m') . '-' . date('Y') . '.pdf'; 

$pdf->Output('', $nombre);
?>