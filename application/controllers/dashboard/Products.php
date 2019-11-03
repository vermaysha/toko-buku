<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		
		$this->load->model('booksModel');
		if ( ! $this->authentication->isAuthenticated()) {
			redirect('login');
		}
	}

	public function index()
	{		
		$args['success'] = $this->session->flashdata('success');
		$args['products'] = $this->booksModel->getAll();
		$this->template->setArgs($args);
		$this->template->display('layouts/dashboard', 'products/manage');
	}
	
	public function edit($id = null) {
		if (empty($id)) {
			redirect('dashboard/products');
		}
		
		if ($this->input->post('edit')) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('title', 'Judul Buku', 'required');
			$this->form_validation->set_rules('publisher', 'Penerbit', 'required');
			$this->form_validation->set_rules('author', 'Penulis', 'required');
			$this->form_validation->set_rules('category', 'Kategori Buku', 'required');
			$this->form_validation->set_rules('price', 'Harga Buku', 'required');
			$this->form_validation->set_rules('synopsis', 'Sinopsis','required');
			$this->form_validation->set_rules('details', 'Details','required');
			
			
			if ($this->form_validation->run()) {
				if ( ! empty($_FILES['photos']['name'])) {
					// Upload photos first
					$path = FCPATH . '/uploads/' . date('Y/m/d');
					if (!file_exists($path)) {
						mkdir($path, 0755, true);
					}

					$this->load->library('upload', [
						'upload_path' => $path,
						'allowed_types' => 'gif|jpg|png',
						'max_size'     => 1024 * 20,
						'max_filename' => 200,
						'file_ext_tolower' => true,
						'remove_spaces' => true,
						'detect_mime' => true,
						'mod_mime_fix' => false
					]);
					if ($this->upload->do_upload('photos')) {
	                	$imageData = $this->upload->data();
						$this->load->library('image_lib');
						foreach ([60, 128, 256] as $size) {
							$this->image_lib->initialize([
			                	'image_library' => 'gd2',
								'source_image' => $imageData['full_path'],
								// 'create_thumb' => TRUE,
								'maintain_ratio' => false,
								'width'         => $size,
								'height'       => $size,
								'new_image' => $imageData['raw_name'] . '-'.$size.'x'.$size . $imageData['file_ext'],
		                	]);
							$this->image_lib->resize();
							$this->image_lib->clear();
						}
	                	$this->load->model('mediaModel');
	                	$idPhotos = $this->mediaModel->save($imageData);
	                	$books = [
	                		'title'  => $this->input->post('title'),
	                		'publisher'  => $this->input->post('publisher'),
	                		'author'  => $this->input->post('author'),
	                		'price'  => $this->input->post('price'),
	                		'synopsis'  => $this->input->post('synopsis'),
	                		'details'  => $this->input->post('details'),
	                		'photos' => $idPhotos,
	                		'category' => $this->input->post('category')
	                	];
	                	$this->booksModel->update($books, $id);
	                	$this->session->set_flashdata('success', 'Buku telah diubah');
	                	redirect('dashboard/products');
	                } else {
	                	$errors = $this->upload->display_errors();
	                }
				} else {
					$books = [
                		'title'  => $this->input->post('title'),
                		'publisher'  => $this->input->post('publisher'),
                		'author'  => $this->input->post('author'),
                		'price'  => $this->input->post('price'),
                		'synopsis'  => $this->input->post('synopsis'),
                		'details'  => $this->input->post('details'),
                		'category' => $this->input->post('category')
                	];
                	$this->booksModel->update($books, $id);
                	$this->session->set_flashdata('success', 'Buku telah diubah');
                	redirect('dashboard/products');
				}
			}
		}
		
		$this->load->model('categoryModel');
		$data['category'] = $this->categoryModel->getAll();
		$data['errors'] = empty($errors) ? null: $errors;
		$data['product'] = $this->booksModel->getById($id);
		$this->template->setArgs($data);
		$this->template->display('layouts/dashboard', 'products/edit');
	}
	
	public function add_new() {
		if ($this->input->post('add')) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('title', 'Judul Buku', 'required');
			$this->form_validation->set_rules('publisher', 'Penerbit', 'required');
			$this->form_validation->set_rules('author', 'Penulis', 'required');
			$this->form_validation->set_rules('category', 'Kategori Buku', 'required');
			$this->form_validation->set_rules('price', 'Harga Buku', 'required');
			$this->form_validation->set_rules('synopsis', 'Sinopsis','required');
			$this->form_validation->set_rules('details', 'Details','required');
			if (empty($_FILES['photos']['name']))
			{
			    $this->form_validation->set_rules('photos', 'Foto Buku', 'required');
			}
			
			if ($this->form_validation->run()) {
				// Upload photos first
				$path = FCPATH . '/uploads/' . date('Y/m/d');
				if (!file_exists($path)) {
					mkdir($path, 0755, true);
				}

				$this->load->library('upload', [
					'upload_path' => $path,
					'allowed_types' => 'gif|jpg|png',
					'max_size'     => 1024 * 20,
					'max_filename' => 200,
					'file_ext_tolower' => true,
					'remove_spaces' => true,
					'detect_mime' => true,
					'mod_mime_fix' => false
				]);
				if ($this->upload->do_upload('photos')) {
                	$imageData = $this->upload->data();
					$this->load->library('image_lib');
					foreach ([60, 128, 256] as $size) {
						$this->image_lib->initialize([
		                	'image_library' => 'gd2',
							'source_image' => $imageData['full_path'],
							// 'create_thumb' => TRUE,
							'maintain_ratio' => false,
							'width'         => $size,
							'height'       => $size,
							'new_image' => $imageData['raw_name'] . '-'.$size.'x'.$size . $imageData['file_ext'],
	                	]);
						$this->image_lib->resize();
						$this->image_lib->clear();
					}
                	$this->load->model('mediaModel');
                	$idPhotos = $this->mediaModel->save($imageData);
                	$books = [
                		'title'  => $this->input->post('title'),
                		'publisher'  => $this->input->post('publisher'),
                		'author'  => $this->input->post('author'),
                		'price'  => $this->input->post('price'),
                		'synopsis'  => $this->input->post('synopsis'),
                		'details'  => $this->input->post('details'),
                		'photos' => $idPhotos,
                		'category' => $this->input->post('category')
                	];
                	$this->booksModel->save($books);
                	$this->session->set_flashdata('success', 'Buku telah ditambahkan');
                	redirect('dashboard/products');
                } else {
                	$errors = $this->upload->display_errors();
                }
			}
		}
		
		$this->load->model('categoryModel');
		$data['category'] = $this->categoryModel->getAll();
		$data['errors'] = empty($errors) ? null: $errors;
		$this->template->setArgs($data);
		$this->template->display('layouts/dashboard', 'products/add-new');
	}
}
