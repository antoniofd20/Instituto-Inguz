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
            $this->Cell(90, 6, 'Resumen de ingresos', 0, 1, 'R');
            
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
    $pdf->SetFillColor(255, 255, 255);
    
    $pdf->SetTextColor(34, 85, 146);
    $pdf->SetFont('Helvetica','B',14);
    $pdf->Cell(0, 7, 'Reporte de ingresos', 0, 1, 'C');
    
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('Helvetica','',12);
    $pdf->Cell(0, 6, 'Ingresos del dia tal al dia tal', 0, 1, 'C');

    $pdf->Cell(0, 6, '', 0, 1);

    ## // RESUMEN DE COBRANZA
    $pdf->SetFont('Helvetica','B',12);
    $pdf->Cell(0, 6, 'Resumen de cobranza', 0, 1, 'L');

    $pdf->SetFont('Helvetica','',12);
    $pdf->SetFillColor(47, 82, 143);
    $pdf->SetTextColor(255, 255, 255);

    $pdf->Cell(150, 6, 'Concepto', 0, 0, 'C', true);
    $pdf->Cell(45, 6, 'Importe', 0, 1, 'C', true);

    $pdf->SetFillColor(255, 255, 255);
    $pdf->SetTextColor(0, 0, 0);

    $pdf->Cell(150, 6, 'Inscripcion', 1, 0, 'C');
    $pdf->Cell(45, 6, '$7000.00', 1, 1, 'C');

    $pdf->Cell(150, 6, 'Mensualidad Bachillerato', 1, 0, 'C');
    $pdf->Cell(45, 6, '$10800.00', 1, 1, 'C');

    $pdf->Cell(150, 6, 'Mensualidad Ingles', 1, 0, 'C');
    $pdf->Cell(45, 6, '$6000.00', 1, 1, 'C');

    $pdf->Cell(150, 6, 'Libros', 1, 0, 'C');
    $pdf->Cell(45, 6, '$1000.00', 1, 1, 'C');

    $pdf->Cell(150, 6, 'Guias', 1, 0, 'C');
    $pdf->Cell(45, 6, '$800.00', 1, 1, 'C');

    $pdf->Cell(150, 6, 'Examen de colocacion', 1, 0, 'C');
    $pdf->Cell(45, 6, '$20000.00', 1, 1, 'C');

    $pdf->Cell(150, 6, 'Otros Documentos', 1, 0, 'C');
    $pdf->Cell(45, 6, '$500.00', 1, 1, 'C');

    $pdf->Cell(150, 6, 'Credecial', 1, 0, 'C');
    $pdf->Cell(45, 6, '$400.00', 1, 1, 'C');

    $pdf->Cell(150, 6, 'Acto Civico', 1, 0, 'C');
    $pdf->Cell(45, 6, '$1000.00', 1, 1, 'C');

    ## // AGREGAR TOTAL

    $pdf->AddPage();

    ## // RESUMEN DE INSCRIPCIONES
    $pdf->SetTextColor(34, 85, 146);
    $pdf->SetFont('Helvetica','B',14);
    $pdf->Cell(0, 7, 'Reporte de inscripciones', 0, 1, 'C');
    
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('Helvetica','',12);
    $pdf->Cell(0, 6, 'Ingresos del dia tal al dia tal', 0, 1, 'C');
    $pdf->SetFont('Helvetica','B',12);
    $pdf->Cell(0, 6, 'Resumen de inscripciones', 0, 1, 'L');
    
    $pdf->SetFont('Helvetica','',12);
    $pdf->SetFillColor(47, 82, 143);
    $pdf->SetTextColor(255, 255, 255);
    
    ## // ENCABEZADO 
    $pdf->Cell(20, 6, 'Clave', 0, 0, 'C', true);
    $pdf->Cell(70, 6, 'Nombre', 0, 0, 'C', true);
    $pdf->Cell(30, 6, 'Especialidad', 0, 0, 'C', true);
    $pdf->Cell(25, 6, 'Estado', 0, 0, 'C', true);
    $pdf->Cell(25, 6, 'Telefono', 0, 0, 'C', true);
    $pdf->Cell(25, 6, 'Importe', 0, 1, 'C', true);

    ## // CONTENIDO
    $pdf->SetFillColor(255, 255, 255);
    $pdf->SetTextColor(0, 0, 0);

    $pdf->Cell(20, 6, '0001', 1, 0, 'C');
    $pdf->Cell(70, 6, 'Raymundo Antonio Flores Diaz', 1, 0, 'C');
    $pdf->Cell(30, 6, 'CIENCIAS', 1, 0, 'C');
    $pdf->Cell(25, 6, 'ACTIVO', 1, 0, 'C');
    $pdf->Cell(25, 6, '5540713097', 1, 0, 'C');
    $pdf->Cell(25, 6, '$1000.00', 1, 1, 'C');
    $pdf->Cell(20, 6, '0001', 1, 0, 'C');
    $pdf->Cell(70, 6, 'Beatriz Diaz Rodriguez', 1, 0, 'C');
    $pdf->Cell(30, 6, 'SOCIALES', 1, 0, 'C');
    $pdf->Cell(25, 6, 'ACTIVO', 1, 0, 'C');
    $pdf->Cell(25, 6, '5540713097', 1, 0, 'C');
    $pdf->Cell(25, 6, '$1000.00', 1, 1, 'C');
    $pdf->Cell(20, 6, '0001', 1, 0, 'C');
    $pdf->Cell(70, 6, 'Itzel Nayeli Toledo Alvarez', 1, 0, 'C');
    $pdf->Cell(30, 6, 'CIENCIAS', 1, 0, 'C');
    $pdf->Cell(25, 6, 'ACTIVO', 1, 0, 'C');
    $pdf->Cell(25, 6, '5540713097', 1, 0, 'C');
    $pdf->Cell(25, 6, '$1000.00', 1, 1, 'C');
    $pdf->Cell(20, 6, '0001', 1, 0, 'C');
    $pdf->Cell(70, 6, 'Cesar Alejandro Bonilla', 1, 0, 'C');
    $pdf->Cell(30, 6, 'CIENCIAS', 1, 0, 'C');
    $pdf->Cell(25, 6, 'ACTIVO', 1, 0, 'C');
    $pdf->Cell(25, 6, '5540713097', 1, 0, 'C');
    $pdf->Cell(25, 6, '$1000.00', 1, 1, 'C');

    ## // AGREGAR TOTAL


    
## // SE GENERA UN NOMBRE PARA CUANDO SE DESCARGUE EL ARCHIVO

$nombre = 'ingresos' . date('d') . '-' . date('m') . '-' . date('Y') . '.pdf'; 

$pdf->Output('', $nombre);
?>