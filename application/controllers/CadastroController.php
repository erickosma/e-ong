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
		->appendFile('public/js/cadastro/validacao.js')
		->appendFile('public/js/jquery/js/valida.js')
		->appendFile('public/js/jquery/js/jquery.mask.js')
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
	}

	public function ongAction()
	{
		$this->view->headTitle('Cadasro - Ong ');
		$this->view->description = "Cadastro de  ong";
		$this->view->keywords = "cadastro,ong,voluntarios,procura";
		$this->view->headMeta()->appendHttpEquiv('Content-Type',
  												'text/html; charset=ISO-8859-1');
	}

	public function cidadesAction()
	{
		$this->_helper->layout->disableLayout();
		$this->_helper->viewRenderer->setNoRender();
		header( 'Cache-Control: no-cache' );
		header( 'Content-type: application/xml; charset="utf-8"', true );


		$db = Zend_Registry::get("db");
		$cod_estados = $_POST["estado"];
		$citiesdb = new Application_Model_DbTable_SysCidade();
			
		$col = $db->fetchAll(
		$citiesdb->select()
		->where('estado = ?', $cod_estados)
		->order('nome')
		);
		$i=0;
		foreach($col as $cities)
		{
			$cidades[$i] = array(
    					'chave'         => $cities['chave'],
    					'nome'          => $cities['nome']
			);
			$i++;
		}
		echo $this->view->json($cidades);
	}

	public function validaCpfAction()
	{
		$this->_helper->layout->disableLayout();
		$this->_helper->viewRenderer->setNoRender();
		header( 'Cache-Control: no-cache' );
		header( 'Content-type: application/xml; charset="utf-8"', true );

		$db = Zend_Registry::get("db");
		$cpf = $_POST["cpf"];

		$cpf=str_replace(".","",$cpf);
		$cpf=str_replace("-","",$cpf);

		$user_data = new Application_Model_Usuario();
		$cons= $db->fetchAll($user_data->select()->where('cpf_cnpj = ?', $cpf));

		if($cons)
		{
			$validcpf=0;
		}
		else
		{
			$validcpf=1;
		}
		echo $this->view->json($validcpf);
	}

	public function validaCnpjAction()
	{
		// action body
	}

	public function validaEmailAction()
	{
		$this->_helper->layout->disableLayout();
		$this->_helper->viewRenderer->setNoRender();
		header( 'Cache-Control: no-cache' );
		header( 'Content-type: application/xml; charset="utf-8"', true );
		if ( $this->getRequest()->isPost() ) {
			$data = $this->getRequest()->getPost();
			$email=$data["email"];
			$validator = new Zend_Validate_EmailAddress();
			if ($validator->isValid($email)) {
				// email address appears to be valid
				$validatorEmail = new Zend_Validate_Db_NoRecordExists(
					array(
			    					        'table' => 'usuario_login',
			    					        'field' => 'email',
			    			    			'schema'=> 'ong'
					)
				);
				if ($validatorEmail->isValid($email)) {
					// email address appears to be valid
					echo $this->view->json(1);
				} else {
					echo $this->view->json(0);
				}
				 
			} else {
				echo $this->view->json(0);
			}
		}
	}

	public function validaUserNameAction()
	{
		$this->_helper->layout->disableLayout();
		$this->_helper->viewRenderer->setNoRender();
		header( 'Cache-Control: no-cache' );
		header( 'Content-type: application/xml; charset="utf-8"', true );
		if ( $this->getRequest()->isPost() ) {
			$data = $this->getRequest()->getPost();
			$login = $data["login"];

			$validator = new Zend_Validate_Db_NoRecordExists(
			array(
			        'table' => 'usuario_login',
			        'field' => 'login',
	    			'schema'=> 'ong'
			)
			);
			if ($validator->isValid($login)) {
				// email address appears to be valid
				echo $this->view->json(1);
			} else {
				echo $this->view->json(0);
			}
		}
	}


}















