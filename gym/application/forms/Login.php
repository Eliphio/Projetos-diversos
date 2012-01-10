<?php

class Application_Form_Login extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
		$this->setName('login'); 
		$username = new Zend_Form_Element_Text('username'); 
		$username->setLabel('Usuário')->setRequired(true) ->addFilter('StripTags') ->addFilter('StringTrim') ->addValidator('NotEmpty');
		$password = new Zend_Form_Element_Password('password'); 
		$password->setLabel('Senha')->setRequired(true) ->addFilter('StripTags') ->addFilter('StringTrim') ->addValidator('NotEmpty');
		$submit = new Zend_Form_Element_Submit('submit'); 
		$submit->setAttrib('id', 'submitbutton');
		$this->addElements(array($username, $password, $submit));  
    }


}