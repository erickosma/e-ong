<?php
class AuthController extends Zend_Controller_Action
{

    public function init()
    {
    	$this->view->addHelperPath('ZendX/JQuery/View/Helper/', 'ZendX_JQuery_View_Helper');
    	
    	
		$this->view->headLink()->appendStylesheet('public/css/geral.css')
    							->appendStylesheet('public/css/forms.css');
    	$this->view->headMeta()->appendName('keywords', 'ong, busca, profissionais,voluntários');	/* Initialize action controller here */
    	$this->view->headTitle('Login');
    	$this->view->description = "Busca por vonluntarios busca por ong";
    	$this->view->keywords = "ong,profissionais,voluntarios,procura";
    	$this->view->headMeta()->appendHttpEquiv('Content-Type',
    	                                   'text/html; charset=ISO-8859-1');
    	$this->view->addHelperPath('ZendX/JQuery/View/Helper/', 'ZendX_JQuery_View_Helper');
    	
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
	
		//Verifica se existem dados de POST
        if ( $this->getRequest()->isPost() ) {
            $data = $this->getRequest()->getPost();
            //Formulário corretamente preenchido?
            if ( $form->isValid($data) ) {
                $login = $form->getValue('login');
                $senha = $form->getValue('senha');
 
                try {
                    Application_Model_Auth::login($login, $senha);
                    //Redireciona para o Controller protegido
                    return $this->_helper->redirector->goToRoute( array('controller' => 'perfil'), null, true);
                } catch (Exception $e) {
                    //Dados inválidos
                    $this->_helper->FlashMessenger($e->getMessage());
                    $this->_redirect('/auth/login');
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
	    return $this->_helper->redirector('index',"index");
    }

    protected  function redirectUserAction()
    {
        // action body
    }


}







