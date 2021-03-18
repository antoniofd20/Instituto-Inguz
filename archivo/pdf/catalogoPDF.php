<?php
    
    require('../../librerias/fpdf182/fpdf.php');
    
    $hoy = getdate();
    $mes = date('Y');
    
    
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
    
            $this->Cell(195, 6, '', 0, 1);
    
            # COMO SI DIERA UN MARGEN A LA IZQUIERDA
            $this->Cell(105, 6, '', 0);
    
            // Título
            // Arial bold 15
            $this->SetFont('Helvetica','B',12);
            $this->SetTextColor(34, 85, 146);
            $this->Cell(90, 6, 'Catalogo', 0, 1, 'R');
            
            # COMO SI DIERA UN MARGEN A LA IZQUIERDA
            $this->Cell(105, 6, '', 0);
    
            # PARA EL TEXTO FECHA
            $this->SetFont('Helvetica','B',12);
            $this->SetTextColor(0,0,0);
            $this->Cell(40, 6, 'Fecha', 0, 0, 'R');
    
            # PARA LA FECHA
            $this->SetFont('Helvetica','',12);
            $this->Cell(50, 6, utf8_decode(date('d') . ' de ' . strtolower($mes) . ' del ' . date('Y')), 0, 1, 'R');
    
            # COMO SI DIERA UN MARGEN A LA IZQUIERDA
            $this->Cell(105, 6, '', 0);
            # PARA EL TEXTO HORA
            $this->SetFont('Helvetica','B',12);
            $this->SetTextColor(0,0,0);
            $this->Cell(40, 6, 'Hora', 0, 0, 'R');
    
            # PARA LA HORA
            $this->SetFont('Helvetica','',12);
            $this->Cell(50, 6, date('G:i:s A'), 0, 1, 'R');
    
            $this->Cell(195, 10, '', 0, 1); 
            
            
            # AGREGAR CICLO PARA IMPRIMIR A TODOS LOS ALUMNOS
            $this->SetFont('Helvetica','',12);
            $this->SetFillColor(47, 82, 143);
            $this->SetTextColor(255, 255, 255);
    
            $this->Cell(40, 6, utf8_decode('Clave'), 0, 0, 'C', true);
            $this->Cell(115, 6, utf8_decode('Descripcion'), 0, 0, 'C', true);
            $this->Cell(40, 6, utf8_decode('Costo'), 0, 1, 'C', true);
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
    $pdf = new PDF('P', 'mm', 'Letter');
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Helvetica','',12);





// Creación del objeto de la clase heredada


# AGREGAR CONSULTA PARA MOSTRAR A LOS ALUMNOS
    // CODE...

$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0, 0, 0);

$pdf->Cell(40, 6, utf8_decode('0001'), 1, 0, 'C', true);
$pdf->Cell(115, 6, utf8_decode('Inscripcion Bachillerato'), 1, 0, 'C', true);
$pdf->Cell(40, 6, utf8_decode('$1,350.00'), 1, 1, 'C', true);

$pdf->Cell(40, 6, utf8_decode('0001'), 1, 0, 'C', true);
$pdf->Cell(115, 6, utf8_decode('Tramite Alta SEP'), 1, 0, 'C', true);
$pdf->Cell(40, 6, utf8_decode('$1,350.00'), 1, 1, 'C', true);

$pdf->Cell(40, 6, utf8_decode('0001'), 1, 0, 'C', true);
$pdf->Cell(115, 6, utf8_decode('Mensualidad'), 1, 0, 'C', true);
$pdf->Cell(40, 6, utf8_decode('$1,350.00'), 1, 1, 'C', true);

$pdf->Cell(40, 6, utf8_decode('0001'), 1, 0, 'C', true);
$pdf->Cell(115, 6, utf8_decode('Guia Bachillerato Ciencias Experimentales'), 1, 0, 'C', true);
$pdf->Cell(40, 6, utf8_decode('$1,350.00'), 1, 1, 'C', true);

$pdf->Cell(40, 6, utf8_decode('0001'), 1, 0, 'C', true);
$pdf->Cell(115, 6, utf8_decode('Guia Bachillerato Ciencias Sociales'), 1, 0, 'C', true);
$pdf->Cell(40, 6, utf8_decode('$1,350.00'), 1, 1, 'C', true);

$pdf->Cell(40, 6, utf8_decode('0001'), 1, 0, 'C', true);
$pdf->Cell(115, 6, utf8_decode('Libro Ingles Nivel 1'), 1, 0, 'C', true);
$pdf->Cell(40, 6, utf8_decode('$1,350.00'), 1, 1, 'C', true);

