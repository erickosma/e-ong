<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
    	$this->view->addHelperPath('ZendX/JQuery/View/Helper/', 'ZendX_JQuery_View_Helper');
    	$this->view->headScript()->appendFile('public/js/jquery/js/jquery-1.7.1.min.js')
						    	->appendFile('public/js/index/index.js')
						    	->appendFile('public/js/jquery/js/plugins/cufon-yui.js')
						    	->appendFile('public/js/jquery/js/plugins/jquery.cycle.all.min.js')
						    	->appendFile('public/js/jquery/js/plugins/liberation_sans.js');
						    	
    	
    	$this->view->headLink()->appendStylesheet('public/css/index/index.css')
    							->appendStylesheet('public/css/geral.css');
    	$this->view->headMeta()->appendName('keywords', 'ong, busca, profissionais,volunt�rios');	/* Initialize action controller here */
    	$this->view->headTitle('Ong');
    	$this->view->description = "Busca por vonluntarios busca por ong";
    	$this->view->keywords = "ong,profissionais,voluntarios,procura";
    	$this->view->headMeta()->appendHttpEquiv('Content-Type',
    	                                   'text/html; charset=ISO-8859-1');
    	$this->view->addHelperPath('ZendX/JQuery/View/Helper/', 'ZendX_JQuery_View_Helper');
    	
    	
    }

    public function indexAction()
    {
    	$date     = new Zend_Date();
    	$currency = new Zend_Currency();
    	
    	/* Saldo na Conta */
    	$hoje  = $date->now();
    	$saldo = $currency->toCurrency(1000);
    	/* Camada de Visualiza��o */
    	$this->view->hoje  = $hoje;
    	$this->view->saldo = $saldo;
    }


}

