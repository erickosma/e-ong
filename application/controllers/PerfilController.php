<?php

class PerfilController extends Zend_Controller_Action
{

    public function init()
    {
    	$this->view->addHelperPath('ZendX/JQuery/View/Helper/', 'ZendX_JQuery_View_Helper');
		$this->view->headLink()->appendStylesheet('public/css/geral.css')
			->appendStylesheet('public/css/forms.css')
			->appendStylesheet('public/css/perfil/perfil.css');
		$this->view->headScript()->appendFile('public/js/jquery/js/jquery-1.7.1.min.js')
			->appendFile('public/js/jquery/js/jquery-ui-1.8.17.custom.min.js')
			->appendFile('public/js/cadastro/validacao.js')
			->appendFile('public/js/jquery/js/valida.js')
			->appendFile('public/js/jquery/js/jquery.mask.js')
			->appendFile('public/js/cadastro/cadastro.js')
			->appendFile('public/js/perfil/perfil.js');
    	/* Initialize action controller here */
    }

    public function indexAction()
    {
       	$this->view->headTitle('Perfil');
    	$this->view->description = "Perfil ";
    	$this->view->headMeta()->appendHttpEquiv('Content-Type',
    	  												'text/html; charset=ISO-8859-1');
 
    }

    public function addAction()
    {
        // action body
    }

    public function welcomeAction()
    {
        // action body
    }

    public function ongAction()
    {
    	 
        // action body
    }

    public function profissionalAction()
    {
    	$this->view->headTitle('Perfil profissional');
    	$this->view->description = "Perfil profissional";
    	$this->view->headMeta()->appendHttpEquiv('Content-Type',
    	    	  												'text/html; charset=ISO-8859-1');
    	
        // action body
    }

    public function dadosPessoaisOngAction()
    {
    	$this->_helper->layout->disableLayout();
    	
    	// action body
    }

    public function dadosPessoaisProfissionalAction()
    {
    	$this->_helper->layout->disableLayout();
    	$this->view->headTitle('Perfil profissional ');
    	$this->view->description = "Cadastro de profissional ";
    	$this->view->keywords = "cadastro,profissionais,voluntarios,procura";
    	$this->view->headMeta()->appendHttpEquiv('Content-Type',
    	  												'text/html; charset=ISO-8859-1');
    	/*if(isset($values))
    	{
    		$form->setDefault('nome',$values->first_name);
    		$form->setDefault('sobrenome',$values->last_name);
    		$form->setDefault('country',$values->country);
    		$form->setDefault('state',$values->state);
    		$form->setDefault('cities',$values->city);
    	}*/
    /*	$authNamespace = new Zend_Session_Namespace('Zend_Auth');
    	$user_data = new User_Data();
    	$data = $user_data->find($authNamespace->user->freelancer_id);
    	$this->view->form = $this->getUpdateProfForm($data[0]);
    	*/
    	
    	$form = new Application_Form_Cadastro();
    	$this->view->form = $form;
    	
        // action body
    }


}













