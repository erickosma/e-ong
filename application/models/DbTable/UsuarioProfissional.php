<?php

class Application_Model_DbTable_UsuarioProfissional extends Application_Model_DbTable_Usuario
{

    protected $_name = 'usuario_profissional';
    protected $_schema ="ong";
    protected $_primary = 'id_usuario_profissional';
    
    
    public function cadastroCompleto($id){
    	$row = $this->fetchRow(	$this->select()
    								->from(array('up' => $this->_name),array('objetivo'=>'ifnull(up.objetivos,0)',
    																		'data_nascimento'=> 'ifnull(up.data_nascimento,0)',
    																		'endereco'=> 'ifnull(up.endereco,0)')
    										)		
    								->where('id_usuario =  ?', $id)
				);
    	$arr=$row->toArray();
    	if($this->checkTermo($arr["objetivo"])  && $this->checkTermo($arr["data_nascimento"])   &&  $this->checkTermo($arr["endereco"]))
    	{
    		return true;
    	}
    	else
    	{
    		return false;	
    	}
    	return false;
    }
    
    
    protected function checkTermo($termo)
    {
    	
    	if(isset($termo) && $termo != ""  && $termo != " " && $termo != "0")
    	{
    		return true;
    	}
    	else
    	{
    		return false;	
    	}
    }
}

