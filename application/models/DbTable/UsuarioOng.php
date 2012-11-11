<?php

class Application_Model_DbTable_UsuarioOng extends Application_Model_DbTable_Usuario
{

    protected $_name = 'usuario_ong';
  //  protected $_schema ="ong";
    protected $_primary = 'id_usuario_ong';
    
    public function cadastroCompleto($id){
    	$row = $this->fetchRow(	$this->select()
						    	->from(array('uo' => $this->_name),array('desc'=>'ifnull(uo.desc_ong,0)','site'=> 'ifnull(uo.site,0)','endereco'=> 'ifnull(uo.endereco,0)'))
						    	->where('id_usuario =  ?', $id)
						    	);
    	$arr=$row->toArray();
    	if($this->checkTermo($arr["desc"]) && $this->checkTermo($arr["site"])  && $this->checkTermo($arr["endereco"]))
    	{
    		return true;
    	}
    	else
    	{
    		return false;
    	}
    }
    
    
    protected function checkTermo($termo)
    {
    	 
    	if(isset($termo) && $termo != ""  && $termo != " "  && $termo != "0")
    	{
    		return true;
    	}
    	else
    	{
    		return false;
    	}
    }
}

