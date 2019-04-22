<?php
require_once('../core/db.php');

	if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
		$user_id = $_POST['user_id'];
		$item_id = $_POST['item_id'];
		$resultMsg;
		$email;
		$email_subject="Check from Auction";
		$email_msg="Test";
		$email_name;
		include 'function/db.php';
		
		if($user_id != 0){
			$query = "UPDATE item SET status=0, winner=$user_id WHERE item_id=$item_id";
			$result = $mysqli->query($query) or die('Ошибка '.$mysqli->error);

			if($result){
				$resultMsg = "Победитель";
			}
            $query = "SELECT email,name FROM user WHERE user_id=$user_id";
            $result = $mysqli->query($query) or die(mysqli_error());
            if($result){
                $email_assoc=$result->fetch_assoc();
                $email=$email_assoc['email'];
                $email_name=$email_assoc['name'];
            }
		}else{
			$query = "UPDATE item SET status=0, winner=0 WHERE item_id=$item_id";
			$result = $mysqli->query($query) or die('Ошибка '.$mysqli->error);

			if($result){
				$resultMsg =  "НЕ победитель";
			}
		}
        function mime_header_encode($str, $data_charset, $send_charset) { // функция прeoбрaзoвaния зaгoлoвкoв в вeрную кoдирoвку
            if($data_charset != $send_charset)
                $str=iconv($data_charset,$send_charset.'//IGNORE',$str);
            return ('=?'.$send_charset.'?B?'.base64_encode($str).'?=');
        }

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
        $emailgo= new TEmail; // инициaлизируeм супeр клaсс oтпрaвки
        $emailgo->from_email= 'Auction_site'; // oт кoгo
        $emailgo->from_name= 'Тeстoвaя фoрмa';
        /*$emailgo->to_email= $email; // кoму
        $emailgo->to_name= $email_name;
        $emailgo->subject= $email_subject; // тeмa
        $emailgo->body= $email_msg; // сooбщeниe*/
        $emailgo->to_email= 'idrisov.rad@gmail.com';
        $emailgo->to_name= 'kek';
        $emailgo->subject= 'lul'; // тeмa
        $emailgo->body= 'lul'; // сooбщeниe
        $emailgo->send(); // oтпрaвляeм
		echo $resultMsg;
	}
?>
