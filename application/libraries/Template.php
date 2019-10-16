<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template 
{
	/**
	 * Instanced CI
	 *
	 * @param object
	 */
	private $_ci = null;
	
	/**
	 * Arguments
	 *
	 * @param object
	 */
	private $_args = [];
	
	/**
	 * Class Constructor
	 *
	 * @return void
	 */
	public function __construct() {
		$this->_ci =& get_instance();
	}
	
	/**
	 * Set Template Args
	 *
	 * @param $arr 
	 * @return Bool
	 */
	public function setArgs($arr) {
		foreach ($arr as $key => $val) {
			$this->_args[$key] = $val;
		}
		return true;
	}
	
	/**
	 * Display Template Master
	 *
	 * @return void
	 */
	public function display($template, $section) {
		$_args['contents'] = $this->_ci->load->view($section, $this->_args, true);
		return $this->_ci->load->view($template, array_merge($_args, $this->_args));
	}
}
