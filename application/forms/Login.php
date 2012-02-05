<?php

class Application_Form_Login extends Zend_Form
{

	public function init()
	{
		/* Form Elements & Other Definitions Here ... */
		 
		$this->setName('login');
		$login = new Zend_Form_Element_Text('login');
		$login->setLabel('Login:')
				->setRequired(true)
				->addFilter('StripTags')
				->addDecorator('HtmlTag', 
						array('tag'=>'div', 'class'=>'campo'))
				->addValidator("StringLength",false,array(4, 50 , 'messages'=> 'StringLength'))
				->addValidator('NotEmpty');
		$senha = new Zend_Form_Element_Password('senha');
		$senha->setLabel('Senha:')
				->setRequired(true)
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addDecorator('HtmlTag',
						array('tag'=>'div', 'class'=>'campo'))
				->addValidator("StringLength",false,array(4, 50 , 'messages'=> 'StringLength'))
				->addValidator('NotEmpty');
		 
		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setLabel('Logar')
				->setAttrib('id', 'submitbutton');
		// We want to display a 'failed authentication' message if necessary;
		// we'll do that with the form 'description', so we need to add that
		// decorator.
		$this->setDecorators(array(
			    	'FormElements',
					array('HtmlTag', array('tag' => 'div', 'class' => 'zend_form')),
					array('Description', array('placement' => 'prepend')),
			    	'Form'));
		$this->addElements(array($login, $senha, $submit));
		$translate = Zend_Registry::get('Zend_Translate');
		$this->setTranslator($translate);
		$translate->setLocale('br');
	}


}

