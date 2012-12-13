<?php
// INI sets
ini_set('memory_limit', '1G');

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

// define application options and read params from CLI
$getopt = new Zend_Console_Getopt(array(
    'action|a=s' => 'action to perform in format of "controller/action/param1/value1/param2/value2..."',
    'env|e-s'    => 'defines application environment (defaults to "production")',
    'help|h'     => 'displays usage information',
));

try {
    $getopt->parse();
} catch (Zend_Console_Getopt_Exception $e) {
    // Bad options passed: report usage
    echo $e->getUsageMessage();
    return false;
}

// show help message in case it was requested or params were incorrect (module, controller and action)
if ($getopt->getOption('h') || !$getopt->getOption('a')) {
    echo $getopt->getUsageMessage();
    return true;
}

// initialize values based on presence or absence of CLI options
$env      = $getopt->getOption('e');
defined('APPLICATION_ENV')
 || define('APPLICATION_ENV', (null === $env) ? 'production' : $env);

// initialize Zend_Application
$application = new Zend_Application (
    APPLICATION_ENV,
    APPLICATION_PATH . '/configs/application.ini'
);
// bootstrap and retrive the frontController resource
$front = $application->getBootstrap()
      ->bootstrap('frontController')
      ->getResource('frontController');

// Get module list
$moduleList = array();
$modulePath = APPLICATION_PATH.'/modules/';
$dirList = scandir($modulePath);
foreach ($dirList as $dir) {
    if (!is_dir($modulePath . $dir)) continue;
    if ($dir[0] == '.') continue;
    $moduleList[] = $dir;
}

// I like the idea to define request params separated by slash "/"
// for ex. "[module]/controller/action/param1/value1/param2/value2..."
$params = explode('/', $getopt->getOption('a'));
$requestParams = array();
foreach ($params as $i => $param) {
    // Set module
    if (!isset($requestParams['module'])) {
        if (in_array($param, $moduleList))
            $requestParams['module'] = $param;
        else {
            $requestParams['module'] = 'default';
            $requestParams['controller'] = $param;
        }
    }
    // Set controller
    elseif (!isset($requestParams['controller']))
        $requestParams['controller'] = $param;
    // Set action
    elseif (!isset($requestParams['action']))
        $requestParams['action'] = $param;
    // Set param
    else {
        if (isset($params[$i+1]))
            $requestParams[$param] = $params[$i+1];
        else
            $requestParams[$param] = '';
        $i++;
    }
}
$request = new Zend_Controller_Request_Simple(
    $requestParams['action'], $requestParams['controller'], $requestParams['module'], $requestParams
);

// set front controller options to make everything operational from CLI
$front->setRequest($request)
   ->setResponse(new Zend_Controller_Response_Cli())
   ->setRouter(new Nanocoding_Zend_Controller_Router_Cli())
   ->throwExceptions(true);

// lets bootstrap our application and enjoy!
$application->bootstrap()
   ->run();