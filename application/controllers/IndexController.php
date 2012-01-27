<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
    	$this->view->headScript()->appendFile('public/js/index/index.js');
    	$this->view->headLink()->appendStylesheet('public/css/index/index.css')
    							->appendStylesheet('public/css/geral.css');
    	$this->view->headMeta()->appendName('keywords', 'ong, busca, profissionais,voluntários');	/* Initialize action controller here */
    	$this->view->headTitle('Ong');
    	$this->view->description = "Busca por vonluntarios busca por ong";
    	$this->view->keywords = "ong,profissionais,voluntarios,procura";
    	$this->view->headMeta()->appendHttpEquiv('Content-Type',
    	                                   'text/html; charset=ISO-8859-1');
    }

    public function indexAction()
    {
    	$date     = new Zend_Date();
    	$currency = new Zend_Currency();
    	
    	/* Saldo na Conta */
    	$hoje  = $date->now();
    	$saldo = $currency->toCurrency(1000);
    	
    	/* Camada de Visualização */
    	$this->view->hoje  = $hoje;
    	$this->view->saldo = $saldo;
    }


}

