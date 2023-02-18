<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Eerror_404 extends Front_Controller {

	public function index()
	{
		$this->data['hideBanner'] = true;
		header("HTTP/1.0 404 Not Found");
		$this->data['page_title'] = '404 Page Not Found';
		$this->display_template('error_404', $this->data);
	}
}
