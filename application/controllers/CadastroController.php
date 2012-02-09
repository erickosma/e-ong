<?php

class CadastroController extends Zend_Controller_Action
{

    public function init()
    {
    	$this->view->addHelperPath('ZendX/JQuery/View/Helper/', 'ZendX_JQuery_View_Helper');
    	$this->view->headLink()->appendStylesheet('public/css/geral.css')
      						 ->appendStylesheet('public/css/forms.css')
       						->appendStylesheet('public/css/cadastro/cadaastro.css');
    	$this->view->headScript()->appendFile('public/js/jquery/js/jquery-1.7.1.min.js')
						    	->appendFile('public/js/jquery/js/jquery-ui-1.8.17.custom.min.js')
    							->appendFile('public/js/cadastro/cadastro.js');
    	
    }

    public function indexAction()
    {
    	$this->view->headTitle('Cadasro- Escolha o seu ');
    	$this->view->description = "Cadastro de profissional e ong";
    	$this->view->keywords = "cadastro,ong,profissionais,voluntarios,procura";
    	$this->view->headMeta()->appendHttpEquiv('Content-Type',
  												'text/html; charset=ISO-8859-1');
    }

    public function profissionalAction()
    {
        $this->view->headTitle('Cadasro - profissional ');
    	$this->view->description = "Cadastro de profissional ";
    	$this->view->keywords = "cadastro,profissionais,voluntarios,procura";
    	$this->view->headMeta()->appendHttpEquiv('Content-Type',
  												'text/html; charset=ISO-8859-1');
    	$form = new Application_Form_Cadastro();
    	$this->view->form = $form;
    	
    /**
     * $validator = new Zend_Validate_EmailAddress();
if ($validator->isValid($email)) {
    // email appears to be valid
} else {
    // email is invalid; print the reasons
    foreach ($validator->getMessages() as $message) {
        echo "$message\n";
    }
}



$validator = new Zend_Validate_Date();
 
$validator->isValid('2000-10-10');   // returns true
$validator->isValid('10.10.2000'); // returns false
     */
    }

    public function ongAction()
    {
       $this->view->headTitle('Cadasro - Ong ');
    	$this->view->description = "Cadastro de  ong";
    	$this->view->keywords = "cadastro,ong,voluntarios,procura";
    	$this->view->headMeta()->appendHttpEquiv('Content-Type',
  												'text/html; charset=ISO-8859-1');
    }


}





