<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

	public function index()
	{
		if ( ! $this->authentication->isAuthenticated()) {
			redirect('login');
		}
		
		$this->template->display('layouts/dashboard', 'products/manage');
	}
	
	public function add_new() {
		$this->template->display('layouts/dashboard', 'products/add-new');
	}
}
