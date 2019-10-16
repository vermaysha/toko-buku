<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	
	public function index() {
		if ( ! $this->authentication->isAuthenticated()) {
			redirect('auth/login');
		}
	}
	
	public function login() {
		
	}
}
