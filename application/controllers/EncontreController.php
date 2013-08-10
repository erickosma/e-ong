<?php

class EncontreController extends Zend_Controller_Action
{

	public function init()
	{
		$this->view->addHelperPath('ZendX/JQuery/View/Helper/', 'ZendX_JQuery_View_Helper');
		$this->view->headScript()->appendFile('public/js/jquery/js/jquery-1.7.1.min.js')
		->appendFile('public/js/buscar/pesquisa.js')
		->appendFile('public/js/jquery/js/plugins/cufon-yui.js')
		->appendFile('public/js/jquery/js/plugins/jquery.cycle.all.min.js')
		->appendFile('public/js/jquery/js/plugins/liberation_sans.js');
			
		 
		$this->view->headLink()
					->appendStylesheet('public/css/encontre/pesquisa.css')
					->appendStylesheet('public/css/geral.css')
					->appendStylesheet('public/css/forms.css');
		$this->view->headMeta()->appendName('keywords', 'ong, busca, profissionais,volunt�rios');	/* Initialize action controller here */
		$this->view->headTitle('Ação paralela');
		$this->view->description = "Encontre  vonluntarios e ong";
		$this->view->keywords = "ong,profissionais,voluntarios,procura,encontre";
		$this->view->headMeta()->appendHttpEquiv('Content-Type',
				'text/html; charset=utf8');
		$this->view->addHelperPath('ZendX/JQuery/View/Helper/', 'ZendX_JQuery_View_Helper');
		 
	}

	public function indexAction()
	{
		$Pesquisa  = new Application_Model_Pesquisa();

		$result = $Pesquisa->pesquisaVasia();
		$this->view->numFound = $Pesquisa->getNumFound();
		$this->view->time = $Pesquisa->getTime();
		$this->view->termo = "";
		$this->view->qtdPesquisa = $Pesquisa->qtdPesuisa;
		if($result){
			$this->view->result = $result;
		}
		$this->view->headTitle()->setSeparator(' - ');
		$this->view->headTitle()->prepend('Encontre  vonluntarios e ong');
		
		 //colocar aqui algo que grave os resultados
		 //para usar no futuro por usuário 
		
	}

	public function termoAction()
	{
		$Pesquisa  = new Application_Model_Pesquisa();

		$request = $this->getRequest();
		$termo = $Pesquisa->checkParam($request);
		if($termo){
			$result = $Pesquisa->pesquisa();
			$this->view->numFound = $Pesquisa->getNumFound();
			$this->view->time = $Pesquisa->getTime();
			$this->view->termo = urldecode($Pesquisa->getTermo());
			$this->view->qtdPesquisa = $Pesquisa->qtdPesuisa;
			if($result){
				$this->view->result = $result;
			}
			$this->view->headTitle()->setSeparator(' - ');
			$this->view->headTitle()->prepend('Encontre  vonluntarios e ong - '.$termo);
			
			$this->view->description = "Encontre  vonluntarios e ong -".$termo;
			$this->view->keywords = "ong,profissionais,voluntarios,procura,encontre,".$termo;
			
			 //colocar aqui algo que grave os resultados
			 //para usar no futuro por usuário 
		}
		else{
			$this->view->headTitle()->setSeparator(' - ');
			$this->view->headTitle()->prepend('Encontre  vonluntarios e ong');
			$this->view->description = "Encontre  vonluntarios e ong -".$termo;
			$this->view->keywords = "ong,profissionais,voluntarios,procura,encontre,".$termo;
			$this->view->numFound=0;
			 
		}
	}

	public function ajudeAction()
	{
		// action body
	}

	public function ajudaAction()
	{
		$this->view->headScript()
				->appendFile('public/js/jquery/js/plugins/jquery.jqEasyCharCounter.js');
		Application_Model_Redirect::saveRequestUri();
		$Pesquisa  = new Application_Model_Pesquisa();
		$request = $this->getRequest();
		$id = $Pesquisa->checkDigit($request);
		if($id)
		{
			$result = $Pesquisa->findById($id);
			$result= Application_Model_Util::arrayToObject($result[0]);
			if((int)$result->tipo == 1){
				$this->view->textoAjuda = "Entre em contato, de sua ajuda.";
			}
			else if((int)$result->tipo == 2){
				$this->view->textoAjuda = "Entre em contato com quem esta querendo ajudar.";
			//	$Ong = new  Application_Model_DbTable_UsuarioOng();
		//		$resOng=$Ong->find($result->id_usuario);
			//	print_r($resOng->toArray());exit;
			}
			$this->view->numFound = $Pesquisa->getNumFound();
			$this->view->time = $Pesquisa->getTime();
			$this->view->ajuda =  $result;
			if($usuario = Zend_Auth::getInstance()->getIdentity()){
				$this->view->estaLogado =true;
				$this->view->logado =$usuario;
				if($result->id_usuario == $usuario->getId()){
					$this->view->dono =true;
				}
				
			}
	
			
		}
		 
		 
		$this->view->id = $id;
	}

	public function ongAction()
	{
		// action body
	}


}









