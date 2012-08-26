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
		$this->view->headMeta()->appendHttpEquiv('Content-Type',
		    	  												'text/html; charset=ISO-8859-1');
		
	
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
        $this->view->Usuario=Zend_Auth::getInstance()->getIdentity();
	
        
    }

    public function ongAction()
    {
    	$this->view->headScript()->appendFile('public/js/perfil/ong.js');
    	$this->view->headTitle('Perfil Ong');
    	$this->view->description = "Perfil ong";
    	if(Application_Model_Auth::completo()){
    		$this->view->completaDados = "";
    	}
    	else{
    		$this->view->completaDtados = "Complete seu cadastro!";
    	}
    	// action bodyeaa
        // action body
    }

    public function profissionalAction()
    {
    	$this->view->headScript()->appendFile('public/js/perfil/profissional.js');
    	$this->view->headTitle('Perfil Ong');
    	$this->view->description = "Perfil ong";
    	if(Application_Model_Auth::completo()){
    		$this->view->completaDados = "";
    	}
    	else{
    		$this->view->completaDtados = "Complete seu cadastro!";
    	}
    	// action bodyeaa
    }

    public function dadosPessoaisOngAction()
    {
    	$this->view->headMeta()->appendHttpEquiv('Content-Type',
    			'text/html; charset=utf-8');
    	
    	$this->_helper->layout->disableLayout();
    	$this->view->headTitle('Perfil ong ');
    	$this->view->description = "Perfil ong  ";
    	$this->view->keywords = "cadastro,ong,voluntarios,procura";
    	$db_estado=new Application_Model_DbTable_SysEstado();
    		
    	$userData = new Application_Model_DbTable_Usuario();
    	$form = new Application_Form_CadastroOng();
    	
    	$usuario = Zend_Auth::getInstance()->getIdentity();
		$data=$userData->loadAllDataUser($usuario->getId());
		if(Application_Model_Auth::completo($usuario->getId(), $usuario->getTipo())){
			$this->view->completaDados = "";
		}
		else{
			$this->view->completaDados = "Complete seu cadastro!";	
		}
	
		if(isset($data))
    	{
    		$form->setDefault('nome',$data->nome);
    		$form->setDefault('sobrenome',$data->sobrenome);
    		$form->setDefault('login',$data->login);
    		$form->campoOculto("login");
    		$form->campoOculto('senha');
    		$form->campoOculto('confirm_senha');
    		$form->setDefault('email',$data->email);
    		$form->lockField('email');
    		$form->setDefault('cpf',$data->cpf_cnpj);
    		$arrayEnd=explode("N?", $data->usuario_ong->endereco);
    		$form->setDefault('endereco',$arrayEnd[0]);
    		$form->setDefault('numero',$arrayEnd[1]);
    		$form->setDefault('complemento',$data->usuario_ong->complemento);
    		$form->setDefault('bairro',$data->usuario_ong->bairro);
    		$form->setDefault('estado',$data->cidade_estado->estado);
    		$form->loadCidades($data->cidade_estado->estado);
    		$form->setDefault('cidade', $data->cidade_estado->chave);
    		$form->campoOculto('submit');
    	}
    	$this->view->form = $form;
    	
    	// action body
    }

    public function dadosPessoaisProfissionalAction()
    {
    	$this->_helper->layout->disableLayout();
    	$this->view->headTitle('Perfil profissional ');
    	$this->view->description = "Cadastro de profissional ";
    	$this->view->keywords = "cadastro,profissionais,voluntarios,procura";
    	$db_estado=new Application_Model_DbTable_SysEstado();
    		
    	$userData = new Application_Model_DbTable_Usuario();
    	$form = new Application_Form_Cadastro();
    	
    	$usuario = Zend_Auth::getInstance()->getIdentity();
		$data=$userData->loadAllDataUser($usuario->getId());
		if(Application_Model_Auth::completo($usuario->getId(), $usuario->getTipo())){
			$this->view->completaDados = "";
		}
		else{
			$this->view->completaDados = "Complete seu cadastro!";	
		}
	
		if(isset($data))
    	{
    		$form->setDefault('nome',$data->nome);
    		$form->setDefault('sobrenome',$data->sobrenome);
    		$form->setDefault('login',$data->login);
    		$form->campoOculto("login");
    		$form->campoOculto('senha');
    		$form->campoOculto('confirm_senha');
    		$form->setDefault('email',$data->email);
    		$form->lockField('email');
			$form->addCpf();
    		$form->setDefault('cpf',$data->cpf_cnpj);
			
    		$form->addDataNacimento();
    		$nasc=explode("-",$data->usuario_profissional->data_nascimento);
    		if(isset($nasc[2]))
    		{
    			$form->setDefault('dataNacimento',$nasc[2]."/".$nasc[1]."/".$nasc[0]);
    		}
    		else
    		{
    			$form->setDefault('dataNacimento',"");
    		}
    		$arrayEnd=explode("N?", $data->usuario_profissional->endereco);
    		$form->setDefault('sexo',$data->usuario_profissional->sexo);
    		$form->setDefault('endereco',$arrayEnd[0]);
    		$form->setDefault('numero',$arrayEnd[1]);
    		$form->setDefault('complemento',$data->usuario_profissional->complemento);
    		$form->setDefault('bairro',$data->usuario_profissional->bairro);
    		$form->setDefault('estado', $data->cidade_estado->estado);
    		$form->loadCidades($data->cidade_estado->estado);
    		$form->setDefault('cidade', $data->cidade_estado->chave);
    		$form->campoOculto('submit');
    		$form->formObjetivos();
    	}
    	$this->view->form = $form;
    }

    public function imagemAction()
    {
        $this->_helper->layout->disableLayout();
    	$this->view->headTitle('Perfil profissional');
    }

    public function mensagemAction()
    {
    	
        // action body
    	$this->_helper->layout->disableLayout();
    	$this->view->headTitle('Perfil profissional');
    }

    public function emailAction()
    {
        $this->_helper->layout->disableLayout();
    	$this->view->headTitle('Perfil profissional');
    	$usuario = Zend_Auth::getInstance()->getIdentity();
    	$this->view->usuario = $usuario;
    	$this->view->email = $usuario->getEmail();
    	 
    }

    public function dadosAction()
    {
        $this->_helper->layout->disableLayout();
    	$this->view->headTitle('Perfil profissional');
    }


}





















