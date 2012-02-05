<?php
class Zend_View_Helper_MyStyle extends Zend_View_Helper_HeadLink {

	public function MyStyle()
	{
		$items = array();
		$stylesheets = array();
		foreach ($this as $item) {
			if ($item->type == 'text/css' && $item->conditionalStylesheet === false) {
				$stylesheets[$item->media][] = $item->href;
			} else {
				$items[] = $this->itemToString($item);
			}
		}
		foreach ($stylesheets as $media=>$styles) {
			$item = new stdClass();
			$item->rel = 'stylesheet';
			$item->type = 'text/css';
			$newname = 'css_' . md5('vcss'  . implode(',', $styles) ) .'.css';
			$this->process($styles, $newname);
			$item->href =$this->getMinUrl() . '/' . $newname;
			$item->media = $media;
			$item->conditionalStylesheet = false;
			$items[] = $this->itemToString($item);
		}
		return  implode($this->_escape($this->getSeparator()), $items);
	}

	protected function process($files, $name)
	{
		$cacheFile = $this->getDir() . '/' . $name;
		if (file_exists($cacheFile) ) {
			$data = filemtime($cacheFile)+3600;
			if(($data < time())){
				return;
			}
		}
		$cache='';
		foreach ($files as $v) {
			$cache .= file_get_contents(APPLICATION_PATH."/../" . $v );
		}
		$fp = fopen($cacheFile, "wb");
		if ($fp) {
			fwrite($fp, $cache);
			fclose($fp);
		}
	}

	public function getMinUrl() {
		return BASE_URL.'/public/tmp';
	}

	public function getDir(){
		return APPLICATION_PATH ."/../public/tmp";
	}

}
