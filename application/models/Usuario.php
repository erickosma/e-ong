<?php

class Application_Model_Usuario implements Zend_Acl_Role_Interface
{
    private $_userName;
    private $_roleId;
    private $_fullName;
    private $_email; 
    private $id;
    private $_tipo;
    private $dadosCompletos;
 
    public function getUserName()
    {
        return $this->_userName;
    }
 
    public function setUserName($userName)
    {
        $this->_userName = (string) $userName;
    }
 
    public function getFullName()
    {
        return $this->_fullName;
    }
 
    public function setFullName($fullName)
    {
        $this->_fullName = (string) $fullName;
    }
    /**
     *
     */
    public function getRoleId()
    {
        return $this->_roleId;
    }
 
    public function setRoleId($roleId)
    {
        $this->_roleId = (string) $roleId;
    }
    
    public function setEmail($_email) {
    	$this->_email = $_email;
    }
    
    public function getEmail() {
    	return $this->_email;
    }
    
    public function setId($id) {
    	$this->id = $id;
    }
    
    public function getId() {
    	return $this->id;
    }
    
    public function setTipo($_tipo) {
    	$this->_tipo = $_tipo;
    }
    
    public function getTipo() {
    	return $this->_tipo;
    }
    
    public function setDadosCompletos($dadosCompletos) {
    	$this->dadosCompletos = $dadosCompletos;
    }
    
    public function getDadosCompletos() {
    	return $this->dadosCompletos;
    }
    
}

