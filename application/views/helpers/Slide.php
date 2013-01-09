<?php
/**
 * Menu perfil
 * Auxiliar da Camada de Visualiza��o
 * @author Erick GIorgio
 * @date 2011-10-04
 * @see APPLICATION_PATH/views/helpers/Date.php
 */
class Zend_View_Helper_Slide extends Zend_View_Helper_Abstract
{
    /**
     * M�todo Principal
     * @param string $value Valor para Formata��o
     * @param string $format Formato de Sa�da
     * @return string Valor Formatado
     */
    public function slide($slide="slide")
    {
    	$this->view->slide=0;
 		$controller =Zend_Controller_Front::getInstance()->getRequest()->getControllerName();
    	if($controller == "index" || $controller = "sobre-nos")
	    {
	    	$this->view->slide=1;
	    }
	    else{
	    	$this->view->slide=0;
	    }
       if($slide != "" || !is_null($slide))
       {
       		echo $this->view->render ($slide.".phtml");
       }
       else
       {
    	   echo  $this->view->render("slide.phtml");
       }
    }
   
}