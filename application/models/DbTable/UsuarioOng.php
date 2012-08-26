<?php

class Application_Model_DbTable_UsuarioOng extends Application_Model_DbTable_Usuario
{

    protected $_name = 'usuario_ong';
    protected $_schema ="ong";
    protected $_primary = 'id_usuario_ong';
    
    public function cadastroCompleto($id){
    	$row = $this->fetchRow(	$this->select()
						    	->from(array('uo' => $this->_name),array('desc'=>'ifnull(uo.desc_ong,0)','site'=> 'ifnull(uo.site,0)','endereco'=> 'ifnull(uo.endereco,0)'))
						    	->where('id_usuario =  ?', $id)
						    	);
    	$arr=$row->toArray();
    	if($arr["desc"]!= 0 && $arr["site"]!= 0  && $arr["endereco"]!= 0)
    	{
    		return true;
    	}
    	else
    	{
    		return false;
    	}
    }
}

