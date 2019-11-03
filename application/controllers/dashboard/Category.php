<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('categoryModel');
		
		if ( ! $this->authentication->isAuthenticated()) {
			redirect('login');
		}
	}

	public function index()
	{
		if ( ! $this->authentication->isAuthenticated()) {
			redirect('login');
		}
		
		$page = empty($_page = $this->input->get('page')) ? 1 : $_page;
		$per_page = 5;
		$limit = 5;
		
		$this->load->library('pagination');
		$config['base_url'] = base_url('dashboard/category');
		$config['total_rows'] = $this->categoryModel->db->get('category')->num_rows();
		$config['per_page'] = $per_page;
		$config['page_query_string'] = true;
		$config['query_string_segment'] = 'page';
		$config['use_page_numbers'] = true;
		$config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
		$config['full_tag_close'] = '</ul>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$this->pagination->initialize($config);
		
		$categories = $this->categoryModel->getAll(($page - 1) * $limit, $limit);
		
		$this->template->setArgs([
			'category' => $categories,
			'success' => $this->session->flashdata('success'),
			'error' => $this->session->flashdata('error'),
			'pagination' => $this->pagination->create_links()
		]);
		
		$this->template->display('layouts/dashboard', 'category/manage');
	}
	
	public function add_new() {
		if ( ! empty($this->input->post('create'))) {
			// Validate the user input
			$this->load->library('form_validation');
			$this->form_validation->set_rules('category', 'Nama', 'required');
			$this->form_validation->set_rules('permalink', 'Tajuk','alpha_dash');
			
			// Execute program when validation is success
			if ($this->form_validation->run()) {
				$category = $this->input->post('category');
				$permalink = $this->input->post('permalink');
				
				if (empty($permalink)) {
					$permalink = url_title($category, '-', true);
				}
				
				do {
					$this->load->helper('string');
					$permalink = increment_string($permalink, '-');
				} while ($this->categoryModel->isExist($permalink));
				
				$this->categoryModel->save($category, $permalink);
				$this->session->set_flashdata('success', 'Kategori telah ditambahkan !');
				redirect('dashboard/category');
			}
		}
		
		$this->template->display('layouts/dashboard', 'category/add-new');
	}
	
	public function delete($id = null) {
		if (empty($id)) {
			redirect('dashboard/category');
		}
		
		if ( ! $this->categoryModel->checkById($id)) {
			$this->session->set_flashdata('error', 'Kategori tidak ditemukan untuk dihapus !');
			redirect('dashboard/category');
		}

		if ($this->categoryModel->getById($id)->total_posts > 0) {
			$this->session->set_flashdata('error', 'Kategori memiliki isi !, tidak bisa dihapus !.');
			redirect('dashboard/category');
		}
		
		$this->categoryModel->delete($id);
		$this->session->set_flashdata('success', 'Kategori telah dihapus !');
		redirect('dashboard/category');
	}
}
