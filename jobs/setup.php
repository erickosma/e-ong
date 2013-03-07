<?php
//define var
$env      = null;

// INI sets
//ini_set('memory_limit', '1G');

// should be removed starting from PHP version >= 5.3.0
defined('__DIR__') || define('__DIR__', dirname(__FILE__));

// initialize the application path, library and autoloading
defined('APPLICATION_PATH') ||
define('APPLICATION_PATH', realpath(__DIR__ . '/../application'));

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
		realpath(APPLICATION_PATH . '/../library'),
		realpath(APPLICATION_PATH . '/../library/Janrain'),
		realpath(APPLICATION_PATH . '/../application/modules/default/models'),
		get_include_path(),
)));

// Set $_SERVER params
$_SERVER['DOCUMENT_ROOT'] = __DIR__;
$_SERVER['REMOTE_ADDR']   = '';
$_SERVER['HTTP_USER_AGENT'] = 'robot dusya';
$_SERVER['REQUEST_URI']     = '/en/';
$_SERVER['REMOTE_ADDR']     = '127.0.0.1';

require_once 'Zend/Loader/Autoloader.php';
$loader = Zend_Loader_Autoloader::getInstance();

// we need this custom namespace to load our custom class
$loader->registerNamespace('Application_');


// initialize values based on presence or absence of CLI options
defined('APPLICATION_ENV')
|| define('APPLICATION_ENV', (null === $env) ? 'production' : $env);


// initialize Zend_Application
$application = new Zend_Application (
		APPLICATION_ENV,
		APPLICATION_PATH . '/configs/application.ini'
);


//only load resources we need for script, in this case db and mail
$application->getBootstrap()->bootstrap(array('db'));
