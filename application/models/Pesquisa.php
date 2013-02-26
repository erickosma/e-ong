<?php

class Application_Model_Pesquisa
{
	public $termo;
	public $result;
	public $numFound;
	
	
	
	public function __construct()
	{
	
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
	
	public function checkParam($request)
	{
		$termo =false;
		$arr = explode("/", $request->getRequestUri());
		if(isset($arr[1]) && $arr[1] === "encontre"  && isset($arr[3]) ){
			$termo=strip_tags($arr[3]);
			$termo = preg_replace("/&#?[a-z0-9]+;/i","",$termo);
		}
		$this->setTermo($termo);
		return $termo;
	}
	
	
	public function pesquisa()
	{
		$oportunidade = new Application_Model_DbTable_Oportunidade();
		$select  = $oportunidade->select()
		->where('titulo LIKE ?', '%teste%');
		$rows = $oportunidade->fetchAll($select);
		if($rows->count() > 0){
			$rowsetArray = $rows->toArray();
				
			foreach ($rowsetArray as $rowArray) {
				foreach ($rowArray as $column => $value) {
					echo "\t$column => $value\n";
				}
			}
	
		}
		exit;
	
	}
	
	
	
}

