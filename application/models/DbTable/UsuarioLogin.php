<?php

class Application_Model_DbTable_UsuarioLogin extends Application_Model_DbTable_Usuario
{

	protected $_name = 'usuario_login';
	//protected $_schema ="ong";


	public function checkUnique($field,$value)
	{
		$user = $this->fetchRow($this->select()->where(''.$field.' = ?', $value));
		if($user)
		{
			return false;
		}
		return true;
	}

	public function checkEmail($email){
		$validator = new Zend_Validate_EmailAddress();
		if ($validator->isValid($email)) {
			// email address appears to be valid
			$validatorEmail = new Zend_Validate_Db_NoRecordExists(
			array(
    				    					        'table' => 'usuario_login',
    				    					        'field' => 'email'
    				    			    			
			)
			);
			if ($validatorEmail->isValid($email)) {
				return true;
			} else {
				return false;
			}
			 
		} else {
			return false;
		}
	}
}

