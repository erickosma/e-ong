<?php
/**
 * Menu perfil
 * Auxiliar da Camada de Visualização
 * @author Erick GIorgio
 * @date 2011-10-04
 * @see APPLICATION_PATH/views/helpers/Date.php
 */
class Zend_View_Helper_Menu extends Zend_View_Helper_Abstract
{
    /**
     * Método Principal
     * @param string $value Valor para Formatação
     * @param string $format Formato de Saída
     * @return string Valor Formatado
     */
    public function menu($menu)
    {
    	$usuario = Zend_Auth::getInstance()->getIdentity();
    	$this->view->usuario = $usuario;
    	$this->view->translate = Zend_Registry::get('Zend_Translate');
		$this->view->translate->setLocale('br');
       if($menu != "" || !is_null($menu))
       {
       		echo $this->view->render ($menu.".phtml");
       }
       else
       {
    	   echo  $this->view->render("menu_topo.phtml");
       }
    }
   
}