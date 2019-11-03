<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MediaModel extends CI_Model
{
	public function save($data) {
		$this->db->insert('media', [
			'name' => $data['file_name'],
			'orig_name' => $data['orig_name'],
			'path' => substr($data['full_path'], strlen(FCPATH)),
			'type' => $data['file_type'],
			'size' => $data['file_size'],
			'height' => $data['image_height'],
			'width' => $data['image_width'],
			'uploaded_at' => date('Y-m-d H:i:s')
		]);
		
		return $this->db->insert_id();
	}
}
