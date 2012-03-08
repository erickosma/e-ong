<?php

class Application_Form_Cadastro extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
    	$this->setName('profissional');
    	$this->setAction("new-profissional");
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
		
		
		$cpf = new Zend_Form_Element_Text('cpf');
		$cpf->setLabel('CPF:')
			->setRequired(true)
			->setAttrib('alt', 'cpf')
			->addFilter('StripTags')
			->addValidator('Cpf')
			->addFilter('StringTrim')
			->addValidator('NotEmpty')
			->addDecorator('HtmlTag',
						array('tag'=>'div', 'class'=>'campoFim'));
   		
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
			$arr[]=utf8_decode($est["nome"]);
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
								$radio, $dataNacimento,$cpf,
								$endereco,$numero,$complemento,
								$bairro,$cep,$state,$cities,
								$submit));
		
		$translate = Zend_Registry::get('Zend_Translate');
		$this->setTranslator($translate);
		$translate->setLocale('br');
		
    }
	
	public function lockField($field){       
        $elem = $this->getElement($field);       
        $elem->setAttrib('disabled', true);
        $elem->setAttrib('readonly',true);
    }
    
    public function campoOculto($field){       
        $elem = $this->getElement($field);
        $elem->addDecorator('HtmlTag',
    		array('tag'=>'div', 'style'=>'display:none;'));
        $elem->removeDecorator('label');
    }
    
    
    public function loadCidades($estado,$field="cidade"){
    	$citiesdb = new Application_Model_DbTable_SysCidade();
    	$rows=$citiesdb->loadCidadeByestado($estado);
    	$arr[0]= "Escolha cidade";
    	foreach ($rows as $est) {
    		$arr[$est["chave"]]=$est["nome"];
    	}
    	$elem = $this->getElement($field);
    	$elem->addMultiOptions($arr);
    }
    
    public function formObjetivos(){
    	$obj= new Zend_Form_Element_Textarea('objetivo');
    	$obj->setLabel('Objetivo:')
		    	->addFilter('StripTags')
    			->setAttrib('rows', 2)
    			->setAttrib('cols', 30)
		    	->addDecorator('HtmlTag',
						array('tag'=>'div', 'class'=>'campoTextArea')				
    					);
    	$this->addElements(array($obj));
    }
    
    public function formHorarioDisp(){
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
    }
}

