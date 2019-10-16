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
	 * @param $key Key
	 * @param $val Value
	 * @return Bool
	 */
	public function setArgs($key, $val) {
		$this->_args[$key] = $val;
		return true;
	}
	
	/**
	 * Display Template Master
	 *
	 * @return void
	 */
	public function display($template, $section) {
		$_args['contents'] = $this->load->view($section, $this->_args, true);
		return $this->_ci->load->view($template, array_merge($_args, $this->_args));
	}
}
