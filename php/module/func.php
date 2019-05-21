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
		require('fpdf.php');
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

        function send()
        {
            $dc = $this->data_charset;
            $sc = $this->send_charset;
            $enc_to = mime_header_encode($this->to_name, $dc, $sc) . ' <' . $this->to_email . '>';
            $enc_subject = mime_header_encode($this->subject, $dc, $sc);
            $enc_from = mime_header_encode($this->from_name, $dc, $sc) . ' <' . $this->from_email . '>';
            $enc_body = $dc == $sc ? $this->body : iconv($dc, $sc . '//IGNORE', $this->body);
            $headers = '';
            $headers .= "Mime-Version: 1.0\r\n";
            $headers .= "Content-type: " . $this->type . "; charset=" . $sc . "\r\n";
            $headers .= "From: " . $enc_from . "\r\n";
            return mail($enc_to, $enc_subject, $enc_body, $headers);
        }
    }

		class PDF extends FPDF
		{
		//Загрузка данных
		function LoadData($file=null)
		{
		    //Чтение строк из файла
		    //$lines=file($file);
		    $data=array();/*
		    foreach($lines as $line)
		      $data[]=explode(';',chop($line));*/
				//	из бд
				$query = "SELECT item.itemname, bidHistory.price FROM item, bidHistory WHERE bidHistory.item_id = item.item_id AND item.winner=bidHistory.user_id ORDER BY item.item_id DESC";
				$result = $mysqli->query($query)or die('Ошибка '.$mysqli->error);
				if(mysqli_num_rows($result) != 0)
					$data = mysqli_fetch_array($result);
		    return $data;
		}
		//Создание таблицы с чеком
		    //Ширина колонки
		    $w=array(40,35,40,45);
		    //Заголовок
		    for($i=0;$i<count($header);$i++)
		        $this->Cell($w[$i],7,$header[$i],1,0,'C');
		    $this->Ln();
		    //Данные
		    foreach($data as $row)
		    {
		        $this->Cell($w[0],6,$row[0],'LR');
		        $this->Cell($w[1],6,sum($row[0]),'LR');//количество
		        $this->Cell($w[2],6,number_format($row[1]),'LR',0,'R');
		        $this->Cell($w[3],6,sum(number_format($row[1])),'LR',0,'R');
		        $this->Ln();
		    }
		    //Линия закрытия (последняя линия)
		    $this->Cell(array_sum($w),0,'','T');
		}

?>
