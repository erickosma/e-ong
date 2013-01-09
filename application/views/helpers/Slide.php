<?php
/**
 * Menu perfil
 * Auxiliar da Camada de Visualização
 * @author Erick GIorgio
 * @date 2011-10-04
 * @see APPLICATION_PATH/views/helpers/Date.php
 */
class Zend_View_Helper_Slide extends Zend_View_Helper_Abstract
{
    /**
     * Método Principal
     * @param string $value Valor para Formatação
     * @param string $format Formato de Saída
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