<?php

class Application_Model_Pesquisa
{

	
	public function __construct()
	{
	
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

