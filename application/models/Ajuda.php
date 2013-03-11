<?php

class Application_Model_Ajuda
{
	private $idOportunidade;
	private $titulo;
	private $horario;
	private $areaAtuacao;
	private $areaAtuacaoManual;
	private $descricao;
	private $url;
	private $cidade;
	private $status;
	private $createAt;
	private $updateAt;
	private $total;
	private $usuario;
	
	public function setIdOportunidade($idOportunidade) {
		$this->idOportunidade = $idOportunidade;
	}
	public function getIdOportunidade() {
		return $this->idOportunidade;
	}
	
	
	public function setTitulo($titulo) {
		$this->titulo = $titulo;
	}
	public function getTitulo() {
		return $this->titulo;
	}
	
	
	public function setHorario($horario) {
		$this->horario = $horario;
	}
	public function getHorario() {
		return $this->horario;
	}
	
	
	public function setAreaAtuacao($areaAtuacao) {
		$this->areaAtuacao = $areaAtuacao;
	}
	public function getAreaAtuacao() {
		return $this->areaAtuacao;
	}
	
	
	
	public function setAreaAtuacaoManual($areaAtuacaoManual) {
		$this->areaAtuacaoManual = $areaAtuacaoManual;
	}
	public function getAreaAtuacaoManual() {
		return $this->areaAtuacaoManual;
	}
	
	
	public function setDescricao($descricao) {
		$this->descricao = $descricao;
	}
	public function getDescricao() {
		return $this->descricao;
	}
	
	
	public function setUrl($url) {
		$this->url = $url;
	}
	public function getUrl() {
		return $this->url;
	}
	
	
	public function setCidade($cidade) {
		$this->cidade = $cidade;
	}
	public function getCidade() {
		return $this->cidade;
	}
	
	
	public function setStatus($status) {
		$this->status = $status;
	}
	public function getStatus() {
		return $this->status;
	}
	
	
	public function setCreateAt($createAt) {
		$this->createAt = $createAt;
	}
	public function getCreateAt() {
		return $this->createAt;
	}
	
	
	public function setUpdateAt($updateAt) {
		$this->updateAt = $updateAt;
	}
	public function getUpdateAt() {
		return $this->updateAt;
	}
	
	public function setUsuario($usuario) {
		$this->usuario = $usuario;
	}
	
	public function getUsuario() {
		return $this->usuario;
	}
	
//------------------------------------------------------------	
	
	
	public function loadById(){
		
	}
	
	
	public function newAjuda(){
		$Oportunidade = new Application_Model_DbTable_Oportunidade();
		$novaAjuda  = $Oportunidade->createRow();
		$novaAjuda->titulo = $this->getTitulo();
		$novaAjuda->descricao = $this->getDescricao();
		$novaAjuda->cidade =$this->getCidade();
		$novaAjuda->status =$this->getStatus();
		$novaAjuda->create_at =$this->getCreateAt();
		//salva
		$id = $novaAjuda->save();
		$this->setIdOportunidade($id);
		if(isset($id)){
			$url =$this->formataUrl(). "-" .$id;
			$data = array("url" =>$url );
			$where = $Oportunidade->getAdapter()->quoteInto('id_oportunidade = ?', (int)$id);
			$Oportunidade->update($data, $where);
			
			$OportunidadeUsuario = new Application_Model_DbTable_OportunidadeUsuario();
			$row  = $OportunidadeUsuario->createRow();
			$row->id_oportunidade	= $id;
			$row->id_usuario =  $this->getUsuario()->getId();
			$row->tipo =  $this->getUsuario()->getTipo();
			$row->save();
			return $id;
			
		}
		else{
			return false;
		}
	}
	

		
	protected function formataUrl($string=null)
	{
		if(!is_null($string))
		{
			return  urlencode(strtolower(preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $string)));
		}
		else{
			return  urlencode(strtolower(preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $this->getTitulo())));
			
		}
	
	}
}

