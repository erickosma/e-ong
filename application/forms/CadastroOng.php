<?php

class Application_Form_CadastroOng extends Zend_Form
{

    public function init()
    {
        $this->setName('ong');
    	$this->setAction("new-ong");
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
		//	->setValue("admin@a")
			->addDecorator('HtmlTag',
			array('tag'=>'div', 'class'=>'campoFim'))
			->addValidator("StringLength",false,array(4, 50 , 'messages'=> 'StringLength'))
			->addValidator('NotEmpty')
			->addValidator('regex', false, array('/[^a-zA-Z0-9@#\[\].]/'));
		//-----

		$fantasia = new Zend_Form_Element_Text('fantasia');
		$fantasia->setLabel("Nome Fantasia:")
				->setRequired(true)
				->addDecorator('HtmlTag',
				array('tag'=>'div', 'class'=>'campo'))
				->addFilter('StripTags')
				->addValidator("StringLength",false,array(4, 80 , 'messages'=> 'StringLength'))
				->addValidator('NotEmpty');
		
		$razao = new Zend_Form_Element_Text('razao');
		$razao->setLabel("Razão Social:")
				->setRequired(true)
				->addDecorator('HtmlTag',
				array('tag'=>'div', 'class'=>'campo'))
				->addFilter('StripTags')
				->addValidator("StringLength",false,array(4, 80 , 'messages'=> 'StringLength'))
				->addValidator('NotEmpty');
				
		
		$cpf = new Zend_Form_Element_Text('cnpj');
		$cpf->setLabel('CNPJ:')
			->setRequired(true)
			->setAttrib('alt', 'cnpj')
			->addFilter('StripTags')
			->addValidator('cnpj')
			->addFilter('StringTrim')
			->addValidator('NotEmpty')
			->addDecorator('HtmlTag',
						array('tag'=>'div', 'class'=>'campoFim'));
   		//------------------
		//endereço
		$endereco = new Zend_Form_Element_Text('endereco');
		$endereco->setLabel('Endereço:')
			->setRequired(true)
			->addFilter('StripTags')
			->addDecorator('HtmlTag',
			array('tag'=>'div', 'class'=>'campo'))
			->addValidator("StringLength",false,array(4, 50 , 'messages'=> 'StringLength'))
			->addValidator('NotEmpty');
		$numero = new Zend_Form_Element_Text('numero');
		$numero->setLabel('Nº:')
				->setAttrib('size', 5)
				->addDecorator('HtmlTag',
		array('tag'=>'div', 'class'=>'campo'));
		
		
		$complemento = new Zend_Form_Element_Text('complemento');
		$complemento->setLabel('Complemento:')
				->addFilter('StripTags')
				->addDecorator('HtmlTag',
				array('tag'=>'div', 'class'=>'campo'));
		$bairro = new Zend_Form_Element_Text('bairro');
		$bairro->setLabel('Bairro:')
				->addFilter('StripTags')
				->addDecorator('HtmlTag',
				array('tag'=>'div', 'class'=>'campo'));
		
		$cep= new Zend_Form_Element_Text('bairro');
		$cep->setLabel('Bairro:')
				->addFilter('StripTags')
				->addDecorator('HtmlTag',
				array('tag'=>'div', 'class'=>'campo'));
		
		
		$db_estado=new Application_Model_DbTable_SysEstado();
		 
		$state_array = $db_estado->fetchAll()->toArray();
		$arr[0]= "Escolha estado";
		foreach ($state_array as $est) {
			$arr[]=$est["nome"];
		}
		unset($arr[29]);
		unset($arr[28]);
		$state = new Zend_Form_Element_Select("estado");
		$state->setLabel('Estado:')
				->setName("estado")
				->addMultiOptions($arr)
				->setRequired(true)
				->addFilter('StripTags')
				->addDecorator('HtmlTag',
							array('tag'=>'div', 'class'=>'campo'));
		
		$cities = new Zend_Form_Element_Select("cidade");
		$cities->setLabel('Cidade:')
				->setName("cidade")
				->setOptions(array('RegisterInArrayValidator' => false))
				->setRequired(true)
				->addMultiOptions(array(
								'0'	=> 'Escolha estado'))
				->addFilter('StripTags')
				->addDecorator('HtmlTag',
							array('tag'=>'div', 'class'=>'campo'));
		
		$capoOculto= new Zend_Form_Element_Hidden("campo_oculto");
		$capoOculto->setValue("1");
		
		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setLabel('Cadastrar')
			->setAttrib('id', 'submitbutton');
		
		
		
		
		//decoracao
		$this->setDecorators(array(
					    	'FormElements',
							array('HtmlTag', array('tag' => 'div', 'class' => 'zend_form')),
							array('Description', array('placement' => 'prepend')),
					    	'Form'));
		$this->addElements(array($nome,$sobreNome,$login, 
								$passworf,$confirmPassworf,$email,
								 $fantasia,$razao,$cpf,
								$endereco,$numero,$complemento,
								$bairro,$cep,$state,$cities,$capoOculto,
								$submit));
		$translate = Zend_Registry::get('Zend_Translate');
		$this->setTranslator($translate);
		$translate->setLocale('br');

    }


}

