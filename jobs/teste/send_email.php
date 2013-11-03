<?php
$path = dirname(__FILE__);
require_once $path.'/../setup.php';
error_reporting(E_ALL);

// get the options and run CLIerror_repo()
try {
	$opts = new Zend_Console_Getopt('e');
	$opts->setOption('ignoreCase', true);
	$options = $opts->parse();
	$new=argsToArray($options);
	print_r($new);
	if (isset($opts->e)) {
		echo "I got the a option ".$new["e"]." \n";
		$subject = "Teste zend " .Zend_Date::now();
		$message= "<h2>Uma menssagem de teste em ".Zend_Date::now()."</h2>";
		
		//$tr = new Zend_Mail_Transport_Sendmail('contato@acaoparalela.com');
		//Zend_Mail::setDefaultTransport($tr);
		
		
		$mail = new Zend_Mail('utf-8');
		$mail->addTo($new["e"]);
		$mail->setSubject($subject);
		$mail->setBodyHtml($message);
		$mail->setFrom('contato@acaoparalela.com', 'Voluntário');
		$mail->setHeaderEncoding(Zend_Mime::ENCODING_BASE64);
		//print_r($mail);exit;
		//Send it!
		$sent = true;
		try {
			$mail->send();
			echo "send teste \n";
		} catch (Exception $e){
			print_r($e);
			$sent = false;
		}
		//Do stuff (display error message, log it, redirect user, etc)
		if($sent){
			echo "Mail was sent successfully. \n";
		} else {
			echo "Mail failed to send. \n";
		}

	}


} catch (Zend_Console_Getopt_Exception $e) {
	echo $e->getUsageMessage();
	exit;
} catch (exception $e) {
	echo $e->getMessage();
	exit;
}



