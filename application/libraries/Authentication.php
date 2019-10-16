<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authentication
{
	/**
	 * Instanced CI
	 *
	 * @param object
	 */
	private $_ci = null;
	
	/**
	 * Class Constructor
	 *
	 * @return void
	 */
	public function __construct() {
		$this->_ci =& get_instance();
	}
	
	/**
	 * Check that user is authenticated ?
	 *
	 * @return Bool
	 */
	public function isAuthenticated() {
		return $this->_ci->session->has_userdata('username') && 
			   $this->_ci->session->has_userdata('id');
	}
	
	/**
	 * Create new user session
	 *
	 * @param $username Username
	 * @param $id 		ID
	 * @return Bool
	 */
	public function create($username, $id) {
		return $this->_ci->session->set_userdata('username', $username) &&
			   $this->_ci->session->set_userdata('id', $id);
	}
	
	/**
	 * Destroy the auth session
	 *
	 * @return Bool
	 */
	public function destroyAuth() {
		$this->_ci->sesison->sess_destroy();
		return true;
	}
	
	/**
	 * Get Username from authenticated User
	 *
	 * @return String
	 */
	public function getUsername() {
		return $this->_ci->session->userdata('username');
	}
	
	/**
	 * Get ID from authenticated User
	 *
	 * @return Int
	 */
	public function getId() {
		return $this->_ci->session->userdata('id');
	}
	
	/**
	 * Get Role from authenticated User
	 *
	 * @return string
	 */
	public function getRole() {
		return $this->_ci->usersModel->getUser($this->_ci->session->userdata('username'))->level;
	}
	
	/**
	 * Get users meta data from authenticated User
	 * 
	 * @param $key Meta Key
	 * @return String|Integer|Float
	 */
	public function getMeta($key) {
		return $this->_ci->usersModel->getMeta($key);
	}
}
