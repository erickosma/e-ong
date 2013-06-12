<?php

 class  Application_Model_Redirect
{

	/**
	 * Enter description here...
	 *
	 * @var string
	 */
	protected  static $_namespace = __CLASS__;
	
	/**
	 * Enter description here...
	 *
	 * @var Zend_Session_Namespace
	 */
	protected static $_session = null;
	
	/**
	 * Enter description here...
	 *
	 * @param string $namespace
	 * @return ZendY_Controller_Action_Helper_LastDecline
	 */
	public static  function setNamespace($namespace)
	{
		self::$_namespace = $namespace;
		return $this;
	}
	
	/**
	 * Enter description here...
	 *
	 * @return string
	 */
	public static function getNamespace()
	{
		return self::$_namespace;
	}
	
	/**
	 * Enter description here...
	 *
	 * @param Zend_Session_Namespace $session
	 * @return ZendY_Controller_Action_Helper_LastDecline
	 */
	public static function setSession($session)
	{
		self::$_session = $session;
		return self;
	}
	
	/**
	 * Enter description here...
	 *
	 * @return Zend_Session_Namespace
	 */
	public static function getSession()
	{
		if (null === self::$_session) {
			self::$_session = new Zend_Session_Namespace(self::getNamespace());
		}
		return self::$_session;
	}
	
	public static function destroy(){
		Zend_Session::namespaceUnset(self::getNamespace());
	}
	
	/**
	 * Enter description here...
	 *
	 * @return Zend_Controller_Action_Helper_Redirector
	 */
	protected static function _getRedirector()
	{
		return Zend_Controller_Action_HelperBroker::getStaticHelper('Redirector');
	}
	
	/**
	 * Enter description here...
	 *
	 * @param string $requestUri
	 * @return ZendY_Controller_Action_Helper_LastDecline
	 */
	public static function saveRequestUri($requestUri = '')
	{
		if ('' === $requestUri) {
			$requestUri = Zend_Controller_Front::getInstance()->getRequest()->getRequestUri();
		}
		self::getSession()->lastRequestUri = $requestUri;
	
		return $this;
	}
	
	/**
	 *
	 * @return bool
	 */
	public static function hasRequestUri()
	{
		$session = self::getSession();
		return isset($session->lastRequestUri);
	}
	
	/**
	 * Enter description here...
	 *
	 * @return string|null
	 */
	public static function getRequestUri()
	{
		$session = self::getSession();
		if (self::hasRequestUri()) {
			$lastRequestUri = $session->lastRequestUri;
			unset($session->lastRequestUri);
			return $lastRequestUri;
		} else {
			return null;
		}
	}
	
	/**
	 * Enter description here...
	 *
	 */
	public static function redirect()
	{
		if (null === ($lastRequestUri = self::getRequestUri())) {
			self::_getRedirector()->gotoUrl('/perfil');
			//self::destroy();
		} else {
			self::_getRedirector()->gotoUrl($lastRequestUri);
			//self::destroy();
		}
	}
	
	/**
	 * Enter description here...
	 *
	 */
	public static function direct()
	{
		self::redirect();
	}
	
	public static function redirectUrl($url){
		self::_getRedirector()->gotoUrl($url);
	}
}

