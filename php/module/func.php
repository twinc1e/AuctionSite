<?php
	function sec2hms ($sec, $padHours = false)
	  {

	    // start with a blank string
	    $hms = "";

	    // do the hours first: there are 3600 seconds in an hour, so if we divide
	    // the total number of seconds by 3600 and throw away the remainder, we're
	    // left with the number of hours in those seconds
	    $hours = intval(intval($sec) / 3600);

	    // add hours to $hms (with a leading 0 if asked for)
	    $hms .= ($padHours)
	          ? str_pad($hours, 2, "0", STR_PAD_LEFT). ":"
	          : $hours. ":";

	    // dividing the total seconds by 60 will give us the number of minutes
	    // in total, but we're interested in *minutes past the hour* and to get
	    // this, we have to divide by 60 again and then use the remainder
	    $minutes = intval(($sec / 60) % 60);

	    // add minutes to $hms (with a leading 0 if needed)
	    $hms .= str_pad($minutes, 2, "0", STR_PAD_LEFT). ":";

	    // seconds past the minute are found by dividing the total number of seconds
	    // by 60 and using the remainder
	    $seconds = intval($sec % 60);

	    // add seconds to $hms (with a leading 0 if needed)
	    $hms .= str_pad($seconds, 2, "0", STR_PAD_LEFT);

	    // done!
	    return $hms;

	  }

		require('..\..\asset\tfpdf.php');

    class TEmail
    {
        public $from_email;
        public $from_name;
        public $to_email;
        public $to_name;
        public $subject;
        public $data_charset = 'UTF-8';
        public $send_charset = 'windows-1251';
        public $body = '';
        public $type = 'text/plain';

        function send(
					$email='nadusha_28_97@mail.com',
					$email_name='test',
					$from_email = 'torgi@mail.ru',
					$email_subject='Чек победителя',
					$email_msg="it's testing")
        {
					$emailgo = new TEmail; // инициaлизируeм супeр клaсс oтпрaвки
					//$emailgo->from_email= $from_email; // oт кoгo
					$emailgo->from_name= $from_name;
					$emailgo->to_email= $email; // кoму -[почта
					$emailgo->to_name= $email_name;//   -[имя
					$emailgo->subject= $email_subject; // тeмa
					$emailgo->body= 'Поздравляю, вы победили! Вы можете приобрести товар по чеку в вашем личном кабинете по ссылке:'
													+$email_msg; // сooбщeниe*/
					$emailgo->send(); // oтпрaвляeм

        }
    }

		class PDF extends tFPDF
		{
		//Загрузка данных ----didn't use----
		function LoadData($file=null)
		{
		    $data=array();
				if ($file!=null){
				    //Чтение строк из файла
				    $lines=file($file);
				    foreach($lines as $line)
				      $data[]=explode(';',chop($line));
				}
				// $query = "SELECT item.itemname, bidHistory.price FROM item, bidHistory WHERE bidHistory.item_id = item.item_id AND item.winner=bidHistory.user_id ORDER BY item.item_id DESC";
				// $result = $mysqli->query($query)or die('Ошибка '.$mysqli->error);
				// if(mysqli_num_rows($result) != 0)
				// 	$data = mysqli_fetch_array($result);
		    return $data;
		}
		function simplepdfTable($header,$data)
		{
				//Заголовок
			foreach($header as $col)
					$this->Cell(40,7,$col,1);
			$this->Ln();
	 //var_dump($header,"----",$data);
			//Данные
			foreach($data as $row)
			{
					for($col=0;$col<count($row);$col++)
					//foreach($row as $col)
							$this->Cell(40,6,$row[$col],1);
					$this->Ln();
			}
		}

		function pdfTable($header,$data)
		{//Создание таблицы с чеком
			//Ширина колонки
			    $w=array(40,40,40,40);
			    //Заголовок
			    for($i=0;$i<count($header);$i++)
			        $this->Cell($w[$i],7,$header[$i],1);//,0,'C'
			    $this->Ln();
			    //Данные
			    foreach($data as $row)
			    {
			        $this->Cell($w[0],6,$row[0],1,'LR');
			        $this->Cell($w[1],6,$row[1],1,'LR');//количество
			        $this->Cell($w[2],6,$row[2],1,'LR',0,'R');//
			        $this->Cell($w[3],6,$row[3],1,'LR',0,'R');
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

function printToPDF($data=null)
{
	define('FPDF_FONTPATH','font/');
//require('printing.class.php');
	$pdf=new PDF();
	//http://auctionsite/asset/itemImg/logo.jpg
	//Заголовки столбцов
	$header=array('Name, Count, Price, Summary');
	//Загрузка данных
//$data=$pdf->LoadData(/*из бд нужные данные в txt файле*/);
 	$pdf->AddFont('ArialMT','','arial.php');
 	$pdf->SetFont('ArialMT','',14);
	$pdf->AddPage();
	//var_dump("db = ",$data,"!");
	$pdf->simplepdfTable($header,$data);
	// $pdf->pdfTable($header,$data);
	// $pdf->Output();

	//$pdf->Cell(960,500,include 'file.php');
	$pdf->Output("For_winner.pdf");
}
