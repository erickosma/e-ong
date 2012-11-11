<?php

class Application_Model_DbTable_SysCidade extends Zend_Db_Table_Abstract
{
	//protected $_schema ="ong";
    protected $_name = 'sys_cidade';

    public function loadCidadeEstado($id){
    	$select = $this->select()
				    	->setIntegrityCheck(false)
				    	->from(array("sc"=>'sys_cidade'))
				    	->joinInner(array('se'=>'sys_estado'),'se.chave = sc.estado',
				    			array('estado_nome'=>'se.nome','se.sigla'))
				    	->where("sc.chave = ?",$id);
    	$articleRecord= $this->fetchRow($select);
    	$data=$articleRecord->toArray();
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
    
    public function loadCidadeByestado($estado){
    	$col = $this->fetchAll(
    		$this->select()
	    		->where('estado = ?', $estado)
	    		->order('nome')
    		);
    	return $col->toArray();
    }
}

