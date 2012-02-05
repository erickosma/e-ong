<?php
class AuthController extends Zend_Controller_Action
{

	public function init()
	{
		$this->view->headScript()->appendFile('public/js/index/index.js');
    	$this->view->headLink()->appendStylesheet('public/css/geral.css')
    							->appendStylesheet('public/css/forms.css');
    	$this->view->headMeta()->appendName('keywords', 'ong, busca, profissionais,voluntários');	/* Initialize action controller here */
    	$this->view->headTitle('Login');
    	$this->view->description = "Busca por vonluntarios busca por ong";
    	$this->view->keywords = "ong,profissionais,voluntarios,procura";
    	$this->view->headMeta()->appendHttpEquiv('Content-Type',
    	                                   'text/html; charset=ISO-8859-1');
	}

	public function indexAction()
	{
		return $this->_helper->redirector('login');
		// action body
	}

	public function loginAction()
	{
		// action body
		//menssagem de erro
		$this->_flashMessenger = $this->_helper->getHelper('FlashMessenger');
		$this->view->messages = $this->_flashMessenger->getMessages();
		$form = new Application_Form_Login();
		$this->view->form = $form;
		//Verifica se existem dados de POST
	
		if ( $this->getRequest()->isPost() ) {
			$data = $this->getRequest()->getPost();
			//Formulário corretamente preenchido?
			if ( $form->isValid($data) ) {
				$login = $form->getValue('login');
				$senha = $form->getValue('senha');
				 
				$dbAdapter = Zend_Db_Table::getDefaultAdapter();
				//Inicia o adaptador Zend_Auth para banco de dados
				$authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);
				$authAdapter->setTableName('usuario_login')
						->setIdentityColumn('login')
						->setCredentialColumn('senha')
						->setCredentialTreatment('SHA1(?)');
				//Define os dados para processar o login
				$authAdapter->setIdentity($login)
						->setCredential($senha);
				//Efetua o login
				$auth = Zend_Auth::getInstance();
				$result = $auth->authenticate($authAdapter);
				//Verifica se o login foi efetuado com sucesso
				if ( $result->isValid() ) {
					//Armazena os dados do usuário em sessão, apenas desconsiderando
					//a senha do usuário
					$info = $authAdapter->getResultRowObject(null, 'senha');
					$storage = $auth->getStorage();
					$storage->write($info);
					//Redireciona para o Controller protegido
					return $this->_helper->redirector->goToRoute( array('controller' => 'cadastro'), null, true);
				} else {
					//login com email
					 
					//Inicia o adaptador Zend_Auth para banco de dados
					$authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);
					$authAdapter->setTableName('usuario_login')
							->setIdentityColumn('email')
							->setCredentialColumn('senha')
							->setCredentialTreatment('SHA1(?)');
						//Define os dados para processar o login
					$authAdapter->setIdentity($login)
							->setCredential($senha);
					//Efetua o login
					$auth = Zend_Auth::getInstance();
					$result = $auth->authenticate($authAdapter);
					//Verifica se o login foi efetuado com sucesso
					if ( $result->isValid() ) {
						//Armazena os dados do usuário em sessão, apenas desconsiderando
						//a senha do usuário
						$info = $authAdapter->getResultRowObject(null, 'senha');
						$storage = $auth->getStorage();
						$storage->write($info);
						//Redireciona para o Controller protegido
						return $this->_helper->redirector->goToRoute( array('controller' => 'cadastro'), null, true);
					}
					else{
						//Dados inválidos
						$this->_helper->FlashMessenger('Usuário ou senha inválidos!');
						$this->_redirect('/auth/login');

					}
				}
			} else {
				//Formulário preenchido de forma incorreta
				$form->populate($data);
			}
		}
	}

	public function logoutAction()
	{
		$auth = Zend_Auth::getInstance();
	    $auth->clearIdentity();
	    return $this->_helper->redirector('index');
	}


}





