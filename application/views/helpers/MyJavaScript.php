<?php
class Zend_View_Helper_MyJavaScript extends Zend_View_Helper_HeadScript{
	
	public function MyJavaScript() 
	{
		//<script type="text/javascript" src="public/js/index/index.js"></script>
		$items = array();
		$scripts = array();
		foreach ($this as $item) {
			if ($item->type == 'text/javascript' ){
				$scripts[$item->src][] = $item->attributes['src'];
			} else {
				$items[] = $this->itemToString($item);
			}
		}
		foreach ($scripts as $src=>$js) {
			$item = new stdClass();
			$item->typre = 'text/javascript';
			$newname = 'js_' . md5('vcss'  . implode(',', $js) ) . '.js';
			$this->process($js, $newname);
			$item->attributes['src'] = $this->getMinUrl() . '/' . $newname;
			$items[] = $this->itemToString($item);
		}
		return  implode($this->_escape($this->getSeparator()), $items);
	}

	protected function process($files, $name)
	{
		$cacheFile = $this->getDir() . '/' . $name;
		$data = filemtime($cacheFile)+3600;
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
    		$fp = @fopen($cacheFile, "wb");
          if ($fp) {
              fwrite($fp, $cache);
              fclose($fp);
          }
      }
      
      public function getMinUrl() {
		
      	return  BASE_URL.'/public/tmp';
      }
      
      public function getDir(){
      	return APPLICATION_PATH."/../public/tmp";
      }
      
  }
