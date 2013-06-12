<?php

class Application_Model_Util
{


	
	/**
	 * Transforma array em objeto 
	 * 
	 * @param unknown_type $array
	 * @return unknown|stdClass|boolean
	 */

	public static function arrayToObject(array $array ,$object = null) {
		if(!is_array($array)) {
			return $array;
		}
		if ($object == null) {
			$object   = new stdClass();
		}
		$object = new stdClass();
		if (is_array($array) && count($array) > 0) {
			 foreach ($array as $key => $val) {
			 	if (is_array($val)) {
			 		$object->$key = self::arrayToObject($val, new stdClass);
			 	} else {
			 		$object->$key = $val;
			 	}
			 }
			 return $object;
		}
		else {
			return false;
		}
	}
	
	/**
	 * Converte uma data em um formato 
	 *$date1 = new Zend_Date('2013-03-11 02:26:51', null, 'pt_br');
	 *
	 * completo  11/03/2013  12:56:00
	 * normal  	 11/03/2013
	 * portal    11 Mar 2013
	 * @param unknown_type $data
	 * @param unknown_type $formato
	 */
	public static function trataData($data,$formato="completo")
	{
		//$date1 = new Zend_Date('2013-03-11 02:26:51', null, 'pt_br');
		if($formato == "completo"){
			$date = new Zend_Date($data, null, 'pt_br');
			return $date;
		}
		else if($formato == "normal"){
			$date = new Zend_Date($data);
			return  $date->get('dd/MM/YYYY');
		}
		else if($formato == "portal"){
			$date = new Zend_Date($data);
			return   $date->get('dd'). " ". ucfirst(substr($date->get('MMMM'), 0, 3)) ." ".$date->get('YYYY');
		}
	}
	
	
	public static function  trataCidadeEstado($cidade,$estado=null,$delimitador="-")
	{
		$cidade = ucwords(strtolower($cidade));
		if(!is_null($estado)){
			return $cidade ."".$delimitador."".$estado;
		}
		return $cidade;
	}
	

	public static function cortaString($texto, $quantidadeCaracteres, $stringComplemento="...")
	{
		$stringSemEspacos = trim($texto);
		$recorteString = "";
		for ($i = 0;; $i++)
		{
			if (($quantidadeCaracteres + $i) <= strlen($texto))
			{
				$stringRecortada = substr($stringSemEspacos, 0, $quantidadeCaracteres + $i);
				if(substr($stringRecortada, -1) == " ")
				{
					$recorteString = substr($stringRecortada, 0, -1) ."".$stringComplemento;
					break;
				}

			}
			elseif (($quantidadeCaracteres + $i) > strlen($texto))
			{
				$recorteString = $texto;
				break;
			}
		}
		return $recorteString;
	}
	
	
	public static  function saveLog($errors){
		
		$logger = new Zend_Log();
		$writer = new Zend_Log_Writer_Stream('application/tmp/erro/error.xml');
		$formatter = new Zend_Log_Formatter_Xml();
		$writer->setFormatter($formatter);
		$logger->addWriter($writer);
		//$exception->getTraceAsString();
		$msg= "<file>".$errors->getFile()."</file>";
		$msg.=  "<line>".$errors->getLine()."</line>";
		$msg.= "<error>".$errors->getMessage()."</error>";
		$logger->debug($msg."\r\n");
	}
	
	
	
	public static  function saveLogDB($errors)
	{
		$config = new Zend_Config_Ini('application/configs/application.ini', 'staging');
		$params = array ('host'     => $config->resources->db->params->host,
				'username' => $config->resources->db->params->username,
				'password' => $config->resources->db->params->password,
				'dbname'   => "estatisticas",
				'charset'   => $config->resources->db->params->charset,
				);
		$db = Zend_Db::factory('PDO_MYSQL', $params);
		
		$columnMapping = array(
				    'message'   => 'message',
					'file'   => 'file',
					'line'   => 'line',
				    'url'     => 'url',
				    'date'  => 'date',
				);
		$writer = new Zend_Log_Writer_Db($db, 'erro_log', $columnMapping);
		$logger   = new Zend_Log($writer);
		$logger->setEventItem('message',$errors->getMessage());
		$logger->setEventItem('file',$errors->getFile());
		$logger->setEventItem('line',$errors->getLine());
		$logger->setEventItem('url' , $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
		$logger->setEventItem('date', new Zend_Db_Expr('NOW()'));
		$logger->info("Erros");
		
	}
	
	
	public static function encodeNumUrl($url){
		return base64_encode(gzcompress($url));
	}
	
	public static function decodeNumUrl($url){
		return  @gzuncompress( base64_decode( $url ) );
	}
	
	

}

