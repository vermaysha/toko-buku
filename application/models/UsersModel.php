<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UsersModel extends CI_Model
{
	/**
	 * Variable to save the users meta
	 *
	 * @param Array
	 */
	private $_savedUsersMeta = [];
	
	/**
	 * Get users meta data
	 * 
	 * @param $id User ID
	 * @param $key Meta Key
	 * @return String|Integer|Float
	 */
	public function getMeta($id, $key) {
		if (isset($this->_savedUsersMeta[$id][$key])) {
			return $this->_savedUsersMeta[$id][$key];
		}
		
		$meta = $this->db->select('meta_value')
						 ->where('id', $id)
						 ->where('meta_key', $key)
						 ->get('users_meta')
						 ->row();
						 
		return $this->_savedUsersMeta[$id][$key] = $meta->meta_value;
	}
	
	/**
	 * Get user data by username
	 *
	 * @param $username Username
	 * @return Object
	 */
	public function getUser($username) {
		return $this->db->where('username', $username)
						->get('users')
						->row();
	}
	
	public function insert($username, $password, $data = []) {
		$status = $this->db->insert('users', [
			'username' => $username,
			'password' => password_hash($password, PASSWORD_ARGON2I),
			'level' => 'user'
		]);
		
		$userId = $this->db->insert_id();
		
		$meta = [];
		foreach ($data as $key => $val) {
			$meta[] = [
				'meta_key' => $key,
				'meta_value' => $val,
				'id_user' => $userId
			];
		}
		
		return $status && $this->db->insert_batch('users_meta', $meta);
	}
	
	public function updateLastLogin($username) {
		return $this->db->set('last_login', date('Y-m-d H:i:s'))->where('username', $username)->update('users');
	}
}
