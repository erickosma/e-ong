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
    
}

