<?php
class Application_Plugin_Auth extends Zend_Controller_Plugin_Abstract
{
	/**
	 * @var Zend_Auth
	 */
	protected $_auth = null;
	/**
	 * @var Zend_Acl
	 */
	protected $_acl = null;
	/**
	 * @var array
	 */
	protected $_notLoggedRoute = array(
        'controller' => 'auth',
        'action'     => 'login',
        'module'     => 'default'
	);
	/**
	 * @var array
	 */
	protected $_forbiddenRoute = array(
        'controller' => 'error',
        'action'     => 'forbidden',
        'module'     => 'default'
	);

	
	protected $_moRedirect = array("index","auth");
	
	
	/**
	 * Comtroller com permi��o abertos
	 * 
	 * @var unknown_type
	 */
	protected $_opemController = array( "index",
        								"error",
										"sobre-nos"
	);
	public function __construct()
	{
		$this->_auth = Zend_Auth::getInstance();
		$this->_acl = Zend_Registry::get('acl');
	}

	
	public function preDispatch(Zend_Controller_Request_Abstract $request)
	{
		$controller = "";
		$action     = "";
		$module     = "";
	/*	if($request->getControllerName() == "index" ){
			$controller = $request->getControllerName();
			$action     = $request->getActionName();
			$module     = $request->getModuleName();
		}
		else if ( !$this->_auth->hasIdentity() ) {
			
		}*/
		 if (!$this->_isAuthorized($request->getControllerName(),$request->getActionName())  ) {
		 	if(!$this->_auth->hasIdentity()){
		 		if(! in_array($request->getControllerName(), $this->_moRedirect))
		 		{
		 			Application_Model_Redirect::saveRequestUri("/".$request->getControllerName()."/".$request->getActionName());
		 		}
		 		$controller = $this->_notLoggedRoute['controller'];
		 		$action     = $this->_notLoggedRoute['action'];
		 		$module     = $this->_notLoggedRoute['module'];
		 	}
		 	else{
		 		$controller = $this->_forbiddenRoute['controller'];
		 		$action     = $this->_forbiddenRoute['action'];
		 		$module     = $this->_forbiddenRoute['module'];
		 	}
	 	} 
		
		else {
			$controller = $request->getControllerName();
			$action     = $request->getActionName();
			$module     = $request->getModuleName();
		}
		$request->setControllerName($controller);
		$request->setActionName($action);
		$request->setModuleName($module);
	}

	protected function _isAuthorized($controller, $action)
	{
		$this->_acl = Zend_Registry::get('acl');
		$user = $this->_auth->getIdentity();
		
		if(in_array($controller, $this->_opemController))
		{
			return true;
		}
		if ( !$this->_acl->has( $controller ) || !$this->_acl->isAllowed( $user, $controller, $action ) )
		{
			return false;
		}
		return true;
	}
	
}