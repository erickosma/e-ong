<?php

class SobreNosController extends Zend_Controller_Action
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
    	$this->view->headTitle('Ação  Paralela - Sobre nós ');
    	$this->view->description = "Ação  Paralela - Sobre nós ";
    	$this->view->keywords = "ong,profissionais,voluntarios,procura,busca,acao paralela,ação paralela,sobre";
    	$this->view->headMeta()->appendHttpEquiv('Content-Type',
    	                                   'text/html; charset=UTF-8');
    	
    }

    public function indexAction()
    {
        // action body
    }


}

