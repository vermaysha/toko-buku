<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BooksModel extends CI_Model
{
	public function save($data) {
		$this->db->insert('books', $data);
		
		return $this->db->insert_id();
	}
	
	public function getById($id) {
		return $this->db->where('id', $id)->get('books')->row();
	}
	
	public function update($data, $id) {
		return $this->db->where('id', $id)->update('books', $data);
	}
	
	public function delete($id) {
		return $this->db->where('id', $id)->delete('books');
	}
	
	public function getAll($offset = null, $limit = null) {
		$this->db->select('books.id as id_book,books.title,books.publisher,books.author,category.name,media.path');
		$this->db->from('books');
		$this->db->join('category', 'category.id=books.category', 'inner');
		$this->db->join('media', 'media.id=books.photos', 'inner');
		if ( ! empty($limit)) {
			$this->db->limit($limit, $offset);
		}
		return $this->db->get()->result();
	}
}
