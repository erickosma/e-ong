<?php
$path = dirname(__FILE__);
require_once $path.'/../setup.php';


// get the options and run CLI
try {
	$opts = new Zend_Console_Getopt('abc');
	$opts->setOption('ignoreCase', true);
	$options = $opts->parse();
	$new=argsToArray($options);
	print_r($new);
	if (isset($opts->a)) {
		echo "I got the a option ".$new["a"]." .\n";
	}
	if (isset($opts->b)) {
		echo "I got the b option  ".$new["b"].".\n";
	}
	if (isset($opts->c)) {
		echo "I got the c option  ".$new["c"]." .\n";
	}
} catch (Zend_Console_Getopt_Exception $e) {
	echo $e->getUsageMessage();
	exit;
} catch (exception $e) {
	echo $e->getMessage();
	exit;
}

$args = $opts->getRemainingArgs();
for($i=0;$i < 9000;$i++){

}

//}
