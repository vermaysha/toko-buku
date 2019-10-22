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

if ( ! function_exists('site_info')) {
	function site_info($setting) {
		$ci =& get_instance();
		return $ci->settingsModel->get($setting);
	}
}

if ( ! function_exists('active_sidebar')) {
	function active_sidebar($name) {
		$url = substr(current_url(), strlen(base_url()));
		$urlArray = explode('/', $url);
		return isset($urlArray[1]) && $urlArray[1] == $name ? 'active' : null;
	}
}
