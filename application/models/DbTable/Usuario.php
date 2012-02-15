<?php

class Application_Model_DbTable_Usuario extends Zend_Db_Table_Abstract
{
	protected $_schema ="ong";
    protected $_name = 'usuario';

    public function checkUnique($field,$value)
    {
    	$user = $this->fetchRow($this->select()->where(''.$field.' = ?', $value));
    	if($user)
    	{
    		return false;
    	}
    	return true;
    }
    
}

