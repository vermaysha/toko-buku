<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	
	/**
	 * Index page
	 *
	 * @return void
	 */
	public function index() {
		if ($this->authentication->isAuthenticated()) {
			redirect('dashboard');
		}
		redirect('login');
	}
	
	/**
	 * Login page
	 *
	 * @return void
	 */
	public function login() {
		if ($this->authentication->isAuthenticated()) {
			redirect('dashboard');
		}
		
		// if button login clicked
		if ($this->input->post('login')) {
			// Validate the user input
			$this->load->library('form_validation');
			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('password', 'Password','required');
			
			// Execute program when validation is success
			if ($this->form_validation->run()) {
				$username = $this->input->post('username');
				$password = $this->input->post('password');
				
				if (empty($users = $this->usersModel->getUser($username))) {
					$error = 'Username not exists !';
				} else if ( ! password_verify($password, $users->password)) {
					$error = 'Password wrong !';
				} else {
					$this->usersModel->updateLastLogin($username);
					$this->authentication->create($username, $users->id);
					redirect('dashboard');
				}
			}
		}
		
		
		$this->template->setArgs([
			'error' => isset($error) ? $error : null,
			'success' => $this->session->flashdata('success')
		]);
		$this->template->display('layouts/auth', 'auth/login');
	}
	
	/**
	 * Register page
	 *
	 * @return void
	 */
	public function register() {
		if ($this->authentication->isAuthenticated()) {
			redirect('dashboard');
		}
		
		if ($this->input->post('register')) {
			// Validate the user input
			$this->load->library('form_validation');
			$this->form_validation->set_rules('fullname', 'fullname', 'required');
			$this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]|min_length[5]|alpha_dash', 
				['is_unique' => 'Username exists !']);
			$this->form_validation->set_rules('password', 'Password','required|min_length[8]');
			$this->form_validation->set_rules('retype_password', 'Retype Password', 'required|matches[password]');
			$this->form_validation->set_rules('term', 'Term', 'required');
			
			// Execute program when validation is success
			if ($this->form_validation->run()) {
				$fullname = $this->input->post('fullname');
				$username = $this->input->post('username');
				$password = $this->input->post('password');
				
				$this->usersModel->insert($username, $password, ['fullname' => $fullname]);
				
				$this->session->set_flashdata('success', 'Register success, please login !');
				redirect('login');
			}
		}
		
		$this->template->setArgs([
			'error' => $this->session->flashdata('error')
		]);
		$this->template->display('layouts/auth', 'auth/register');
	}
	
	public function logout() {
		if ( ! $this->authentication->isAuthenticated()) {
			redirect('login');
		}
		$this->authentication->destroyAuth();
		redirect('login');
	}
}
