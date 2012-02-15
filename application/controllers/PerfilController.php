<?php

class PerfilController extends Zend_Controller_Action
{

    public function init()
    {
    	$this->view->headLink()->appendStylesheet('public/css/geral.css');
    	$this->view->addHelperPath('ZendX/JQuery/View/Helper/', 'ZendX_JQuery_View_Helper');
    	
    	/* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function addAction()
    {
        // action body
    }

    public function welcomeAction()
    {
        // action body
    }


}





