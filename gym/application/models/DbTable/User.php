<?php

class Application_Model_DbTable_User extends Zend_Db_Table_Abstract
{

    protected $_name = 'users';
	
	public function getUser($id) {
		$id = (int)$id;
		$row = $this->fetchRow('id = ' . $id);
		if (!$row) {
			throw new Exception("Código não encontrado: $id!");
		}
		return $row->toArray();
	}
	
	public function addUser($name, $email, $password, $type) {
		$data = array (
			'name' => $name,
			'email' => $email,
			'password' => $password,
			'type' => $type,
			'created_at' => date()
		);
		$this->insert($data);
	}
	
	public function updateUser($id, $name, $email, $password, $type) {
		$data = array (
			'name' => $name,
			'email' => $email,
			'password' => $password,
			'type' => $type,
			'updated_at' => date()
		);
		$this->update($data, 'id = ' . (int)$id);		
	}
	
	public function deleteUser($id) {
		$this->delete('id = ' . $id);
	} 
}

