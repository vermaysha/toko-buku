<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('usersModel');
		
		if ( ! $this->authentication->isAuthenticated()) {
			redirect('login');
		}
	}

	public function index() {
		$this->template->setArgs([
			'success' => $this->session->flashdata('success'),
			'users' => $this->usersModel->getAll()
		]);
		$this->template->display('layouts/dashboard', 'users/manage');
	}
	
	public function add_new() {
		if ($this->input->post('create')) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('fullname', 'Nama Lengkap', 'trim|required');
			$this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[users.username]|alpha_dash|min_length[5]');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
			$this->form_validation->set_rules('born_date', 'Tanggal Lahir', 'trim|required');
			$this->form_validation->set_rules('gender', 'Jenis Kelamin', 'trim|required|in_list[male,female,other]');
			$this->form_validation->set_rules('role', 'Role', 'trim|required|in_list[user,admin]');
			if (empty($_FILES['photos']['name'])) {
			    $this->form_validation->set_rules('photos', 'Foto', 'required');
			}
			
			if ($this->form_validation->run()) {
				// Upload photos first
				$path = FCPATH . '/uploads/photos/';
				if (!file_exists($path)) {
					mkdir($path, 0755, true);
				}

				$this->load->library('upload', [
					'upload_path'      => $path,
					'file_name'        => $this->input->post('username'),
					'allowed_types'    => 'gif|jpg|png|jpeg',
					'max_size'         => 1024 * 20,
					'file_ext_tolower' => true,
					'remove_spaces'    => true,
					'detect_mime'      => true,
					'mod_mime_fix'     => false,
					'overwrite'        => true
				]);

				if ($this->upload->do_upload('photos')) {
                	$imageData = $this->upload->data();
					$this->load->library('image_lib');
					foreach ([60, 128, 256] as $size) {
						$this->image_lib->initialize([
		                	'image_library' => 'gd2',
							'source_image' => $imageData['full_path'],
							'maintain_ratio' => false,
							'width'         => $size,
							'height'       => $size,
							'new_image' => $imageData['raw_name'] . '-'.$size.'x'.$size . $imageData['file_ext'],
	                	]);
						$this->image_lib->resize();
						$this->image_lib->clear();
					}
					$this->usersModel->insert(
						$this->input->post('username'),
						$this->input->post('password'),
						$this->input->post('role'),
						[
							'fullname'  => $this->input->post('fullname'),
							'email'     => $this->input->post('email'),
							'born_date' => $this->input->post('born_date'),
							'gender'    => $this->input->post('gender'),
							'photos'    => $imageData['file_name']
						]
					);
					$this->session->set_flashdata('success', 'User telah ditambahkan !');
					redirect('dashboard/users');
				} else {
                	$errors = $this->upload->display_errors();
				}
			}
		}
		$this->template->setArgs([
			'errors' => empty($errors) ? null : $errors
		]);
		$this->template->display('layouts/dashboard', 'users/add-new');
	}
	
	public function edit($id = null) {
		if (empty($id)) {
			redirect('dashboard/products');
		}
		
		if ($this->input->post('edit')) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('fullname', 'Nama Lengkap', 'trim|required');
			$this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[users.username]|alpha_dash|min_length[5]');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
			if ($this->input->post('password')) {
				$this->form_validation->set_rules('password', 'Password', 'trim|min_length[8]');
			}
			$this->form_validation->set_rules('born_date', 'Tanggal Lahir', 'trim|required');
			$this->form_validation->set_rules('gender', 'Jenis Kelamin', 'trim|required|in_list[male,female,other]');
			$this->form_validation->set_rules('role', 'Role', 'trim|required|in_list[user,admin]');
						
			if ($this->form_validation->run()) {
				if (empty($_FILES['photos']['name'])) {
					
					// Upload photos first
					$path = FCPATH . '/uploads/photos/';
					if (!file_exists($path)) {
						mkdir($path, 0755, true);
					}

					$this->load->library('upload', [
						'upload_path'      => $path,
						'file_name'        => $this->input->post('username'),
						'allowed_types'    => 'gif|jpg|png|jpeg',
						'max_size'         => 1024 * 20,
						'file_ext_tolower' => true,
						'remove_spaces'    => true,
						'detect_mime'      => true,
						'mod_mime_fix'     => false,
						'overwrite'        => true
					]);

					if ($this->upload->do_upload('photos')) {
	                	$imageData = $this->upload->data();
						$this->load->library('image_lib');
						foreach ([60, 128, 256] as $size) {
							$this->image_lib->initialize([
			                	'image_library' => 'gd2',
								'source_image' => $imageData['full_path'],
								'maintain_ratio' => false,
								'width'         => $size,
								'height'       => $size,
								'new_image' => $imageData['raw_name'] . '-'.$size.'x'.$size . $imageData['file_ext'],
		                	]);
							$this->image_lib->resize();
							$this->image_lib->clear();
						}
						$this->usersModel->update(
							$this->input->post('username'),
							$this->input->post('password'),
							$this->input->post('role'),
							[
								'fullname'  => $this->input->post('fullname'),
								'email'     => $this->input->post('email'),
								'born_date' => $this->input->post('born_date'),
								'gender'    => $this->input->post('gender'),
								'photos'    => $imageData['file_name']
							], $id
						);
						// $this->session->set_flashdata('success', 'User telah diubah !');
						// redirect('dashboard/users');
					} else {
	                	$errors = $this->upload->display_errors();
					}
				} else {
					$this->usersModel->update(
						$this->input->post('username'),
						$this->input->post('password'),
						$this->input->post('role'),
						[
							'fullname'  => $this->input->post('fullname'),
							'email'     => $this->input->post('email'),
							'born_date' => $this->input->post('born_date'),
							'gender'    => $this->input->post('gender')
						], $id
					);
					// $this->session->set_flashdata('success', 'User telah diubah !');
					// redirect('dashboard/users');
				}
			}
		}
		$this->template->setArgs([
			'errors' => empty($errors) ? null : $errors,
			'user' => $this->usersModel->getById($id)
		]);
		$this->template->display('layouts/dashboard', 'users/edit');
	}
	
}

/* End of file Users.php */
/* Location: ./application/controllers/dashboard/Users.php */
