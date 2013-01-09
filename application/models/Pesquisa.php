<?php

class Application_Model_Pesquisa
{

	public function __construct()
	{
		
	}
	
	
	public function pesquisa($termo)
	{
		if($this->checkTermo($termo))
		{
			$oportunidade = new Application_Model_DbTable_Oportunidade();
			$select  = $oportunidade->select()
								->from(array("o"=> 'oportunidade'),	
											array("o.titulo","o.descricao","o.url"))
								->where('titulo LIKE ?', '%'.$termo.'%');
			$rows = $oportunidade->fetchAll($select);
			if($rows->count() > 0)
			{
				$rowsetArray = $rows->toArray();
				return $rowsetArray;
			}
		}
		else
		{
			return false;
		}
	}
	
	
	protected function checkTermo($termo)
	{
	
		if(isset($termo) && $termo != ""  && $termo != " "  && $termo != "0")
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	public function trataAreaAtuacao(){
		//manul 
		//sistema
		//retorna nome
	}
	
	public function trataData(){
		
	}
	
	public function trataUrl(){
			
	}
}

