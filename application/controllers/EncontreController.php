<?php

class EncontreController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    	$this->view->addHelperPath('ZendX/JQuery/View/Helper/', 'ZendX_JQuery_View_Helper');
    	$this->view->headLink()->appendStylesheet('public/css/geral.css')
    	->appendStylesheet('public/css/forms.css');
    	$this->view->headMeta()->appendHttpEquiv('Content-Type',
    			'text/html; charset=ISO-8859-1');
    	$this->view->headScript()->appendFile('public/js/jquery/js/jquery-1.7.1.min.js')
    	->appendFile('public/js/jquery/js/jquery-ui-1.8.17.custom.min.js')
    	->appendFile('public/js/buscar/pesquisa.js');
    }

    public function indexAction()
    {
        // action body
    }

    public function termoAction()
    {
        // action body
    }

    public function ajudeAction()
    {
        // action body
    }


}





