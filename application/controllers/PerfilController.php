<?php

class PerfilController extends Zend_Controller_Action
{

    public function init()
    {
    	$this->view->addHelperPath('ZendX/JQuery/View/Helper/', 'ZendX_JQuery_View_Helper');
		$this->view->headLink()->appendStylesheet('public/css/geral.css')
			->appendStylesheet('public/css/forms.css')
			->appendStylesheet('public/css/perfil/menu.css')
			->appendStylesheet('public/css/perfil/perfil.css');
		$this->view->headScript()->appendFile('public/js/jquery/js/jquery-1.7.1.min.js')
			->appendFile('public/js/jquery/js/jquery-ui-1.8.17.custom.min.js')
			->appendFile('public/js/jquery/js/numeric.js')
			->appendFile('public/js/cadastro/validacao.js')
			->appendFile('public/js/jquery/js/valida.js')
			->appendFile('public/js/jquery/js/jquery.mask.js')
			->appendFile('public/js/cadastro/cadastro.js')
			->appendFile('public/js/perfil/perfil.js');
    	/* Initialize action controller here */
		$this->view->headMeta()->appendHttpEquiv('Content-Type',
		    	  												'text/html; charset=utf-8');
		
	
    }

    public function indexAction()
    {
       	$this->view->headTitle('Perfil');
    	$this->view->description = "Perfil ";
    	$this->view->headMeta()->appendHttpEquiv('Content-Type',
    	  												'text/html; charset=utf-8');
    	$usuario = Zend_Auth::getInstance()->getIdentity();
    	$this->view->usuario = $usuario;
    	if(Application_Model_Redirect::hasRequestUri() ){
    		$uri =Application_Model_Redirect::getRequestUri();
    	}
	
    	if(strlen($uri) > 3 ){
    		$this->view->uri = Application_Model_Redirect::getRequestUri();
    	}
    	
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
    	
    	$this->view->headTitle('Perfil Profissional');
    	$this->view->description = "Perfil Profissional";
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
    	/*$this->view->headMeta()->appendHttpEquiv('Content-Type',
    			'text/html; charset=utf-8');
    	*/
    	$this->view->headScript()->appendFile('public/js/perfil/ong.js');
    	//$this->_helper->layout->disableLayout();
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
    	//$this->_helper->layout->disableLayout();
    	$this->view->headScript()->appendFile('public/js/perfil/profissional.js')
    							->appendFile('public/js/perfil/dados-pessoais-profissional.js');
    	 
    	$this->view->headTitle('Perfil profissional - Dados pessoais ');
    	$this->view->description = "Perfil de profissional - Dados pessoais";
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
    		$form->addElement('text', 'id_usuario');
    		$form->setDefault('id_usuario',$data->id_usuario);
    		$form->campoOculto("id_usuario");
    		
    		$form->setDefault('nome',$data->nome);
    		$form->setDefault('sobrenome',$data->sobrenome);
    		$form->setDefault('login',$data->login);
    		$form->campoOculto("login");
    		$form->campoOculto('senha');
    		$form->campoOculto('confirm_senha');
    		$form->setDefault('email',$data->email);
    		$form->lockField('email');
    		if(!isset($data->cpf_cnpj) && $data->cpf_cnpj != "" || $data->cpf_cnpj != " "){
    			$form->addCpf();
    		}
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
    		$form->setDefault('sexo',$data->usuario_profissional->sexo);

    		$form->setDefault('estado', $data->cidade_estado->estado);
    		$form->loadCidades($data->cidade_estado->estado);
    		$form->setDefault('cidade', $data->cidade_estado->chave);
    		
    		$arrayEnd=explode("N?", $data->usuario_profissional->endereco);
    		$form->addEndereco();
    		$form->setDefault('endereco',$arrayEnd[0]);
    		$form->addNumero();
    		$form->setDefault('numero',(int)$arrayEnd[1]);
    		$form->addComplemento();
    		$form->setDefault('complemento',$data->usuario_profissional->complemento);
    		$form->addBairro();
    		$form->setDefault('bairro',$data->usuario_profissional->bairro);
    		$form->formObjetivos();
    		$form->setDefault('objetivo',$data->usuario_profissional->objetivos);
    		
    	}
    	$this->view->form = $form;
    }

    public function imagemAction()
    {
    	$this->view->headScript()->appendFile('public/js/perfil/profissional.js')
    			->appendFile('public/js/perfil/dados-pessoais-profissional.js');
    	$this->view->headTitle('Perfil profissional - Imagem ');
    	$this->view->description = "Perfil de profissional - Imagem";
    	$this->view->keywords = "cadastro,profissionais,voluntarios,procura";
    	$form = new Application_Form_Imagem();
    	$usuarioImagem = new Application_Model_DbTable_UsuarioImg();
    	$usuario = Zend_Auth::getInstance()->getIdentity();
    	$select=$usuarioImagem->select()
    						->where('id_usuario = ?',(int)$usuario->getId());
    	$rows = $usuarioImagem->fetchRow($select);
    	if($rows){
    		$possuiImagem=true;
    	}
    	else{
    		$possuiImagem=false;
    		 
    	}
    		
    	if($this->getRequest()->isPost() ){
    		$upload = new Application_Model_Upload();
    		$file=$upload->upload($usuario->getId());
    		if(!$file)
    		{
    			$dadosFormulario = $this->getRequest()->getPost();
    			$form->populate( $dadosFormulario );
    		}
    		else
    		{
    			if($possuiImagem){
    				$data = array("nome" => $file);
    				$where = $usuarioImagem->getAdapter()->quoteInto('id_usuario = ?', (int)$usuario->getId());
    				$usuarioImagem->update($data, $where);
    			}
    			else{
	    			$data = array("id_usuario" => $usuario->getId(),
	    					"nome" => $file);
	    			$usuarioImagem->insert($data);
    			}
    		}
    	}
    	$this->view->form =$form;
    	if($possuiImagem){
    		$this->view->nome = $rows->nome;
    		$this->view->path= "../data/uploads/imagem/profissional/";
    	}
    	else{
    		$this->view->nome ="ele.jpg";
    		$this->view->path="public/images/geral/";
    	}
    	
    }

    public function mensagemAction()
    {
    	
        // action body
    	$this->view->headTitle('Perfil profissional - Mensagem ');
    	$this->view->description = "Perfil de profissional - Mensagem";
    	$this->view->keywords = "cadastro,profissionais,voluntarios,procura";
    	$this->view->headScript()->appendFile('public/js/perfil/profissional.js');
    }

    public function emailAction()
    {
       // $this->_helper->layout->disableLayout();
    	$this->view->headTitle('Perfil profissional - Email ');
    	$this->view->description = "Perfil de profissional - Email";
    	$this->view->keywords = "cadastro,profissionais,voluntarios,procura";
    	$this->view->headScript()->appendFile('public/js/perfil/profissional.js');
    	$usuario = Zend_Auth::getInstance()->getIdentity();
    	$this->view->usuario = $usuario;
    	$this->view->email = $usuario->getEmail();
    	 
    }

    public function dadosAction()
    {
     //   $this->_helper->layout->disableLayout();
    	$this->view->headTitle('Perfil profissional - Dados confidenciais ');
    	$this->view->description = "Perfil de profissional - Dados confidenciais";
    	$this->view->keywords = "cadastro,profissionais,voluntarios,procura";
    	$this->view->headScript()->appendFile('public/js/perfil/profissional.js');
    	$this->view->headScript()->appendFile('public/js/perfil/dados.js');
    	
    }

    public function updateDadosProfissionalAction()
    {
    	// action body
    	$this->_helper->layout->disableLayout();
    	$this->_helper->viewRenderer->setNoRender();
    	header( 'Cache-Control: no-cache' );
    	header( 'Content-type: application/json; charset="utf-8"', true );
    	$request = $this->getRequest();
    	if ( $request->isPost() )
    	{
    		try {
    			$user= new Application_Model_DbTable_Usuario();
    			$usuarioProfissional = new Application_Model_DbTable_UsuarioProfissional();
    			if($user->checkUnique('cpf_cnpj', $request->getParam('cpf'))){
    				$data  = array(
    						'nome'   	=> $request->getParam('nome'),
    						'sobrenome' => $request->getParam('sobrenome'),
    						'update_at' => date("Y-m-d H:i:s"),
    						'cpf_cnpj' 	=> $request->getParam('cpf')
    				);
    				$where = $user->getAdapter()->quoteInto('id_usuario = ?', (int)$request->getParam('id_usuario'));
    				$user->update($data, $where);
    					
    				$arrdate=  explode('/', $request->getParam('dataNacimento',null));
    				if(!is_null($arrdate)){
    					$date=$arrdate[2]."-".$arrdate[1]."-".$arrdate[0];
    				}
    				else{
    					$date = NULL;
    				}
    				$endereco =$request->getParam('endereco');
    				$numero=$request->getParam('numero',null);
    				if(!is_null($numero))
    				{
    					$endereco .=" N� ".$numero;
    				}
    				$data  = array(
    						'sexo'   			=> $request->getParam('sexo'),
    						'data_nascimento'	 => $date,
    						'endereco' 			=>  $endereco ,
    						'complemento' 		=> $request->getParam('complemento',null),
    						'bairro' 			=> $request->getParam('bairro',null),
    						'cep' 				=> $request->getParam('cep',null),
    						'id_cidade' 		=> $request->getParam('cidade',null),
    						'objetivos' 		=> $request->getParam('objetivo',null)
    				);
    				$usuarioProfissional->update($data, $where);
    				echo $this->view->json(2);
    			}
    			else{
    				echo $this->view->json(5);
    			}
    		}
    		catch (Exception $e)
    		{
    			echo $e->getMessage();
    		}
    		 
    	}
    }
    
    public function updateDadosConfidenciaisAction()
    {
    	$this->_helper->layout->disableLayout();
    	$this->_helper->viewRenderer->setNoRender();
    	header( 'Cache-Control: no-cache' );
    	header( 'Content-type: application/json; charset="utf-8" ', true );
    	 
    	$request = $this->getRequest();
    	if ( $request->isPost() )
    	{

    		try{
    			$user= new Application_Model_DbTable_Usuario();
    			$usuarioSession = Zend_Auth::getInstance()->getIdentity();
    			$where = $user->getAdapter()->quoteInto('id_usuario = ?', (int)$usuarioSession->getId());
    			if($request->getParam('email',false))
    			{
    				if((int)$request->getParam('email') == 1)
    				{
    					$conf=0;
    				}
    				else{
    					$conf=1;
    				}
    				$data  = array(
    						'email_confidencial'   	=>$conf
    				);
    				$user->update($data, $where);
    				echo "1";
    			}
    			elseif($request->getParam('endereco',false))
    			{
    				if((int)$request->getParam('endereco') == 1)
    				{
    					$conf=0;
    				}
    				else{
    					$conf=1;
    				}
    				$data  = array(
    						'endereco_confidencial'   	=> $conf
    				);
    				$user->update($data, $where);
    				echo "1";
    			}
    			elseif($request->getParam('tel',false))
    			{
    				if((int)$request->getParam('tel') == 1)
    				{
    					$conf=0;
    				}
    				else{
    					$conf=1;
    				}
    				$data  = array(
    						'telefone_confidencial'   	=> $conf
    				);
    				$user->update($data, $where);
    				echo "1";
    			}
    			else{
    				echo "0";
    			}
    		}
    		catch (Exception $e){
    			echo $e->getMessage();
    		}
    	}
    	else
    	{
    		echo "0";
    		 
    	}
    }

    public function minhasAjudasAction()
    {
        // action body
    }


}




