<?php

class Application_Model_Upload
{

	private  $path;
	private $fileImfo;
	
	protected  $imageAdapter;
	
	public function setPath($path) {
		$this->path = $path;
	}
	public function getPath() {
		return $this->path;
	}
	
	public function setFileImfo($fileImfo) {
		$this->fileImfo = $fileImfo;
	}
	public function getFileImfo() {
		return $this->fileImfo;
	}
	
	
	public function __construct()
	{
		
		$this->setPath('C:\php\workspace\acaoparalela\data\uploads\imagem\profissional\\');
		$this->imageAdapter= new Zend_File_Transfer_Adapter_Http();
	}

	
	public function upload($userId=false)
	{
		$this->imageAdapter->setDestination($this->getPath());
		$files = $this->imageAdapter->getFileInfo();
		$this->setFileImfo($files);
		foreach ($files as $file => $info) {
			/* Verifica se é valido */
			if ( $this->checkExtention($info["name"]) && $this->imageAdapter->isValid($file)) {
				try {
					$this->imageAdapter->receive($file);
					$fileName = $this->imageAdapter->getFileName($file);
					$name = $this->imageAdapter->getFileName($file, false);
					rename($fileName, $this->getPath()."".$userId.".".$this->findExts($name));
					return $userId.".".$this->findExts($name);
				} catch (Zend_File_Transfer_Exception $e) {
					$e->getMessage();
					return false;
				}
				
			}
		}
		return false;
	}

	protected function findExts($filename)
	{
		$filename = strtolower($filename) ;
		$exts = split("[/\\.]", $filename) ;
		$n = count($exts)-1;
		$exts = $exts[$n];
		return $exts;
	
	}
	protected function checkExtention($fileName)
	{
		$ext=$this->findExts($fileName);
		if($ext == "jpg"   ||  $ext == "png" ||  $ext == "gif")
		{
			return true;			
		}
		else
		{
			return false;
		}
		
	}
}

