<?php

class Application_Form_User extends Zend_Form
{

	public function init() {
		$this->setName('user'); 
		$id = new Zend_Form_Element_Hidden('id');
		$id->addFilter('Int');
		$name = new Zend_Form_Element_Text('name'); 
		$name->setLabel('Nome de usuário')
			->setRequired(true) 
			->addFilter('StripTags') 
			->addFilter('StringTrim') 
			->addValidator('NotEmpty');
		$email = new Zend_Form_Element_Text('email'); 
		$email->setLabel('e-Mail')
			->setRequired(true) 
			->addFilter('StripTags') 
			->addFilter('StringTrim') 
			->addValidator('NotEmpty');
		$password = new Zend_Form_Element_Password('password');
		$password->setLabel('Senha')
			->setRequired(true)
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->addValidator('NotEmpty');
		$confirm = new Zend_Form_Element_Password('confirm');
		$confirm->setLabel('Confirma senha')
			->setRequired(true)
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->addValidator('NotEmpty');
		$type = new Zend_Form_Element_Password('type');
		$type->setLabel('Tipo de usuário')
			->setRequired(true)
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->addValidator('NotEmpty');
		
		$submit = new Zend_Form_Element_Submit('submit'); $submit->setAttrib('id', 'submitbutton');
		$this->addElements(array($id, $name, $email, $password, $confirm, $type, $submit));
	}
}

