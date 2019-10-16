<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class settingsModel extends CI_Model
{
	/**
	 * Variable to save the settings
	 *
	 * @param Array
	 */
	private $_savedSettings = [];
	
	public function __constructor() {
		parent::__constructor();
		
		$settings = $meta = $this->db->select('setting_val')
						 ->where('setting_key', $key)
						 ->where('autoload', 1)
						 ->get('settings')
						 ->result();
		
		foreach ($settings as $key => $val) {
			$this->_savedSettings[$key] = $val;
		}
	}
	
	/**
	 * Get users meta data
	 * 
	 * @param $key Meta Key
	 * @return String|Integer|Float
	 */
	public function get($key) {
		if (isset($this->_savedSettings[$key])) {
			return $this->_savedSettings[$key];
		}
		
		$meta = $this->db->select('setting_val')
						 ->where('setting_key', $key)
						 ->get('settings')
						 ->row();
						 
		return $this->_savedSettings[$key] = $meta->setting_val;
	}
}
