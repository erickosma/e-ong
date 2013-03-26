<?php

class ErrorController extends Zend_Controller_Action
{

    public function errorAction()
    {
        $errors = $this->_getParam('error_handler');
        
        if (!$errors || !$errors instanceof ArrayObject) {
            $this->view->message = 'Aconteceu algum erro! <br>';
            return;
        }
        
        switch ($errors->type) {
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ROUTE:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION:
                // 404 error -- controller or action not found
                $this->getResponse()->setHttpResponseCode(404);
                $priority = Zend_Log::NOTICE;
                $this->view->message = '<h1>Ops!</h1>  Não conseguimos encontrar o que vc procura';
                break;
            default:
                // application error
            	$this->saveLog($errors);
            	$this->saveLogBD($errors);
                $this->getResponse()->setHttpResponseCode(500);
                $priority = Zend_Log::CRIT;
                $this->view->message = '<h2>Encontramos algum erro por aqui!<h2>';
                break;
        }
        
        // Log exception, if logger available
        if ($log = $this->getLog()) {
            $log->log($this->view->message, $priority, $errors->exception);
            $log->log('Request Parameters', $priority, $errors->request->getParams());
        }
        
        // conditionally display exceptions
        if ($this->getInvokeArg('displayExceptions') == true) {
            $this->view->exception = $errors->exception;
        }
        
        $this->view->request   = $errors->request;
    }

    public function getLog()
    {
        $bootstrap = $this->getInvokeArg('bootstrap');
        if (!$bootstrap->hasResource('Log')) {
            return false;
        }
        $log = $bootstrap->getResource('Log');
        return $log;
    }

    public function forbiddenAction()
    {
        // action body
    	$this->view->headMeta()->appendName('keywords', 'ong, busca, profissionais,volunt�rios');	/* Initialize action controller here */
    	$this->view->headTitle('Ação paralela 404');
    	$this->view->description = "Encontre  vonluntarios e ong";
    	$this->view->keywords = "ong,profissionais,voluntarios,procura,encontre";
    	
    	$this->view->headMeta()->appendHttpEquiv('Content-Type',
    			'text/html; charset=utf-8');
    	$this->view->headLink()->appendStylesheet('public/css/geral.css');	 
    }
    protected function saveLog($errors){
    	 
    	$logger = new Zend_Log();
    	$writer = new Zend_Log_Writer_Stream('application/tmp/erro/error.xml');
    	$formatter = new Zend_Log_Formatter_Xml();
    	$writer->setFormatter($formatter);
    	$logger->addWriter($writer);
    	$exception = $errors->exception;
    	$exception->getTraceAsString();
    	$logger->debug($exception->getMessage()."\r\n");
    }

    
    
    protected function saveLogBD($errors){
    
    	$config = new Zend_Config_Ini('application/configs/application.ini', 'staging');
		$params = array ('host'     => $config->resources->db->params->host,
				'username' => $config->resources->db->params->username,
				'password' => $config->resources->db->params->password,
				'dbname'   => "estatisticas",
				'charset'   => $config->resources->db->params->charset,
				);
		$db = Zend_Db::factory('PDO_MYSQL', $params);
		
		$columnMapping = array(
				    'message'   => 'message',
					'file'   => 'file',
					'line'   => 'line',
				    'url'     => 'url',
				    'date'  => 'date',
				);
		$writer = new Zend_Log_Writer_Db($db, 'erro_log', $columnMapping);
		$logger   = new Zend_Log($writer);
		$exception = $errors->exception;
		$exception->getTraceAsString();
		
		$logger->setEventItem('message',$exception->getMessage());
		$logger->setEventItem('file',$errors->getFile());
		$logger->setEventItem('line',$errors->getLine());
		$logger->setEventItem('url' , $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
		$logger->setEventItem('date', new Zend_Db_Expr('NOW()'));
		$logger->info("Erros");
    }
    
}



