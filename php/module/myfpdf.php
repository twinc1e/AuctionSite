<?
		require('../../asset/tfpdf.php');
		class PDF extends tFPDF{
			function pdfTable($header,$data)
			{//Создание таблицы с чеком
					//Ширина колонки
			    $w=array(40,40,40,40);
			    //Заголовок
			    for($i=0;$i<count($header);$i++)
			        $this->Cell($w[$i],7,$header[$i],1,'C');//,0,'C'
			    $this->Ln();
			    //Данные
					//var_dump('my',$data);
			    foreach($data as $row)
			    {
			        $this->Cell($w[0],6,$row[0],1,'LR');
			        $this->Cell($w[1],6,$row[1],1,'LR');//количество
			        $this->Cell($w[2],6,$row[2],1,'LR');//
			        $this->Cell($w[3],6,$row[2],1,'LR');
			        $this->Ln();
			    }
			    //Линия закрытия (последняя линия)
			    $this->Cell(array_sum($w),0,'','T');
		}

		function Title($title,$image,$company_name,$company_adres,$company_tel,$company_site) {
        $this->Image($image,6,6,30,20);
        $this->Cell(30); // выводим пустую ячейку, ширина которой 30
        $this->SetFont('Arial-BoldMT','',10); // задаем шрифт, и размер шрифта
        $this->Cell(40,4,$company_name,0,0,'L',0); // выводим название компании
        $this->Cell(70);
        $this->SetFillColor(187,189,189);  // задаем цвет заливки следующих ячеек (R,G,B)
        $this->Cell(50,4,$title,0,0,'C',1); // выводим наименование компании
        $this->ln(); // переходим на следующую строку
        $this->Cell(30);
        $this->SetFont('ArialMT','',10);
        $this->Cell(40,4,$company_adres,0,10,'L',0); // выводим адрес компании
        $this->Cell(40,4,$company_tel,0,10,'L',0); // выводим телфон компании
        $this->Cell(40,4,$company_site,0,10,'L',0); // выводим адрес сайта компании
        $this->ln();
        $this->ln();
	}
}
//-----------
function printToPDF($data)
{
	define('FPDF_FONTPATH','font/');
//require('printing.class.php');
	$pdf=new PDF();
	//http://auctionsite/asset/itemImg/logo.jpg
	//Заголовки столбцов
	$header=['ID', 'Name', 'Price', 'Summary'];
	//Загрузка данных
//$data=$pdf->LoadData(/*из бд нужные данные в txt файле*/);
 	$pdf->AddFont('ArialMT','','arial.php');
 	$pdf->SetFont('ArialMT','',14);
	$pdf->AddPage();
	//var_dump("db = ",$data,"!");
	$pdf->pdfTable($header,$data);
	// $pdf->pdfTable($header,$data);
	// $pdf->Output();
	//$pdf->Cell(960,500,include 'file.php');
	$pdf->Output("For_winner.pdf","../../");
}
//------open func from url without request
if (isset($_GET['exportEl'])) {
    printToPDF($exportEl);
		var_dump( "data_yes",$exportEl);
		$_SESSION['notice'] = "Экспорт прошел успешно";
  }else{
		var_dump( "data_no");
		$_SESSION['notice'] = "Экспорт прошел успешно";
	}
