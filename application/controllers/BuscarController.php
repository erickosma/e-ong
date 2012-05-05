<?php

class BuscarController extends Zend_Controller_Action
{

    public function init()
    {
 		$this->view->addHelperPath('ZendX/JQuery/View/Helper/', 'ZendX_JQuery_View_Helper');
    	$this->view->headLink()->appendStylesheet('public/css/geral.css')
    							->appendStylesheet('public/css/forms.css');
    	$this->view->headMeta()->appendHttpEquiv('Content-Type',
    	                                   'text/html; charset=ISO-8859-1');
    	$this->view->addHelperPath('ZendX/JQuery/View/Helper/', 'ZendX_JQuery_View_Helper');
    	
    }

    public function indexAction()
    {
        // action body
    }

    public function ongAction()
    {
    	$this->view->headMeta()->appendName('keywords', 'ong, busca, profissionais,voluntários');	/* Initialize action controller here */
    	$this->view->headTitle('Buscar ongs');
    	$this->view->description = "Busca por vonluntarios busca por ong";
    	$this->view->keywords = "ong,profissionais,voluntarios,procura";
    	 
    	// action body
    }

    public function profissionaisAction()
    {
    	$this->view->headMeta()->appendName('keywords', 'ong, busca, profissionais,voluntários');	/* Initialize action controller here */
    	$this->view->headTitle('Buscar profissionais');
    	$this->view->description = "Busca por vonluntarios busca por ong";
    	$this->view->keywords = "ong,profissionais,voluntarios,procura";
    	 
        // action body
    }


}





