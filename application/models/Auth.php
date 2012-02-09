<?php

class Application_Model_Auth
{
    public static function login($login, $senha)
    {
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        //Inicia o adaptador Zend_Auth para banco de dados
        $authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);
        $authAdapter->setTableName('usuario_login')
                    ->setIdentityColumn('login')
                    ->setCredentialColumn('senha')
                    ->setCredentialTreatment('SHA1(?)');
        //Define os dados para processar o login
        $authAdapter->setIdentity($login)
                    ->setCredential($senha);
        //Faz inner join dos dados do perfil no SELECT do Auth_Adapter
        $select = $authAdapter->getDbSelect();
        $select->join( array('u' => 'usuario'), 'u.id_usuario = usuario_login.id_usuario', array( 'nome'=> 'CONCAT(u.nome," ",u.sobrenome )' , 'u.tipo') );
        //Efetua o login
        $auth = Zend_Auth::getInstance();
        $result = $auth->authenticate($authAdapter);
        //Verifica se o login foi efetuado com sucesso
        if ( $result->isValid() ) {
            //Recupera o objeto do usuário, sem a senha
            $info = $authAdapter->getResultRowObject(null, 'senha');
 
            $usuario = new Application_Model_Usuario();
            $usuario->setId($info->id_usuario);
            $usuario->setFullName( $info->nome );
            $usuario->setUserName( $info->login );
            $usuario->setEmail($info->email);
            switch ($info->tipo){
            	case '0':
        		    $usuario->setRoleId("admin");
 		 		break;
 		 		case '1':
 		 			$usuario->setRoleId("user");
 		 		break;
 		 		case '2':
 		 			$usuario->setRoleId("user");
 		 			break;
            }
            $storage = $auth->getStorage();
            $storage->write($usuario);
            $authNamespace = new Zend_Session_Namespace('Zend_Auth');
            $authNamespace->user = $usuario;
            	
            return true;
        }
        else{
        	$authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);
        	$authAdapter->setTableName('usuario_login')
	        	->setIdentityColumn('email')
	        	->setCredentialColumn('senha')
	        	->setCredentialTreatment('SHA1(?)');
        	//Define os dados para processar o login
        	$authAdapter->setIdentity($login)
        		->setCredential($senha);
        	//Faz inner join dos dados do perfil no SELECT do Auth_Adapter
        	$select = $authAdapter->getDbSelect();
        	$select->join( array('u' => 'usuario'), 'u.id_usuario = usuario_login.id_usuario', array( 'nome'=> 'CONCAT(u.nome," ",u.sobrenome )' , 'u.tipo') );
        	//Efetua o login
        	$auth = Zend_Auth::getInstance();
        	$result = $auth->authenticate($authAdapter);
        	//Verifica se o login foi efetuado com sucesso
        	if ( $result->isValid() ) {
        		//Recupera o objeto do usuário, sem a senha
        		$info = $authAdapter->getResultRowObject(null, 'senha');
        	
        		$usuario = new Application_Model_Usuario();
        		$usuario->setFullName( $info->nome );
        		$usuario->setUserName( $info->login );
        		$usuario->setEmail($info->email);
        		switch ($info->tipo){
        			case '0':
        				$usuario->setRoleId("admin");
        				break;
        			case '1':
        				$usuario->setRoleId("user");
        				break;
        			case '2':
        				$usuario->setRoleId("user");
        				break;
        		}
        		$storage = $auth->getStorage();
        		$storage->write($usuario);
        		return true;
        	} 
        }
        throw new Exception('<div id="erroLogin">Nome de usuário ou senha inválida</div>');
    }
}

