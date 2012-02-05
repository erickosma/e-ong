<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

	protected function _initAutoload()
	{
		require_once 'Zend/Loader/Autoloader.php';
		$moduleLoader = new Zend_Application_Module_Autoloader(array(
							'basePath'      => APPLICATION_PATH,
		    				'namespace'     => 'Application' ));
		$autoloader = Zend_Loader_Autoloader::getInstance();
		$autoloader->setFallbackAutoloader(true);
		return $autoloader;
	}

	/**
	 * Função faz a conexão com o banco de dados e registra a variável $db para
	 * que ela esteja disponível em toda a aplicação.
	 */
	protected function _initConnection()
	{

		/**
		 * Obtém os resources(recursos).
		 */
		$options    = $this->getOption('resources');
		$db_adapter = $options['db']['adapter'];
		$params     = $options['db']['params'];

		try{

			/**
			 * Este método carrega dinamicamente a classe adptadora
			 * usando Zend_Loader::loadClass().
			 */
			$db = Zend_Db::factory($db_adapter, $params);

			/**
			 * Este método retorna um objeto para a conexão representada por uma
			 * respectiva extensão de banco de dados.
			 */
			$db->getConnection();
			// Registra a $db para que se torne acessível em toda app
			$registry = Zend_Registry::getInstance();
			$registry->set('db', $db);
			$select = new Zend_Db_Select($db);

		}catch( Zend_Exception $e){
			echo "Estamos sem conexão ao banco de dados neste momento. Tente mais tarde por favor.";
			exit;
		}


	}
	
	/**
	*
	* Initiate translation package in the portal register in the variable Zend_Translate and load
	* the archive.
	*
	* @access protected
	* @return null
	*/
	protected function _initLanguage()
	{
		try
		{
			$translate = new Zend_Translate('csv',APPLICATION_PATH .'/languages/en.csv','en' );
			$translate->addTranslation( APPLICATION_PATH .'/languages/br.csv', 'br');
			Zend_Registry::set('Zend_Translate', $translate);
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
		}
	}
	
	
	protected function _initAcl()
	{
		//$aclSetup = new Aplication_Acl_Setup();
	}
	

}

