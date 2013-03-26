<?php

class EncontreController extends Zend_Controller_Action
{

    public function init()
    {
   		$this->view->addHelperPath('ZendX/JQuery/View/Helper/', 'ZendX_JQuery_View_Helper');
    	$this->view->headScript()->appendFile('public/js/jquery/js/jquery-1.7.1.min.js')
						    	->appendFile('public/js/buscar/pesquisa.js')
						    	->appendFile('public/js/jquery/js/plugins/cufon-yui.js')
						    	->appendFile('public/js/jquery/js/plugins/jquery.cycle.all.min.js')
						    	->appendFile('public/js/jquery/js/plugins/liberation_sans.js');
						    	
    	
    	$this->view->headLink()->appendStylesheet('public/css/index/index.css')
    							->appendStylesheet('public/css/encontre/pesquisa.css')
    							->appendStylesheet('public/css/geral.css')
    							->appendStylesheet('public/css/forms.css');
    	$this->view->headMeta()->appendName('keywords', 'ong, busca, profissionais,volunt�rios');	/* Initialize action controller here */
    	$this->view->headTitle('Ação paralela');
    	$this->view->description = "Encontre  vonluntarios e ong";
    	$this->view->keywords = "ong,profissionais,voluntarios,procura,encontre";
    	$this->view->headMeta()->appendHttpEquiv('Content-Type',
    	                                   'text/html; charset=utf8');
    	$this->view->addHelperPath('ZendX/JQuery/View/Helper/', 'ZendX_JQuery_View_Helper');
    	
       }

    public function indexAction()
    {
        // action body
    }

    public function termoAction()
    {
    	$Pesquisa  = new Application_Model_Pesquisa();
    	
    	$request = $this->getRequest();
    	$termo = $Pesquisa->checkParam($request);
    	if($termo){
    		$result = $Pesquisa->pesquisa();   
    		$this->view->numFound = $Pesquisa->getNumFound();
    		$this->view->time = $Pesquisa->getTime();
    		$this->view->termo = urldecode($Pesquisa->getTermo());
    		$this->view->qtdPesquisa = $Pesquisa->qtdPesuisa;
    		if($result){
    			$this->view->result = $result;
    		}
    	}
    }

    
    
    
    
    
    public function ajudeAction()
    {
        // action body
    }


	
}





