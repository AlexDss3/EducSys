<?php
$this->load->library('fpdf');

class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        // Arial bold 15
        $this->SetFont('Arial','B',18);
        // Movernos a la derecha
        $this->Cell(80);
        // Título
        $this->Cell(100,10,utf8_decode('Detalles de la planificación'),0,0,'C');
        $this->SetMargins(22, 15);
        // Salto de línea
        $this->Ln(20);
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        
        $this->SetAutoPageBreak(1);
    }
}

$pdf = new PDF();
/* CONFIGURACIÓN DE LA PÁGINA */
$pdf->AddPage('L','Letter');

foreach ($Profesor as $prof) {
    $Nombre = $prof->nombre;
    $Apellido = $prof->apellido;
    /* DATOS DE LA ASIGNATURA */
    $pdf->SetFont('Arial','B',16);
    $pdf->Cell(30,10,utf8_decode("Profesor:"),0,1,'L',0);
    /* PROFESOR */
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(40,10,utf8_decode($Nombre),1,0,'L',0);
    $pdf->Cell(60,10,utf8_decode($Apellido),1,1,'L',0);
    
    $pdf->Cell(30,10,"",0,1,'L',0);
}

/* MATERIA */
$pdf->SetFont('Arial','B',16);
$pdf->Cell(30,10,utf8_decode("Materia:"),0,1,'L',0);
$pdf->SetFont('Arial','',12);
$pdf->Cell(100,10,utf8_decode($Materia),1,1,'L',0);
$pdf->Cell(30,10,"",0,1,'L',0);

/* SECCION */
foreach ($SeccionAsignada as $sa) {
    $Seccion = $sa->seccion;
    $Nivel = $sa->tipo;
    /* SECCION ASIGNADA */
    $pdf->SetFont('Arial','B',16);
    $pdf->Cell(30,10,utf8_decode("Sección asignada:"),0,1,'L',0);
    
    /* SECCIÓN */
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(145,10,utf8_decode($Seccion),1,0,'L',0);

    /* NIVEL EDUCATIVO */
    if($Nivel == "B"){
        $pdf->Cell(35,10,utf8_decode("Básica"),1,1,'L',0);
    }else if($Nivel == "M"){
        $pdf->Cell(35,10,utf8_decode("Bachillerato"),1,1,'L',0);
    }
    $pdf->Cell(30,10,"",0,1,'L',0);
}

/* AÑO */
$pdf->SetFont('Arial','B',16);
$pdf->Cell(25,10,utf8_decode("Año:"),0,0,'L',0);
$pdf->SetFont('Arial','',12);
$pdf->Cell(12,10,utf8_decode($Anio),0,1,'L',0);

$pdf->Cell(30,10,"",0,1,'L',0);

 /* DATOS DE LA PLANIFICACIÓN */
 $pdf->SetFont('Arial','B',12);
 $pdf->Cell(11,10,utf8_decode("Del"),1,0,'L',0);
 $pdf->Cell(11,10,utf8_decode("Al"),1,0,'L',0);
 $pdf->Cell(100,10,utf8_decode("Unidad "),1,0,'L',0);
 $pdf->Cell(100,10,utf8_decode("Tema"),1,0,'L',0);
 $pdf->Cell(12,10,utf8_decode("Ejec."),1,1,'L',0);


foreach ($DatosExportar as $dtexp) {
    $NumeroUnidad = $dtexp->unidad;
    $Unidad = $dtexp->nombreUnidad;
    $SubIndice = $dtexp->correlativo;
    $Tema = $dtexp->tema;
    $Anio = $dtexp->anio;
    $Inicio = $dtexp->desde;
    $Fin = $dtexp->hasta;
    $Realizado = $dtexp->ejecutado;
    

    /* DATOS */
    /* INICIO */
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(11,10,$Inicio,1,0,'L',0);
    $pdf->Cell(11,10,$Fin,1,0,'L',0);

    /* UNIDAD */
    $pdf->Cell(100,10,utf8_decode($NumeroUnidad).". ".utf8_decode($Unidad),1,0,'L',0);
    /* TEMA */
    $pdf->Cell(100,10,utf8_decode($SubIndice).". ".utf8_decode($Tema),1,0,'L',0);

    /* SE EJECUTARÁ */
    $pdf->Cell(12,10,$Realizado,1,1,'L',0);
}

$pdf->Output();