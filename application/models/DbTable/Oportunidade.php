<?php

class Application_Model_DbTable_Oportunidade extends Zend_Db_Table_Abstract
{

    protected $_name = 'oportunidade';
    protected $_primary = 'id_oportunidade';

    
    
    public  function arrayToObject($array = array()) {
    	if (!empty($array)) {
    		$data = false;
    		foreach ($array as $akey => $aval) {
    			$data -> {$akey} = $aval;
    		}
    		return $data;
    	}
    	return false;
    }
    
    
    
    public function ultimas($count=2){
    	$select  = $this->select()
    	->setIntegrityCheck(false)
    	->from(array("o"=>"oportunidade"))
    	->joinInner(array('sc'=>'sys_cidade'),'sc.chave = o.cidade',
    			array('sc.nome'))
    	->joinInner(array('ou'=>'oportunidade_usuario'),'ou.id_oportunidade = o.id_oportunidade',
    			array('ou.id_usuario','ou.tipo',))
    	->joinInner(array('se'=>'sys_estado'),'se.chave = sc.estado',
    			array('estado_nome'=>'se.nome','se.sigla'))
    	->order(array('o.update_at desc', 'o.create_at desc'))
    	->limit($count);
    	//$sql = $select->__toString();
		//echo "$sql\n";exit;
    	return $select;
    }
}

