<?php

class Application_Model_DbTable_Usuario extends Zend_Db_Table_Abstract
{
	protected $_schema ="ong";
    protected $_name = 'usuario';
    protected $_primary = 'id_usuario';

    public function checkUnique($field,$value)
    {
    	$user = $this->fetchRow($this->select()->where(''.$field.' = ?', $value));
    	if($user)
    	{
    		return false;
    	}
    	return true;
    }
    
    /*
     * Carrega todos os dados de um usu'ario 
     */
    public function loadAllDataUser($id){
    	//$data = $user_data->find($authNamespace->user->freelancer_id);
    	$select = $this->select()
				    	->setIntegrityCheck(false)
				    	->from(array("u"=> $this->_name))
				    	->joinInner(array('ul'=>'usuario_login'),'ul.id_usuario = u.id_usuario',
    								array('ul.login','ul.email'))
    					->where("u.id_usuario =?",$id);
    	$articleRecord= $this->fetchRow($select);
    	$data=$articleRecord->toArray();
    	if($data["tipo"] == 1){
    		$profissional = new Application_Model_DbTable_UsuarioProfissional();
			$select=	$profissional->select() 
		    		    			 ->where('id_usuario = ?', $data["id_usuario"] );
    		$rows = $profissional->fetchRow($select);		
    		$data["usuario_profissional"]=$this->arrayToObject($rows->toArray());
    		$cidade = new Application_Model_DbTable_SysCidade();
    		$data["cidade_estado"]=$cidade->loadCidadeEstado($data["usuario_profissional"]->id_cidade);
    	}
    	else if($data["tipo"] == 2){
    		$ong = new Application_Model_DbTable_UsuarioOng();
    		$select=	$ong->select()
    						->where('id_usuario = ?', $data["id_usuario"] );
    		$rows = $ong->fetchRow($select);
    		$data["usuario_ong"]=$this->arrayToObject($rows->toArray());
        	$cidade = new Application_Model_DbTable_SysCidade();
    		$data["cidade_estado"]=$cidade->loadCidadeEstado($data["usuario_ong"]->id_cidade);
  		
    	}
    	else{
    		$profissional = new Application_Model_DbTable_UsuarioProfissional();
			$select=	$profissional->select() 
		    		    			 ->where('id_usuario = ?', $data["id_usuario"] );
    		$rows = $profissional->fetchRow($select);		
    		$data["usuario_profissional"]=$this->arrayToObject($rows->toArray());
    		
    		$ong = new Application_Model_DbTable_UsuarioOng();
    		$select=	$ong->select()
    						->where('id_usuario = ?', $data["id_usuario"] );
    		$rows = $ong->fetchRow($select);
    		$data["usuario_ong"]=$this->arrayToObject($rows->toArray());
    		
    		$cidade = new Application_Model_DbTable_SysCidade();
    		$data["cidade_estado"]=$cidade->loadCidadeEstado($data["usuario_ong"]->id_cidade);
    	}
    	return $this->arrayToObject($data);
    }
    
    
    
   protected  function arrayToObject($array = array()) {
    	if (!empty($array)) {
    		$data = false;
    		foreach ($array as $akey => $aval) {
    			$data -> {$akey} = $aval;
    		}
    		return $data;
    	}
    	return false;
    }
    

}

