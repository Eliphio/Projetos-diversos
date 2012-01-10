<?php

class UsersController extends Zend_Controller_Action
{

    public function preDispatch()
    {
		//Autentica‹o
		if ( !Zend_Auth::getInstance()->hasIdentity() ) {
        	return $this->_helper->redirector->goToRoute(array('controller' => 'auth'), null, true);
		}		
    }

	private $_model;

    public function init()
    {
        /* Initialize action controller here */
       // Zend_Loader::loadClass('Application_Model_User');
       
       	$user = new Application_Model_User();
    }

    public function indexAction()
    {
        // action body
        try {
       		$user = new Application_Model_DbTable_User(); 
	       	echo "droga ".$user->getUser(10);
			break;
		} catch (exception $e) {
			echo $e->getMessage();
		} 
    }

    public function addAction()
    {
        // action body
        $form = new Application_Form_User();
		$form->submit->setLabel('Cadastrar');
		$this->view->form = $form;
    }

    public function editAction()
    {
        // action body
    }

    public function deleteAction()
    {
        // action body
    }


}




