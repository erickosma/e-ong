<?php
class Application_Acl_Setup
{
	/**
	 * @var Zend_Acl
	 */
	protected $_acl;

	public function __construct()
	{
		$this->_acl = new Zend_Acl();
		$this->_initialize();
	}

	protected function _initialize()
	{
		$this->_setupRoles();
		$this->_setupResources();
		$this->_setupPrivileges();
		$this->_saveAcl();
	}

	protected function _setupRoles()
	{
		$this->_acl->addRole( new Zend_Acl_Role('guest') );
		$this->_acl->addRole( new Zend_Acl_Role('user'), 'guest' );
		$this->_acl->addRole( new Zend_Acl_Role('admin'), array('user','guest') );
	}

	protected function _setupResources()
	{
		$this->_acl->addResource( new Zend_Acl_Resource('auth') );
		$this->_acl->addResource( new Zend_Acl_Resource('index') );
		$this->_acl->addResource( new Zend_Acl_Resource('encontre') );
		$this->_acl->addResource( new Zend_Acl_Resource('buscar') );
		$this->_acl->addResource( new Zend_Acl_Resource('error') );
		$this->_acl->addResource( new Zend_Acl_Resource('cadastro') );
		$this->_acl->addResource( new Zend_Acl_Resource('perfil') );
		$this->_acl->addResource( new Zend_Acl_Resource('admin') );
	}

	protected function _setupPrivileges()
	{
		$this->_acl->allow(null, 'auth', array('index', 'login') )
					->allow(null, 'cadastro', 
							array('index', 'save','profissional','ong','cidades','valida-cpf','valida-cnpj','valida-user-name','valida-email','new-profissional','new-ong'))
					->allow( null, 'index', array('index'))
					->allow(null, 'encontre', array('index', 'ong', 'voluntario', 'termo', 'ajuda') )
		;
		$this->_acl->allow( 'user', 'cadastro', array('index', 'save','profissional','ong','ajuda','new-ajuda') )
					->allow( 'user', 'auth', 'logout' )
					->allow( 'user', 'perfil', array('index', 'save', 'editar', 'update', 'imagem', 'welcome','ong','profissional','dados-pessoais-profissional','update-dados-profissional','dados-pessoais-ong'
														,'mensagem','email','dados',"update-dados-confidenciais"));
		$this->_acl->allow( 'admin', 'admin' );
		
	}

	protected function _saveAcl()
	{
		$registry = Zend_Registry::getInstance();
		$registry->set('acl', $this->_acl);
	}
}