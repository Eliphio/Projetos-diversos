<?php

class Application_Model_User
{	
	public function getUser($id = 1) {
		$id = (int)$id;
		$user = new Application_Model_DbTable_User();
		$row = $user->fetchRow('id = ' . $id);
		print_r($row);
		break;
		if (!$row) {
			throw new Exception("C—digo n‹o encontrado: $id!");
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