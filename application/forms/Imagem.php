<?php

class Application_Form_Imagem extends Zend_Form
{

    public function init()
    {
        $this->setName('update-imagem');
    	$this->setAction("imagem");
		$element = new Zend_Form_Element_File('fileUpload');
    	$element->setLabel('')
	    	->addValidator('Extension', false, 'jpg,png,gif')
	    	->addValidator('Size', false, 4097152)
	    	->addValidator('Count', false, 1)
	    	->addDecorator('HtmlTag',
	    			array('tag'=>'div'));
    	$submit = new Zend_Form_Element_Submit('submit');
    	$submit->setLabel('Enviar imagem')
    			->setAttrib('id', 'submitbutton');
    	
    	$this->setDecorators(array(
    			'FormElements',
    			array('HtmlTag', array('tag' => 'div', 'class' => 'zend_form')),
    			array('Description', array('placement' => 'prepend')),
    			'Form'));
    	
    	$this->addElements(array($element,$submit));
    }


}

