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
						 
		return $this->_savedUsersMeta[$id][$key] = $meta->meta_key;
	}
	
	/**
	 * Get user data by username
	 *
	 * @param $username Username
	 * @return Object
	 */
	public function getUser($username) {
		return $this->db->select(['password', 'level', 'last_activity', 'remember_token'])
						->where('username', $username)
						->get('users')
						->row();
	}
}
