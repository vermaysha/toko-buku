<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('base_url')) {
	function base_url($url = '') {
		$ci =& get_instance();
		$use_https = (bool) $ci->settingsModel->get('use_https');
		$prefix = ($use_https) ? 'https://' : 'http://';
		
		return $prefix . $ci->settingsModel->get('site_url') . $url;
	}
}


if ( ! function_exists('asset_url')) {
	function asset_url($url = '') {
		return base_url('assets/' . $url);
	}
}

if ( ! function_exists('setting')) {
	function setting($setting) {
		$ci =& get_instance();
		return $ci->settingsModel->get($setting);
	}
}
