<?php

class BuscarController extends Zend_Controller_Action
{

    public function init()
    {
 		$this->view->addHelperPath('ZendX/JQuery/View/Helper/', 'ZendX_JQuery_View_Helper');
    	$this->view->headLink()->appendStylesheet('public/css/geral.css')
    							->appendStylesheet('public/css/forms.css');
    	$this->view->headMeta()->appendHttpEquiv('Content-Type',
    	                                   'text/html; charset=utf-8');
		$this->view->headScript()->appendFile('public/js/jquery/js/jquery-1.7.1.min.js')
			->appendFile('public/js/jquery/js/jquery-ui-1.8.17.custom.min.js')
			->appendFile('public/js/buscar/pesquisa.js');
    }

    public function indexAction()
    {
    	$this->view->headMeta()->appendName('keywords', 'ong, busca, profissionais,volunt�rios');	/* Initialize action controller here */
    	$this->view->headTitle('Buscar - Ajude a ajudar');
    	$this->view->description = "Busca por vonluntarios busca por ong";
    	$this->view->keywords = "ong,profissionais,voluntarios,procura";
        // action body
    }

    public function ongAction()
    {
    	$this->view->headMeta()->appendName('keywords', 'ong, busca, profissionais,volunt�rios');	/* Initialize action controller here */
    	$this->view->headTitle('Buscar ongs');
    	$this->view->description = "Busca por vonluntarios busca por ong";
    	$this->view->keywords = "ong,profissionais,voluntarios,procura";
    	 
    	// action body
    }

    public function profissionaisAction()
    {
    	
        // action body
    }

    public function usuarioAction()
    {
        $this->view->headMeta()->appendName('keywords', 'ong, busca, profissionais,volunt�rios');	/* Initialize action controller here */
    	$this->view->headTitle('Buscar usu�rio');
    	$this->view->description = "Busca por vonluntarios busca por ong";
    	$this->view->keywords = "ong,profissionais,voluntarios,procura";

    }

    public function termoAction()
    {
    	$this->_helper->layout->disableLayout();
    	
    	$request = $this->getRequest();
    	$termo = $request->getParam("q");
    	$Pesquisa =  new Application_Model_Pesquisa();
    	$result = $Pesquisa->pesquisa($termo);
		$this->view->pesquisa = $result;
		$this->view->total = count($result);
    	// action body
    }


}









