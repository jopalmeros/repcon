
<?php

    require('fpdf/fpdf.php');
    date_default_timezone_set('America/El_Salvador');

    class PDF extends FPDF{
        function Header(){
            $this->setY(12);
            $this->setX(10);

            /*
            //$this->Image('img/ftv.jpg',25,5,33);        
            $this->SetFont('times', '', 20);
            $this->Text(60, 15, utf8_decode('El Señor Arzobispo'));
            $this->Text(50, 25, utf8_decode('D. Jorge Carlos Patrón Wong'));
            $this->Text(25,35, utf8_decode(' Administro el Sacramento de Confirmación '));
            //$this->Text(78,33, utf8_decode('noexisteelemail@gamail.com'));

            $this->Image('img/ftv.jpg',160,5,33);
            */
            //información de # de factura
            /*
            $this->SetFont('Arial','B',10);   
            $this->Text(150,48, utf8_decode('FACTURA N°:'));
            $this->SetFont('Arial','',10);  
            $this->Text(176,48, '2002');
            */
            
            // Agregamos los datos del cliente
            /*
            $this->SetFont('Arial','B',10);    
            $this->Text(10,48, utf8_decode('Fecha:'));
            $this->SetFont('Arial','',10);    
            $this->Text(25,48, date('d/m/Y'));
            */
            
            // Agregamos los datos de la factura
            /*
            $this->SetFont('Arial','B',10);    
            $this->Text(10,54, utf8_decode('Cliente:'));
            $this->SetFont('Arial','',10);    
            $this->Text(25,54, 'Mikasa Akerman');
            */
            $this->Ln(50);
        }

        function Footer(){
             $this->SetFont('helvetica', 'B', 8);
                $this->SetY(-15);
                $this->Cell(95,5,utf8_decode('Página ').$this->PageNo().' / {nb}',0,0,'L');
                $this->Cell(95,5,date('d/m/Y | g:i:a') ,00,1,'R');
                $this->Line(10,287,200,287);
                $this->Cell(0,5,utf8_decode("Kodo Sensei © Todos los derechos reservados."),0,0,"C");

        }   


    }


    require ("cn7.php");
    $consulta = "SELECT * FROM confirmacion where num = 1 ";
    $resultado = mysqli_query($conexion, $consulta);

    $pdf = new PDF('P','mm','Letter');
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetAutoPageBreak(true, 20);
    $pdf->SetTopMargin(15);
    $pdf->SetLeftMargin(10);
    $pdf->SetRightMargin(10);

    $pdf->setY(60);$pdf->setX(135);
    $pdf->Ln();

    // En esta parte estan los encabezados
    /*
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(20, 7, utf8_decode('Cod'),1,0,'C',0);
    $pdf->Cell(95, 7, utf8_decode('Descripción'),1,0,'C',0);
    $pdf->Cell(20, 7, utf8_decode('Cant'),1,0,'C',0);
    $pdf->Cell(25, 7, utf8_decode('Precio'),1,0,'C',0);
    $pdf->Cell(25, 7, utf8_decode('Total'),1,1,'C',0);
    */

    //$pdf->SetFont('Arial','',10);

    //Aqui inicia el for con todos los productos
    /*
    for ($i=0; $i < 5; $i++) { 
        $pdf->Cell(20, 7, $i+1,1,0,'L',0);
        $pdf->Cell(95, 7, utf8_decode('Descripción del producto'),1,0,'L',0);
        $pdf->Cell(20, 7, utf8_decode('20'),1,0,'R',0);
        $pdf->Cell(25, 7, utf8_decode('5'),1,0,'R',0);
        $pdf->Cell(25, 7, utf8_decode('100'),1,1,'R',0);
        
    }
    */


    //$this->Image('img/ftv.jpg',25,5,33);        
    $pdf->SetFont('times', '', 20);
    $pdf->Text(55, 10, utf8_decode('Arquidiocesis de Xalapa'));
    $pdf->Text(60, 18, utf8_decode('El Señor Arzobispo'));
    $pdf->Text(50, 26, utf8_decode('D. Jorge Carlos Patrón Wong'));
    $pdf->Text(25,34, utf8_decode(' Administro el Sacramento de Confirmación '));
    //$this->Text(78,33, utf8_decode('noexisteelemail@gamail.com'));

    $pdf->Image('img/ftv.jpg',160,5,33);

    /*
    while ($row=$resultado->fetch_assoc()) {
        $pdf->Cell(80,10,$row['nombre'],1,0,'C',0);
        $pdf->Cell(50,10,$row['precio'],1,0,'C',0);
        $pdf->Cell(50,10,$row['stock'],1,1,'C',0);
    } 
    */

    $pdf->SetFont('Arial','',20);
    //$pdf->Text(27, 45, utf8_decode('A: C A R L O S'));


    while ($row=$resultado->fetch_assoc()) {
        
        //***CONFIRMADO***
        $pdf->Text(27, 45, utf8_decode($row['nom_con']));
        $pdf->line(27,46,195,46);
 
        //***PADRES***
        /*
        $pdf->SetFont('Arial','',12);
        $pdf->Text(27, 53, utf8_decode("Hij"));
        $pdf->SetFont('Arial','u',12);
        //$pdf->Text(32, 53, utf8_decode("a"));
        $pdf->Text(32, 53, utf8_decode($row['hij'])); 
        $pdf->SetFont('Arial','',12);
        $pdf->Text(36, 53, utf8_decode("de:"));
        $pdf->SetFont('Arial','u',12);        
        //$pdf->Text(44, 53, utf8_decode("IRVIN DE JESUS GARCIA APODACA"));
        $pdf->Text(44, 53, utf8_decode($row['padre']));
        */

        $padres = "Hij".$row['hij']." de ". $row['padre'];
        $pdf->SetFont('Arial','',12);
        $pdf->Text(27, 53, utf8_decode($padres));
        //$pdf->Text(44, 60, utf8_decode("NIMBE ANNEL HERNANDEZ PEREZ"));
        $pdf->Text(44, 60, utf8_decode($row['madre']));


        //LUGAR CONFIRMACION:
        /*
        $pdf->SetFont('Arial','',12);
        $pdf->Text(27, 67, utf8_decode("En la parroquia de:"));
        $pdf->SetFont('Arial','u',12);
        //$pdf->Text(64, 67, utf8_decode("SAN SALVADOR"));
        $pdf->Text(64, 67, utf8_decode($row['lugar_confirmacion']));
        */

        $lugar_con = "En la parroquia de: ". $row['lugar_confirmacion'];
        $pdf->SetFont('Arial','',12);
        $pdf->Text(27, 67, utf8_decode($lugar_con));


        //***PARROQUIA DE BAUTISMO***
        /*
        $pdf->SetFont('Arial','',12);
        $pdf->Text(27, 74, utf8_decode("Bautizad"));
        $pdf->SetFont('Arial','u',12);
        $pdf->Text(44, 74, utf8_decode("a"));
        $pdf->SetFont('Arial','',12);
        $pdf->Text(49, 74, utf8_decode("en la parroquia de:"));
        $pdf->SetFont('Arial','u',12);
        //$pdf->Text(85, 74, utf8_decode("Los sagrados corazones de jesus y de maria"));
        $pdf->Text(85, 74, utf8_decode($row['parroquia_bau']));
        */

        $parroquia_bau = "Bautizad". $row['hij']." en la parroquia de: ".$row['parroquia_bau'];
        $pdf->SetFont('Arial','',12);
        $pdf->Text(27, 74, utf8_decode($parroquia_bau));

        //LUGAR BAUTISMO
        /*
        $pdf->SetFont('Arial','',12);
        $pdf->Text(27, 80, utf8_decode("Lugar:"));
        $pdf->SetFont('Arial','u',12);
        //$pdf->Text(40, 80, utf8_decode("Xalapa"));
        $pdf->Text(40, 80, utf8_decode($row['lugar_bau']));
        */

        $lugar_bau = "Lugar: ".$row['lugar_bau'];
        $pdf->SetFont('Arial','',12);
        $pdf->Text(27, 80, utf8_decode($lugar_bau));

        /*
        $pdf->SetFont('Arial','',12);
        $pdf->Text(27, 86, utf8_decode("Estado:"));
        $pdf->SetFont('Arial','u',12);
        //$pdf->Text(42, 86, utf8_decode("Veracruz"));
        $pdf->Text(42, 86, utf8_decode($row['estado_bau']));

        $pdf->SetFont('Arial','',12);
        $pdf->Text(66, 86, utf8_decode("el día"));
        $pdf->SetFont('Arial','u',12);
        //$pdf->Text(78, 86, utf8_decode("25"));
        $pdf->Text(78, 86, utf8_decode($row['dia_bau']));
        $pdf->SetFont('Arial','',12);
        $pdf->Text(86, 86, utf8_decode("de"));
        $pdf->SetFont('Arial','u',12);
        //$pdf->Text(84, 86, utf8_decode("Octubre"));
        $pdf->Text(92, 86, utf8_decode($row['mes_bau']));
        $pdf->SetFont('Arial','',12);
        $pdf->Text(108, 86, utf8_decode("de"));
        $pdf->SetFont('Arial','u',12);
        //$pdf->Text(115, 86, utf8_decode("2015"));
        $pdf->Text(115, 86, utf8_decode($row['ano_bau']));
        */

        //LUGAR Y FECHA E BAUTISMO
        $lf_bau = "Estado: ".$row['estado_bau']." el día ".$row['dia_bau']." de ". $row['mes_bau']." de ". $row['ano_bau'];
        $pdf->SetFont('Arial','',12);
        $pdf->Text(27, 86, utf8_decode($lf_bau));

        //PADRINOS
        /*
        $pdf->SetFont('Arial','',12);
        $pdf->Text(27, 93, utf8_decode("Padrino:"));
        $pdf->SetFont('Arial','u',12);
        //$pdf->Text(45, 93, utf8_decode("*********************************************"));
        $pdf->Text(45, 93, utf8_decode($row['padrino']));
        $pdf->SetFont('Arial','',12);
        $pdf->Text(27, 99, utf8_decode("Madrina:"));
        $pdf->SetFont('Arial','u',12);
        //$pdf->Text(45, 99, utf8_decode("MAYRA GUADALUPE GARCIA APODACA"));
        $pdf->Text(45, 99, utf8_decode($row['madrina']));
        */

        $padrino = "Padrino: ".$row['padrino'];
        $madrina = "Madrina: ".$row['madrina'];
        $pdf->SetFont('Arial','',12);
        $pdf->Text(27, 93, utf8_decode($padrino));
        $pdf->Text(27, 99, utf8_decode($madrina));



        /*
        $pdf->SetFont('Arial','',12);
        $pdf->Text(27,  106, utf8_decode("Chiconquiaco, Ver"));
        $pdf->Text(63,  106, utf8_decode("el día"));
        $pdf->SetFont('Arial','u',12);
        $pdf->Text(75,  106, utf8_decode("25"));
        $pdf->SetFont('Arial','',12);
        $pdf->Text(82, 106, utf8_decode("de"));
        $pdf->SetFont('Arial','u',12);
        $pdf->Text(88, 106, utf8_decode("Marzo"));
        $pdf->SetFont('Arial','',12);
        $pdf->Text(101, 106, utf8_decode("de"));
        $pdf->SetFont('Arial','u',12);
        $pdf->Text(108, 106, utf8_decode("2015"));
        */

        //LUGAR Y FECHA DE CONFIRMACION
        $lf_con = "Chiconquiaco, Ver el día ".$row['dia_con']." de ". $row['mes_con']." de ". $row['ano_con'];
        $pdf->SetFont('Arial','',12);
        $pdf->Text(27, 106, utf8_decode($lf_con));

        //***************************************
        //LINEAS QUE SIRVEN DE MARCO.
        $pdf->SetDrawColor(0,0,0,0);
        $pdf->setlinewidth(1);    
        $pdf->line(0,2,217,2);
        $pdf->line(0,115,217,115);
    }


    //// Apartir de aqui esta la tabla con los subtotales y totales

    /*
    $pdf->Ln(10);
            $pdf->setX(95);
            $pdf->Cell(40,6,'Subtotal',1,0);
            $pdf->Cell(60,6,'4000','1',1,'R');
            $pdf->setX(95);
            $pdf->Cell(40,6,'Descuento',1,0);
            $pdf->Cell(60,6,'4000','1',1,'R');
            $pdf->setX(95);
            $pdf->Cell(40,6,'Impuesto',1,0);
            $pdf->Cell(60,6,'4000','1',1,'R');
            $pdf->setX(95);
            $pdf->Cell(40,6,'Total',1,0);
            $pdf->Cell(60,6,'4000','1',1,'R');
     */
     
    $pdf->Output();
?>