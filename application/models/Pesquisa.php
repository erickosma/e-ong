<?php

class Application_Model_Pesquisa
{
	public $termo;
	public $result;
	public $numFound;
	public $qtdPesuisa;
	
	
	protected $start;
	protected $end;
	protected $time;
	protected $microtime;
	
	
	private $oportunidade;
	
	public function __construct()
	{
		$this->setNumFound(0);
		$this->setResult(false);
		$this->setTermo(false);
		$this->start = microtime(true);
		$this->qtdPesuisa=0;
	}
	
	
	public function setTermo($termo) {
		$this->termo = $termo;
	}
	public function getTermo() {
		return $this->termo;
	}
	
	public function setResult($result) {
		$this->result = $result;
	}
	public function getResult() {
		return $this->result;
	}
	
	
	public function setNumFound($numFound) {
		$this->numFound = $numFound;
	}
	public function getNumFound() {
		return $this->numFound;
	}
	
	
	public function setTime($time) {
		$this->time = $time;
	}
	
	public function getTime() {
		return $this->time;
	}
	
	public function setMicrotime($microtime) {
		$this->microtime = $microtime;
	}
	
	public function getMicrotime() {
		return $this->microtime;
	}
	
	
	
	public function checkParam($request)
	{
		$termo =false;
		$arr = explode("/", $request->getRequestUri());
		if(isset($arr[1]) && $arr[1] === "encontre"  && isset($arr[3]) ){
			$termo=strip_tags($arr[3]);
			$termo = preg_replace("/&#?[a-z0-9]+;/i","",$termo);
		}
		$this->setTermo(urldecode($termo));
		return $termo;
	}
	
	
	protected function duration(){
		$this->end = microtime(true);
		$duration=$this->end - $this->start;
		$this->setMicrotime($duration);
		$hours = (int)($duration/60/60);
		$minutes = (int)($duration/60)-$hours*60;
		$seconds = $duration-$hours*60*60-$minutes*60;
		if((int)$seconds >= 1){
			$this->setTime( round($seconds, 2) );
		}
		else{
			$this->setTime( round($duration, 2));
		}
		
	}
	
	/**
	 * metodo global de pesquisa 
	 * 
	 */
	public function pesquisa()
	{
		$this->oportunidade = new Application_Model_DbTable_Oportunidade();
		try {
			$this->pesquisaTitulo();
			if($this->getNumFound() > 0)
			{
				$this->duration();
				$this->qtdPesuisa=1;
				return $this->getResult();
			}
			//pesqiosa cidade 
			else
			{
				$this->pesquisaCidade();
				if($this->getNumFound() > 0)
				{
					$this->duration();
					$this->qtdPesuisa=2;
					return $this->getResult();
				}
				//pesquisa estado
				$this->pesquisaEstado();
				if($this->getNumFound() > 0)
				{
					$this->duration();
					$this->qtdPesuisa=2;
					return $this->getResult();
				}
				else{
					return false;
				}
			}
		}
		catch (Exception $e)
		{
			Application_Model_Util::saveLogDB($e);
		}
	}
	
	/**
	 * Processa um select 
	 * @param unknown_type $select
	 */
	protected function processPesquisa($select){
		$rows = $this->oportunidade->fetchAll($select);
		$this->setNumFound($rows->count());
		if($this->getNumFound() > 0){
			$this->setResult(Application_Model_Util::arrayToObject($rows->toArray()));
		}
	}
	
	
	/** 
	 * Pesquisa pelo titulo
	 */
	public function pesquisaTitulo(){
		$select  = $this->oportunidade->select()
							->setIntegrityCheck(false)
							->from(array("o"=>"oportunidade"))
							->joinInner(array('sc'=>'sys_cidade'),'sc.chave = o.cidade',
									array('sc.nome'))
							->joinInner(array('se'=>'sys_estado'),'se.chave = sc.estado',
									array('estado_nome'=>'se.nome','se.sigla'))
							->where('titulo LIKE ?', '%'.$this->getTermo().'%');
		//echo $select->__toString();
		$this->processPesquisa($select);
	}
	
	public function pesquisaCidade(){
		$select  = $this->oportunidade->select()
							->setIntegrityCheck(false)
							->from(array("o"=>"oportunidade"))
							->joinInner(array('sc'=>'sys_cidade'),'sc.chave = o.cidade',
										array('sc.nome'))
							->joinInner(array('se'=>'sys_estado'),'se.chave = sc.estado',
									array('estado_nome'=>'se.nome','se.sigla'))
							->where('sc.nome LIKE ?', '%'.strtoupper($this->getTermo()).'%');
		$this->processPesquisa($select);
	}
	
	public function pesquisaEstado(){
		$select  = $this->oportunidade->select()
						->setIntegrityCheck(false)
						->from(array("o"=>"oportunidade"))
						->joinInner(array('sc'=>'sys_cidade'),'sc.chave = o.cidade',
									array('sc.nome'))
						->joinInner(array('se'=>'sys_estado'),'se.chave = sc.estado',
									array('estado_nome'=>'se.nome','se.sigla'))
						->where('se.nome LIKE ?', '%'.ucwords($this->getTermo()).'%');
		$this->processPesquisa($select);
	}
	
	
	//quando estiver no modulo ajude se a palavra chave for nula coloca alguma 
	
}

