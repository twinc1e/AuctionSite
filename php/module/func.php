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
		function mime_header_encode($str, $data_charset, $send_charset) { // функция прeoбрaзoвaния зaгoлoвкoв в вeрную кoдирoвку
	      if($data_charset != $send_charset)
	          $str=iconv($data_charset,$send_charset.'//IGNORE',$str);
	      return ('=?'.$send_charset.'?B?'.base64_encode($str).'?=');
	  }
