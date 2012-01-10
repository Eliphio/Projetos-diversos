<?php

class AuthController extends Zend_Controller_Action
{
	function init()
	{
		//global $db;
		$this->initView();
		Zend_Loader::loadClass('Zend_Session_Namespace');
		//$this->view->baseUrl = $this->_request->getBaseUrl();
	}

	public function indexAction()
	{
	    return $this->_helper->redirector('login');
	}

	function loginAction() {
		$form = new Application_Form_Login();
		$form->submit->setLabel('Log in'); 
		$this->view->form = $form;
		/*	
		//Verifica chaves primárias e gera caso não exista, através das chaves definidas nos modelos
		//$this->_helper->redirector('index');
		if ($this->getRequest()->isPost())
		{
			// // collect the data from the user
			// Zend_Loader::loadClass('Zend_Filter_StripTags');
			$formData = $this->getRequest()->getPost(); 
 			if ($form->isValid($formData)) {
				$username = $form->getValue('username');
				$password = $form->getValue('password');
  				if (strtoupper($username) == 'GYM') {
					$data = array(
					'password'=>'=?;<:;;:**',
					'type'=>'1'
					);
					$data['name'] = 'GYM';
					$usuario = new Application_Model_DbTable_Users();
					$where = $usuario->fetchAll("name = 'GYM'");
					if (count($where) == 0)
						$usuario->insert($data);
				}
				// setup Zend_Auth adapter for a database table
				Zend_Loader::loadClass('Zend_Auth_Adapter_DbTable');
				// $db = Zend_Registry::get('db');
				$authAdapter = new Zend_Auth_Adapter_DbTable();
				echo "passou aqui";
				break;
				$authAdapter->setTableName('users');
				$authAdapter->setIdentityColumn('name');
				$authAdapter->setCredentialColumn('password');
				// Set the input credential values to authenticate against
				$authAdapter->setIdentity(strtoupper($username));
				$authAdapter->setCredential($this->inverteSenha(strtoupper($password)));
				// do the authentication
				$auth = Zend_Auth::getInstance();
				$result = $auth->authenticate($authAdapter);
				if ($result->isValid()) {
					// success: store database row to auth's storage
					// system. (Not the password though!)
					$data = $authAdapter->getResultRowObject(null,'password');
					$auth->getStorage()->write($data);
					//$EMPRESA = new Zend_Session_Namespace('EMPRESA');
					$USUARIO = new Zend_Session_Namespace('USUARIO');
					$USUARIO->nome = strtoupper($username);
					$this->_redirect('/');
					return;
				}
				$this->_redirect('/');
			} else {
				// failure: clear database row from session
				$this->view->message = 'Senha ou usuário incorreto.';				
				$form->populate($formData);
			}
		}
		 * */
		$this->_flashMessenger = $this->_helper->getHelper('FlashMessenger');
	    $this->view->messages = $this->_flashMessenger->getMessages();
	    if ( $this->getRequest()->isPost() ) {
	        $data = $this->getRequest()->getPost();
	        //Formulário corretamente preenchido?
	        if ( $form->isValid($data) ) {
	            $login = $form->getValue('username');
	            $senha = $form->getValue('password');
	            //Inicia o adaptador Zend_Auth para banco de dados
	            $options = array(
				    'host'     => '127.0.0.1',
				    'username' => 'root',
				    'password' => '',
				    'dbname'   => 'gym_development'
				);
				$db = Zend_Db::factory('PDO_MYSQL', $options);
				Zend_Db_Table_Abstract::setDefaultAdapter($db);
	            $dbAdapter = Zend_Db_Table::getDefaultAdapter($db);
	            $authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter); 
	            $authAdapter->setTableName('users')
	                        ->setIdentityColumn('name')
	                        ->setCredentialColumn('password');
	                        //->setCredentialTreatment('PASSWORD(?)');
	            //Define os dados para processar o login
	            $authAdapter->setIdentity(strtoupper($login))
	                        ->setCredential($this->inverteSenha($senha));
	            //Efetua o login
	            $auth = Zend_Auth::getInstance();
	            $result = $auth->authenticate($authAdapter);

 	            //Verifica se o login foi efetuado com sucesso
	            if ( $result->isValid() ) {
	                //Armazena os dados do usuário em sessão, apenas desconsiderando
	                //a senha do usuário
	                $info = $authAdapter->getResultRowObject(null, 'password');
	                $storage = $auth->getStorage();
	                $storage->write($info);
	                //Redireciona para o Controller protegido
	                return $this->_helper->redirector->goToRoute( array('controller' => 'index'), null, true);
	            } else {
	                //Dados inválidos
	                $this->_helper->FlashMessenger('Usuário ou senha inválidos!');
	                $this->_redirect('auth');
	            }
                $this->_helper->FlashMessenger('Usuário ou senha inválidos!');
                $this->_redirect('auth');
	        } else {
	            //Formulário preenchido de forma incorreta
	            $form->populate($data);
	        }		 		
		}
	}

	function logoutAction()
	{
		//Desloga
		$auth = Zend_Auth::getInstance();
	    $auth->clearIdentity();
	    return $this->_helper->redirector('index');
	}

	function inverteSenha($string)
	{
		$stringnova = NULL;
		$this->_helper->viewRenderer->setNoRender();
		for ($i = 0; $i < strlen($string); $i++)
		{
			$ascii_code = ord($string[$i]);
			$ascii_code += 10;
			$stringnova .= chr($ascii_code);
		}
		if (strlen($string)<10)
		{
			for ($i = 0; $i < (10-strlen($string)); $i++)
			{
				$stringnova .= "*";
			}
		}
		return $stringnova;
	}
}
