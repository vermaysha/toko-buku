<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CategoryModel extends CI_Model
{
	public function isExist($permalink) {
		return $this->db->select('id')
						->where('permalink', $permalink)
						->get('category')
						->num_rows() > 0;
	}
	
	public function checkById($id) {
		return $this->db->select('id')
						->where('id', $id)
						->get('category')
						->num_rows() > 0;
	}
	
	public function save($name, $permalink) {
		return $this->db->insert('category', [
			'name' => $name,
			'permalink' => $permalink,
			'created_at' => date('Y-m-d H:i:s')
		]);
	}
	
	public function delete($id) {
		return $this->db->where('id', $id)->delete('category');
	}
	
	public function getAll($offset = null, $limit = null) {
		$limitStr = null;
		if ( ! is_null($limit) && ! is_null($offset) ) {
			$limitStr = "LIMIT $offset,$limit";
		}
		return $this->db->query("SELECT `category`.`id`, `category`.`name`, `category`.`permalink`, " .
						" (SELECT COUNT(`id`) FROM `books` WHERE `books`.`id_category` = `category`.`id` ) AS `total_books`" .
						" FROM `category` $limitStr")->result();
	}
	
	public function getById($id) {
		return $this->db->query("SELECT `category`.`id`, `category`.`name`, `category`.`permalink`, " .
						" (SELECT COUNT(`id`) FROM `books` WHERE `books`.`id_category` = `category`.`id` ) AS `total_books`" .
						" WHERE `category`.`id` = $this->db->escape($id) " .
						" FROM `category`")->row();
	}
}