$pdf->Cell(40, 6, utf8_decode('0001'), 1, 0, 'C', true);
$pdf->Cell(115, 6, utf8_decode('Libro Ingles Nivel 2'), 1, 0, 'C', true);
$pdf->Cell(40, 6, utf8_decode('$1,350.00'), 1, 1, 'C', true);

$pdf->Cell(40, 6, utf8_decode('0001'), 1, 0, 'C', true);
$pdf->Cell(115, 6, utf8_decode('Libro Ingles Nivel 3'), 1, 0, 'C', true);
$pdf->Cell(40, 6, utf8_decode('$1,350.00'), 1, 1, 'C', true);

$pdf->Cell(40, 6, utf8_decode('0001'), 1, 0, 'C', true);
$pdf->Cell(115, 6, utf8_decode('Libro Ingles Nivel 4'), 1, 0, 'C', true);
$pdf->Cell(40, 6, utf8_decode('$1,350.00'), 1, 1, 'C', true);

$pdf->Cell(40, 6, utf8_decode('0001'), 1, 0, 'C', true);
$pdf->Cell(115, 6, utf8_decode('Libro Ingles Nivel 5'), 1, 0, 'C', true);
$pdf->Cell(40, 6, utf8_decode('$1,350.00'), 1, 1, 'C', true);

$pdf->Cell(40, 6, utf8_decode('0001'), 1, 0, 'C', true);
$pdf->Cell(115, 6, utf8_decode('Libro Ingles Nivel 6'), 1, 0, 'C', true);
$pdf->Cell(40, 6, utf8_decode('$1,350.00'), 1, 1, 'C', true);

$pdf->Cell(40, 6, utf8_decode('0001'), 1, 0, 'C', true);
$pdf->Cell(115, 6, utf8_decode('Libro Ingles Nivel 7'), 1, 0, 'C', true);
$pdf->Cell(40, 6, utf8_decode('$1,350.00'), 1, 1, 'C', true);

$pdf->Cell(40, 6, utf8_decode('0001'), 1, 0, 'C', true);
$pdf->Cell(115, 6, utf8_decode('Tamite Liberacion'), 1, 0, 'C', true);
$pdf->Cell(40, 6, utf8_decode('$1,350.00'), 1, 1, 'C', true);

$pdf->Cell(40, 6, utf8_decode('0001'), 1, 0, 'C', true);
$pdf->Cell(115, 6, utf8_decode('Reposicion Acta de Nacimiento'), 1, 0, 'C', true);
$pdf->Cell(40, 6, utf8_decode('$1,350.00'), 1, 1, 'C', true);

$pdf->Cell(40, 6, utf8_decode('0001'), 1, 0, 'C', true);
$pdf->Cell(115, 6, utf8_decode('Recuperacion Certificado de Secundaria'), 1, 0, 'C', true);
$pdf->Cell(40, 6, utf8_decode('$1,350.00'), 1, 1, 'C', true);

$pdf->Cell(40, 6, utf8_decode('0001'), 1, 0, 'C', true);
$pdf->Cell(115, 6, utf8_decode('Constancia de Estudios'), 1, 0, 'C', true);
$pdf->Cell(40, 6, utf8_decode('$1,350.00'), 1, 1, 'C', true);

$pdf->Cell(40, 6, utf8_decode('0001'), 1, 0, 'C', true);
$pdf->Cell(115, 6, utf8_decode('Credencial'), 1, 0, 'C', true);
$pdf->Cell(40, 6, utf8_decode('$1,350.00'), 1, 1, 'C', true);

$pdf->Cell(40, 6, utf8_decode('0001'), 1, 0, 'C', true);
$pdf->Cell(115, 6, utf8_decode('Acto Civico'), 1, 0, 'C', true);
$pdf->Cell(40, 6, utf8_decode('$1,350.00'), 1, 1, 'C', true);

$pdf->Cell(40, 6, utf8_decode('0001'), 1, 0, 'C', true);
$pdf->Cell(115, 6, utf8_decode('Examen de Colocacion'), 1, 0, 'C', true);
$pdf->Cell(40, 6, utf8_decode('$1,350.00'), 1, 1, 'C', true);



## // SE GENERA UN NOMBRE PARA CUANDO SE DESCARGUE EL ARCHIVO

$nombre = 'catalogo' . date('d') . '-' . date('m') . '-' . date('Y') . '.pdf'; 

$pdf->Output('', $nombre);
?>