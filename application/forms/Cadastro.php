<?php

class Application_Form_Cadastro extends Zend_Form
{

    public function init()
    {
    	
    	$validacaoCpf = new Zend_Validate_Db_NoRecordExists(
    			array(
					'table' => 'usuario', 
					'field' => 'cpf_cnpj' 
    			));
        /* Form Elements & Other Definitions Here ... */
    	$this->setName('profissional');
		$nome = new Zend_Form_Element_Text('nome');
		$nome->setLabel("Nome")
			->setRequired(true)
			->addDecorator('HtmlTag',
					array('tag'=>'div', 'class'=>'campo'))
			->addFilter('StripTags')
			->addValidator("StringLength",false,array(4, 80 , 'messages'=> 'StringLength'))
			->addValidator('NotEmpty');
		$sobreNome = new Zend_Form_Element_Text('sobrenome');
		$sobreNome->setLabel("Sobrenome:")
			->setRequired(true)
			->addDecorator('HtmlTag',
				array('tag'=>'div', 'class'=>'campoFim'))
			->addFilter('StripTags')
			->addValidator("StringLength",false,array(4, 50 , 'messages'=> 'StringLength'))
			->addValidator('NotEmpty');

		
		$login = new Zend_Form_Element_Text('login');
		$login->setLabel('usuario:')
				->setRequired(true)
				->addFilter('StripTags')
				->addDecorator('HtmlTag',
					array('tag'=>'div', 'class'=>'campo'))
				->addValidator("StringLength",false,array(4, 50 , 'messages'=> 'StringLength'))
				->addValidator('NotEmpty');
		
		$passworf = new Zend_Form_Element_Password("senha");
		$passworf->setLabel('senha:')
			->setRequired(true)
			->addFilter('StripTags')
			->addDecorator('HtmlTag',
				array('tag'=>'div', 'class'=>'campo'))
			->addValidator("StringLength",false,array(4, 50 , 'messages'=> 'StringLength'))
			->addValidator('NotEmpty');
		$confirmPassworf = new Zend_Form_Element_Password("confirm_senha");
		$confirmPassworf->setLabel('confirma senha:')
			->setRequired(true)
			->addFilter('StripTags')
			->addDecorator('HtmlTag',
				array('tag'=>'div', 'class'=>'campo'))
			->addValidator("StringLength",false,array(4, 50 , 'messages'=> 'StringLength'))
			->addValidator('NotEmpty');
		$email = new Zend_Form_Element_Text('email');
		$email->setLabel('email:')
			->setRequired(true)
			->addFilter('StripTags')
			->addDecorator('HtmlTag',
			array('tag'=>'div', 'class'=>'campoFim'))
			->addValidator("StringLength",false,array(4, 50 , 'messages'=> 'StringLength'))
			->addValidator('NotEmpty')
			->addValidator('regex', false, array('/[^a-zA-Z0-9@#\[\].]/'));
		//-----
		$radio = new Zend_Form_Element_Radio('sexo');
		$radio->setLabel('Sexo')
				->setMultiOptions(array('1'=>'Mascolino','2'=>'Feminino')  )
				->setOptions(array('separator'=>'&nbsp;&nbsp;&nbsp;'))
				->addDecorator('HtmlTag',
					array('tag'=>'div', 'class'=>'btRadio'));
		$dataNacimento = new Zend_Form_Element_Text("dataNacimento");
		$dataNacimento->setLabel('Data nascimento:')
					->addDecorator('HtmlTag',
						array('tag'=>'div', 'class'=>'campo'));
		
		
		$cpf = new Zend_Form_Element_Text('cpfcli');
		$cpf->setLabel('CPF/CNPJ:')
			->setRequired(true)
			->setAttrib('size', 25)
			->setAttrib('alt', 'cpf-cnpj')
			->addFilter('StripTags')
			->addValidator('Cpf')
			->addFilter('StringTrim')
			->addValidator('NotEmpty')
			->addValidator($validacaoCpf)
			->addDecorator('HtmlTag',
						array('tag'=>'div', 'class'=>'campo'));
   		
		$endereco = new Zend_Form_Element_Text('login');
		$endereco->setLabel('endereco:')
			->setRequired(true)
			->addFilter('StripTags')
			->addDecorator('HtmlTag',
			array('tag'=>'div', 'class'=>'campo'))
			->addValidator("StringLength",false,array(4, 50 , 'messages'=> 'StringLength'))
			->addValidator('NotEmpty');

		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setLabel('Logar')
		->setAttrib('id', 'submitbutton');
		
		
		
		
		//decoracao
		$this->setDecorators(array(
					    	'FormElements',
		array('HtmlTag', array('tag' => 'div', 'class' => 'zend_form')),
		array('Description', array('placement' => 'prepend')),
					    	'Form'));
		$this->addElements(array($nome,$sobreNome,$login, 
								$passworf,$confirmPassworf,$email,
								$radio, $dataNacimento,$cpf,$submit));
		$translate = Zend_Registry::get('Zend_Translate');
		$this->setTranslator($translate);
		$translate->setLocale('br');
		
    }


}

