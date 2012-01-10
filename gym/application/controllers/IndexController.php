<?php

class IndexController extends Zend_Controller_Action
{
	function preDispatch()
	{
		//Autenticação
		if ( !Zend_Auth::getInstance()->hasIdentity() ) {
        	return $this->_helper->redirector->goToRoute(array('controller' => 'auth'), null, true);
    	}
	}
	
	function init()                
	{
		$this->initView();                        
		$this->view->baseUrl = $this->_request->getBaseUrl();                        
		$user = Zend_Auth::getInstance()->getIdentity();                               
		Zend_Loader::loadClass('Zend_Session');	
		$USUARIO = new Zend_Session_Namespace('USUARIO');
		$this->view->usuario = $USUARIO->nome;
	}
	
    public function indexAction()
    {
        // action body
	}


}

