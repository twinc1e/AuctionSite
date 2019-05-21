<?php
require_once('../core/db.php');
require_once('../module/func.php');

	if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
		$user_id = $_POST['user_id'];
		$item_id = $_POST['item_id'];
		$resultMsg;
		$email;
		// $from_email = 'torgi@mail.ru';
		// $from_name = 'Сайт АУКЦИОН';
		// $email_subject='Чек победителя';
		// $email_msg="";
		$email_name;

		if($user_id != 0){
			$query = "UPDATE item SET winner=$user_id WHERE item_id=$item_id";
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
			$query = "UPDATE item SET winner=0 WHERE item_id=$item_id";
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
        send();
        // $emailgo = new TEmail; // инициaлизируeм супeр клaсс oтпрaвки
        // //$emailgo->from_email= $from_email; // oт кoгo
        // $emailgo->from_name= $from_name;
        // $emailgo->to_email= $email; // кoму
        // $emailgo->to_name= $email_name;
        // $emailgo->subject= $email_subject; // тeмa
        // $emailgo->body= 'Поздравляю, вы победили! Вы можете приобрести товар по чеку в вашем личном кабинете по ссылке:'
				// 								+$email_msg; // сooбщeниe*/
        // // $emailgo->to_email= 'idrisov.rad@gmail.com';
        // // $emailgo->to_name= 'kek';
        // // $emailgo->subject= 'lul'; // тeмa
        // // $emailgo->body= 'lul'; // сooбщeниe
        // $emailgo->send(); // oтпрaвляeм
		echo $resultMsg;
	}
?>
