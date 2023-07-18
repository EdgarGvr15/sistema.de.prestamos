<?php

require('fpdf/fpdf.php');



class PDF extends FPDF
{

   // Cabecera de página
   function Header()
   {
      //include '../../recursos/Recurso_conexion_bd.php';//llamamos a la conexion BD

      //$consulta_info = $conexion->query(" select *from hotel ");//traemos datos de la empresa desde BD
      //$dato_info = $consulta_info->fetch_object();
      $this->SetFont('Times','B',20); 
      $this->Image('uploads/1687893060_Fondoo.png',0,0,680);
      $this->Image('uploads/Mi proyecto.png',168,10,30);
      $this->setXY(50,15,);
      $this->Cell(110,10,utf8_decode('Sistema de registro de prestamos'),1,1,'C',0);
      $this->Ln(15);

      /* TITULO DE LA TABLA */
      //color
      $this->SetTextColor(23, 32, 42);
      $this->Cell(50); // mover a la derecha
      $this->SetFont('Arial', 'B', 15);
      $this->Cell(100, 10, utf8_decode("REPORTE DE PRESTAMOS "), 0, 1, 'C', 0);
      $this->Ln(7);

      /* CAMPOS DE LA TABLA */
      //color93, 173, 226
      $this->SetFillColor(93, 173, 226); //colorFondo
      $this->SetTextColor(23, 32, 42); //colorTexto
      $this->SetDrawColor(163, 163, 163); //colorBorde
      $this->SetFont('Arial', 'B', 11);
      $this->Cell(10, 10, utf8_decode('N°'), 1, 0, 'C', 1);
      $this->Cell(60, 10, utf8_decode('Usuario'), 1, 0, 'C', 1);
      $this->Cell(70, 10, utf8_decode('Fecha Y Hora'), 1, 0, 'C', 1);
      $this->Cell(50, 10, utf8_decode('Equipos'), 1, 1, 'C', 1);
    //  $this->Cell(40, 10, utf8_decode('CARACTERÍSTICAS'), 1, 0, 'C', 1);
     // $this->Cell(30, 10, utf8_decode('ESTADO'), 1, 1, 'C', 1);
   }

   // Pie de página
   function Footer()
   {
      $this->SetY(-15); // Posición: a 1,5 cm del final
      $this->SetFont('Arial', 'B', 8); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C'); //pie de pagina(numero de pagina)

      $this->SetY(-15); // Posición: a 1,5 cm del final
      $this->SetFont('Arial', 'B', 8); //tipo fuente, cursiva, tamañoTexto
      $hoy = date('d/m/Y');
      $this->Cell(355, 10, utf8_decode($hoy), 0, 0, 'C'); // pie de pagina(fecha de pagina)
   }
}

//include '../../recursos/Recurso_conexion_bd.php';
//require '../../funciones/CortarCadena.php';
/* CONSULTA INFORMACION DEL HOSPEDAJE */
//$consulta_info = $conexion->query(" select *from hotel ");
//$dato_info = $consulta_info->fetch_object();


include('db.php');
include('initialize.php');
require('db.php');
require('config.php');
require_once('initialize.php');
require_once('classes/DBConnection.php');
require_once('classes/SystemSettings.php');
$db = new DBConnection;
$conn = $db->conn;


$consulta = ("SELECT * from `patient_list` p inner join `appointments` a on p.id = a.patient_id  order by unix_timestamp(a.date_sched) desc ");


$pdf = new PDF();
$pdf->AddPage(); /* aqui entran dos para parametros (horientazion,tamaño)V->portrait H->landscape tamaño (A3.A4.A5.letter.legal) */
$pdf->AliasNbPages(); //muestra la pagina / y total de paginas

$i = 0;
$pdf->SetFont('Arial', '', 12);
$pdf->SetDrawColor(163, 163, 163); //colorBorde

/*$consulta_reporte_alquiler = $conexion->query("  ");*/
$resultado = mysqli_query($conexion,$consulta);

/*while ($datos_reporte = $consulta_reporte_alquiler->fetch_object()) {      
   }*/

   while($row = $resultado->fetch_assoc()){

$i = $i + 1;

/* TABLA */
$pdf->Cell(10, 8, utf8_decode($i), 1, 0, 'C', 0);
$pdf->Cell(60,8, $row['name'], 1, 0, 'C',0);
$pdf->Cell(70,8, $row['date_sched'], 'B' ,0, 'C',0);
$pdf->Cell(50,8, $row['ailment'], 1, 1,'B' ,0,);
//$pdf->Cell(60, 10, utf8_decode($row->name), 1, 0, 'C', 0);
//$pdf->Cell(70, 10, utf8_decode("fecha y hora"), 1, 0, 'C', 0);
//$pdf->Cell(50, 10, utf8_decode("equipos"), 1, 1, 'C', 0);
//$pdf->Cell(70, 10, utf8_decode("info"), 1, 1, 'C', 0);
//$pdf->Cell(25, 10, utf8_decode("total"), 1, 1, 'C', 0);

    }
    $pdf->Output('reporte de prestamos de equipos.pdf', 'I');//nombreDescarga, Visor(I->visualizar - D->descargar)
?>